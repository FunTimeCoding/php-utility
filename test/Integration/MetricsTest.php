<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Integration;

use Exception;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class MetricsTest extends TestCase
{
    private static function isFile(SplFileInfo $file): bool
    {
        return $file->isFile();
    }

    private static function getFileName(SplFileInfo $file): string
    {
        return $file->getFilename();
    }

    private static function getPathName(SplFileInfo $file): string
    {
        return $file->getPathname();
    }

    /**
     * @return string[]
     */
    private static function collectFiles(string $testDirectory): array
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

    private static function endsWith(string $haystack, string $needle): bool
    {
        $length = strlen($needle);

        if ($length === 0) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }

    private static function startsWith(string $haystack, string $needle): bool
    {
        return strpos($haystack, $needle) === 0;
    }
}
