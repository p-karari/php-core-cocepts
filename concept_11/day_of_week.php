<?php

// day_of_week.php

// This script determines the current day of the week and provides a custom message.

echo "<h2>Day of Week Status Checker 🗓️</h2>";

// 1. Get the current day of the week.
// date('N') returns the numeric representation of the day (1 for Monday through 7 for Sunday).
$day_number = (int) date('N'); 

// date('l') returns the full textual representation of the day of the week.
$day_name = date('l'); 

echo "<p>Today is: <strong>{$day_name}</strong> (Day {$day_number})</p>";

// 2. Use a switch statement for efficient multi-way decision based on the day number.
$message = "";

switch ($day_number) {
    case 1:
        $message = "It's the start of the week! Time to tackle those goals. ☕";
        break;
    case 2:
    case 3:
    case 4:
        $message = "Mid-week hustle is in full swing. Keep going! 💪";
        break;
    case 5:
        $message = "It's Friday! The weekend is almost here. 🎉";
        break;
    case 6:
        $message = "Saturday! Enjoy your day off. Get some rest or have fun. 🥳";
        break;
    case 7:
        $message = "Sunday. Perfect for winding down and preparing for the week ahead. 🧘";
        break;
    default:
        // This case should theoretically never be reached with date('N').
        $message = "Error: Could not determine the day of the week.";
}

echo "<h3>Daily Status:</h3>";
echo "<p>{$message}</p>";

echo "<hr>";

// 3. Alternative: Using if/elseif/else for checking weekend vs. weekday
echo "<h2>Alternative Check: Weekend or Weekday?</h2>";

if ($day_number >= 6) { // 6 (Sat) or 7 (Sun)
    echo "<p style='color: blue;'><strong>It's the Weekend!</strong> Enjoy your time off.</p>";
} else { // 1 through 5 (Mon-Fri)
    echo "<p style='color: green;'><strong>It's a Weekday.</strong> Back to work!</p>";
}

?>