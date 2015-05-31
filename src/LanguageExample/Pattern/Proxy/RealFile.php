<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Proxy;

class RealFile implements FileInterface
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $content;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->readFromDisk();
    }

    private function readFromDisk()
    {
        $this->content = 'Imaginary content of '.$this->filename;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
