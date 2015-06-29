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
    private $hashes = array();

    /**
     * @var CustomStorageObject[]
     */
    private $objects = array();

    /**
     * @var array
     */
    private $objectData = array();

    /**
     * @param $object
     * @param mixed|null $data
     */
    public function attach($object, $data = null)
    {
        $this->hashes = spl_object_hash($object);
        $this->objects[$this->position] = $object;
        $this->objectData[$this->position] = $data;
        $this->length++;
        $this->position++;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->objectData[$this->position];
    }

    public function next()
    {
        $this->position++;
    }

    /**
     * @return string
     */
    public function key()
    {
        return $this->objects[$this->position]->__toString();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        $result = false;

        if ($this->position < $this->length) {
            $result = true;
        }

        return $result;
    }

    public function rewind()
    {
        $this->position = 0;
    }
}