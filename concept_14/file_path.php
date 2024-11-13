<?php

// file_path.php

// This script demonstrates how to work with file paths in PHP using various 
// built-in functions, primarily focusing on retrieving path information and manipulating components.

echo "<h1>PHP File Path Functions 📂</h1>";

// ---------------------------------------------------------------------
// 1. Setup: Define a sample path for demonstration
// ---------------------------------------------------------------------

// Sample paths for testing
$path_full = "/var/www/html/app/config/settings.dev.php";
$path_relative = "templates/user/header.html";
$current_dir = __DIR__; // A PHP magic constant for the current script's directory

echo "<h2>1. Path Components (basename, dirname, extension)</h2>";

// ---------------------------------------------------------------------
// 1a. basename(): Returns the filename part of the path
// ---------------------------------------------------------------------
$filename_full = basename($path_full);
$filename_relative = basename($path_relative);

echo "<li><strong>basename(\$path_full):</strong> {$filename_full}</li>"; // Output: settings.dev.php
echo "<li><strong>basename(\$path_relative):</strong> {$filename_relative}</li>"; // Output: header.html

// basename() can optionally remove a suffix
$filename_no_ext = basename($path_full, ".php");
echo "<li><strong>basename(..., '.php'):</strong> {$filename_no_ext}</li>"; // Output: settings.dev.

// ---------------------------------------------------------------------
// 1b. dirname(): Returns the directory part of the path
// ---------------------------------------------------------------------
$directory_full = dirname($path_full);
$directory_relative = dirname($path_relative);

echo "<li><strong>dirname(\$path_full):</strong> {$directory_full}</li>"; // Output: /var/www/html/app/config
echo "<li><strong>dirname(\$path_relative):</strong> {$directory_relative}</li>"; // Output: templates/user

echo "<hr>";

echo "<h2>2. pathinfo() (Comprehensive Path Information)</h2>";

// ---------------------------------------------------------------------
// 2. pathinfo(): Returns an associative array with all path components
// ---------------------------------------------------------------------
$path_info = pathinfo($path_full);

echo "<h3>pathinfo(\$path_full) Array:</h3>";
echo "<pre>";
print_r($path_info);
echo "</pre>";

// Accessing components directly from the pathinfo array:
echo "<li><strong>Extension:</strong> {$path_info['extension']}</li>"; // Output: php
echo "<li><strong>Filename (stem):</strong> {$path_info['filename']}</li>"; // Output: settings.dev

// You can also request specific elements directly:
$extension_only = pathinfo($path_full, PATHINFO_EXTENSION);
echo "<li><strong>pathinfo(..., PATHINFO_EXTENSION):</strong> {$extension_only}</li>";

echo "<hr>";

echo "<h2>3. Real Path and Absolute Path</h2>";

// ---------------------------------------------------------------------
// 3a. realpath(): Returns the canonicalized absolute pathname
// ---------------------------------------------------------------------
// Note: realpath() returns FALSE if the file/path doesn't exist.
// This function resolves symbolic links and redundant directory separators (like /../).
$real_path = realpath($current_dir . "/../" . basename(__FILE__));
if ($real_path) {
    echo "<li><strong>realpath() (Current Script):</strong> {$real_path}</li>";
} else {
    echo "<li><strong>realpath():</strong> File does not exist or access denied.</li>";
}

// ---------------------------------------------------------------------
// 3b. __FILE__ and __DIR__ (Magic Constants)
// ---------------------------------------------------------------------
echo "<li><strong>__FILE__ (Current script path):</strong> " . __FILE__ . "</li>";
echo "<li><strong>__DIR__ (Current directory):</strong> " . __DIR__ . "</li>";
?>