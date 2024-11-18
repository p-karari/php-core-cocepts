<?php

// arrow_functions.php

// This script demonstrates **Arrow Functions** in PHP, introduced in PHP 7.4. 
// They provide a concise syntax for defining anonymous functions (closures) 
// that consist of a single expression.

echo "<h1>PHP Arrow Functions (fn) Demo 🏹</h1>";
echo "<p>Arrow functions are a syntactic sugar for simple closures. They automatically inherit variables from the parent scope **by value**.</p>";

// ---------------------------------------------------------------------
// 1. Basic Arrow Function Syntax
// ---------------------------------------------------------------------

echo "<h2>1. Basic Syntax: fn(args) => expression</h2>";

// Standard closure equivalent:
// $add_closure = function($a, $b) { return $a + $b; };

// Arrow function syntax:
$add_arrow = fn($a, $b) => $a + $b;

$result = $add_arrow(10, 5);
echo "<li>Result of fn(10, 5) => \$a + \$b: <strong>{$result}</strong></li>";

// Arrow functions are perfect for simple, single-line logic.
$is_even = fn($n) => $n % 2 === 0;
$check = 14;
echo "<li>Is {$check} even? <strong>" . ($is_even($check) ? 'Yes' : 'No') . "</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Automatic Variable Inheritance (No 'use' keyword)
// ---------------------------------------------------------------------

echo "<h2>2. Automatic Variable Inheritance (By Value)</h2>";

$discount_rate = 0.25; // Variable in the parent scope
$shipping_fee = 10;    // Variable in the parent scope

// The $discount_rate and $shipping_fee variables are automatically available 
// inside the arrow function without the `use` keyword.
$calculate_final_price = fn($price) => ($price * (1 - $discount_rate)) + $shipping_fee;

$initial_price = 100;
$final_price = $calculate_final_price($initial_price);

echo "<li>Initial Price: \${$initial_price}</li>";
echo "<li>Discount Rate: {$discount_rate}</li>";
echo "<li>Shipping Fee: \${$shipping_fee}</li>";
echo "<li>Final Price: <strong>\${$final_price}</strong></li>"; // (100 * 0.75) + 10 = 85

// Note on Scope: Arrow functions inherit by **value**. Changing the external 
// variable *after* declaration will not affect the function's logic.
$discount_rate = 0.50; // Changing the external variable

$new_final_price = $calculate_final_price(100);
echo "<li>Final Price (after external change): <strong>\${$new_final_price}</strong></li>"; // Still 85 (uses original 0.25 rate)

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Arrow Function as an Array Callback
// ---------------------------------------------------------------------

echo "<h2>3. Used as an Array Callback (array_map)</h2>";

$numbers = [1, 2, 3, 4, 5];
$factor = 3;

// array_map uses the arrow function to multiply each element by $factor
$multiplied_numbers = array_map(fn($n) => $n * $factor, $numbers);

echo "Original: " . implode(", ", $numbers) . "<br>";
echo "Factor: {$factor}<br>";
echo "Mapped (x{$factor}): <strong>" . implode(", ", $multiplied_numbers) . "</strong><br>"; // 3, 6, 9, 12, 15
?>