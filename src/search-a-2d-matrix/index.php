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
     * @param int[][] $matrix
     * @param int $target
     *
     * @return bool
     */
    public function searchMatrix(
        array $matrix,
        int $target
    ): bool {
        foreach ($matrix as $arr) {
            if ($target <= $arr[count($arr) - 1]) {
                return in_array($target, $arr);
            }
        }

        return false;
    }
}

// READ INPUT
[$matrix] = fscanf($input, "%s\n");
[$target] = fscanf($input, "%d\n");

// PREPARE DATA FOR SOLUTION
eval("\$matrix = $matrix;");

$solution = new Solution();
$result = $solution->searchMatrix($matrix, $target);

// FORMAT OUTPUT
$result = $result
    ? "true"
    : "false";

// WRITE OUTPUT
fwrite($output, $result);
