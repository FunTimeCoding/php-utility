<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Framework;

use Symfony\Component\Yaml\Parser;

class YamlConfiguration
{
    /**
     * @var array<string|array>
     */
    private $configuration;

    /**
     * @throws FrameworkException
     */
    public function __construct(string $filename)
    {
        $path = $this->expandTilde($filename);
        $content = file_get_contents($path);

        if ($content === false) {
            throw new FrameworkException('Could not read file: ' . $path);
        }

        $parser = new Parser();
        $this->configuration = $parser->parse($content);
    }

    public function expandTilde(string $path): string
    {
        if (function_exists('posix_getuid') && strpos($path, '~') !== false) {
            $info = posix_getpwuid(posix_getuid());
            $path = str_replace('~', $info['dir'], $path);
        }

        return $path;
    }

    /**
     * @param array<int, string> $keys
     * @param array<string, mixed> $heap
     * @return string|array<int, string> Empty string if not found.
     */
    public function getFromMultidimensionalArray(array $keys, array $heap)
    {
        $length = count($keys);
        $depth = 0;

        foreach ($keys as $key) {
            if (array_key_exists($key, $heap)) {
                if ($depth === $length) {
                    break;
                }

                $heap = $heap[$key];
            } else {
                return '';
            }

            ++$depth;
        }

        return $heap;
    }

    /**
     * @return string Empty string if not found.
     * @throws FrameworkException If found value is not a string.
     */
    public function getString(string $key): string
    {
        if (array_key_exists($key, $this->configuration)) {
            if (is_string($this->configuration[$key]) === false) {
                throw new FrameworkException('Key does not contain a string: ' . $key);
            }

            // TODO: Try to remove with new Phan version when AST is updated.
            /** @phan-suppress-next-line PhanPartialTypeMismatchReturn */
            return $this->configuration[$key];
        }

        return '';
    }

    /**
     * @return array<string, string> Empty array if not found.
     * @throws FrameworkException If found value is not an array.
     */
    public function getArray(string $key): array
    {
        if (array_key_exists($key, $this->configuration)) {
            if (is_array($this->configuration[$key]) === false) {
                throw new FrameworkException('Key does not contain an array: ' . $key);
            }

            // TODO: Try to remove with new Phan version when AST is updated.
            /** @phan-suppress-next-line PhanPartialTypeMismatchReturn */
            return $this->configuration[$key];
        }

        return [];
    }

    /**
     * @param array<int, string> $pathOfKeys
     * @return string Empty string if not found.
     * @throws FrameworkException If found value is not a string.
     */
    public function getStringDeep(array $pathOfKeys): string
    {
        $result = $this->getFromMultidimensionalArray($pathOfKeys, $this->configuration);

        if (is_string($result) === false) {
            throw new FrameworkException('Path of keys does not lead to a string: ' . join(',', $pathOfKeys));
        }

        return $result;
    }

    /**
     * @param array<int, string> $pathOfKeys
     * @return array<int, string> Empty array if not found.
     * @throws FrameworkException If found value is not an array.
     */
    public function getArrayDeep(array $pathOfKeys): array
    {
        $result = $this->getFromMultidimensionalArray($pathOfKeys, $this->configuration);

        if ($result == '') {
            $result = [];
        } elseif (is_array($result) === false) {
            throw new FrameworkException('Path of keys does not lead to an array: ' . join(',', $pathOfKeys));
        }

        return $result;
    }
}
