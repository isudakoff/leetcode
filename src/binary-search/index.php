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

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution
{
    /**
     * @param int[] $nums
     * @param int $target
     *
     * @return int
     */
    public function search(array $nums, int $target): int
    {
        $low = 0;
        $high = count($nums) - 1;

        while ($low <= $high) {
            $mid = $low + $high;
            $guess = $nums[$mid];

            if ($guess === $target) {
                return $mid;
            }

            if ($guess > $target) {
                $high = $mid - 1;
            } else {
                $low = $mid + 1;
            }
        }

        return -1;
    }
}


// READ INPUT
[$nums] = fscanf($input, "%s\n");
[$target] = fscanf($input, "%d\n");

// PREPARE DATA FOR SOLUTION
eval("\$nums = (array)$nums;");

$solution = new Solution();
$result = $solution->search($nums, $target);

fwrite($output, (string)$result);
