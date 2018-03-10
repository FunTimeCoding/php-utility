<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use Iterator;
use MultipleIterator;

class MyObjectStorage implements Iterator, Attachable
{
    /**
     * @var ArrayIterator
     */
    private $objectsIterator;

    /**
     * @var ArrayIterator
     */
    private $dataIterator;

    /**
     * @var MultipleIterator
     */
    private $storage;

    /**
     * @param array $objects
     * @param array $data
     */
    public function __construct(array $objects, array $data)
    {
        $this->objectsIterator = new ArrayIterator($objects);
        $this->dataIterator = new ArrayIterator($data);

        $this->storage = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
        $this->storage->attachIterator($this->objectsIterator, 'objects');
        $this->storage->attachIterator($this->dataIterator, 'data');
    }

    /**
     * @param mixed $object
     * @param mixed|null $data
     */
    public function attach($object, $data = null)
    {
        $this->objectsIterator->append($object);
        $this->dataIterator->append($data);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        $result = $this->storage->current();

        return $result['data'];
    }

    public function next()
    {
        $this->storage->next();
    }

    /**
     * @return string
     */
    public function key()
    {
        $result = $this->storage->current();

        return $result['objects']->__toString();
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
        $this->storage->valid();
    }
}
