<?php

// include-require.php

// This file serves as a comparison and demonstration of the four PHP file inclusion statements:
// include, require, include_once, and require_once.

echo "<h1>PHP File Inclusion: include vs. require vs. _once</h1>";

// ---------------------------------------------------------------------
// 1. Setup Dummy Files for Demonstration
// ---------------------------------------------------------------------

// Create a file to be successfully included
file_put_contents("vars.php", "<?php \$db_host = 'localhost'; \$counter = 1; echo \"<p style='color: blue;'>[vars.php] Loaded successfully.</p>\"; ?>");

// Create a file to demonstrate repeated inclusion
file_put_contents("function.php", "<?php 
\$counter++; // will be incremented on every include 
function log_message(\$msg) { echo \"<p style='color: purple;'>[function.php] Log: \$msg</p>\"; }
log_message('Definition loaded');
?>");

echo "<h2>1. include vs. require</h2>";

// ---------------------------------------------------------------------
// 1a. include: Non-fatal error on failure
// ---------------------------------------------------------------------
echo "<h3>1a. include (Warning on Failure, Script Continues)</h3>";

// Successful include
include "vars.php";
echo "DB Host: <strong>" . (\$db_host ?? 'N/A') . "</strong><br>";

// Failed include: PHP issues a WARNING but continues to run
echo "<p style='color: orange;'>Attempting to <code>include</code> a non-existent file...</p>";
include "non_existent_file.php"; 
echo "<p style='color: green;'>✅ Execution reached this line after the failed include.</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 1b. require: Fatal error on failure
// ---------------------------------------------------------------------
echo "<h3>1b. require (Fatal Error on Failure, Script Halts)</h3>";

// Successful require
require "vars.php"; // Already loaded, but will execute again if not '_once'
echo "DB Host: <strong>" . (\$db_host ?? 'N/A') . "</strong><br>";

// Failed require (Commented out to allow the script to finish and show other sections)
/*
echo "<p style='color: red;'>Attempting to <code>require</code> a non-existent file...</p>";
require "non_existent_file_fatal.php"; // Will cause a FATAL ERROR and script will stop.
echo "<p>❌ This line will NOT be reached.</p>";
*/

echo "<p><em>Note: The failed <code>require</code> is commented out to allow the script to continue. In production, <code>require</code> is used for essential files like configuration.</em></p>";

echo "<hr>";

echo "<h2>2. include_once vs. require_once</h2>";

// ---------------------------------------------------------------------
// 2a. include_once: Prevents multiple inclusions
// ---------------------------------------------------------------------
echo "<h3>2a. include_once (Prevents Redundancy)</h3>";

// First inclusion: executes the file
include_once "function.php"; 
echo "Counter value: <strong>{$counter}</strong><br>"; // Counter is now 2 (from initial 1 + 1)

// Second inclusion: ignored because it was already included
include_once "function.php"; 
echo "Counter value after second attempt: <strong>{$counter}</strong><br>"; // Counter remains 2

echo "<hr>";

// ---------------------------------------------------------------------
// 2b. require_once: Prevents multiple inclusions, but is fatal on first failure
// ---------------------------------------------------------------------
echo "<h3>2b. require_once (Prevents Redundancy + Fatal on First Failure)</h3>";

// First inclusion: executes the file
require_once "function.php"; 
echo "Counter value: <strong>{$counter}</strong><br>"; // Counter is now 3

// Second inclusion: ignored because it was already required
require_once "function.php"; 
echo "Counter value after second attempt: <strong>{$counter}</strong><br>"; // Counter remains 3

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Cleanup (for local testing environment)
// ---------------------------------------------------------------------
@unlink("vars.php");
@unlink("function.php");
echo "<p><em>Cleanup: Dummy files vars.php and function.php have been deleted.</em></p>";

?>