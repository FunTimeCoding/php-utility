<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample\Pattern\Proxy;

interface FileInterface
{
    /**
     * @param string $filename
     */
    public function __construct($filename);

    /**
     * @return string
     */
    public function getContent();
}
