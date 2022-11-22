<?php

namespace Part1\AnalysisOfAlgorithms;

final class ThreeSumFast
{
    private function binarySearch(Array $arr, $x): int
    {
        // check for empty array
        if (count($arr) === 0) return -1;
        $low = 0;
        $high = count($arr) - 1;

        while ($low <= $high) {

            // compute middle index
            $mid = floor(($low + $high) / 2);

            // element found at mid
            if($arr[$mid] == $x) {
                return $mid;
            }

            if ($x < $arr[$mid]) {
                // search the left side of the array
                $high = $mid -1;
            }
            else {
                // search the right side of the array
                $low = $mid + 1;
            }
        }

        // If we reach here element x doesnt exist
        return -1;
    }

    private function containsDuplicates(array $a): bool
    {
        for ($i = 1; $i < count($a); $i++) {
            if ($a[$i] === $a[$i - 1]) {
                return true;
            }

            return false;
        }
    }

    private function count(array $a): int
    {
        $n = count($a);

        sort($a);

        if ($this->containsDuplicates($a)) {
            throw new \Exception('Array contains duplicates.');
        }

        $count = 0;

        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                $arr = $a;

                // remove elements on indexes $i and $j from array before running binary search on it
                unset($arr[$i]);
                unset($arr[$j]);

                // reindex array
                $arr = array_values($arr);

                // get $k
                $k = $this->binarySearch($arr, -($a[$i] + $a[$j]));

                if ($k === -1) {
                    continue;
                }

                if ($a[$k] === -($a[$j] + $a[$i])) {
                    echo sprintf('Sum i: %d + j: %d + k: %d', $a[$i], $a[$j], $a[$k])."\n";
                    $count++;
                }
            }
        }

        return $count;
    }

    public static function main(): void
    {
        $array = [30, -40, -20, -10, 40, 0, 10, 5];

        $threeSum = new self();

        $count = $threeSum->count($array);

        echo sprintf("Count is: %d", $count);
    }
}