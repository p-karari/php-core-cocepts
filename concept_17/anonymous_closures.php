<?php

// anonymous_closures.php

// This script demonstrates Anonymous Functions (or Closures) in PHP.
// They are functions without a specified name that can be stored in a variable 
// and passed as arguments to other functions. They are commonly used for 
// callback functions.

echo "<h1>PHP Anonymous Functions (Closures) Demo 🧑‍💻</h1>";

// ---------------------------------------------------------------------
// 1. Basic Anonymous Function
// ---------------------------------------------------------------------

echo "<h2>1. Basic Anonymous Function</h2>";

// Assign the function to a variable, ending with a semicolon.
$greet = function($name) {
    return "Hello, " . ucfirst($name) . "!";
};

// Execute the anonymous function using the variable name
$message = $greet("alice");
echo "Greeting: <strong>{$message}</strong><br>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Closures: Inheriting Variables from Parent Scope (The 'use' Keyword)
// ---------------------------------------------------------------------

echo "<h2>2. Closures with 'use' (Variable Inheritance)</h2>";

$salutation = "Good day";
$delimiter = "---";

// The 'use' keyword allows the closure to access variables defined in the 
// scope where the closure was declared (the parent scope).
$formal_greet = function($name) use ($salutation, &$delimiter) {
    // The $salutation variable is passed by value (copied)
    // The $delimiter variable is passed by reference (&), allowing modification
    $delimiter = "|||"; // This modification affects the original $delimiter variable
    return "{$salutation}, {$name}{$delimiter}";
};

$formal_message = $formal_greet("Bob");
echo "Formal Greeting: <strong>{$formal_message}</strong><br>";
echo "Original Delimiter after closure execution: <strong>{$delimiter}</strong><br>"; // Output: ||| (modified by reference)
// The $salutation variable remains "Good day" inside the closure.

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Anonymous Function as a Callback
// ---------------------------------------------------------------------

echo "<h2>3. Anonymous Function as an Array Callback</h2>";

$numbers = [1, 2, 3, 4, 5, 6];

echo "Original Array: " . implode(", ", $numbers) . "<br>";

// array_filter uses an anonymous function to decide which elements to keep.
// The array_filter function iterates over the array, passing each value to the callback.
$even_numbers = array_filter($numbers, function($n) {
    return ($n % 2 === 0); // Only return TRUE for even numbers
});

echo "Filtered (Even Numbers): <strong>" . implode(", ", $even_numbers) . "</strong><br>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Arrow Functions (Shorthand for simple closures - PHP 7.4+)
// ---------------------------------------------------------------------

echo "<h2>4. Arrow Functions (fn shorthand - PHP 7.4+)</h2>";
echo "<p>Arrow functions are concise syntax for closures that automatically import variables from the parent scope by value.</p>";

$factor = 10;

// Syntax: fn(arguments) => expression
// The $factor variable is automatically available (by value) without 'use'.
$multiplier = fn($n) => $n * $factor;

$result_multiplied = array_map($multiplier, [1, 5, 10]);

echo "Factor: {$factor}<br>";
echo "Mapped Results (x {$factor}): <strong>" . implode(", ", $result_multiplied) . "</strong><br>"; // 10, 50, 100
?>