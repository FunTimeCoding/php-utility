<?php

namespace FunTimeCoding\PhpUtility\Framework;

use Exception;

class Kernel
{
    const EXIT_CODE_OK = 0;
    const EXIT_CODE_ERROR = 1;
    const PROJECT_ROOT_MARKER_FILE = 'README.md';

    /**
     * @var int
     */
    private $exitCode = 0;

    public function __construct()
    {
        $this->exitCode = static::EXIT_CODE_OK;
    }

    public function load(): int
    {
        return $this->exitCode;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getProjectRoot(): string
    {
        $projectRoot = '';
        $currentDirectory = __DIR__;

        while ($currentDirectory != '/') {
            if ($this->isFileInDirectory(static::PROJECT_ROOT_MARKER_FILE, $currentDirectory)) {
                $projectRoot = $currentDirectory;
            }

            $currentDirectory = realpath($currentDirectory . DIRECTORY_SEPARATOR . '../');
        }

        if ($projectRoot == '') {
            throw new Exception('Could not determine project root.');
        }

        return $projectRoot;
    }

    private function isFileInDirectory(string $fileName, string $directory): bool
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
