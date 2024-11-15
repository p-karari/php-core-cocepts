<?php

// return_type.php

// This script demonstrates the use of return type declarations (return type hints) 
// in PHP functions. Return type declarations specify the expected data type of the 
// value that a function will return.

echo "<h1>PHP Return Type Declaration Demo 💡</h1>";
echo "<p>Return type hints improve code readability and allow PHP to throw a 
<strong>TypeError</strong> if the returned value does not match the declared type.</p>";

// ---------------------------------------------------------------------
// 1. Scalar Return Types (string, int, float, bool)
// ---------------------------------------------------------------------

echo "<h2>1. Scalar Types</h2>";

/**
 * Calculates the total price including tax and returns a float.
 * @param float $price The base price.
 * @return float
 */
function calculate_total(float $price): float {
    $tax_rate = 0.05;
    return $price * (1 + $tax_rate);
}

$cost = 50.00;
$total = calculate_total($cost);
echo "<li>Total cost for \${$cost} (5% tax): <strong>\${$total}</strong> (float)</li>";


/**
 * Formats a user's full name.
 * @param string $first_name
 * @param string $last_name
 * @return string
 */
function format_name(string $first_name, string $last_name): string {
    return strtoupper($last_name) . ", " . ucfirst($first_name);
}

$full_name = format_name("alice", "wonderland");
echo "<li>Formatted Name: <strong>{$full_name}</strong> (string)</li>";


/**
 * Checks if a user is eligible for a discount.
 * @param int $age User's age.
 * @return bool
 */
function is_eligible_for_discount(int $age): bool {
    return $age < 18 || $age > 65;
}

$age1 = 70;
$eligible = is_eligible_for_discount($age1);
echo "<li>Age {$age1} eligible: <strong>" . ($eligible ? 'Yes' : 'No') . "</strong> (bool)</li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Complex Return Types (array, object, iterable)
// ---------------------------------------------------------------------

echo "<h2>2. Complex Types (Array)</h2>";

/**
 * Retrieves a list of products.
 * @return array
 */
function get_products(): array {
    return [
        ['id' => 101, 'name' => 'Widget'],
        ['id' => 102, 'name' => 'Gadget']
    ];
}

$products = get_products();
echo "<li>Products found: <strong>" . count($products) . "</strong> (array)</li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Special Return Types (void, ?Type)
// ---------------------------------------------------------------------

echo "<h2>3. Special Types (void and nullable)</h2>";

/**
 * Logs a message, but returns nothing.
 * The 'void' type ensures that no return statement or a 'return;' 
 * with no value is used.
 * @param string $msg
 * @return void
 */
function log_event(string $msg): void {
    echo "<p style='color: brown;'>[LOG] {$msg}</p>";
    // return "Error"; // This would cause a TypeError
}

log_event("Function called with a void return type.");

/**
 * Finds a user by ID. Returns a string or NULL if not found.
 * The '?' prefix makes the type nullable.
 * @param int $id
 * @return ?string
 */
function find_username(int $id): ?string {
    if ($id === 1) {
        return "Alex_Admin";
    }
    return null; // Must return null or a string
}

$user1 = find_username(1);
$user2 = find_username(2);

echo "<li>User 1 Name: <strong>{$user1}</strong> (?string)</li>";
echo "<li>User 2 Name: <strong>" . var_export($user2, true) . "</strong> (?string)</li>";

?>