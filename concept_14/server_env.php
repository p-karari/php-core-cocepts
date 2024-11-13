<?php

// _Server_env.php

// This script demonstrates the use of the $_SERVER superglobal array, 
// which contains information about the server, the execution environment, 
// and the current request.

echo "<h1>PHP \$_SERVER Superglobal Demonstration 💻</h1>";
echo "<p>The \$_SERVER array provides critical information about the web server and the current client request.</p>";

echo "<h2>1. Request Information (Client/Browser)</h2>";
// Data related to the request initiated by the client (browser)

echo "<ul>";
echo "<li><strong>Request Method:</strong> " . ($_SERVER['REQUEST_METHOD'] ?? 'N/A') . " (How the page was accessed, e.g., GET/POST)</li>";
echo "<li><strong>Request URI:</strong> " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . " (The path after the domain name)</li>";
echo "<li><strong>User Agent:</strong> " . ($_SERVER['HTTP_USER_AGENT'] ?? 'N/A') . " (Browser and OS info)</li>";
echo "<li><strong>Remote IP Address:</strong> " . ($_SERVER['REMOTE_ADDR'] ?? 'N/A') . " (The IP address of the client)</li>";
echo "<li><strong>Referer:</strong> " . ($_SERVER['HTTP_REFERER'] ?? 'N/A') . " (The previous page visited, if any)</li>";
echo "</ul>";

echo "<hr>";

echo "<h2>2. Server and Execution Environment</h2>";
// Data related to the server on which the script is running

echo "<ul>";
echo "<li><strong>Server Name:</strong> " . ($_SERVER['SERVER_NAME'] ?? 'N/A') . " (The host name of the server)</li>";
echo "<li><strong>Server Software:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'N/A') . " (e.g., Apache/nginx)</li>";
echo "<li><strong>Server Protocol:</strong> " . ($_SERVER['SERVER_PROTOCOL'] ?? 'N/A') . " (e.g., HTTP/1.1)</li>";
echo "<li><strong>Server Port:</strong> " . ($_SERVER['SERVER_PORT'] ?? 'N/A') . " (The port the server is listening on)</li>";
echo "<li><strong>Document Root:</strong> " . ($_SERVER['DOCUMENT_ROOT'] ?? 'N/A') . " (The main directory for web files)</li>";
echo "</ul>";

echo "<hr>";

echo "<h2>3. Script Location and Path</h2>";
// Data related to the current script's location

echo "<ul>";
echo "<li><strong>Script Filename:</strong> " . ($_SERVER['SCRIPT_FILENAME'] ?? 'N/A') . " (Full path to the script)</li>";
echo "<li><strong>PHP Self:</strong> " . ($_SERVER['PHP_SELF'] ?? 'N/A') . " (The filename of the currently executing script, useful for form actions)</li>";
echo "<li><strong>Gateway Interface:</strong> " . ($_SERVER['GATEWAY_INTERFACE'] ?? 'N/A') . " (e.g., CGI/1.1)</li>";
echo "</ul>";

echo "<hr>";

echo "<h2>4. Full \$_SERVER Array Content (for Inspection)</h2>";
// Display the entire array structure for detailed inspection

echo "<pre>";
// Use the null coalescing operator (??) in case $_SERVER is somehow unset, though highly unlikely
print_r($_SERVER ?? '$_SERVER array is unavailable.');
echo "</pre>";

?>