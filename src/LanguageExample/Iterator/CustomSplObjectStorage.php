<?php

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
    public function attach($object, $data = null)
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

    public function next()
    {
        $this->storage->next();
    }

    /**
     * @return object
     */
    public function key()
    {
        return $this->storage->current()->__toString();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->storage->valid();
    }

    public function rewind()
    {
        $this->storage->rewind();
    }
}
