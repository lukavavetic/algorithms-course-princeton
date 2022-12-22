<?php

declare(strict_types=1);

namespace Part1\Sorting;
class Insertion
{
    /** @param array<int, int> $list*/
    private static function sort(array $list): array
    {
        $n = count($list);

        for ($i = 1; $i < $n; $i++) {
            for ($j = $i; $j > 0 && $list[$j] < $list[$j-1]; $j--) {
                $swap = $list[$j - 1];
                $list[$j - 1] = $list[$j];
                $list[$j] = $swap;
            }
        }

        return $list;
    }

    public static function main(): void
    {
        $result = Insertion::sort([7, 10, 5, 3, 8, 4, 2, 9, 6]);

        print_r($result);
    }
}