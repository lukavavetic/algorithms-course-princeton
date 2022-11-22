<?php

declare(strict_types=1);

namespace Part1\AnalysisOfAlgorithms;

final class BinarySearch
{
    private function binarySearch(array $a, int $key): int
    {
        $low = 0;
        $high = count($a) - 1;

        while ($low <= $high) {
            $mid = $low + ($high - $low)  / 2;

            if ($key < $a[$mid]) $high = $mid - 1;

            elseif ($key > $a[$mid]) $low = $mid + 1;

            else return $mid;
        }

        return -1;
    }

    public static function main(): void
    {
        $array = [6, 13, 14, 25, 33, 43, 51, 53, 64, 72, 84, 93, 95, 96, 97];

        $key = 33;

        $binarySearch = new self();

        $index = $binarySearch->binarySearch($array, $key);

        echo sprintf("Index is: %d", $index);
    }
}