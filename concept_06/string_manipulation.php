<?php

// string_manipulation.php

$base_string = "  Learn PHP String Functions  ";
$search_text = "PHP";
$replacement_text = "Modern PHP 8";

echo "<h2>Original String: '{$base_string}'</h2>";

// 1. Trimming Whitespace (trim, ltrim, rtrim)
$trimmed_string = trim($base_string);
echo "<h3>1. Trimming</h3>";
echo "Trimmed: '{$trimmed_string}'<br>";

// 2. Case Conversion (strtoupper, strtolower, ucfirst, ucwords)
$upper_string = strtoupper($trimmed_string);
$lower_string = strtolower($trimmed_string);
$ucfirst_string = ucfirst($lower_string);
$ucwords_string = ucwords($lower_string);

echo "<h3>2. Case Conversion</h3>";
echo "Uppercase: {$upper_string}<br>";      // LEARN PHP STRING FUNCTIONS
echo "Lowercase: {$lower_string}<br>";      // learn php string functions
echo "First Char Uppercase: {$ucfirst_string}<br>"; // Learn php string functions
echo "Words Uppercase: {$ucwords_string}<br>";   // Learn Php String Functions

// 3. Length and Searching (strlen, strpos, str_contains)
$length = strlen($trimmed_string);
$position = strpos($trimmed_string, $search_text);
$contains = str_contains($trimmed_string, "Functions");

echo "<h3>3. Length and Position</h3>";
echo "Length: {$length}<br>";
echo "'{$search_text}' found at index: {$position}<br>"; // 6
echo "Contains 'Functions': " . ($contains ? 'Yes' : 'No') . "<br>";

// 4. Substrings (substr)
// Start at index 6 (P in PHP), take 3 characters
$extracted_substring = substr($trimmed_string, $position, 3);
// Get everything after the position
$from_position = substr($trimmed_string, $position);

echo "<h3>4. Substrings</h3>";
echo "Extracted 'PHP': {$extracted_substring}<br>";
echo "From position 6: {$from_position}<br>";

// 5. Replacing Content (str_replace)
$replaced_string = str_replace($search_text, $replacement_text, $trimmed_string);

echo "<h3>5. Replacing</h3>";
echo "Replaced: {$replaced_string}<br>"; // Learn Modern PHP 8 String Functions

// 6. Splitting and Joining (explode, implode)
$sentence = "apple,banana,orange";
$delimiter = ",";
$fruit_array = explode($delimiter, $sentence);
$new_sentence = implode(" | ", $fruit_array);

echo "<h3>6. Splitting and Joining</h3>";
echo "Array (print_r): ";
print_r($fruit_array);
echo "<br>";
echo "Joined: {$new_sentence}<br>"; // apple | banana | orange

?>