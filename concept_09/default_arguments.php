<?php

// default-arguments.php

// Default arguments (or optional parameters) allow a function to use a 
// preset value if no argument is passed for that parameter during the function call.

echo "<h2>1. Basic Default Argument</h2>";

// 1. Function with a default argument
function generate_log(string $message, string $level = "INFO") {
    $timestamp = date("Y-m-d H:i:s");
    echo "[{$timestamp}] [{$level}] {$message}<br>";
}

// Call 1: Use the default level ("INFO")
generate_log("User logged in successfully.");

// Call 2: Override the default level
generate_log("Database connection failed.", "ERROR");

echo "<hr>";

echo "<h2>2. Multiple Default Arguments</h2>";

// 2. Function with multiple parameters, some having defaults
function format_price(float $amount, string $currency = "$", int $decimals = 2) {
    // Format the number to the specified decimal places
    $formatted_amount = number_format($amount, $decimals);
    return "{$currency}{$formatted_amount}";
}

$cost = 125.759;

// Call 1: Use all defaults ($, 2 decimals)
echo "Default Format: " . format_price($cost) . "<br>"; // $125.76

// Call 2: Override currency
echo "Euro Format: " . format_price($cost, "€") . "<br>"; // €125.76

// Call 3: Override currency and decimals
echo "Yen Format (0 decimals): " . format_price($cost, "¥", 0) . "<br>"; // ¥126

echo "<hr>";

echo "<h2>3. Placement of Default Arguments</h2>";

// Note: Parameters with default values MUST be placed AFTER parameters 
// without default values.

// function invalid_order(string $name = "Guest", int $age) // This would cause a syntax error
// { ... }

function greet_vip(string $name, bool $is_vip = false) {
    $title = $is_vip ? "VIP" : "Standard User";
    echo "Welcome, {$name}. Access as: {$title}.<br>";
}

// Call 1: Omit the optional argument
greet_vip("Charlie");

// Call 2: Specify the optional argument
greet_vip("Dana", true);

?>