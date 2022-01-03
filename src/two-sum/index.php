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
     * @return int[]
     */
    public function twoSum(
        array $nums,
        int $target
    ): array {
        $map = [];

        foreach ($nums as $index => $num) {
            $map[$num][] = $index;
        }

//        echo json_encode([$map]) . PHP_EOL;

        foreach ($map as $num => $indices) {
//            echo json_encode([$map, $indices]) . PHP_EOL;

            if (isset($map[$target - $num])) {
                if ($target - $num === $num && count($indices) < 2) {
                    continue;
                }

                return [array_shift($map[$target - $num]), array_shift($map[$num])];
            }
        }

        return $map;
    }
}

// READ INPUT
[$nums] = fscanf($input, "%s\n");
[$target] = fscanf($input, "%d\n");

// PREPARE DATA FOR SOLUTION
eval("\$nums = $nums;");

$solution = new Solution();
$result = $solution->twoSum($nums, $target);

// FORMAT OUTPUT
$result = json_encode($result);

// WRITE OUTPUT
fwrite($output, $result);
