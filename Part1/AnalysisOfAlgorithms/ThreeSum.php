<?php

namespace Part1\AnalysisOfAlgorithms;

final class ThreeSum
{
    private function count(array $a): int
    {
        $N = count($a);
        $count = 0;

        for ($i = 0; $i < $N; $i++) {
            for ($j = $i+1; $j < $N; $j++) {
                for ($k = $j+1; $k < $N; $k++) {
                    echo sprintf('Sum i: %d + j: %d + k: %d', $a[$i], $a[$j], $a[$k])."\n";
                    if ($a[$i] + $a[$j] + $a[$k] === 0) {
                        $count++;
                    }
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