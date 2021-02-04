<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//echo $_POST["first"]+$_POST["second"];
$temp = print_r($_POST,true);
$firstNumber = (float)$_POST["firstNum"];
$secondNumber = (float)$_POST['secondNum'];
switch($_POST["opr"]){
    case "+":
        echo $firstNumber+$secondNumber;
        break;
    case "-":
        echo $firstNumber-$secondNumber;
        break;
    case "/":
        echo $firstNumber/$secondNumber;
        break;
    case "*":
        echo $firstNumber*$secondNumber;
        break;
    default:
        break;
}

