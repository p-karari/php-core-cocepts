<?php

// ternary_operator.php

// The ternary operator (?:) is a concise shorthand for a simple if-else statement.
// Syntax: (condition) ? value_if_true : value_if_false;

echo "<h2>1. Basic Ternary Operator</h2>";

$is_logged_in = false;
$user_status = "";

// If $is_logged_in is true, $user_status gets "Online", otherwise it gets "Offline".
$user_status = $is_logged_in ? "Online" : "Offline";

echo "User Status: <strong>{$user_status}</strong><br>";

// Change the condition
$is_logged_in = true;
$user_status = $is_logged_in ? "Online" : "Offline";
echo "User Status (Logged In): <strong>{$user_status}</strong><br>";

echo "<hr>";

echo "<h2>2. Assigning Function/Method Results</h2>";

function get_discount_rate(bool $is_vip): float {
    // Return 0.15 (15%) if VIP, else 0.05 (5%)
    return $is_vip ? 0.15 : 0.05;
}

$is_premium_customer = true;
$discount = get_discount_rate($is_premium_customer);

echo "Premium Customer Discount: " . ($discount * 100) . "%<br>";

echo "<hr>";

echo "<h2>3. The Elvis Operator (?:) - PHP 5.3+</h2>";

// The middle part of the ternary operator can be omitted.
// Syntax: condition ?: value_if_false
// This means: If 'condition' is TRUE, use 'condition', otherwise use 'value_if_false'.
// This is useful for checking if a value exists and using it if it does.

$name_from_session = "Alice"; // Assume this is a variable or function call result

// If $name_from_session is truthy, use it; otherwise, use "Guest".
$display_name = $name_from_session ?: "Guest"; 

echo "Display Name: {$display_name}<br>";

$name_from_session = ""; // Empty string is falsy

$display_name = $name_from_session ?: "Guest"; 
echo "Display Name (Empty String): {$display_name}<br>";

echo "<hr>";

echo "<h2>4. Combining in Output</h2>";
$stock_level = 0;

echo "The item is " . ($stock_level > 0 ? "In Stock" : "Out of Stock") . ".<br>";

?>