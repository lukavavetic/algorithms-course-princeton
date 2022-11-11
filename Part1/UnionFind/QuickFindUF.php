<?php

namespace Part1\UnionFind;

final class QuickFindUF
{
    /** @var int[]  */
    private array $ids; // id[i] = component identifier of i
    private int $count; // number of components

    private function __construct(int $n)
    {
        $this->count = $n;

        for ($i = 0; $i < $n; $i++) {
            $this->ids[$i] = $i;
        }
    }

    private function find(int $p): int
    {
        $this->validate($p);

        return $this->ids[$p];
    }

    private function validate(int $p): void
    {
        $n = count($this->ids);

        if ($p < 0 || $p >= $n) {
            throw new \Exception(sprintf('Index %d is not between 0 and %d', $p, ($n - 1)));
        }
    }

    private function union(int $p, int $q): void
    {
        $this->validate($p);
        $this->validate($q);

        $pID = $this->ids[$p];
        $qID = $this->ids[$q];

        if ($pID === $qID) return;

        for ($i = 0; $i < count($this->ids); $i++) {
            if ($this->ids[$i] === $pID) {
                $this->ids[$i] = $qID;
                $this->count--;
            }
        }
    }

    public static function main(): void
    {
        $n = readline('Number of objects:');

        $uf = new self($n);

        echo sprintf('Component count: %d', $uf->count). "\n";

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

            echo "Component count: ".$count."\n";
        }
    }
}