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

abstract class GuessGame
{
    /**
     * @var int
     */
    private $pick;

    public function __construct(int $pick)
    {
        $this->pick = $pick;
    }

    public function guess(int $num): int
    {
        if ($num < $this->pick) {
            return 1;
        }

        if ($num > $this->pick) {
            return -1;
        }

        return 0;
    }

    abstract public function guessNumber($n);
}

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution extends GuessGame
{
    public $pick;

    /**
     * @param int $n
     *
     * @return int
     */
    public function guessNumber($n)
    {
        $low = 0;
        $high = $n;

        while ($low <= $high) {
            $mid = (int)floor(($low + $high) / 2);
            $guess = $this->guess($mid);

            if ($guess === 0) {
                return $mid;
            }

            if ($guess === -1) {
                $high = $mid - 1;
            } elseif ($guess === 1) {
                $low = $mid + 1;
            }
        }

        return $n;
    }
}

// READ INPUT
[$n] = fscanf($input, "%d\n");
[$pick] = fscanf($input, "%d\n");

$solution = new Solution($pick);
$result = $solution->guessNumber($n);

// WRITE OUTPUT
fwrite($output, (string)$result);
