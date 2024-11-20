<?php

// error_debugging.php

// This script demonstrates common error handling and debugging techniques 
// in PHP, including configuration settings and basic functions for inspection.

echo "<h1>PHP Error Handling & Debugging Demo 🐞</h1>";

// ---------------------------------------------------------------------
// 1. Error Reporting Configuration
// ---------------------------------------------------------------------

echo "<h2>1. Error Configuration Settings</h2>";

// Display current settings (good for environment checks)
echo "<li><strong>display_errors:</strong> " . ini_get('display_errors') . " (Should be 'Off' in production)</li>";
echo "<li><strong>error_reporting:</strong> " . ini_get('error_reporting') . " (Current level)</li>";

// Setting these during runtime (overriding php.ini for the script's duration):

// ini_set('display_errors', '1'); 
// ini_set('error_reporting', E_ALL); // Show all errors, warnings, and notices

echo "<p><em>Note: Settings are commented out. Typically, this is done globally in `php.ini` or conditionally based on environment.</em></p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Generating Different Error Types
// ---------------------------------------------------------------------

echo "<h2>2. Generating Errors and Warnings</h2>";

// 2a. Notice (Accessing an undefined variable)
echo "<h3>Notice Example:</h3>";
echo "<li>Undefined variable: " . ($undefined_var ?? 'Default Value') . "</li>"; // The ?? suppresses the Notice in the output

// 2b. Warning (Including a missing file)
echo "<h3>Warning Example:</h3>";
// include('missing_file_warning.php'); // Uncomment to see the Warning

// 2c. Fatal Error (Calling a function on a non-object/array with strict type)
echo "<h3>Fatal Error (Syntax/Logic):</h3>";
// Fatal errors stop script execution. Example:
// $array = null; 
// foreach ($array as $item) { echo $item; } // This often leads to a Fatal Error in modern PHP.

echo "<p><em>Errors are often handled with try/catch blocks or custom error handlers in production code.</em></p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Inspection and Debugging Functions
// ---------------------------------------------------------------------

echo "<h2>3. Inspection with Debugging Functions</h2>";

$user_data = [
    'id' => 10,
    'name' => 'John Doe',
    'active' => true,
    'details' => ['email' => 'john@example.com', 'role' => 'editor']
];

// 3a. print_r(): Prints human-readable information about a variable.
echo "<h3>print_r() Example (Array Structure):</h3>";
echo "<pre>";
print_r($user_data);
echo "</pre>";

// 3b. var_dump(): Displays structured information about expressions, including its type and value.
echo "<h3>var_dump() Example (Type and Value):</h3>";
echo "<pre>";
var_dump($user_data);
echo "</pre>";

// 3c. var_export(): Returns a parsable string representation of a variable.
echo "<h3>var_export() Example (Exportable Code):</h3>";
echo "<pre>";
var_export($user_data);
echo "</pre>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Debug Backtrace (for internal function errors)
// ---------------------------------------------------------------------

echo "<h2>4. Debug Backtrace</h2>";

function a() {
    b();
}

function b() {
    c();
}

function c() {
    // debug_backtrace() shows the stack trace of function calls leading to this point.
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3); // Get only the first 3 calls, excluding args
    echo "<h3>Function Call Stack:</h3>";
    echo "<pre>";
    print_r($trace);
    echo "</pre>";
}

a();

?>