<?php

namespace Part1\UnionFind;

final class WeightedQuickUnionUF
{
    private array $parent; // parent[i] = parent of i
    private array $size; // size[i] = number of elements in subtree rooted at i
    private int $count; // number of components

    private function __construct(int $n)
    {
        $this->count = $n;

        for ($i = 0; $i < $n; $i++) {
            $this->parent[$i] = $i;
            $this->size[$i] = 1;
        }
    }

    private function validate(int $p): void
    {
        $n = count($this->parent);

        if ($p < 0 || $p >= $n) {
            throw new \Exception(sprintf('Index %d is not between 0 and %d', $p, ($n - 1)));
        }
    }

    private function find(int $p): int
    {
        $this->validate($p);

        while($p !== $this->parent[$p]) {
            $p = $this->parent[$p];
        }

        return $p;
    }

    private function union(int $p, int $q): void
    {
        $rootP = $this->find($p);
        $rootQ = $this->find($q);

        if ($rootP === $rootQ) return;

        // make smaller root point to larger one
        if ($this->size[$rootP] < $this->size[$rootQ]) {
            $this->parent[$rootP] = $rootQ;
            $this->size[$rootQ] += $this->size[$rootP];
        } else {
            $this->parent[$rootQ] = $rootP;
            $this->size[$rootP] += $this->size[$rootQ];
        }

        $this->count--;
    }

    public static function main(): void
    {
        $n = readline('Number of objects:');

        $uf = new self($n);

        while($values = readline('Enter union x,y:') ) {
            $union = explode(',', $values);

            $p = (int) $union[0];
            $q = (int) $union[1];

            if ($uf->find($p) === $uf->find($q)) continue;

            $uf->union($p, $q);

            $count = $uf->count;

            if ($count <= 0) {
                break;
            }

            echo implode(', ', $uf->parent). "\n";
        }
    }
}