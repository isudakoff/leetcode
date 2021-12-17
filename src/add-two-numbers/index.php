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

/**
 * @param array $lists
 *
 * @return ListNode
 */
function toLinkedLists(array $list): ?ListNode
{
    $result = null;

    $countList = count($list);

    if ($countList) {
        $result = $prev = new ListNode($list[0]);

        for ($j = 1; $j < $countList; $j++) {
            $prev->next = $node = new ListNode($list[$j]);
            $prev = $node;
        }
    }

    return $result;
}


// Classes

class ListNode
{
    public $val = 0;
    public $next = null;

    public function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

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
     * @param ListNode $firstList
     * @param ListNode $secondList
     *
     * @return ListNode
     */
    public function addTwoNumbers(
        ListNode $firstList,
        ListNode $secondList
    ): ListNode {
        /** @var \ListNode $next */
        $next = $firstList;
        $i = 0;
        $firstNumber = "0";

        while ($next !== null) {
            $k = bcpow("10", (string)$i);
            $num = bcmul((string)$next->val, $k);
            $firstNumber = bcadd($firstNumber, $num);
            $i++;
            $next = $next->next;
        }

        /** @var \ListNode $next */
        $next = $secondList;
        $i = 0;
        $secondNumber = "0";

        while ($next !== null) {
            $k = bcpow("10", (string)$i);
            $num = bcmul((string)$next->val, $k);
            $secondNumber = bcadd($secondNumber, $num);
            $i++;
            $next = $next->next;
        }

        $finalNumber = str_split(strrev(bcadd($firstNumber, $secondNumber)));

        return toLinkedLists($finalNumber);
    }
}


// READ INPUT
[$first] = fscanf($input, "%s\n");
[$second] = fscanf($input, "%s\n");

// PREPARE DATA FOR SOLUTION
$firstList = null;
$secondList = null;
eval("\$firstList = $first;\$secondList = $second;");
$firstList = toLinkedLists($firstList);
$secondList = toLinkedLists($secondList);

$solution = new Solution();
$resultList = $solution->addTwoNumbers($firstList, $secondList);

// format
$result = json_encode($resultList, JSON_PRETTY_PRINT);

fwrite($output, $result);
