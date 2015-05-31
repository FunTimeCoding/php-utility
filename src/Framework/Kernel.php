<?php

namespace FunTimeCoding\PhpSkeleton\Framework;

use Exception;

class Kernel
{
    const EXIT_CODE_OK = 0;
    const EXIT_CODE_ERROR = 1;
    const PROJECT_ROOT_MARKER_FILE = 'README.md';
    private $exitCode = 0;

    public function __construct()
    {
        $this->exitCode = static::EXIT_CODE_OK;
    }

    /**
     * @return int
     */
    public function load()
    {
        return $this->exitCode;
    }

    /**
     * @return string
     *
     * @throws Exception
     */
    public function getProjectRoot()
    {
        $projectRoot = '';
        $currentDirectory = __DIR__;
        $foundRoot = false;

        while ($currentDirectory != '/') {
            $foundRoot = $this->isFileInDirectory(static::PROJECT_ROOT_MARKER_FILE, $currentDirectory);

            if ($foundRoot) {
                $projectRoot = $currentDirectory;
                break;
            }

            $currentDirectory = realpath($currentDirectory.DIRECTORY_SEPARATOR.'../');
        }

        if (!$foundRoot) {
            throw new Exception('Could not determine project root.');
        }

        return $projectRoot;
    }

    /**
     * @param string $fileName
     * @param string $directory
     *
     * @return bool
     */
    private function isFileInDirectory($fileName, $directory)
    {
        $result = false;
        $directoryContents = scandir($directory);

        foreach ($directoryContents as $element) {
            if ($element == $fileName) {
                $result = true;
                break;
            }
        }

        return $result;
    }
}
