<?php

// simple_addition.php

// This script demonstrates a very basic PHP program to perform and display 
// the result of an arithmetic addition operation.

echo "<h1>Simple PHP Addition Example ➕</h1>";

// 1. Define two variables to hold the numbers.
$number1 = 50;
$number2 = 25;

// 2. Perform the addition operation.
$sum = $number1 + $number2;

// 3. Output the result to the browser.

echo "<h2>The Calculation:</h2>";
echo "<p>First Number: {$number1}</p>";
echo "<p>Second Number: {$number2}</p>";

echo "<h2>The Result:</h2>";
echo "<p>When {$number1} is added to {$number2}, the sum is:</p>";
echo "<strong>{$number1} + {$number2} = {$sum}</strong>";

// 4. Perform a direct calculation without intermediate variables.
echo "<h3>Another direct addition:</h3>";
echo "<p>100 + 7 = <strong>" . (100 + 7) . "</strong></p>";

?>