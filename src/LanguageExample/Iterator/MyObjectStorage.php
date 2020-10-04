<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Iterator;

use ArrayIterator;
use Iterator;
use MultipleIterator;

/**
 * @implements Iterator<bool|float|int|mixed|string|null, mixed|null>
 */
class MyObjectStorage implements Iterator, Attachable
{
    /**
     * @var ArrayIterator<int, CustomStorageObject>
     */
    private $objectsIterator;

    /**
     * @var ArrayIterator<int, mixed|null>
     */
    private $dataIterator;

    /**
     * @var MultipleIterator
     */
    private $storage;

    /**
     * @param array<int, CustomStorageObject> $objects
     * @param array<int, mixed|null> $data
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
     * @param mixed $key
     * @param mixed|null $value
     */
    public function attach($key, $value = null): void
    {
        $this->objectsIterator->append($key);
        $this->dataIterator->append($value);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        $result = $this->storage->current();

        return $result['data'];
    }

    public function next(): void
    {
        $this->storage->next();
    }

    public function key(): string
    {
        $result = $this->storage->current();

        return (string)$result['objects'];
    }

    public function valid(): bool
    {
        return $this->storage->valid();
    }

    public function rewind(): void
    {
        $this->storage->valid();
    }
}
