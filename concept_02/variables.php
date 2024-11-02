<?php

// variables.php

// 1. Basic Variable Assignment
$name = "Alice"; // String
$age = 25;       // Integer
$price = 19.99;  // Float (or double)
$is_active = true; // Boolean (case-insensitive: TRUE, true)

echo "<h2>Basic Variables</h2>";
echo "Name: {$name}<br>";
echo "Age: {$age}<br>";
echo "Price: {$price}<br>";
echo "Active: " . ($is_active ? 'Yes' : 'No') . "<br>";

// 2. Dynamic Typing: PHP variables change type based on their value
$mixed_var = "Hello";  // String
var_dump($mixed_var);
$mixed_var = 12345;    // Integer
var_dump($mixed_var);

// 3. Variable Naming Rules: must start with $ followed by a letter or underscore
$_user_id = 101; // Valid, starts with underscore
// $1invalid = "Error"; // Invalid, starts with a number

echo "User ID: {$_user_id}<br>";

// 4. Case Sensitivity: PHP variable names are case-sensitive
$Color = "Red";
$color = "Blue";
// The following two variables are distinct
echo "Color 1: {$Color}<br>"; // Output: Red
echo "Color 2: {$color}<br>"; // Output: Blue

// 5. Assignment by Reference: uses the ampersand (&)
$original = 50;
$reference = &$original; // $reference now points to the same memory location as $original

$reference = 100; // Changing $reference also changes $original

echo "<h2>Assignment by Reference</h2>";
echo "Original after change: {$original}<br>"; // Output: 100
echo "Reference value: {$reference}<br>";   // Output: 100

// 6. Variable Variables (or "double dollar" syntax)
$car = "Toyota";
$$car = "Camry"; // This creates a new variable named $Toyota with the value "Camry"

echo "<h2>Variable Variables</h2>";
echo "Value of \$car: {$car}<br>";      // Output: Toyota
echo "Value of \$\$car (\$$car): {$$car}<br>"; // Output: Camry
// Equivalent to: echo $Toyota;

// 7. Undefined Variables: PHP issues a notice but uses a NULL value
// echo $undefined_var; // This would generate a PHP Notice

// Use isset() to check if a variable has been set and is not NULL
echo "<h2>isset() Check</h2>";
if (isset($age)) {
    echo "The \$age variable is set.<br>";
} else {
    echo "The \$age variable is NOT set.<br>";
}
?>