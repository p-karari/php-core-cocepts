<?php

// includerequire.php

// This script demonstrates the differences between the four primary file inclusion statements in PHP:
// include, require, include_once, and require_once.

echo "<h1>PHP File Inclusion Statements</h1>";

// ---------------------------------------------------------------------
// Configuration for Demonstration
// ---------------------------------------------------------------------

// Create a dummy file for inclusion: config.php
// In a real scenario, this file would exist separately.
file_put_contents("config.php", "<?php \$config_setting = 'Database connection string.'; echo \"<p><strong>[config.php]</strong> Variable initialized.</p>\"; ?>");

// Create a file that intentionally contains an error: error_file.php
file_put_contents("error_file.php", "<?php \$test = 1; \$test = \"string\"; // This is okay, PHP is loosely typed. HOWEVER, we will include a non-existent file to simulate a fatal error later. ?>");

echo "<h2>1. include (Non-fatal error)</h2>";
echo "<p>When using <code>include</code>, if the file is not found, a <strong>Warning</strong> is issued, and the script <strong>continues execution</strong>.</p>";

// 1. A successful include
include "config.php";
echo "Config setting loaded: <strong>" . ($config_setting ?? 'N/A') . "</strong><br>";

// 2. An include that fails
echo "<p style='color: orange;'>Attempting to include a non-existent file...</p>";
include "non_existent_include.php"; // Will generate a PHP Warning

echo "<p style='color: green;'>✅ Script execution continues after the failed include.</p>";

echo "<hr>";

echo "<h2>2. require (Fatal error)</h2>";
echo "<p>When using <code>require</code>, if the file is not found, a <strong>Fatal Error</strong> is issued, and the script <strong>stops execution</strong> immediately.</p>";

// 3. A successful require
require "config.php";
echo "Config setting required: <strong>" . ($config_setting ?? 'N/A') . "</strong><br>";

// 4. A require that fails (UNCOMMENT TO SEE FATAL ERROR)
/*
echo "<p style='color: red;'>Attempting to require a non-existent file (Fatal Error will stop script)...</p>";
require "non_existent_require.php"; // Will generate a PHP Fatal Error and halt the script.
echo "<p style='color: red;'>❌ This line will NOT be reached if the file is missing.</p>";
*/

echo "<p><em>Note: The failed <code>require</code> is commented out to allow the script to complete the demonstration of <code>include_once</code> and <code>require_once</code>.</em></p>";

echo "<hr>";

echo "<h2>3. include_once and require_once</h2>";
echo "<p>These versions check if the file has already been included/required. If it has, it won't be included again.</p>";

$counter = 0;
file_put_contents("counter_snippet.php", "<?php \$counter++; echo \"<p><strong>[counter_snippet.php]</strong> Counter: \$counter</p>\"; ?>");

echo "<h3>Using include_once:</h3>";
include_once "counter_snippet.php"; // First time: included and executed.
include_once "counter_snippet.php"; // Second time: skipped.
echo "Final counter value: <strong>" . $counter . "</strong><br>";

echo "<h3>Using require_once:</h3>";
require_once "counter_snippet.php"; // First time: included and executed.
require_once "counter_snippet.php"; // Second time: skipped.
echo "Final counter value: <strong>" . $counter . "</strong><br>";

// ---------------------------------------------------------------------
// Clean up the dummy files (optional, for script hygiene)
// ---------------------------------------------------------------------
@unlink("config.php");
@unlink("error_file.php");
@unlink("counter_snippet.php");

?>