<?php

declare(strict_types=1);

ini_set('memory_limit', '256M');

define('TXTIN', fopen('input.txt', 'r'));
define('TXTOUT', fopen('output.txt', 'w'));

$input = TXTIN;
//$input = STDIN;
$output = TXTOUT;
//$output = STDOUT;

// Helpers

function dd(...$args)
{
    vd(...$args);
    die;
}

function vd(...$args)
{
    var_dump(...$args);
}

// Classes

class Solution
{
    /**
     * @param int[] $nums
     *
     * @return int
     */
    public function findMin(array $nums): int
    {
//        return $this->findMinSimple($nums);
        $low = 0;
        $high = count($nums) - 1;

        while ($low < $high) {
            $mid = (int)floor(($low + $high) / 2);
            $guess = $nums[$mid];

            if ($guess > $nums[$high]) {
                $low = $mid + 1;
            } else {
                $high = $mid;
            }
        }

        return $nums[$low];
    }

    /**
     * @param int[] $nums
     *
     * @return int
     */
    public function findMinSimple(array $nums): int
    {
        return min($nums);
    }
}

// READ INPUT
[$nums] = fscanf($input, "%s\n");

// PREPARE DATA FOR SOLUTION
eval("\$nums = $nums;");

$solution = new Solution();
$result = $solution->findMin($nums);

// FORMAT OUTPUT
$result = (string)$result;

// WRITE OUTPUT
fwrite($output, $result);
