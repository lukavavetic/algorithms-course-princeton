<?php

declare(strict_types=1);

namespace Part1\StackQueueBag;

use SplFixedArray;

class ResizingArrayStack
{
    // initial capacity of underlying resizing array
    private const CAPACITY = 3;

    /** @var array<int, Item> */
    private SplFixedArray $a; // array of items
    private int $n; // number of elements in stack

    public function __construct()
    {
        $this->a = new SplFixedArray(self::CAPACITY);
        $this->n = 0;
    }

    public function isEmpty(): bool
    {
        return $this->n === 0;
    }

    public function size(): int
    {
        return $this->n;
    }

    public function getA(): \SplFixedArray
    {
        return $this->a;
    }

    // resize the underlying array holding the elements
    public function resize(int $capacity): void
    {
        if (false === ($capacity >= $this->n)) throw new Exception('Capacity must be greater than current size.');

        $copy = new SplFixedArray($capacity);

        for ($i = 0; $i < $this->n; $i++) {
            $copy[$i] = $this->a[$i];
        }

        $this->a = $copy;
    }

    public function push(Item $item): void
    {
        if ($this->n === count($this->a)) $this->resize(2*$this->n);

        $this->a[$this->n] = $item;

        $this->n++;
    }

    public function pop(): Item
    {
        if ($this->isEmpty()) throw new Exception('Stack underflow');

        $item = $this->a[$this->n - 1];

        $this->n--;

        //shrink size of array if necessary
        if ($this->n > 0 && $this->n === count($this->a)/4) $this->resize(count($this->a)/2);

        return $item;
    }

    public function peek(): Item
    {
        if ($this->isEmpty()) throw new Exception('Stack underflow');

        return $this->a[$this->n - 1];
    }

    public function iterator(): ReverseArrayIterator
    {
        return new ReverseArrayIterator($this->a);
    }

    public static function main(): void
    {
        $stack = new self();

        $stack->push(new Item('First Item'));
        $stack->push(new Item('Second Item'));
        $stack->push(new Item('Third Item'));

        foreach ($stack->iterator() as $key => $item) {
            echo sprintf('Key: %s - Value: %s', $key, $item);
        }
    }
}

class ReverseArrayIterator implements \Iterator
{
    private SplFixedArray $array;
    private int $position;

    public function __construct(SplFixedArray $array)
    {
        $this->array = $array;
    }

    public function current(): mixed
    {
        var_dump(__METHOD__);

        return $this->array[$this->position];
    }

    public function next(): void
    {
        var_dump(__METHOD__);

        $this->position--;
    }

    public function key(): mixed
    {
        var_dump(__METHOD__);

        return $this->position;
    }

    public function valid(): bool
    {
        var_dump(__METHOD__);

        return $this->position >= 0;
    }

    public function rewind(): void
    {
        var_dump(__METHOD__);

        $this->position = count($this->array) - 1;
    }
}