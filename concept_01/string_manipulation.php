<?php

// string_manipulation.php

$greeting = "  Hello, World!   ";
$name = "php programming";

// 1. Trim whitespace
$trimmed_greeting = trim($greeting);
echo "Trimmed: '{$trimmed_greeting}'\n"; // Output: 'Hello, World!'

// 2. Convert to uppercase and lowercase
$upper_name = strtoupper($name);
$lower_name = strtolower($trimmed_greeting);
echo "Uppercase: {$upper_name}\n"; // Output: PHP PROGRAMMING
echo "Lowercase: {$lower_name}\n"; // Output: hello, world!

// 3. Get string length
$length = strlen($trimmed_greeting);
echo "Length of '{$trimmed_greeting}': {$length}\n"; // Output: 13

// 4. Find the position of a substring
$position = strpos($trimmed_greeting, "World");
echo "Position of 'World': {$position}\n"; // Output: 7 (starts counting from 0)

// 5. Extract a substring
$substring = substr($trimmed_greeting, 7, 5); // Start at index 7, take 5 characters
echo "Substring: {$substring}\n"; // Output: World

// 6. Replace a substring
$replaced_string = str_replace("World", "PHP", $trimmed_greeting);
echo "Replaced: {$replaced_string}\n"; // Output: Hello, PHP!

// 7. Concatenation
$full_message = $replaced_string . " Learning is fun!";
echo "Concatenated: {$full_message}\n"; // Output: Hello, PHP! Learning is fun!

// 8. Word count
$word_count = str_word_count($full_message);
echo "Word Count: {$word_count}\n"; // Output: 5