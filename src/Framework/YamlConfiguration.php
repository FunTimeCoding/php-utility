<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Framework;

use Symfony\Component\Yaml\Parser;

class YamlConfiguration implements ConfigInterface
{
    /**
     * @var array
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
     * @return mixed Can be all the types YAML allows, like array. Empty string if not found.
     * @throws FrameworkException
     */
    public function getFromMultidimensionalArray(array $keys, array $heap)
    {
        $length = count($keys);
        $depth = 0;

        foreach ($keys as $key) {
            if (is_int($key) === false && is_string($key) === false) {
                throw new FrameworkException('Invalid key type.');
            }

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
     * @return mixed Can be all the types YAML allows, like array. Empty string if not found.
     */
    public function get(string $key)
    {
        if (array_key_exists($key, $this->configuration)) {
            return $this->configuration[$key];
        }

        return '';
    }

    /**
     * @return mixed Can be all the types YAML allows, like array. Empty string if not found.
     * @throws FrameworkException
     */
    public function getMultipleKeys(array $keys)
    {
        return $this->getFromMultidimensionalArray($keys, $this->configuration);
    }
}
