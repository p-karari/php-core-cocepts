<?php

// basic_string.php

// 1. Simple single-quoted string (literal string - no variable interpolation)
$single_quote_string = 'This is a simple string.';
echo $single_quote_string . "\n";

// 2. Double-quoted string (allows variable interpolation and escape sequences)
$name = "Alice";
$age = 30;
$double_quote_string = "Hello, $name! You are $age years old.\n";
echo $double_quote_string;

// 3. String with escape characters
$escaped_string = "This line has a newline character.\nAnd this is the second line.";
echo $escaped_string . "\n";

$quote_string = "She said, \"PHP is great!\"";
echo $quote_string . "\n";

// 4. Concatenation using the dot operator (.)
$city = "New York";
$greeting = "Welcome to " . $city . "!";
echo $greeting . "\n";

// 5. Appending to a string using the concatenation assignment operator (.=)
$message = "Start here. ";
$message .= "Then add this part. ";
$message .= "Finally, end it.";
echo $message . "\n";

// 6. Accessing characters by index (like an array)
$word = "EXAMPLE";
$first_char = $word[0]; // E
$third_char = $word[2]; // A
echo "First character: $first_char\n";
echo "Third character: $third_char\n";

// 7. Heredoc syntax for multi-line strings (like double quotes)
$product = "Widget Pro";
$description = <<<HTML
This is a multi-line HTML block.
The product name is: <strong>$product</strong>.
It preserves all whitespace and newlines.
The delimiter (HTML) must be on a line by itself.
HTML;
echo $description . "\n";

// 8. Nowdoc syntax for literal multi-line strings (like single quotes, no interpolation)
$code = <<<'PHP_CODE'
function hello() {
    echo 'Hello World!';
}
// Variables like $product are NOT expanded here.
PHP_CODE;
echo $code . "\n";