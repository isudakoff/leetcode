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
    public function singleNumber(array $nums): int
    {
        $map = [];

        foreach ($nums as $num) {
            if (isset($map[$num])) {
                unset($map[$num]);
            } else {
                $map[$num] = 1;
            }
        }

        return key($map);
    }

    /**
     * @param int[] $nums
     *
     * @return int
     */
    public function singleNumber2(array $nums): int
    {
        $res = 0;

        foreach ($nums as $num) {
            $res ^= $num;
        }

        return $res;
    }

    /**
     * @param int[] $nums
     *
     * @return int
     */
    public function singleNumber3(array $nums): int
    {
        for ($i = 1, $iMax = count($nums); $i < $iMax; $i++) {
            $nums[0] ^= $nums[$i];
        }

        return $nums[0];
    }
}

// READ INPUT
[$nums] = fscanf($input, "%s\n");

// PREPARE DATA FOR SOLUTION
eval("\$nums = $nums;");

$solution = new Solution();
$result = $solution->singleNumber($nums);

// FORMAT OUTPUT
$result = (string)$result;

// WRITE OUTPUT
fwrite($output, $result);
