<?php

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
 * @param array[] $lists
 *
 * @return ListNode[]
 */
function toLinkedLists(array $lists): array
{
    $result = [];

    foreach ($lists as $i => $list) {
        $countList = count($list);

        if ($countList) {
            $result[$i] = $prev = new ListNode($list[0]);

            for ($j = 1; $j < $countList; $j++) {
                $prev->next = $node = new ListNode($list[$j]);
                $prev = $node;
            }
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
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution
{
    /**
     * @param ListNode[] $lists
     *
     * @return ListNode
     */
    public function mergeKLists(array $lists)
    {
        $result = null;

        foreach ($lists as $list) {
            $result = $this->mergeTwoLists($result, $list);
        }

        return $result;
    }

    /**
     * @param \ListNode|null $firstList
     * @param \ListNode|null $secondList
     *
     * @return \ListNode|null
     */
    public function mergeTwoLists(
        ?ListNode $firstList,
        ?ListNode $secondList
    ): ?ListNode {
        if ($firstList === null) {
            return $secondList;
        }

        if ($secondList === null) {
            return $firstList;
        }

        if ($firstList->val < $secondList->val) {
            $firstList->next = $this->mergeTwoLists($firstList->next, $secondList);

            return $firstList;
        }

        $secondList->next = $this->mergeTwoLists($firstList, $secondList->next);

        return $secondList;
    }
}


// READ LISTS
[$str] = fscanf($input, "%s\n");
$lists = null;
eval("\$lists = $str;");
$lists = toLinkedLists($lists);

$solution = new Solution();
$sortedList = $solution->mergeKLists($lists);

// format
$result = json_encode($sortedList, JSON_PRETTY_PRINT);

fwrite($output, $result);
