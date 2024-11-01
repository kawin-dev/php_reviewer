<?php
namespace Algorithms\LinkedList;

require_once 'ListNode.php';

class LinkedList {
  public $head;
  public $depth;

  public function __construct() {
    $this->head = null;
    $this->depth = 0;
  }

  public function insertFirst($value){
    $newNode = new ListNode($value);

    if($this->head == null){
        $this->head = $newNode;
    } else {
      $newNode->next = $this->head;
      $this->head = $newNode;
    }

    $this->depth++;
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

    $this->depth++;
  }

  public function deleteValue($deleteValue){
    $traverseNode = $this->head;
    $previousNode = null;

    while($traverseNode != null){
      if($traverseNode->value == $deleteValue){
        if(is_null($previousNode)){
          $this->head = $traverseNode->next;
        }else{
          $previousNode->next = $traverseNode->next;
        }
        $this->depth--;
        return;
      }

      $previousNode = $traverseNode;
      $traverseNode = $traverseNode->next;
    }
  }

  public function mergeSort($head = null){
    if(is_null($head)) $head = $this->head;

    if(is_null($head) || is_null($head->next)){
      return $head;
    }

    $middle = $this->getMiddle($head);
    $nextToMiddle = $middle->next;

    $middle->next = null;

    $left = $this->mergeSort($middle);
    $right = $this->mergeSort($nextToMiddle);

    return $this->sortedMerge($left, $right);
  }

  private function getMiddle($head){
    if(is_null($head)) return $head;

    $slow = $head;
    $fast = $head;

    while($fast->next != null && $fast->next->next != null){
      $slow = $slow->next;
      $fast = $fast->next->next;
    }

    return $slow;
  }

  private function sortedMerge($left, $right){
    if(is_null($left)) return $right;
    if(is_null($right)) return $left;

    if($left->value <= $right->value){
      $result = $left;
      $result->next = $this->sortedMerge($left->next, $right);
    }else{
      $result = $right;
      $result->next = $this->sortedMerge($left, $right->next);
    }

    return $result;
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
