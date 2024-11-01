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

  public function mergeSort($head = null) {
    if (is_null($head)) $head = $this->head;

    if (is_null($head) || is_null($head->next)) {
        return $head; // base case: if the list is empty or has one node
    }

    // Step 1: Get the middle node
    $middle = $this->getMiddle($head);
    $nextToMiddle = $middle->next;

    // Step 2: Split the list into two halves
    $middle->next = null; // Break the list into two halves

    // Step 3: Sort the two halves
    $left = $this->mergeSort($head); // Sort the left half replaced $middle to left since middle is used for right
    $right = $this->mergeSort($nextToMiddle); // Sort the right half

    // Step 4: Merge the sorted halves
    $this->head = $this->sortedMerge($left, $right); // Update the head with the sorted list
    return $this->head; // Return the sorted head
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

  private function sortedMerge($left, $right) {
    if (is_null($left)) return $right;
    if (is_null($right)) return $left;

    $result = null;

    // Compare the values and build the sorted linked list
    if ($left->value <= $right->value) {
      $result = $left; // Start with the left node
      $result->next = $this->sortedMerge($left->next, $right); // Recursively merge the rest
    } else {
      $result = $right; // Start with the right node
      $result->next = $this->sortedMerge($left, $right->next); // Recursively merge the rest
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
