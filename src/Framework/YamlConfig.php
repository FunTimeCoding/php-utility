<?php

namespace FunTimeCoding\PhpUtility\Framework;

use Exception;
use Symfony\Component\Yaml\Parser;

class YamlConfig implements ConfigInterface
{
    private $config = [];

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $path = $this->expandTilde($filename);
        $content = file_get_contents($path);
        $parser = new Parser();
        $this->config = $parser->parse($content);
    }

    /**
     * @param string $path
     *
     * @return string
     */
    public function expandTilde(string $path): string
    {
        if (function_exists('posix_getuid') && strpos($path, '~') !== false) {
            $info = posix_getpwuid(posix_getuid());
            $path = str_replace('~', $info['dir'], $path);
        }

        return (string)$path;
    }

    /**
     * @param array $keys
     * @param array $heap
     *
     * @return mixed Can be all the types YAML allows, like array. Empty string if not found.
     *
     * @throws Exception
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
     * @param string|array $key
     *
     * @return mixed Can be all the types YAML allows, like array. Empty string if not found.
     * @throws Exception
     */
    public function get($key)
    {
        if (is_array($key)) {
            $result = $this->getFromMultidimensionalArray($key, $this->config);
        } elseif (array_key_exists($key, $this->config)) {
            $result = $this->config[$key];
        } else {
            $result = '';
        }

        return $result;
    }
}
