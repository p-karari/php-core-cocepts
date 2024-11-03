<?php

// constants.php

// Constants are identifiers (names) for simple values. 
// A constant's value cannot change during the execution of the script.

echo "<h2>1. Defining Constants using define()</h2>";

// 1. Defining a traditional constant using define()
// Constant names are typically written in uppercase.
define("MAX_USERS", 1000);
define("SITE_NAME", "Example App");
define("DEBUG_MODE", true);

echo "Max Users: " . MAX_USERS . "<br>";
echo "Site Name: " . SITE_NAME . "<br>";
echo "Debug Mode: " . (DEBUG_MODE ? 'On' : 'Off') . "<br>";

// Trying to redefine a constant results in an error/notice (depends on PHP version)
// define("MAX_USERS", 2000); // Fatal Error in modern PHP

echo "<hr>";

echo "<h2>2. Defining Constants using const (PHP 5.3+)</h2>";

// 2. Defining a constant using the 'const' keyword (must be outside a function/class)
const DATABASE_HOST = "localhost";
const CONNECTION_PORT = 3306;

echo "Database Host: " . DATABASE_HOST . "<br>";
echo "Connection Port: " . CONNECTION_PORT . "<br>";

// 3. Difference: const accepts scalar expressions (PHP 5.6+) and array expressions (PHP 7.0+)
const USER_ROLES = ["Admin", "Editor", "Viewer"];
const TOTAL_PRICE = 10 * 5;

echo "Total Price: " . TOTAL_PRICE . "<br>";
echo "First Role: " . USER_ROLES[0] . "<br>";

echo "<hr>";

echo "<h2>3. Built-in Magic Constants</h2>";

// Magic constants change depending on where they are used.
// They start and end with two underscores (__).

echo "The current file name is: <strong>" . __FILE__ . "</strong><br>";
echo "The current line number is: <strong>" . __LINE__ . "</strong><br>";
echo "The directory of this file is: <strong>" . __DIR__ . "</strong><br>";

function checkScope() {
    // __FUNCTION__ returns the function name
    echo "Current scope is the function: <strong>" . __FUNCTION__ . "</strong><br>";
}

checkScope();

echo "<hr>";

echo "<h2>4. Checking if a Constant is Defined</h2>";

// Use defined() to check for existence before using
if (defined("SITE_NAME")) {
    echo "SITE_NAME is defined.<br>";
} else {
    echo "SITE_NAME is not defined.<br>";
}

if (defined("UNDEFINED_CONST")) {
    echo "UNDEFINED_CONST is defined.<br>";
} else {
    echo "UNDEFINED_CONST is NOT defined.<br>";
}
?>