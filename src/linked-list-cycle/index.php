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

/**
 * @param ListNode $head
 * @param int $pos
 *
 * @return ListNode|null
 */
function linkTailToPos(?ListNode $head, int $pos): ?ListNode
{
    if ($head === null) {
        return null;
    }

    $map = [];
    $prev = $head;
    $link = null;
    $i = 0;

    if ($pos !== -1 && $i === $pos) {
        $link = $prev;
    }

    while ($prev->next !== null) {
        $map[] = $prev = $prev->next;
        $i++;

        if ($pos !== -1 && $i === $pos) {
            $link = $prev;
        }
    }

    $prev->next = $link;

    $map[$i] = $link;

    while ($i > 0) {
        $i--;
        $map[$i] = $map[$i + 1];
    }

    $head->next = $map[0];

    return $head;
}

// Classes

class ListNode
{
    public $val = 0;
    public $next = null;

    public function __construct($val = 0)
    {
        $this->val = $val;
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
     * @return bool
     */
    public function hasCycle(?ListNode $head): bool
    {
        $next = $head;
        $map = [];

        while ($next !== null) {
            $key = spl_object_hash($next);

            if (isset($map[$key])) {
                return true;
            }

            $map[$key] = 1;
            $next = $next->next;
        }

        return false;
    }
}


// READ INPUT
[$str] = fscanf($input, "%s\n");
[$pos] = fscanf($input, "%d");

// PREPARE DATA FOR SOLUTION
$head = null;
eval("\$head = $str;");
$head = toLinkedLists($head);
$head = linkTailToPos($head, $pos);

$solution = new Solution();
$hasCycle = $solution->hasCycle($head);

// format
$result = $hasCycle ? 'true' : 'false';

fwrite($output, $result);
