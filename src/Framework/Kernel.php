<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Framework;

class Kernel
{
    public const EXIT_CODE_OK = 0;
    public const PROJECT_ROOT_MARKER_FILE = 'README.md';

    /**
     * @var int
     */
    private $exitCode;

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
     * @throws FrameworkException
     */
    public function getProjectRoot(): string
    {
        $projectRoot = '';
        $currentDirectory = __DIR__;

        while ($currentDirectory !== DIRECTORY_SEPARATOR) {
            if ($this->isFileInDirectory(static::PROJECT_ROOT_MARKER_FILE, $currentDirectory)) {
                $projectRoot = $currentDirectory;
            }

            $pathToDetermine = $currentDirectory . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
            $currentDirectory = realpath($pathToDetermine);

            if ($currentDirectory === false) {
                throw new FrameworkException('Could not determine realpath: ' . $pathToDetermine);
            }
        }

        if ($projectRoot === '') {
            throw new FrameworkException('Could not determine project root.');
        }

        return $projectRoot;
    }

    /**
     * @param string $fileName
     * @param string $directory
     * @return bool
     * @throws FrameworkException
     */
    private function isFileInDirectory(string $fileName, string $directory): bool
    {
        $result = false;
        $directoryContents = scandir($directory);

        if ($directoryContents === false) {
            throw new FrameworkException('Could not scan directory: ' . $directory);
        }

        foreach ($directoryContents as $element) {
            if ($element === $fileName) {
                $result = true;
                break;
            }
        }

        return $result;
    }
}
