<?php

declare(strict_types=1);

namespace Part1\Sorting;
class InsertionX
{
    /** @param array<int, int> $list*/
    private static function sort(array $list): array
    {
        $n = count($list);

        $exchanges = 0;

        for ($i = $n - 1; $i > 0; $i--) {
            if ($list[$i] < $list[$i - 1]) {
                $swap = $list[$i];
                $list[$i] = $list[$i - 1];
                $list[$i - 1] = $swap;

                $exchanges++;
            }
        }

        if ($exchanges === 0) return $list;

        for ($i = 2; $i < $n; $i++) {
            $comparable = $list[$i];

            $j = $i;

            while ($comparable < $list[$j - 1]) {
                $list[$j] = $list[$j - 1];
                $j--;
            }


            $list[$j] = $comparable;

            print_r($list);
        }

        return $list;
    }

    public static function main(): void
    {
        $result = InsertionX::sort([7, 10, 5, 3, 8, 4, 2, 9, 6]);

        print_r($result);
    }
}