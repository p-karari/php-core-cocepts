<?php

// session-start.php

// 1. Start the Session
// session_start() must be the very first thing in your script, 
// before any HTML tags or even blank spaces/newlines, otherwise, 
// PHP will issue a "Headers already sent" error.
session_start();

echo "<h2>PHP Session Management Demo</h2>";
echo "<p>Current Time: " . date('Y-m-d H:i:s') . "</p>";

// -----------------------------------------------------------
// 2. Setting Session Variables
// -----------------------------------------------------------

// Check if the session variable 'visits' is already set
if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 1;
    $_SESSION['first_access'] = time();
    echo "<p style='color: green;'><strong>Session started!</strong> Welcome, first visit recorded.</p>";
} else {
    // If it's set, increment the visit count
    $_SESSION['visits']++;
    echo "<p style='color: blue;'>Welcome back! This is visit number <strong>{$_SESSION['visits']}</strong>.</p>";
}

// Set a common user-related variable
$_SESSION['username'] = "TestUser_" . rand(100, 999);

echo "<hr>";

// -----------------------------------------------------------
// 3. Displaying Session Data
// -----------------------------------------------------------

echo "<h3>Current Session Data:</h3>";
echo "<ul>";
echo "<li>Username: <strong>{$_SESSION['username']}</strong></li>";
echo "<li>Total Visits (in this session): <strong>{$_SESSION['visits']}</strong></li>";
echo "<li>First Access Time (Timestamp): <strong>{$_SESSION['first_access']}</strong></li>";
echo "</ul>";

// Display the entire $_SESSION array for inspection
echo "<h3>\$_SESSION Array Content:</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<hr>";

// -----------------------------------------------------------
// 4. Session ID
// -----------------------------------------------------------

// Display the unique session ID assigned by the server
echo "<p>Your current Session ID (PHPSESSID): <strong>" . session_id() . "</strong></p>";
echo "<p>Refresh this page to see the visit count increment. The Session ID should remain the same.</p>";

?>