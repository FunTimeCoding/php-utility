<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use Iterator;

class MySplObjectHashStorage implements Iterator, Attachable
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var int
     */
    private $length = 0;

    /**
     * @var array
     */
    private $hashes = [];

    /**
     * @var CustomStorageObject[]
     */
    private $objects = [];

    /**
     * @var array
     */
    private $objectData = [];

    /**
     * @param mixed $object
     * @param mixed|null $data
     */
    public function attach($object, $data = null): void
    {
        $this->hashes = spl_object_hash($object);
        $this->objects[$this->position] = $object;
        $this->objectData[$this->position] = $data;
        ++$this->length;
        ++$this->position;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->objectData[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): string
    {
        return (string)$this->objects[$this->position];
    }

    public function valid(): bool
    {
        $result = false;

        if ($this->position < $this->length) {
            $result = true;
        }

        return $result;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
