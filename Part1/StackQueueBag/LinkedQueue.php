<?php

declare(strict_types=1);

namespace Part1\StackQueueBag;

use Part1\StackQueueBag\Node;

final class LinkedQueue
{
    private int $n; // number of elements on queue
    private ?Node $first; // beginning of queue
    private ?Node $last; // end of queue

    public function __construct()
    {
        $this->first = null;
        $this->last = null;
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

    public function peek(): Item
    {
        if ($this->isEmpty()) throw new \Exception('Queue underflow');

        return $this->last->getItem();
    }

    public function enqueue(Item $item): void
    {
        $oldLast = $this->last;

        $last = new Node();
        $last->setItem($item);

        if ($this->isEmpty()) {
            $this->first = $last;
        } else {
            $oldLast->setNext($last);
        }

        $this->last = $last;

        $this->n++;
    }

    public function dequeue(): Item
    {
        if ($this->isEmpty()) throw new \Exception('Queue underflow');

        $oldFirst = $this->first;

        if ($this->size() === 1) {
            $this->first = null;
            $this->last = null;
        } else {
            $this->first = $oldFirst->getNext();
        }

        $this->n--;

        return $oldFirst->getItem();
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

    public function iterator(): QueueIterator
    {
        return new QueueIterator($this->first);
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

        foreach ($queue->iterator() as $item) {
            echo $item;
        }
    }
}

class QueueIterator implements \Iterator
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
