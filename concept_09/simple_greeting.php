<?php

// simple-greeting.php

// This script demonstrates a very basic PHP program to output a greeting.

// 1. Define a variable to hold a name.
$username = "Guest";

// 2. Define a function to generate a simple greeting message.
function generate_greeting(string $name): string {
    // Get the current hour (24-hour format)
    $hour = (int) date("H");
    
    // Determine the appropriate time-based greeting
    if ($hour < 12) {
        $time_greeting = "Good morning";
    } elseif ($hour < 18) {
        $time_greeting = "Good afternoon";
    } else {
        $time_greeting = "Good evening";
    }
    
    // Concatenate and return the final message
    return "<h1>{$time_greeting}, {$name}!</h1>";
}

// 3. Call the function and output the result using echo.
$greeting_html = generate_greeting($username);

echo $greeting_html;

// 4. A simple direct output for comparison
echo "<p>Welcome to the server-side script.</p>";

// To test dynamic behavior, run this script at different times of the day.

?>