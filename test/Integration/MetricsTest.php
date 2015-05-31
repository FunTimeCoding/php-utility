<?php

namespace FunTimeCoding\PhpSkeleton\Test\Integration\LanguageExample;

use DirectoryIterator;
use FunTimeCoding\PhpSkeleton\Framework\Kernel;
use PHPUnit_Framework_TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class MetricsTest extends PHPUnit_Framework_TestCase
{
    public function testInheritanceCapitalization()
    {
        // Iterate over all *Test.php and find 'PHPUnit_Framework_Testcase', which do not get detected by phploc.
        // Note the lower case c in Testcase. It should be 'PHPUnit_Framework_TestCase'.

        $kernel = new Kernel();
        $testDirectory = $kernel->getProjectRoot().DIRECTORY_SEPARATOR.'test';
        $this->assertStringStartsWith('/', $testDirectory);

        $files = array();
        $directoryIterator = new RecursiveDirectoryIterator($testDirectory, RecursiveDirectoryIterator::SKIP_DOTS);
        $iteratorIterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iteratorIterator as $item) {
            /** @var DirectoryIterator $item */
            if ($item->isFile()) {
                $filename = $item->getFilename();
                if ($this->endsWith($filename, 'Test.php')) {
                    $files[] = $item->getPathname();
                }
            }
        }

        foreach ($files as $file) {
            $handle = fopen($file, 'r');

            if ($handle) {
                $found = false;
                while (($line = fgets($handle)) !== false) {
                    if ($this->startsWith($line, 'class ')) {
                        $found = true;
                        $line = trim($line);
                        $this->assertStringEndsWith(' extends PHPUnit_Framework_TestCase', $line);

                        break;
                    }
                }

                if (!$found) {
                    $this->fail('No line starts with \'class\' in '.$file);
                }

                fclose($handle);
            } else {
                $this->fail('Could not read '.$file);
            }
        }
    }

    public function endsWith($haystack, $needle)
    {
        $length = strlen($needle);

        if ($length == 0) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }

    public function startsWith($haystack, $needle)
    {
        $length = strlen($needle);

        return (substr($haystack, 0, $length) === $needle);
    }
}
