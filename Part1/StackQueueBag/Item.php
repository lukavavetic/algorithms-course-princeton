<?php

declare(strict_types=1);

namespace Part1\StackQueueBag;

class Item implements \Stringable
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}