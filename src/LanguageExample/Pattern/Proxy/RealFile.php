<?php
declare(strict_types=1);

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

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->readFromDisk();
    }

    private function readFromDisk(): void
    {
        $this->content = 'Imaginary content of '.$this->filename;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
