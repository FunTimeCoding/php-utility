<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use Iterator;

/**
 * @implements Iterator<bool|float|int|mixed|string|null, mixed|null>
 */
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
     * @var array<string>
     */
    private $hashes = [];

    /**
     * @var array<int, CustomStorageObject>
     */
    private $keys = [];

    /**
     * @var array<int, mixed|null>
     */
    private $values = [];

    /**
     * @param mixed $key
     * @param mixed|null $value
     */
    public function attach($key, $value = null): void
    {
        $this->hashes[] = spl_object_hash($key);
        $this->keys[$this->position] = $key;
        $this->values[$this->position] = $value;
        ++$this->length;
        ++$this->position;
    }

    /**
     * @return mixed|null
     */
    public function current()
    {
        return $this->values[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @return bool|float|int|mixed|string|null
     */
    public function key()
    {
        return $this->keys[$this->position];
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
