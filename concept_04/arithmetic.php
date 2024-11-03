<?php

// arithmetic.php

// Arithmetic operators are used to perform common mathematical operations.

echo "<h2>1. Addition (+) and Subtraction (-)</h2>";
$num1 = 50;
$num2 = 15;

$sum = $num1 + $num2;
$difference = $num1 - $num2;

echo "{$num1} + {$num2} = <strong>{$sum}</strong><br>";         // Output: 65
echo "{$num1} - {$num2} = <strong>{$difference}</strong><br>";  // Output: 35

echo "<hr>";

echo "<h2>2. Multiplication (*) and Division (/)</h2>";
$factor1 = 5;
$factor2 = 12;
$divisor = 4;

$product = $factor1 * $factor2;
$quotient = $product / $divisor;

echo "{$factor1} * {$factor2} = <strong>{$product}</strong><br>"; // Output: 60
echo "{$product} / {$divisor} = <strong>{$quotient}</strong><br>"; // Output: 15 (float if needed, but 60/4 is int 15)

$float_result = 10 / 3;
echo "10 / 3 = <strong>{$float_result}</strong><br>"; // Output: 3.3333333333333

echo "<hr>";

echo "<h2>3. Modulus (%) - Remainder</h2>";
$dividend = 25;
$mod_divisor = 7;

// 25 divided by 7 is 3 with a remainder of 4.
$remainder = $dividend % $mod_divisor;

echo "{$dividend} % {$mod_divisor} = <strong>{$remainder}</strong><br>"; // Output: 4

echo "<hr>";

echo "<h2>4. Exponentiation (**) - Power</h2>";
$base = 2;
$exponent = 5;

// 2 to the power of 5 (2 * 2 * 2 * 2 * 2)
$power = $base ** $exponent;

echo "{$base} ** {$exponent} = <strong>{$power}</strong><br>"; // Output: 32

echo "<hr>";

echo "<h2>5. Operator Precedence</h2>";
// Multiplication and Division have higher precedence than Addition and Subtraction.
$result_precedence = 5 + 2 * 10;
// 2 * 10 = 20, then 5 + 20 = 25
echo "5 + 2 * 10 = <strong>{$result_precedence}</strong><br>"; // Output: 25

// Parentheses override normal precedence
$result_parentheses = (5 + 2) * 10;
// 5 + 2 = 7, then 7 * 10 = 70
echo "(5 + 2) * 10 = <strong>{$result_parentheses}</strong><br>"; // Output: 70