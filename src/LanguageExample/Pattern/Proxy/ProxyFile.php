<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\Proxy;

class ProxyFile implements FileInterface
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var RealFile
     */
    private $file = null;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        if (null === $this->file) {
            $this->file = new RealFile($this->filename);
        }

        return $this->file->getContent();
    }
}
