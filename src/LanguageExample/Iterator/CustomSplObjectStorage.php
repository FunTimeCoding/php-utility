<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use Iterator;
use SplObjectStorage;

/**
 * @implements Iterator<bool|float|int|mixed|string|null, mixed|null>
 */
class CustomSplObjectStorage implements Iterator, Attachable
{
    /**
     * @var SplObjectStorage
     */
    private $storage;

    /**
     * @param mixed $key
     * @param mixed|null $value
     */
    public function attach($key, $value = null): void
    {
        $this->storage->attach($key, $value);
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
