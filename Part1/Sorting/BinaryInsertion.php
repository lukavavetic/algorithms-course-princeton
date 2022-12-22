<?php

declare(strict_types=1);

namespace Part1\Sorting;
class BinaryInsertion
{
    /** @param array<int, int> $list*/
    private static function sort(array $list): array
    {
        $n = count($list);

        for ($i = 1; $i < $n; $i++) {
            $comparable = $list[$i];

            $low = 0;
            $high = $i;

            while ($low < $high) {
                $mid = $low + ($high - $low) / 2;

                if ($comparable < $list[$mid]) {
                    $high = $mid;
                } else {
                    $low = $mid + 1;
                }
            }

            for ($j = $i; $j > $low; $j--) {
                $list[$j] = $list[$j - 1];
            }

            $list[$low] = $comparable;
        }

        return $list;
    }

    public static function main(): void
    {
        $result = BinaryInsertion::sort([7, 10, 5, 3, 8, 4, 2, 9, 6]);

        print_r($result);
    }
}