<?php

// string_and_init.php

// 1. String Initialization (Assigning a literal value)
$author_name = "Jane Smith";
$book_title = 'The PHP Handbook';
$version = "8.3";

echo "<h2>1. Basic Initialization</h2>";
echo "Author: {$author_name}<br>";
echo "Title: {$book_title}<br>";

// 2. String Initialization from Concatenation
$full_title = $book_title . " - Version " . $version;
echo "Full Title: {$full_title}<br>";

// 3. Initialization using Variable Interpolation (Double Quotes)
$message = "The author, $author_name, released version $version.";
echo "Interpolated Message: {$message}<br>";

// 4. Initialization to an Empty String
$empty_string_1 = "";
$empty_string_2 = '';
$empty_string_3 = (string) 0; // Explicitly casting to an empty string from 0 is complex, better to use ""

echo "<h2>2. Empty String Checks</h2>";
echo "Is \$empty_string_1 empty? " . (empty($empty_string_1) ? 'Yes' : 'No') . "<br>";

// 5. Initialization from Null (Variables that have not been set, or explicitly set to null)
// Note: An uninitialized variable will raise a Notice, but is considered NULL.
$uninitialized_string; // Will be NULL
$explicitly_null = null;

// The following line will generate a Notice if displayed without checking/setting
// echo "Uninitialized: " . $uninitialized_string . "<br>";

echo "<h2>3. Initialization from Null</h2>";
// A common pattern to safely initialize a variable that might be null/unset
$safe_string = $uninitialized_string ?? "Default Value"; // PHP 7+ Null Coalescing Operator
echo "Safe Initialization: {$safe_string}<br>";

// 6. Initialization using Heredoc Syntax (for multi-line strings)
$html_content = <<<HTML
<div class="container">
    <h1>Welcome</h1>
    <p>This content was initialized using Heredoc syntax.</p>
    <p>The variable interpolation works here too: {$author_name}</p>
</div>
HTML;

echo "<h2>4. Heredoc Initialization</h2>";
echo $html_content;

?>