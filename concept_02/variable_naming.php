<?php

// variable_naming.php

// 1. All PHP variables must start with the dollar sign ($)
$name = "John Doe";
$_user_count = 500; // Underscore is allowed

// 2. Case Sensitivity: PHP variable names are case-sensitive
$Product = "Laptop";
$product = "Mouse"; // These are two different variables

echo "<h2>1. Case Sensitivity</h2>";
echo "Value of \$Product: {$Product}<br>";
echo "Value of \$product: {$product}<br>";

// 3. Allowed characters: Letters (a-z, A-Z), numbers (0-9), and underscore (_)
$item_price_2024 = 99.99;
$__tempVar = true;

// 4. Invalid starts: Variable names cannot start with a number
// $1st_name = "Error"; // This would cause a parse error

// 5. Recommended naming convention (snake_case or camelCase)
// PHP developers often use snake_case for standard variables
$first_name = "Jane";
$is_authenticated = false;

// Another common practice is camelCase (especially in objects/methods)
$customerName = "Acme Inc.";
$totalAmount = 500.00;

echo "<h2>2. Naming Conventions</h2>";
echo "Snake Case: {$first_name}<br>";
echo "Camel Case: {$customerName}<br>";

// 6. Avoid using reserved keywords as variable names (e.g., $echo, $while)
// While some might work, it's confusing and prone to errors.

// 7. Meaningful and Descriptive Names
$a = 10; // Bad name
$numberOfAttempts = 10; // Good name

echo "<h2>3. Descriptive Names</h2>";
echo "Number of Attempts: {$numberOfAttempts}<br>";

// Example of a variable storing a constant value (though PHP constants are better for this)
$MAX_USERS = 1000; // Conventionally uppercase with underscores for "constants"
echo "Max Users Allowed: {$MAX_USERS}<br>";

?>