<?php

// next_and_current.php

// This script demonstrates the use of the next() and current() functions 
// to manually navigate the internal array pointer in PHP.

echo "<h1>PHP Array Pointer: next() and current() 🚶</h1>";

$planets = ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn"];

echo "<h2>Original Array:</h2>";
echo "<p>" . implode(", ", $planets) . "</p>";

echo "<hr>";

echo "<h2>1. Initial State (Using reset() and current())</h2>";

// The pointer is initially at the first element when the array is created, 
// but using reset() ensures it's at the start for explicit demonstration.
$initial_value = reset($planets);
echo "1. Current value after <strong>reset()</strong>: <strong>{$initial_value}</strong><br>"; // Mercury

// current() returns the element the pointer is currently on.
$current_value = current($planets);
echo "2. Current value: <strong>{$current_value}</strong><br>"; // Mercury

echo "<hr>";

echo "<h2>2. Advancing the Pointer (Using next())</h2>";

echo "<h3>Step-by-Step Movement:</h3>";

// ---------------------------------------------------------------------
// 1st next() call
// ---------------------------------------------------------------------
$next1 = next($planets); // Pointer moves to index 1 (Venus)
echo "3. next() returns: <strong>{$next1}</strong><br>";
echo "4. current() is now: " . current($planets) . "<br>"; // Venus

// ---------------------------------------------------------------------
// 2nd next() call
// ---------------------------------------------------------------------
$next2 = next($planets); // Pointer moves to index 2 (Earth)
echo "5. next() returns: <strong>{$next2}</strong><br>";
echo "6. current() is now: " . current($planets) . "<br>"; // Earth

// ---------------------------------------------------------------------
// Loop until the end
// ---------------------------------------------------------------------

echo "<h3>Looping to the End:</h3>";
// Move the pointer back to the start
reset($planets); 

echo "<p>Starting loop from: " . current($planets) . "</p>";

while (current($planets) !== false) {
    echo "Processing: <strong>" . current($planets) . "</strong><br>";
    // Advance the pointer to the next element
    next($planets);
}

echo "<hr>";

echo "<h2>3. Reaching the End</h2>";

// When next() is called past the last element, the pointer is set to a 
// position after the last element, and both next() and current() return false.
$next_at_end = next($planets);
echo "7. next() returns (after end): <strong>" . var_export($next_at_end, true) . "</strong><br>";

$current_at_end = current($planets);
echo "8. current() returns (after end): <strong>" . var_export($current_at_end, true) . "</strong><br>";

// We can reset the pointer again to start over
reset($planets);
echo "9. After reset(), current() is: <strong>" . current($planets) . "</strong><br>"; // Mercury

?>