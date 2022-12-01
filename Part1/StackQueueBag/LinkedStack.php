<?php

declare(strict_types=1);

namespace Part1\StackQueueBag;

final class LinkedStack
{
    private int $n; //size of the stack
    private ?Node $first; // top of stack

    public function __construct()
    {
        $this->first = null;
        $this->n = 0;
    }

    public function isEmpty(): bool
    {
        return $this->first === null;
    }

    public function size(): int
    {
        return $this->n;
    }

    public function push(Item $item): void
    {
        $oldFirst = $this->first;

        if ($oldFirst && false === ($oldFirst instanceof Node)) throw new \Exception('Not an instance of Node type.');

        $this->first = new Node();
        $this->first->setItem($item);

        if ($oldFirst) {
            $this->first->setNext($oldFirst);
        }

        $this->n++;
    }

    public function pop(): Item
    {
        if ($this->isEmpty()) throw new \Exception('Stack underflow');

        $item = $this->first->getItem();

        $this->first = $this->first->getNext();

        $this->n--;

        return $item;
    }

    public function peek(): Item
    {
        if ($this->isEmpty()) throw new \Exception('Stack underflow');

        return $this->first->getItem();
    }

    public function iterator(): \Iterator
    {
        return new StackIterator($this->first);
    }

    public function printItems(): void
    {
        $current = $this->first;
        while (true) {
            echo $current->getItem()."\n";

            if ($current->hasNext() === false) {
                break;
            }

            $current = $current->getNext();
        }
    }

    public static function main(): void
    {
        $stack = new self();

        $stack->push(new Item('First Item'));
        $stack->push(new Item('Second Item'));
        $stack->push(new Item('Third Item'));

        //$stack->printItems();

        foreach ($stack->iterator() as $key => $item) {
            var_dump($key);
        }
    }
}

class StackIterator implements \Iterator
{
    private Node $first;
    private ?Node $current;

    public function __construct(Node $first)
    {
        $this->first = $first;
        $this->current = $first;
    }

    public function current(): string
    {
        var_dump(__METHOD__);

        return (string) $this->current->getItem();
    }

    public function next(): void
    {
        var_dump(__METHOD__);

        if ($this->current->hasNext()) {
            $this->current = $this->current->getNext();
        } else {
            $this->current = null;
        }
    }

    public function key(): mixed
    {
        var_dump(__METHOD__);
        //add id to an object
        return null;
    }

    public function valid(): bool
    {
        var_dump(__METHOD__);

        return $this->current !== null;
    }

    public function rewind(): void
    {
        var_dump(__METHOD__);

        $this->current = $this->first;
    }
}