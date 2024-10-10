<?php
/**
 * ESTE CÓDIGO ALMACENA LAS FUNCIONES REQUERIDAS PARA LA ACTIVIDAD 6 DE LA UNIDAD 2
 * @author Sandra Fernández Ávila
 * @version 1.0
 */

 function sum(float $number1, float $number2):float {
    $result = 0;
    $result = $number1 + $number2;
    return $result;
 };

 function subtract(float $number1, float $number2):float {
    $result = 0;
    $result = $number1 - $number2;
    return $result;
 };

 function multiplication(float $number1, float $number2):float {
    $result = 0;
    $result = $number1 * $number2;
    return $result;
 };

 function divide(float $number1, float $number2):float {
    $result = 0;
    $result = $number1 / $number2;
    return $result;
 };

 function module(int $number1, int $number2):int {
   $result = 0;
   $result = $number1 % $number2;
   return $result;
};

   function compareTwoNumbers(int $number1, int $number2):bool {
   $result = false;
   if($number1 == $number2) {
      $result = true;
   }
   return $result;
};

   function ifPair(int $number1):bool {
   $result = true;
   if($number1 % 2) {
      $result = false;
   }
   return $result;
};
