<?php
namespace Algorithms\LinkedList;

trait ListNodeTrait {
  public $next;
  public $value;

  public function __construct($value) {
    $this->value = $value;
    $this->next = null;
  }

  public function setNext($next){
    $this->next = $next;
  }
}