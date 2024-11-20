<?php

// display_errors.php

// This script demonstrates how to control the display of PHP errors 
// directly in the browser output using runtime configuration settings.

echo "<h1>PHP Error Display Configuration 🛑</h1>";

// ---------------------------------------------------------------------
// 1. Check Current Configuration
// ---------------------------------------------------------------------

// ini_get() retrieves the current value of a PHP configuration directive.
$current_display = ini_get('display_errors');
$current_reporting = ini_get('error_reporting');

echo "<h2>1. Current Settings:</h2>";
echo "<ul>";
echo "<li><strong>display_errors:</strong> <code>{$current_display}</code> (1 or 'On' means errors show in browser)</li>";
echo "<li><strong>error_reporting:</strong> <code>{$current_reporting}</code> (e.g., <code>E_ALL</code> is 32767)</li>";
echo "</ul>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Demonstration of Error Display (Initial State)
// ---------------------------------------------------------------------

echo "<h2>2. Error Test (Initial State)</h2>";

// This will generate a PHP Notice (accessing an undefined variable).
// The visibility of this Notice depends on the initial configuration.
echo "<li>Test 1 (Notice - Undefined Variable): " . ($test_var ?? 'Using null coalescing to prevent error display') . "</li>";

// This will generate a PHP Warning (using a function that expects an array argument).
// $test_array_warning = array_pop("not_an_array"); // Uncomment to see a Warning


echo "<hr>";

// ---------------------------------------------------------------------
// 3. Enabling Error Display (Runtime)
// ---------------------------------------------------------------------

echo "<h2>3. Enabling Errors for Debugging (Development Mode)</h2>";
echo "<p style='color: blue;'>Setting <code>display_errors = 1</code> and <code>error_reporting = E_ALL</code></p>";

// E_ALL: Reports all errors, warnings, and notices.
ini_set('error_reporting', E_ALL); 
// '1' or 'On' tells PHP to display errors in the HTML output.
ini_set('display_errors', '1'); 

// This setting change is only valid for the duration of this script execution.

// Generate a Notice again, which should now be visible if the server allows 
// ini_set overrides and the initial setting was 'Off'.

// Note: To reliably see the full error output, you may need to refresh the page 
// or run the script on a server where ini_set is permitted.
// If your server is already set to 'On', this step won't change the output.

echo "<h3>Test 2 (Notice - Undefined Variable AFTER enabling):</h3>";
echo "<li>Attempting to echo undefined variable <code>\$new_undefined_var</code>...</li>";
// The following line will directly output the Notice message to the browser, 
// unless the server configuration prevents it or output buffering interferes.
// Since we are inside a code block, we must force the error to display:
@$new_undefined_var; // The @ suppresses the error output for the direct line, 
                      // but the prior ini_set should ensure other subsequent errors display.
                      
// Example of a visible Warning:
// include('a_missing_file_for_test.php'); // Uncomment this to trigger a clear Warning

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Disabling Error Display (Production Mode)
// ---------------------------------------------------------------------

echo "<h2>4. Disabling Errors (Production Mode)</h2>";
echo "<p style='color: red;'>Setting <code>display_errors = 0</code> (Errors are now suppressed from the browser, but should still be logged).</p>";

// '0' or 'Off' hides errors from the user (security best practice).
ini_set('display_errors', '0'); 
// Ensure errors are logged to the file
ini_set('log_errors', '1'); 
// Set the log file path
// ini_set('error_log', '/path/to/php-error.log'); 

echo "<li>Test 3 (Notice - Undefined Variable AFTER disabling): </li>";
// This Notice should now be suppressed from displaying to the user, but logged server-side.
@$final_test_var; // Suppressing the error for a cleaner script, but the setting applies to all subsequent code.

?>