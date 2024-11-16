<?php

// scalar_arguments.php

// This script demonstrates the use of scalar type declarations (type hints) 
// for function arguments in PHP. Scalar types include int, float, string, and bool.

echo "<h1>PHP Scalar Type Arguments Demonstration 🧑‍💻</h1>";
echo "<p>Scalar type hints ensure that the data passed to a function matches the expected primitive type, improving reliability and serving as self-documenting code.</p>";

// Note: Without `declare(strict_types=1);`, PHP will attempt to coerce the value 
// (e.g., converting the string "5" to the integer 5).

// ---------------------------------------------------------------------
// 1. Function with Integer (int) Argument
// ---------------------------------------------------------------------

echo "<h2>1. Integer Type (int)</h2>";

/**
 * Calculates the total number of items needed based on a base quantity and a multiplier.
 * @param int $quantity The base number of items.
 * @param int $multiplier The factor to multiply by.
 * @return int The total number of items.
 */
function calculate_inventory(int $quantity, int $multiplier): int {
    return $quantity * $multiplier;
}

$q = 15;
$m = 3;
$total_items = calculate_inventory($q, $m);
echo "<li>Inventory needed for {$q} items x {$m} multiplier: <strong>{$total_items}</strong></li>";

// Example of coercion (if strict_types=0 is default):
$q_string = "20"; // PHP will convert this string to an integer
$total_coerced = calculate_inventory($q_string, $m);
echo "<li>Coerced example ('20' as string): <strong>{$total_coerced}</strong> (coercion successful)</li>";


echo "<hr>";

// ---------------------------------------------------------------------
// 2. Function with Float (float) Argument
// ---------------------------------------------------------------------

echo "<h2>2. Float Type (float)</h2>";

/**
 * Calculates the shipping cost based on weight and a fixed rate.
 * @param float $weight The weight in kilograms.
 * @return float The shipping cost.
 */
function calculate_shipping(float $weight): float {
    $rate_per_kg = 2.5;
    return $weight * $rate_per_kg;
}

$w = 1.75;
$shipping_cost = calculate_shipping($w);
echo "<li>Shipping cost for {$w} kg: <strong>\${$shipping_cost}</strong></li>";


echo "<hr>";

// ---------------------------------------------------------------------
// 3. Function with String (string) Argument
// ---------------------------------------------------------------------

echo "<h2>3. String Type (string)</h2>";

/**
 * Formats a message with a user name.
 * @param string $user The name of the user.
 * @return string The formatted greeting.
 */
function welcome_user(string $user): string {
    return "Welcome back, " . ucfirst($user) . ".";
}

$username = "charlie";
$greeting = welcome_user($username);
echo "<li>Greeting: <strong>{$greeting}</strong></li>";

// Example of passing a number (if strict_types=0 is default):
$user_id = 42; // PHP will convert the number 42 to the string "42"
$greeting_coerced = welcome_user($user_id);
echo "<li>Coerced example (42 as int): <strong>{$greeting_coerced}</strong></li>";


echo "<hr>";

// ---------------------------------------------------------------------
// 4. Function with Boolean (bool) Argument
// ---------------------------------------------------------------------

echo "<h2>4. Boolean Type (bool)</h2>";

/**
 * Sets the status message based on whether an operation was successful.
 * @param bool $success True if successful, false otherwise.
 * @return string The status message.
 */
function get_status_message(bool $success): string {
    return $success ? 
        "<span style='color: green;'>Operation Successful!</span>" : 
        "<span style='color: red;'>Operation Failed.</span>";
}

$status1 = true;
$status2 = false;
echo "<li>Status 1 ({$status1}): " . get_status_message($status1) . "</li>";
echo "<li>Status 2 ({$status2}): " . get_status_message($status2) . "</li>";

// Example of coercion (if strict_types=0 is default):
$status_int = 1; // PHP converts 1 to true
echo "<li>Coerced example (1 as int): " . get_status_message($status_int) . "</li>";

?>