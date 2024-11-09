<?php

// super_globals.php

// Superglobals are built-in variables in PHP that are always accessible, 
// regardless of scope.

echo "<h2>1. \$_GET (URL parameters)</h2>";
// Accessible after a form submission with method="get" or via URL query strings.
// Example URL: super_globals.php?id=123&user=admin
$user_id = $_GET['id'] ?? 'N/A'; // Null coalescing operator (??) for safety
$username = $_GET['user'] ?? 'Guest';

echo "User ID from URL: {$user_id}<br>";
echo "Username from URL: {$username}<br>";

echo "<hr>";

echo "<h2>2. \$_POST (Form data)</h2>";
// Accessible after a form submission with method="post".
// Cannot easily be demonstrated without an actual form submission, so we show the structure.

echo "The \$_POST array contains data sent from an HTML form using the POST method.<br>";
// To see action: submit a form field named 'email'.
// $email = $_POST['email'] ?? 'Not Submitted';

echo "<hr>";

echo "<h2>3. \$_REQUEST (GET, POST, and COOKIE data)</h2>";
// Contains the contents of $_GET, $_POST, and $_COOKIE. Its use is generally discouraged 
// due to ambiguity (it's hard to tell where the data came from).
$request_id = $_REQUEST['id'] ?? 'N/A';
echo "ID from \$_REQUEST: {$request_id} (Can be GET, POST, or COOKIE)<br>";

echo "<hr>";

echo "<h2>4. \$_SERVER (Server and execution environment info)</h2>";
// Holds information about the server and the execution environment.

echo "Server Name: " . $_SERVER['SERVER_NAME'] . "<br>";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";
echo "Script Filename: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";
echo "Client IP Address: " . $_SERVER['REMOTE_ADDR'] . "<br>"; // Note: Can be unreliable
echo "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";

echo "<hr>";

echo "<h2>5. \$_SESSION (User session data)</h2>";
// Used to store user data across multiple pages. Must start the session first.

// session_start(); // Must be called before any output!

// $_SESSION['user_preference'] = 'dark_mode';
// echo "User Preference: " . ($_SESSION['user_preference'] ?? 'default') . "<br>";

echo "The \$_SESSION array requires <code>session_start()</code> to be functional.<br>";

echo "<hr>";

echo "<h2>6. \$_ENV (Environment variables)</h2>";
// Variables passed to the script via the environment. Often used for configurations.
// The availability of these depends heavily on the server setup (php.ini, server config).
$path_env = $_ENV['PATH'] ?? 'Environment PATH not available via ENV';
echo "Example PATH variable: {$path_env}<br>";

echo "<hr>";

echo "<h2>7. \$_FILES (File uploads)</h2>";
// Contains items uploaded to the current script via the HTTP POST method.
echo "The \$_FILES array is used for handling file uploads.<br>";

echo "<hr>";

echo "<h2>8. \$_COOKIE (HTTP Cookies)</h2>";
// Accessible for reading cookies sent by the client.
// To test: setcookie('theme', 'dark', time() + 3600);
// $theme = $_COOKIE['theme'] ?? 'light';
// echo "Cookie Theme: {$theme}<br>";
echo "The \$_COOKIE array contains data from client-side cookies.<br>";

?>