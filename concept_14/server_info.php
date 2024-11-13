<?php

// server_info.php

// This script demonstrates how to display various pieces of information 
// about the server environment using PHP's $_SERVER superglobal and 
// other built-in PHP functions.

echo "<h1>Server and Environment Information 🖥️</h1>";

echo "<h2>1. General PHP and Server Info</h2>";

// phpinfo() outputs a large amount of information about PHP's configuration, 
// predefined variables, loaded modules, and environment. 
// NOTE: This is often disabled or restricted on production servers for security.
// echo "<h3>Full PHP Info (usually verbose):</h3>";
// phpinfo(); 
echo "<p><em>The full <code>phpinfo()</code> output is often verbose and is commented out for brevity.</em></p>";

// phpversion(): Returns the current PHP version.
echo "<ul>";
echo "<li><strong>PHP Version:</strong> <code>" . phpversion() . "</code></li>";

// $_SERVER['SERVER_SOFTWARE']: Identifies the web server software (e.g., Apache, Nginx).
echo "<li><strong>Server Software:</strong> <code>" . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . "</code></li>";

// $_SERVER['SERVER_NAME']: The hostname of the server.
echo "<li><strong>Server Hostname:</strong> <code>" . ($_SERVER['SERVER_NAME'] ?? 'N/A') . "</code></li>";

// $_SERVER['SERVER_ADDR']: The IP address of the server.
echo "<li><strong>Server IP Address:</strong> <code>" . ($_SERVER['SERVER_ADDR'] ?? 'N/A') . "</code></li>";
echo "</ul>";

echo "<hr>";

echo "<h2>2. Current Script and Request Details</h2>";

echo "<ul>";
// $_SERVER['PHP_SELF']: The filename of the currently executing script, useful for form actions.
echo "<li><strong>Current Script:</strong> <code>" . ($_SERVER['PHP_SELF'] ?? 'N/A') . "</code></li>";

// $_SERVER['DOCUMENT_ROOT']: The main directory where web files are stored.
echo "<li><strong>Document Root:</strong> <code>" . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . "</code></li>";

// $_SERVER['REQUEST_METHOD']: The method used to access the page (GET, POST, etc.).
echo "<li><strong>Request Method:</strong> <code>" . ($_SERVER['REQUEST_METHOD'] ?? 'N/A') . "</code></li>";

// $_SERVER['REMOTE_ADDR']: The IP address of the user viewing the current page.
echo "<li><strong>Client IP Address:</strong> <code>" . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . "</code></li>";

// $_SERVER['REQUEST_TIME']: Timestamp of the start of the request.
echo "<li><strong>Request Timestamp:</strong> <code>" . (date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'] ?? time())) . "</code></li>";
echo "</ul>";

echo "<hr>";

echo "<h2>3. Selected Configuration Settings</h2>";

// ini_get(): Retrieves the current value of a configuration setting from php.ini.
echo "<ul>";
echo "<li><strong>Max Execution Time:</strong> <code>" . ini_get('max_execution_time') . "</code> seconds</li>";
echo "<li><strong>Memory Limit:</strong> <code>" . ini_get('memory_limit') . "</code></li>";
echo "<li><strong>File Uploads:</strong> <code>" . (ini_get('file_uploads') ? 'Enabled' : 'Disabled') . "</code></li>";
echo "<li><strong>Post Max Size:</strong> <code>" . ini_get('post_max_size') . "</code></li>";
echo "</ul>";

echo "<hr>";

echo "<h2>4. All \$_SERVER Variables (Debug View)</h2>";
// Display the entire $_SERVER array for comprehensive inspection.

echo "<pre>";
print_r($_SERVER ?? '$_SERVER is unavailable.');
echo "</pre>";

?>