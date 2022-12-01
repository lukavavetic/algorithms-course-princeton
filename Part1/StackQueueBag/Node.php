<?php

declare(strict_types=1);

namespace Part1\StackQueueBag;

class Node
{
    private Item $item;
    private ?Node $next = null;

    public function hasNext(): bool
    {
        return $this->next !== null;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

    public function setItem(Item $item): void
    {
        $this->item = $item;
    }

    public function getNext(): Node
    {
        return $this->next;
    }

    public function setNext(Node $next): void
    {
        $this->next = $next;
    }
}