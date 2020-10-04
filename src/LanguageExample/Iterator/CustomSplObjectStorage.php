<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use Iterator;
use SplObjectStorage;

class CustomSplObjectStorage implements Iterator, Attachable
{
    /**
     * @var SplObjectStorage
     */
    private $storage;

    /**
     * @param mixed $object
     * @param mixed|null $data
     */
    public function attach($object, $data = null): void
    {
        $this->storage->attach($object, $data);
    }

    public function __construct()
    {
        $this->storage = new SplObjectStorage();
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->storage->getInfo();
    }

    public function next(): void
    {
        $this->storage->next();
    }

    /**
     * @return mixed|null
     */
    public function key()
    {
        return $this->storage->current();
    }

    public function valid(): bool
    {
        return $this->storage->valid();
    }

    public function rewind(): void
    {
        $this->storage->rewind();
    }
}
