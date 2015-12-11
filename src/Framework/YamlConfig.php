<?php

namespace FunTimeCoding\PhpUtility\Framework;

use Exception;
use Symfony\Component\Yaml\Parser;

class YamlConfig implements ConfigInterface
{
    private $config = array();

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
    public function expandTilde($path)
    {
        if (function_exists('posix_getuid') && strpos($path, '~') !== false) {
            $info = posix_getpwuid(posix_getuid());
            $path = str_replace('~', $info['dir'], $path);
        }

        return (string) $path;
    }

    /**
     * @param array $keys
     * @param array $heap
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function getFromMultidimensionalArray(array $keys, array $heap)
    {
        $length = count($keys);
        $depth = 0;

        foreach ($keys as $key) {
            if (array_key_exists($key, $heap)) {
                if ($depth == $length) {
                    break;
                } else {
                    $heap = $heap[$key];
                }
            } else {
                throw new Exception('Not found: '.$key);
            }

            ++$depth;
        }

        return $heap;
    }

    /**
     * @param string|array $key
     *
     * @return mixed
     */
    public function get($key)
    {
        if (is_array($key)) {
            $result = $this->getFromMultidimensionalArray($key, $this->config);
        } else {
            $result = $this->config[$key];
        }

        return $result;
    }
}
