<?php

// closure_scope.php

// This script demonstrates how closures (anonymous functions) in PHP handle 
// variable scoping, particularly the difference between accessing local 
// variables and accessing variables from the parent scope using the `use` keyword.

echo "<h1>PHP Closure Scope Demonstration 🔭</h1>";

// ---------------------------------------------------------------------
// 1. Parent Scope Variables
// ---------------------------------------------------------------------

$multiplier = 5;
$initial_value = 100;

echo "<h2>1. Variables in Parent Scope:</h2>";
echo "<li>\$multiplier (External): {$multiplier}</li>";
echo "<li>\$initial_value (External): {$initial_value}</li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Accessing Parent Scope (Closure with `use` by Value)
// ---------------------------------------------------------------------

echo "<h2>2. Closure with 'use' by Value (Copy)</h2>";

// The $multiplier is passed by value (copied) into the closure's environment.
$calculate_value = function($input) use ($multiplier, $initial_value) {
    // These are *copies* of the variables from the parent scope at the time 
    // the function was declared.
    $local_total = ($input * $multiplier) + $initial_value;
    
    // Changing the local copy *inside* the closure does NOT affect the original.
    $multiplier = 99; 
    
    return $local_total;
};

// Change the parent scope variable *after* the closure is defined.
// This change WILL NOT affect the closure, as it took a copy of the original value (5).
$multiplier = 2; 
$initial_value = 50; 

$result_by_value = $calculate_value(10); 

echo "<li>Result of calculate_value(10): <strong>{$result_by_value}</strong></li>"; // (10 * 5) + 100 = 150
echo "<li>\$multiplier (External) after call: <strong>{$multiplier}</strong></li>"; // 2 (Changed after definition)
echo "<li>\$initial_value (External) after call: <strong>{$initial_value}</strong></li>"; // 50 (Changed after definition)
echo "<p><em>The closure used the original values (5 and 100) because it was passed a copy.</em></p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Accessing Parent Scope (Closure with `use` by Reference)
// ---------------------------------------------------------------------

echo "<h2>3. Closure with 'use' by Reference (&)</h2>";

$counter = 0;
$log_message = "Current count: ";

// The $counter is passed by reference (&), linking it to the original variable.
$increment_and_log = function() use (&$counter, $log_message) {
    // This increments the original $counter in the parent scope.
    $counter++;
    return $log_message . $counter;
};

echo "<li>\$counter (External) initial value: {$counter}</li>"; 

echo "<li>1st call: <strong>" . $increment_and_log() . "</strong></li>"; // Current count: 1
echo "<li>2nd call: <strong>" . $increment_and_log() . "</strong></li>"; // Current count: 2
echo "<li>3rd call: <strong>" . $increment_and_log() . "</strong></li>"; // Current count: 3

echo "<li>\$counter (External) final value: <strong>{$counter}</strong></li>"; // 3 (Original was modified)
echo "<p><em>The closure used a reference, allowing it to modify the external variable.</em></p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Arrow Functions (PHP 7.4+)
// ---------------------------------------------------------------------

echo "<h2>4. Arrow Functions (Automatic 'use' by Value)</h2>";
echo "<p>Arrow functions <code>fn() => ...</code> automatically capture variables from the parent scope **by value**.</p>";

$tax_rate = 0.15;

// The $tax_rate is automatically available (by value) without the `use` keyword.
$calculate_tax = fn($price) => $price * $tax_rate;

$tax_rate = 0.50; // Change the external variable after declaration

$item_price = 200;
$tax_result = $calculate_tax($item_price);

echo "<li>Item Price: \${$item_price}</li>";
echo "<li>Tax Rate used: 15% (the value at declaration)</li>";
echo "<li>Calculated Tax: <strong>\${$tax_result}</strong></li>"; // 200 * 0.15 = 30

?>