<?php

// return_value.php

// Functions use the 'return' statement to send a value back to the code 
// that called them. This stops the function execution.

echo "<h2>1. Simple Return of a Calculated Value</h2>";

// 1. Function that returns the result of a mathematical operation
function calculate_vat(float $price, float $rate = 0.20): float {
    $vat_amount = $price * $rate;
    // Return the calculated value
    return $vat_amount; 
}

$product_price = 100.00;
$vat = calculate_vat($product_price);
$total_price = $product_price + $vat;

echo "Price: \${$product_price}<br>";
echo "VAT Amount: \${$vat}<br>";
echo "Total Price: <strong>\${$total_price}</strong><br>";

echo "<hr>";

echo "<h2>2. Returning a Boolean Value (True/False)</h2>";

// 2. Function that returns a boolean, often used for validation checks
function is_valid_email(string $email): bool {
    // Check if the email contains exactly one '@' symbol
    $valid = (substr_count($email, '@') === 1 && strpos($email, '.') !== false);
    return $valid;
}

$email1 = "test@example.com";
$email2 = "invalid-email";

echo "Email '{$email1}' is valid: " . (is_valid_email($email1) ? 'True' : 'False') . "<br>";
echo "Email '{$email2}' is valid: " . (is_valid_email($email2) ? 'True' : 'False') . "<br>";

echo "<hr>";

echo "<h2>3. Returning an Array</h2>";

// 3. Function that returns a structured data type (an array)
function get_user_data(int $user_id): array {
    // Simulate fetching data from a database
    if ($user_id === 42) {
        return [
            "id" => $user_id,
            "name" => "Neo",
            "status" => "Chosen"
        ];
    }
    // Return an empty array if the user is not found
    return [];
}

$data = get_user_data(42);

if (!empty($data)) {
    echo "User found: Name = {$data['name']}, Status = {$data['status']}<br>";
} else {
    echo "User not found.<br>";
}

echo "<hr>";

echo "<h2>4. Early Return to Stop Execution</h2>";

// 4. Using 'return' inside a conditional block to exit early
function check_permission(string $role): string {
    if ($role === "guest") {
        return "Access Denied: Please log in.";
    }

    if ($role === "admin") {
        return "Full Access Granted.";
    }

    // If the function reaches the end, it returns the final default value
    return "Limited Access for Standard Users.";
}

echo "Admin Check: " . check_permission("admin") . "<br>";
echo "Guest Check: " . check_permission("guest") . "<br>";
?>