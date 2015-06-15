<?php

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use Iterator;

class Cupboard implements Iterator
{
    public $upperDrawer = 'empty';
    public $lowerDrawer = 'empty';

    /**
     * @var string[]
     */
    private $keys;

    /**
     * @var string[]
     */
    private $values;

    /**
     * @var int
     */
    private $length;

    /**
     * @var int
     */
    private $position = 0;

    public function updateIteratorAttributes()
    {
        $attributes = get_object_vars($this);
        unset($attributes['position']);
        unset($attributes['length']);
        unset($attributes['keys']);
        unset($attributes['values']);
        $this->keys = array_keys($attributes);
        $this->values = array_values($attributes);
        $this->length = count($attributes);
    }

    public function current()
    {
        $this->updateIteratorAttributes();

        return $this->values[$this->position];
    }

    public function next()
    {
        $this->updateIteratorAttributes();
        $this->position++;
    }

    public function key()
    {
        $this->updateIteratorAttributes();

        return $this->keys[$this->position];
    }

    public function valid()
    {
        $this->updateIteratorAttributes();
        $result = false;

        if ($this->position < $this->length) {
            $result = true;
        }

        return $result;
    }

    public function rewind()
    {
        $this->updateIteratorAttributes();
        $this->position = 0;
    }
}
