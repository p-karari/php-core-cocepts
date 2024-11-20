<?php

// custom_error.php

// This script demonstrates how to set up and use a custom error handler 
// in PHP, allowing you to intercept standard PHP errors (Notices, Warnings) 
// and handle them in a custom way (e.g., logging them, displaying a friendlier message).

echo "<h1>PHP Custom Error Handler Demo 🛠️</h1>";

// ---------------------------------------------------------------------
// 1. Define the Custom Error Handler Function
// ---------------------------------------------------------------------

/**
 * Custom function to handle PHP errors.
 * This function will be called instead of the default PHP error handler.
 *
 * @param int $errno The error severity level (e.g., E_WARNING, E_NOTICE).
 * @param string $errstr The error message.
 * @param string $errfile The filename where the error occurred.
 * @param int $errline The line number where the error occurred.
 * @return bool Must return true to prevent PHP's internal error handler from running.
 */
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    // 1a. Check which errors we want to handle
    // We ignore errors that are not included in our error_reporting setting 
    // and suppress the handler for errors that are shut down by the @ operator.
    if (!(error_reporting() & $errno)) {
        return false;
    }

    // 1b. Map error numbers to readable strings
    $errorType = match($errno) {
        E_NOTICE => 'Notice',
        E_WARNING => 'Warning',
        E_USER_NOTICE => 'User Notice',
        E_USER_WARNING => 'User Warning',
        E_USER_ERROR => 'User Error',
        E_STRICT => 'Strict',
        default => 'Unknown Error'
    };

    // 1c. Define the custom action (e.g., log to file, display formatted message)
    
    $logMessage = "[{$errorType}] {$errstr} in {$errfile} on line {$errline}";
    
    // Log the error (simulated here)
    // error_log($logMessage); 

    // Display a formatted message to the user
    echo "<div style='border: 1px solid #c00; padding: 10px; margin: 10px 0; background-color: #fdd; color: #333;'>";
    echo "<strong>CUSTOM HANDLER CAUGHT {$errorType}:</strong> {$errstr}<br>";
    echo "<em>File: {$errfile} | Line: {$errline}</em>";
    echo "</div>";

    // 1d. Return true to signal that the error has been handled
    return true;
}

// ---------------------------------------------------------------------
// 2. Register the Custom Handler
// ---------------------------------------------------------------------

// Use set_error_handler() to register the function.
set_error_handler("customErrorHandler");

echo "<h2>2. Error Handler Registered</h2>";
echo "<p>PHP's standard error reporting for this script is now overridden by <code>customErrorHandler()</code>.</p>";

// ---------------------------------------------------------------------
// 3. Trigger Errors to Test the Handler
// ---------------------------------------------------------------------

echo "<h2>3. Triggering Errors</h2>";

// 3a. Trigger a PHP Warning
echo "<h3>Triggering a Warning (e.g., array_pop on non-array):</h3>";
// This would normally display a PHP Warning, but now the custom handler runs.
$not_an_array = "just a string";
@array_pop($not_an_array); // Used @ to suppress the Notice that occurs before the Warning is thrown

// 3b. Trigger a PHP Notice
echo "<h3>Triggering a Notice (e.g., undefined variable):</h3>";
// The handler should intercept the Notice about $nonExistentVar
$test_output = $nonExistentVar ?? 'Default';

// 3c. Trigger a User-Defined Error (E_USER_WARNING)
echo "<h3>Triggering a Custom User Warning (trigger_error):</h3>";
// trigger_error allows us to generate errors/warnings from application logic.
if (empty($_GET['required_param'])) {
    trigger_error("Required URL parameter 'required_param' is missing.", E_USER_WARNING);
}

// ---------------------------------------------------------------------
// 4. Returning to Default Handler (Optional)
// ---------------------------------------------------------------------

echo "<hr>";
echo "<h2>4. Unregistering Handler (restore_error_handler)</h2>";

// Use restore_error_handler() to revert to the previous (or default) error handler.
restore_error_handler();

echo "<p>Custom handler unregistered. Subsequent errors will use PHP's default handler.</p>";

echo "<h3>Testing after unregistering:</h3>";
// This will display the default PHP Notice (or nothing, depending on php.ini display_errors setting)
$default_test_var;
echo "Default Notice Test: " . ($default_test_var ?? 'Value') . "<br>";

?>