<?php

// simple_if.php

// The 'if' statement is the most basic control structure. 
// It executes a block of code only if the condition evaluates to TRUE.

echo "<h2>1. Simple If with Boolean Variable</h2>";

$is_maintenance_mode = true;

if ($is_maintenance_mode) {
    echo "The site is currently under maintenance. Please check back later.<br>";
}

echo "<hr>";

echo "<h2>2. If with Numeric Comparison</h2>";

$current_stock = 5;
$reorder_threshold = 10;

// The condition checks if the current stock is less than the reorder threshold.
if ($current_stock < $reorder_threshold) {
    echo "⚠️ Stock level is low ({$current_stock}). Please reorder items.<br>";
}

echo "<hr>";

echo "<h2>3. If with String Comparison (Case-Sensitive)</h2>";

$user_role = "Admin";
$required_role = "Admin";

if ($user_role === $required_role) {
    echo "Access granted. Showing the Admin Dashboard.<br>";
}

// Example where the condition is false
$user_role_lower = "admin";
if ($user_role_lower === $required_role) {
    // This block will NOT execute because 'admin' !== 'Admin'
    echo "This will not print.<br>"; 
}

echo "<hr>";

echo "<h2>4. If with No Braces (Single Statement)</h2>";
// If the block contains only one statement, the braces can be omitted (though generally discouraged for readability).

$is_vip = true;

if ($is_vip) 
    echo "Welcome, VIP Customer!<br>"; 

// This is still treated as part of the 'if' block:
// $message = "This message is also part of the if block."; 
// Note: Only the *first* statement after the if is conditional without braces. 
// Use braces {} for clarity and safety with multiple statements.

?>