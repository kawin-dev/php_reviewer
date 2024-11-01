<?php
namespace Algorithms\LinkedList;

require_once 'ListNodeTrait.php';

class ListNode {
  use ListNodeTrait;

  public function __construct($value) {
    $this->value = (int)$value;
    $this->next = null;
  }
}