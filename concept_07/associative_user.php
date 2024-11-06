<?php

// associative-user.php

// This script demonstrates the use of an associative array to represent
// a user profile with named key-value pairs.

echo "<h2>1. Defining an Associative Array (User Profile)</h2>";

// Define a user array with keys like 'id', 'username', 'email', and 'is_active'.
$user = [
    "id" => 1001,
    "username" => "john_doe_dev",
    "email" => "john.doe@example.com",
    "is_active" => true,
    "roles" => ["admin", "editor"],
    "last_login" => "2025-10-14 08:30:00"
];

// 2. Accessing User Data
echo "<h3>2. Accessing User Data</h3>";
echo "User ID: " . $user["id"] . "<br>";
echo "Username: " . $user["username"] . "<br>";
echo "Email: " . $user["email"] . "<br>";
echo "Status: " . ($user["is_active"] ? "Active" : "Inactive") . "<br>";

echo "<hr>";

// 3. Modifying and Adding Data
echo "<h3>3. Modifying and Adding Data</h3>";

// Modify an existing value
$user["email"] = "john.d.dev@newcorp.com";
echo "New Email: " . $user["email"] . "<br>";

// Add a new key-value pair
$user["phone"] = "555-1234";
echo "Phone: " . $user["phone"] . "<br>";

// Modifying an element within a nested array
$user["roles"][] = "viewer"; // Add 'viewer' role
echo "Roles: " . implode(", ", $user["roles"]) . "<br>";

echo "<hr>";

// 4. Looping Through the Array (Key and Value)
echo "<h3>4. Looping through Profile Details</h3>";

echo "<ul>";
// Use foreach to iterate over key-value pairs
foreach ($user as $key => $value) {
    // Skip complex types like arrays for simple output
    if (is_array($value)) {
        continue;
    }
    echo "<li><strong>" . ucfirst(str_replace('_', ' ', $key)) . ":</strong> {$value}</li>";
}
echo "</ul>";

echo "<hr>";

// 5. Checking for Key Existence (Safety Check)
echo "<h3>5. Key Existence Check</h3>";

$check_key = "password";
if (isset($user[$check_key])) {
    echo "The key '{$check_key}' is set.<br>";
} else {
    echo "The key '{$check_key}' is not set (expected).<br>";
}
?>