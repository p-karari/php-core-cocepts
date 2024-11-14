<?php

// array_pointers.php

// This script demonstrates array pointers in PHP, which are internal mechanisms 
// that track the "current" element of an array. Key functions for array pointers 
// are current(), next(), prev(), reset(), and end().

echo "<h1>PHP Array Pointer Demonstration ➡️</h1>";

$colors = ["Red", "Green", "Blue", "Yellow", "Purple"];

echo "<h2>Original Array:</h2>";
echo "<pre>";
print_r($colors);
echo "</pre>";

echo "<hr>";

echo "<h2>1. reset() and current()</h2>";
// reset(): Moves the internal pointer to the first element (index 0).
// current(): Returns the value of the array's current element.

// Ensure pointer starts at the beginning
echo "Initial state (reset): ";
echo "Current value: <strong>" . reset($colors) . "</strong><br>"; // Red

echo "<hr>";

echo "<h2>2. next()</h2>";
// next(): Advances the internal pointer one position and returns the value of 
// the new current element. Returns false if the end is reached.

echo "Moving to the next element:<br>";

// 1st next() call
$next1 = next($colors);
echo "1st Next: <strong>{$next1}</strong> (Pointer now at Green)<br>";

// 2nd next() call
$next2 = next($colors);
echo "2nd Next: <strong>{$next2}</strong> (Pointer now at Blue)<br>";

// current() still shows the last element reached
echo "Current value: <strong>" . current($colors) . "</strong><br>"; // Blue

echo "<hr>";

echo "<h2>3. end() and prev()</h2>";
// end(): Moves the internal pointer to the last element.
// prev(): Moves the internal pointer one position backward and returns the value.

echo "Moving to the end (end): <strong>" . end($colors) . "</strong><br>"; // Purple

echo "Moving backward (prev):<br>";

// 1st prev() call
$prev1 = prev($colors);
echo "1st Prev: <strong>{$prev1}</strong> (Pointer now at Yellow)<br>";

// 2nd prev() call
$prev2 = prev($colors);
echo "2nd Prev: <strong>{$prev2}</strong> (Pointer now at Blue)<br>";

echo "<hr>";

echo "<h2>4. key() and each() (Deprecated)</h2>";

// key(): Returns the index or key of the current element.
echo "Current Key: <strong>" . key($colors) . "</strong><br>"; // 2 (for Blue)

// each() was commonly used for iteration but is deprecated in PHP 7.2 
// and removed in PHP 8.0. The `foreach` loop is the modern replacement.

/*
echo "<h3>Each loop (DEPRECATED):</h3>";
reset($colors);
while (list($key, $value) = each($colors)) {
    echo "Key: $key, Value: $value<br>";
}
*/

echo "<h3>Modern Iteration (foreach):</h3>";
echo "<p>The <code>foreach</code> loop is the preferred way to iterate over arrays and manage the pointer implicitly.</p>";

?>