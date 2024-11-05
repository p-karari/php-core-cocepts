<?php

// formatting_names.php

// This script demonstrates different ways to format names using PHP string functions.

$raw_name_input = "  john Doe smith ";
$database_first_name = "alexander";
$database_last_name = "THE GREAT";
$names_array = ["mary", "jane", "doe"];

echo "<h2>1. Cleaning and Basic Case Formatting</h2>";

// 1. Clean up whitespace and standardize case
$clean_name = trim($raw_name_input);
echo "Original: '{$raw_name_input}'<br>";
echo "Trimmed: '{$clean_name}'<br>";

// 2. Convert to Title Case (First letter of each word capitalized)
$formatted_title_case = ucwords(strtolower($clean_name));
echo "Title Case: {$formatted_title_case}<br>"; // Output: John Doe Smith

// 3. Convert to Uppercase (for display/identification)
$formatted_uppercase = strtoupper($clean_name);
echo "Uppercase: {$formatted_uppercase}<br>"; // Output: JOHN DOE SMITH

echo "<hr>";

echo "<h2>2. Formatting from Database Fields</h2>";

// Assume data comes from a database that isn't perfectly cased
$full_db_name = $database_first_name . " " . $database_last_name;

// 4. Standard First Name (First letter only capitalized)
$standard_first_name = ucfirst(strtolower($database_first_name));
echo "Standard First Name: {$standard_first_name}<br>"; // Output: Alexander

// 5. Full Name Title Case
$standard_full_name = ucwords(strtolower($full_db_name));
echo "Standard Full Name: {$standard_full_name}<br>"; // Output: Alexander The Great

echo "<hr>";

echo "<h2>3. Generating Initials</h2>";

$name_parts = explode(" ", $formatted_title_case); // ['John', 'Doe', 'Smith']
$initials = "";

// Loop through each part of the name
foreach ($name_parts as $part) {
    // Get the first character of each word and append it
    $initials .= strtoupper(substr($part, 0, 1));
}

echo "Full Name: {$formatted_title_case}<br>";
echo "Initials: <strong>{$initials}</strong><br>"; // Output: JDS

echo "<hr>";

echo "<h2>4. Formatting Names from an Array</h2>";

// Format a list of names for display in a sentence
$formatted_list = [];
foreach ($names_array as $name) {
    $formatted_list[] = ucfirst($name);
}

// Join the array into a comma-separated string
$name_list_string = implode(", ", $formatted_list);
echo "Formatted List: {$name_list_string}<br>"; // Output: Mary, Jane, Doe
?>