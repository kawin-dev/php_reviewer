<?php

class InsertSort {

    public function __construct() {
    }

    public function startSort($array, $insertNumber){
        $arrayLength = count($array);
        $pointerIndex = $arrayLength - 1;
        $currentValue = $insertNumber;

        while($pointerIndex >= 0 && $array[$pointerIndex] > $currentValue){
            $array[$pointerIndex + 1] = $array[$pointerIndex];
            $pointerIndex--;

            $arrayString = implode(' ', $array);
            echo $arrayString . "\n";
        }

        $array[$pointerIndex + 1] = $currentValue;

        $arrayString = implode(' ', $array);
        echo $arrayString . "\n";
    }
}

$unsortedArrays = [
    [1,2,4,5],
    [2,3,4,5]
];

$insertSort = new InsertSort();
$insertSort->startSort($unsortedArrays[0], 3);
echo("--------\n");
$insertSort->startSort($unsortedArrays[1], 1);