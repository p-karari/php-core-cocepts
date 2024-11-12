<?php

// sanitization.php

// Sanitization is the process of cleaning up user-supplied data to ensure it's 
// safe and valid for its intended use (e.g., displaying in HTML, storing in a database).
// This is critical for preventing security vulnerabilities like XSS.

echo "<h1>PHP Data Sanitization Demo 🧹</h1>";

// ---------------------------------------------------------------------
// 1. Setup: Define raw, potentially malicious user input
// ---------------------------------------------------------------------

$raw_input = [
    'unsafe_html' => 'Hello! <script>alert("XSS Attack!");</script>',
    'email_address' => ' test@example.com ', // Has leading/trailing whitespace
    'url_input' => 'http://malicious.link/search?q=<inject>',
    'int_input' => '123abc456'
];

echo "<h2>Raw Input:</h2>";
echo "<pre>";
print_r($raw_input);
echo "</pre>";

echo "<hr>";

echo "<h2>2. Sanitization using filter_var()</h2>";

// The filter_var() function is the recommended way to sanitize data in PHP.

// ---------------------------------------------------------------------
// 2a. Sanitize for HTML Output (Preventing XSS)
// ---------------------------------------------------------------------
$sanitized_html = filter_var($raw_input['unsafe_html'], FILTER_SANITIZE_SPECIAL_CHARS);

echo "<h3>Sanitize HTML (XSS Protection):</h3>";
echo "<strong>Original:</strong> {$raw_input['unsafe_html']}<br>";
echo "<strong>Sanitized Output:</strong> <code>{$sanitized_html}</code><br>";
echo "<p><em>The script tags are converted to HTML entities (&lt;script&gt;) and won't execute.</em></p>";

// ---------------------------------------------------------------------
// 2b. Sanitize Email Address (Trimming and Cleaning)
// ---------------------------------------------------------------------
$sanitized_email = filter_var($raw_input['email_address'], FILTER_SANITIZE_EMAIL);

echo "<h3>Sanitize Email:</h3>";
echo "<strong>Original:</strong> '{$raw_input['email_address']}'<br>";
echo "<strong>Sanitized Output:</strong> '{$sanitized_email}'<br>";
echo "<p><em><code>FILTER_SANITIZE_EMAIL</code> removes illegal characters and whitespace.</em></p>";

// ---------------------------------------------------------------------
// 2c. Sanitize URL
// ---------------------------------------------------------------------
$sanitized_url = filter_var($raw_input['url_input'], FILTER_SANITIZE_URL);

echo "<h3>Sanitize URL:</h3>";
echo "<strong>Original:</strong> {$raw_input['url_input']}<br>";
echo "<strong>Sanitized Output:</strong> {$sanitized_url}<br>";
echo "<p><em>Removes characters not valid in a URL (like angle brackets).</em></p>";

// ---------------------------------------------------------------------
// 2d. Sanitize Integer
// ---------------------------------------------------------------------
$sanitized_int = filter_var($raw_input['int_input'], FILTER_SANITIZE_NUMBER_INT);

echo "<h3>Sanitize Integer:</h3>";
echo "<strong>Original:</strong> {$raw_input['int_input']}<br>";
echo "<strong>Sanitized Output:</strong> {$sanitized_int}<br>"; // Output: 123456
echo "<p><em>Removes all characters except digits, plus, and minus sign.</em></p>";

echo "<hr>";

echo "<h2>3. Sanitization using htmlspecialchars()</h2>";

// htmlspecialchars() is the most common manual sanitization function for displaying data.
$manual_html_escape = htmlspecialchars($raw_input['unsafe_html']);

echo "<h3>Using htmlspecialchars():</h3>";
echo "<strong>Sanitized Output:</strong> <code>{$manual_html_escape}</code><br>";
echo "<p><em>This function converts only the 5 main HTML entities (& < > \" ') to their safe equivalents.</em></p>";

?>