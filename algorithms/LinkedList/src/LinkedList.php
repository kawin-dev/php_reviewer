<?php
namespace Algorithms\LinkedList;

require_once 'ListNode.php';

class LinkedList {
  public $head;

  public function __construct() {
    $this->head = null;
  }

  public function insertFirst($value){
    $newNode = new ListNode($value);

    if($this->head == null){
        $this->head = $newNode;
    } else {
      $newNode->next = $this->head;
      $this->head = $newNode;
    }
  }

  public function insertLast($value){
    $newNode = new ListNode($value);

    if($this->head === null){
        $this->head = $newNode;
    } else {
      $traverseNode = $this->head;
      while($traverseNode->next != null){
          $traverseNode = $traverseNode->next;
      }

      $traverseNode->next = $newNode;
    }
  }

  public function returnHTML(){
    $traverseNode = $this->head;
    $htmlArray = [];

    while($traverseNode != null){
      $traverseValue = $traverseNode->value;
      array_push($htmlArray, "<div>{$traverseValue}</div>");
      $traverseNode = $traverseNode->next;
    }

    return $htmlArray;
  }
}
