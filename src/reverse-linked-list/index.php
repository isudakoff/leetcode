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
     * @param ListNode|null $head
     *
     * @return ListNode
     */
    public function reverseList(?ListNode $head): ?ListNode
    {
        $map = [];

        while ($head !== null) {
            array_unshift($map, $head->val);

            $head = $head->next;
        }

        return toLinkedLists($map);
    }
}


// READ INPUT
[$list] = fscanf($input, "%s\n");

// PREPARE DATA FOR SOLUTION
eval("\$list = (array)$list;");
$list = toLinkedLists($list);

$solution = new Solution();
$resultList = $solution->reverseList($list);

// format
$result = json_encode($resultList, JSON_PRETTY_PRINT);

fwrite($output, $result);
