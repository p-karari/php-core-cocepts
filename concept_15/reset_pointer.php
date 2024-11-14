<?php

// reset_pointer.php

// This script demonstrates the use of the reset() function, which moves 
// the internal pointer of an array to the first element (index 0).

echo "<h1>PHP Array Pointer: reset() Function ↩️</h1>";

$data = [
    "first_name" => "Alice",
    "last_name" => "Smith",
    "age" => 30,
    "city" => "London"
];

echo "<h2>Original Array (Associative):</h2>";
echo "<pre>";
print_r($data);
echo "</pre>";

echo "<hr>";

echo "<h2>1. Manipulating the Pointer (Moving to the End)</h2>";

// Use end() to move the pointer to the last element
$last_element = end($data);
echo "1. Pointer moved to end. current() value: <strong>{$last_element}</strong><br>"; // London
echo "2. key() at end: <strong>" . key($data) . "</strong><br>"; // city

// Use prev() to move the pointer backward one step
$prev_element = prev($data);
echo "3. Pointer moved back. current() value: <strong>{$prev_element}</strong><br>"; // 30
echo "4. key() at this point: <strong>" . key($data) . "</strong><br>"; // age

echo "<hr>";

echo "<h2>2. Resetting the Pointer</h2>";

// Use reset() to move the internal pointer back to the start
$first_element = reset($data);

echo "<p style='color: green;'><strong>reset() has been called.</strong></p>";

// Now, current() and key() should reflect the first element
echo "5. current() value after <strong>reset()</strong>: <strong>{$first_element}</strong><br>"; // Alice
echo "6. key() after <strong>reset()</strong>: <strong>" . key($data) . "</strong><br>"; // first_name

echo "<hr>";

echo "<h2>3. Example: Ensuring a Loop Starts Correctly</h2>";

// The foreach loop handles the pointer automatically, but manual iteration 
// or functions like current()/next() rely on the pointer position.

// First, deliberately move the pointer off the start position
next($data); 
echo "Current value before reset in loop example: " . current($data) . "<br>"; // Smith

echo "<h3>Iterating from the start:</h3>";

// Always call reset() before manual iteration loops to ensure the array is processed from the beginning.
reset($data);

$i = 1;
// Manually iterate through the array using the pointer functions
while (current($data) !== false) {
    echo "Iteration {$i}: Key = " . key($data) . ", Value = " . current($data) . "<br>";
    next($data); // Move pointer to the next element
    $i++;
}

?>