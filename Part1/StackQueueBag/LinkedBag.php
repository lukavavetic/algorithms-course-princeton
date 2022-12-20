<?php

declare(strict_types=1);

namespace Part1\StackQueueBag;

class LinkedBag
{
    private ?Node $first; // beginning of bag
    private int $n; // number of elements in bag

    private function __construct()
    {
        $this->first = null;
        $this->n = 0;
    }

    private function isEmpty(): bool
    {
        return $this->first === null;
    }

    private function size(): int
    {
        return $this->n;
    }

    private function add(Item $item): void
    {
        $oldFirst = $this->first;

        $first = new Node();
        $first->setItem($item);
        $first->setNext($oldFirst);

        $this->first = $first;

        $this->n++;
    }

    public function iterator(): LinkedBagIterator
    {
        return new LinkedBagIterator($this->first);
    }

    public static function main(): void
    {
        $bag = new self();

        $bag->add(new Item('1'));
        $bag->add(new Item('2'));
        $bag->add(new Item('3'));

        foreach ($bag->iterator() as $item) {
            echo $item."\n";
        }
    }
}

class LinkedBagIterator implements \Iterator
{
    private ?Node $current;
    private Node $first;

    public function __construct(Node $first)
    {
        $this->first = $first;
        $this->current = $first;
    }

    public function current(): Item
    {
        return $this->current->getItem();
    }

    public function next(): void
    {
        $this->current = $this->current->hasNext() ? $this->current->getNext() : null;
    }

    public function key(): mixed
    {
        return null;
    }

    public function valid(): bool
    {
        return $this->current !== null;
    }

    public function rewind(): void
    {
        $this->current = $this->first;
    }
}