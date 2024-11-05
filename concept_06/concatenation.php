<?php

// concatenation.php

// Concatenation is the operation of joining two or more strings end-to-end.
// In PHP, the dot operator (.) is used for concatenation.

$first_name = "Alice";
$last_name = "Wonderland";
$greeting_verb = "welcomes";
$punctuation = "!";
$number_of_visits = 5;

echo "<h2>1. Basic Concatenation using the Dot Operator (.)</h2>";

// Concatenating multiple string variables
$full_name = $first_name . " " . $last_name;
echo "Full Name: {$full_name}<br>"; // Output: Alice Wonderland

// Concatenating strings and a numeric variable (PHP automatically casts the number to a string)
$welcome_message = "The account for " . $full_name . " " . $greeting_verb . " you back. " . $number_of_visits . " visits recorded" . $punctuation;
echo "Message: {$welcome_message}<br>";
// Output: The account for Alice Wonderland welcomes you back. 5 visits recorded!

echo "<hr>";

echo "<h2>2. Concatenation Assignment Operator (.=)</h2>";

// The concatenation assignment operator is used to append a string to the end of an existing string variable.
$log_entry = "Log start: ";
$log_entry .= "User login on " . date("Y-m-d"); // Appends the first part
$log_entry .= ". Status: OK."; // Appends the second part

echo "Log Entry: {$log_entry}<br>";

echo "<hr>";

echo "<h2>3. Concatenation inside Double-Quoted Strings (Interpolation)</h2>";

// Concatenation is often avoided inside double quotes by using variable interpolation.
// While not strictly concatenation, it achieves a similar result in a cleaner way for variables.
$city = "London";
$country = "UK";

// The output is a single joined string, but no '.' operator is used.
$location_string = "You are currently located in {$city}, {$country}.";
echo "Interpolated Location: {$location_string}<br>";

// Complex interpolation (accessing array/object properties or functions) often requires braces {}.
$item_price = 19.99;
$output_price = "The price is $ {$item_price}.";
echo "Interpolated Price: {$output_price}<br>";

echo "<hr>";

echo "<h2>4. Combining Interpolation and Concatenation</h2>";

$item_name = "Laptop";
$discount = 10;

// Interpolation for item_name, concatenation for the rest.
$final_string = "Your item, {$item_name}, has a discount of " . $discount . "% today.";
echo "Combined String: {$final_string}<br>";
?>