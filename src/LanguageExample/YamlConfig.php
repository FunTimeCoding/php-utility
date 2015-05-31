<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use Symfony\Component\Yaml\Parser;

class YamlConfig
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
     * @param string $key
     *
     * @return string
     */
    public function getValue($key)
    {
        return (string) $this->config[$key];
    }
}
