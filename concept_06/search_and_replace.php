<?php

// search_and_replace.php

// PHP provides several functions for searching for and replacing content within strings.

echo "<h2>1. Simple String Replacement (str_replace)</h2>";
// str_replace: Case-sensitive replacement of all occurrences.

$text = "The quick brown fox jumps over the lazy fox.";
$search = "fox";
$replace = "dog";

// Replace all instances of 'fox' with 'dog'
$new_text = str_replace($search, $replace, $text);

echo "Original: {$text}<br>";
echo "Replaced: {$new_text}<br>";
// Output: The quick brown dog jumps over the lazy dog.

echo "<hr>";

echo "<h2>2. Case-Insensitive String Replacement (str_ireplace)</h2>";
// str_ireplace: Case-insensitive version of str_replace.

$text_case = "I Love PHP, but some people write php.";
$search_case = "php";
$replace_case = "JavaScript";

// Replaces "PHP" and "php" with "JavaScript"
$new_text_case = str_ireplace($search_case, $replace_case, $text_case);

echo "Original: {$text_case}<br>";
echo "Replaced (i): {$new_text_case}<br>";
// Output: I Love JavaScript, but some people write JavaScript.

echo "<hr>";

echo "<h2>3. Multiple Search/Replace (Array Input)</h2>";
// Both str_replace and str_ireplace accept arrays for multiple items.

$message = "Hello [USER_NAME], your [PRODUCT] order is confirmed.";
$searches = ["[USER_NAME]", "[PRODUCT]"];
$replacements = ["Alex", "Widget Pro"];

// Replaces all array elements in one go
$personalized_message = str_replace($searches, $replacements, $message);

echo "Template: {$message}<br>";
echo "Result: {$personalized_message}<br>";

echo "<hr>";

echo "<h2>4. Substring Replacement by Position (substr_replace)</h2>";
// substr_replace: Replaces a specific portion of a string defined by start and length.

$code = "ERR_CODE_503_SERVER";
// Replace 503 with 404
// Start at index 9 (the '5'), replace 3 characters (503)
$fixed_code = substr_replace($code, "404", 9, 3); 

echo "Original Code: {$code}<br>";
echo "Fixed Code: {$fixed_code}<br>";
// Output: ERR_CODE_404_SERVER

echo "<hr>";

echo "<h2>5. Regular Expression Replacement (preg_replace)</h2>";
// preg_replace: Powerful replacement using regular expressions (for patterns).

$phone_number = "Call us at (123) 456-7890 or 987.654.3210.";
$pattern = '/\D/'; // Matches any non-digit character

// Remove all non-digit characters
$digits_only = preg_replace($pattern, '', $phone_number);

echo "Original Phone: {$phone_number}<br>";
echo "Digits Only: {$digits_only}<br>"; // 12345678909876543210
?>