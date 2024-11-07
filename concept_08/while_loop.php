<?php

// while_loop.php

// The 'while' loop executes a block of code repeatedly as long as the specified
// condition evaluates to TRUE. The condition is checked BEFORE each iteration.

echo "<h2>1. Basic Count-Up Example</h2>";

$counter = 1;
$limit = 5;

// The loop continues as long as $counter is less than or equal to 5.
while ($counter <= $limit) {
    echo "Current counter value: {$counter}<br>";
    
    // Crucial step: The loop control variable MUST be updated, or it becomes an infinite loop.
    $counter++; 
}

echo "<hr>";

echo "<h2>2. Checking a Condition based on External Data</h2>";

// Imagine this simulates checking a resource status
$is_resource_ready = false;
$attempts = 0;

echo "Attempting to acquire resource...<br>";

// We manually set the flag to true after a few attempts
while (!$is_resource_ready && $attempts < 3) {
    echo "Waiting... Attempt #{$attempts}<br>";
    
    $attempts++;
    
    // Simulate a successful check on the 3rd attempt
    if ($attempts == 3) {
        $is_resource_ready = true;
    }
}

if ($is_resource_ready) {
    echo "Resource is now ready after {$attempts} attempts.<br>";
} else {
    echo "Failed to acquire resource after max attempts.<br>";
}

echo "<hr>";

echo "<h2>3. Using 'break' to Exit the Loop Early</h2>";

$number = 10;

while (true) { // An infinite loop that relies on 'break' for termination
    echo "Current number: {$number}<br>";

    if ($number == 7) {
        echo "Found the target number. Breaking loop.<br>";
        break; // Exit the while loop
    }
    
    $number--; // Decrement the number
}
?>