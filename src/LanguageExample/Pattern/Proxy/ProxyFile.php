<?php
declare(strict_types=1);

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
    private $file;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function getContent(): string
    {
        if (null === $this->file) {
            $this->file = new RealFile($this->filename);
        }

        return $this->file->getContent();
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getFile(): RealFile
    {
        if (null !== $this->file) {
            return $this->file;
        }

        return new RealFile('');
    }
}
