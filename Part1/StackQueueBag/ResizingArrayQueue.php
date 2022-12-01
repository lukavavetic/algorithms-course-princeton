<?php

declare(strict_types=1);

namespace Part1\StackQueueBag;

use SplFixedArray;

class ResizingArrayQueue
{
    private const CAPACITY = 8;
    private int $n; // number of elements in queue
    private ?int $first; // index of first element of queue
    private ?int $last; // index of last element of queue

    /** @var array<int, Item> */
    public SplFixedArray $q; // queue elements

    public function __construct()
    {
        $this->n = 0;
        $this->first = null;
        $this->last = null;

        $this->q = new SplFixedArray(self::CAPACITY);
    }

    public function isEmpty(): bool
    {
        return $this->first === null;
    }

    public function size(): int
    {
        return $this->n;
    }

    public function peek(): Item
    {
        return $this->q[$this->last];
    }

    public function resize(int $capacity): void
    {
        if (false === ($capacity >= $this->n)) throw new \Exception('Capacity too low.');

        $copy = new SplFixedArray($capacity);

        for ($i = 0; $i < $this->n; $i++) {
            $copy[$i] = $this->q[$i];
        }

        $this->q = $copy;
    }

    public function enqueue(Item $item): void
    {
        if ($this->n === count($this->q)) {
            $this->resize(2*count($this->q));
        }

        if ($this->isEmpty()) {
            $last = 0;
            $this->first = $last;
        } else {
            $last = $this->last + 1;
        }

        $this->q[$last] = $item;

        $this->last = $last;

        $this->n++;
    }

    public function dequeue(): Item
    {
        if ($this->isEmpty()) throw new \Exception('Queue underflow');

        $item = $this->q[$this->last];

        unset($this->q[$this->last]);
        $this->last--;
        $this->n--;

        if ($this->n > 0 && $this->n === count($this->q)/4) $this->resize(count($this->q) / 2);

        return $item;
    }

    public function iterator(): ResizingArrayQueueIterator
    {
        return new ResizingArrayQueueIterator($this->q);
    }

    public static function main(): void
    {
        $queue = new self();

        $queue->enqueue(new Item('First Item'));
        $queue->enqueue(new Item('Second Item'));
        $queue->enqueue(new Item('Third Item'));
        $queue->enqueue(new Item('Fourth Item'));
        $queue->enqueue(new Item('Fifth Item'));

        $queue->dequeue();
        $queue->dequeue();
        $queue->dequeue();

        $queue->enqueue(new Item('Third Item'));
        $queue->enqueue(new Item('Fourth Item'));
        $queue->enqueue(new Item('Fifth Item'));

        foreach ($queue->iterator() as $index => $item) {
            echo "Index: ".$index." Item: ".$item."\n";
        }
    }
}

class ResizingArrayQueueIterator implements \Iterator
{
    private int $position = 0;
    private SplFixedArray $q;

    public function __construct(SplFixedArray $q)
    {
        $this->q = $q;
    }

    public function current(): mixed
    {
        //var_dump(__METHOD__);

        return $this->q[$this->position];
    }

    public function next(): void
    {
        //var_dump(__METHOD__);

        $this->position++;
    }

    public function key(): mixed
    {
        //var_dump(__METHOD__);

        return $this->position;
    }

    public function valid(): bool
    {
        //var_dump(__METHOD__);

        return $this->position < count($this->q);
    }

    public function rewind(): void
    {
        //var_dump(__METHOD__);

        $this->position = 0;
    }
}