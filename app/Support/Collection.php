<?php

namespace App\Support;
use IteratorAggregate;
use ArrayIterator;
use JsonSerializable;
class Collection implements IteratorAggregate, JsonSerializable
{
    protected array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function add(array $items)
    {
        $this->items = array_merge($this->items, $items);
    }

    public function get()
    {
        return $this->items;
    }

    public function count()
    {
        return count($this->items);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function merge(Collection $collection)
    {
      //  $this->items = array_merge($this->items, $collection->get());

      return $this->add($collection->get());
    }

    public function toJson()
    {
        return json_encode($this->items);
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}