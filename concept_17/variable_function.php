<?php

// variable_function.php

// This script demonstrates **Variable Functions** in PHP.
// A variable function is a feature that allows a string variable's value 
// to be treated as the name of a function to be called.

echo "<h1>PHP Variable Functions Demonstration 🎭</h1>";
echo "<p>This feature allows functions to be called dynamically, based on a variable's content.</p>";

// ---------------------------------------------------------------------
// 1. Define Standard Functions
// ---------------------------------------------------------------------

function greet(string $name) {
    echo "<li>Greeting: Hello, <strong>{$name}</strong>!</li>";
}

function process(string $data) {
    $processed = strtoupper($data);
    echo "<li>Process: Data <strong>'{$processed}'</strong> has been capitalized.</li>";
}

function logger(string $level, string $message) {
    echo "<li>Logger: [{$level}] {$message}</li>";
}

echo "<h2>1. Standard Function Definitions</h2>";
greet("Alice");
process("initial data");

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Calling Functions Dynamically with a Variable
// ---------------------------------------------------------------------

echo "<h2>2. Dynamic Function Calls</h2>";

// Set a variable to the name of a function
$func_name_1 = "greet";
$func_name_2 = "process";

// Call the function using the variable name followed by parentheses
echo "<h3>Calling 'greet':</h3>";
$func_name_1("Bob"); // Equivalent to: greet("Bob");

echo "<h3>Calling 'process':</h3>";
$func_name_2("dynamic input"); // Equivalent to: process("dynamic input");

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Dynamic Execution in a Loop or Condition
// ---------------------------------------------------------------------

echo "<h2>3. Conditional and Looping Execution</h2>";

$actions = [
    ["name" => "greet", "args" => ["Charlie"]],
    ["name" => "logger", "args" => ["INFO", "User action successful."]],
    ["name" => "process", "args" => ["lowercase string"]]
];

foreach ($actions as $action) {
    $dynamic_function = $action['name'];
    $arguments = $action['args'];
    
    // Safety check: Ensure the function actually exists before calling it
    if (is_callable($dynamic_function)) {
        echo "<p>Executing function: <strong>{$dynamic_function}</strong></p>";
        
        // Use the call_user_func_array() function to pass an array of arguments
        // call_user_func() can be used for non-array arguments, but call_user_func_array() is more flexible.
        call_user_func_array($dynamic_function, $arguments);
    } else {
        echo "<p style='color: red;'>Error: Function '{$dynamic_function}' is not callable.</p>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Calling Static Class Methods Dynamically
// ---------------------------------------------------------------------

echo "<h2>4. Calling Static Methods Dynamically</h2>";

class Utility {
    static function capitalize(string $text) {
        echo "<li>Utility Method: Capitalized result is <strong>" . ucwords($text) . "</strong></li>";
    }
}

// 4a. Array syntax for static methods
$class_method_1 = ["Utility", "capitalize"];
echo "<h3>Using Array Syntax:</h3>";
$class_method_1("a string to be capitalized");

// 4b. String syntax (using double colons) - Not directly supported in PHP's variable functions for simple calls, 
// but the array syntax or call_user_func is reliable.
$method_name = "capitalize";
echo "<h3>Using String and call_user_func():</h3>";
call_user_func(["Utility", $method_name], "another string to capitalize");
?>