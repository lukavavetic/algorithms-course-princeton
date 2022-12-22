<?php

declare(strict_types=1);

namespace Part1\Sorting;

class Selection
{
    /** @param array<int, int> $list*/
    private static function sort(array $list): array
    {
        $n = count($list);

        for ($i = 0; $i < $n; $i++) {
            $min = $i;

            for ($j = $i + 1; $j < $n; $j++) {
                if ($list[$min] > $list[$j]) {
                    $min = $j;
                }
            }

            $swap = $list[$min];
            $list[$min] = $list[$i];
            $list[$i] = $swap;
        }

        return $list;
    }

    public static function main(): void
    {
        $result = Selection::sort([7, 10, 5, 3, 8, 4, 2, 9, 6]);

        print_r($result);
    }
}
