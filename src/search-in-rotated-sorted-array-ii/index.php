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
     * @param int $target
     *
     * @return bool
     */
    public function searchSimple(
        array $nums,
        int $target
    ): bool {
        $ans = array_search($target, $nums);

        return is_int($ans);
    }

    /**
     * @param int[] $nums
     * @param int $target
     *
     * @return bool
     */
    public function search(
        array $nums,
        int $target
    ): bool {
        // return $this->searchSimple($nums, $target);
        $low = 0;
        $high = count($nums) - 1;

//        echo "t=$target\t\tl=$low\th=$high\n\n";

        while ($low <= $high) {
            $mid = (int)floor(($low + $high) / 2);
            $guess = $nums[$mid];
//            echo "l=$low\tm=$mid\th=$high\n";

            if ($guess === $target) {
                return true;
            }

            if ($guess === $nums[$low]) {
                $low++;
                continue;
            }

            if ($guess === $nums[$high]) {
                $high--;
                continue;
            }

            if ($guess >= $nums[$low]) {
                if ($target >= $nums[$low] && $target < $guess) {
                    $high = $mid - 1;
                } else {
                    $low = $mid + 1;
                }
            } elseif ($target > $guess && $target <= $nums[$high]) {
                $low = $mid + 1;
            } else {
                $high = $mid - 1;
            }
        }

        return $nums[$low] === $target;
    }
}

// READ INPUT
[$nums] = fscanf($input, "%s\n");
[$target] = fscanf($input, "%d\n");

// PREPARE DATA FOR SOLUTION
eval("\$nums = $nums;");

$solution = new Solution();
$result = $solution->search($nums, $target);

// FORMAT OUTPUT
$result = $result === true ? 'true' : 'false';

// WRITE OUTPUT
fwrite($output, $result);
