<?php
namespace FunTimeCoding\PhpUtility\Test\Integration;

use DirectoryIterator;
use Exception;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class MetricsTest extends TestCase
{
    public static function isFile(DirectoryIterator $iterator): bool
    {
        return $iterator->isFile();
    }

    public static function getFileName(DirectoryIterator $iterator): string
    {
        return $iterator->getFilename();
    }

    public static function getPathName(DirectoryIterator $iterator): string
    {
        return $iterator->getPathname();
    }

    /**
     * @param string $testDirectory
     * @return string[]
     */
    public static function collectFiles(string $testDirectory): array
    {
        $files = [];
        $iteratorIterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(
                $testDirectory,
                RecursiveDirectoryIterator::SKIP_DOTS
            ),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iteratorIterator as $item) {
            if (self::isFile($item)) {
                $filename = self::getFileName($item);

                if (self::endsWith($filename, 'Test.php')) {
                    $files[] = self::getPathName($item);
                }
            }
        }

        return $files;
    }

    /**
     * Find wrongly capitalized TestCase with a lower case c, which causes problems with phploc.
     * @throws Exception
     */
    public function testInheritanceCapitalization(): void
    {
        $testDirectory = '' . realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
        self::assertStringStartsWith('/', $testDirectory);
        self::assertEquals('test', basename($testDirectory));

        foreach (self::collectFiles($testDirectory) as $file) {
            $handle = fopen($file, 'rb');

            if ($handle !== false) {
                $found = false;

                while (($line = fgets($handle)) !== false) {
                    if (self::startsWith('' . $line, 'class ')) {
                        $found = true;
                        self::assertStringEndsWith(' extends TestCase', trim('' . $line));

                        break;
                    }
                }

                if ($found === false) {
                    self::fail('No line starts with \'class\' in ' . $file);
                }

                fclose($handle);
            } else {
                self::fail('Could not read ' . $file);
            }
        }
    }

    public static function endsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);

        if ($length === 0) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }

    public static function startsWith(string $haystack, string $needle): bool
    {
        return strpos($haystack, $needle) === 0;
    }
}
