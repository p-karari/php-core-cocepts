<?php

// filtering_data.php

// This script demonstrates data validation and filtering in PHP, primarily 
// using the filter_var() and filter_input() functions. Validation checks 
// if data is in a proper format, while filtering cleans or sanitizes data.

echo "<h1>PHP Data Validation and Filtering Demo 🛡️</h1>";

// ---------------------------------------------------------------------
// 1. Setup: Define raw data for filtering (Simulating $_POST or $_GET input)
// ---------------------------------------------------------------------

$raw_data = [
    'email' => ' test@example.com ',
    'age' => '25 years old',
    'url' => 'http://www.google.com',
    'unsafe_html' => '<script>alert("Hacked")</script><h1>User Comment</h1>'
];

echo "<h2>1. Raw Input Data:</h2>";
echo "<pre>"; print_r($raw_data); echo "</pre>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Validation using filter_var()
// ---------------------------------------------------------------------

echo "<h2>2. Data Validation (Checking Format)</h2>";

// 2a. Validate Email Address
$email = $raw_data['email'];
$is_valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);

echo "<li>Email '{$email}': ";
if ($is_valid_email) {
    echo "<span style='color: green;'><strong>Valid</strong></span>. Sanitized: {$is_valid_email}</li>";
} else {
    echo "<span style='color: red;'><strong>Invalid</strong></span> (or filter returned false)</li>";
}

// 2b. Validate Integer Range
$age = $raw_data['age']; // This is a string '25 years old'
$is_valid_age = filter_var($age, FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 18,
        'max_range' => 100
    ]
]);

echo "<li>Age '{$age}': ";
if ($is_valid_age !== false) {
    echo "<span style='color: green;'><strong>Valid</strong></span>. Value: {$is_valid_age}</li>";
} else {
    echo "<span style='color: red;'><strong>Invalid</strong></span>. (Contains non-numeric chars or out of range)</li>";
}

// 2c. Validate URL
$url = $raw_data['url'];
$is_valid_url = filter_var($url, FILTER_VALIDATE_URL);

echo "<li>URL '{$url}': ";
if ($is_valid_url) {
    echo "<span style='color: green;'><strong>Valid</strong></span>.</li>";
} else {
    echo "<span style='color: red;'><strong>Invalid</strong></span>.</li>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Sanitization using filter_var()
// ---------------------------------------------------------------------

echo "<h2>3. Data Sanitization (Cleaning Input)</h2>";

// 3a. Sanitize Unsafe HTML (Prevent XSS)
$unsafe_html = $raw_data['unsafe_html'];
$sanitized_html = filter_var($unsafe_html, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

echo "<li><strong>Original HTML:</strong> <pre>{$unsafe_html}</pre></li>";
echo "<li><strong>Sanitized HTML:</strong> <pre>{$sanitized_html}</pre></li>";
echo "<p><em>The script tags are converted to entities and are harmless.</em></p>";

// 3b. Sanitize/Clean Integer Input
$clean_int = filter_var($raw_data['age'], FILTER_SANITIZE_NUMBER_INT);
echo "<li>Sanitized Age ('{$raw_data['age']}' to int): <strong>{$clean_int}</strong></li>"; // Output: 25

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Using filter_input() (For live $_GET/$_POST)
// ---------------------------------------------------------------------

echo "<h2>4. Using filter_input() (for \$_GET/$_POST)</h2>";
echo "<p><code>filter_input()</code> reads data directly from superglobals like \$_GET or \$_POST, making it ideal for input handling.</p>";

// To test this live, you must access the script with URL parameters:
// Example URL: filtering_data.php?username=Bob&id=42
$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
$user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

echo "<li>Filtered Username (\$_GET['username']): <strong>" . ($username ?: 'N/A') . "</strong></li>";
echo "<li>Validated User ID (\$_GET['id']): <strong>" . ($user_id !== null ? $user_id : 'Invalid/Missing') . "</strong></li>";

?>