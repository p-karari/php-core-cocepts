<?php

// config_settings.php

// This file demonstrates how to read and change PHP's runtime configuration settings.

echo "<h2>1. Reading Configuration Settings</h2>";

// 1. Reading an INI setting using ini_get()
// A common setting: the maximum size for POST data
$max_post_size = ini_get('post_max_size');
echo "Current post_max_size: <strong>{$max_post_size}</strong><br>";

// Another common setting: maximum execution time for scripts
$max_execution_time = ini_get('max_execution_time');
echo "Current max_execution_time: <strong>{$max_execution_time} seconds</strong><br>";

// Checking if display_errors is enabled (important for production vs development)
$display_errors = ini_get('display_errors');
echo "Current display_errors setting: <strong>" . ($display_errors ? 'On' : 'Off') . "</strong><br>";

echo "<hr>";

echo "<h2>2. Changing Configuration Settings (Runtime)</h2>";

// 2. Changing a setting for the duration of the script using ini_set()
// NOTE: Not all settings can be changed at runtime (e.g., max_execution_time can, but post_max_size usually cannot).

// Change the maximum execution time to 60 seconds
ini_set('max_execution_time', 60);
$new_time = ini_get('max_execution_time');
echo "New max_execution_time: <strong>{$new_time} seconds</strong> (For this script only)<br>";

// Disable displaying errors for security (good for production code)
ini_set('display_errors', 'Off');
$new_display = ini_get('display_errors');
echo "New display_errors setting: <strong>" . ($new_display ? 'On' : 'Off') . "</strong><br>";

// Set the error reporting level (E_ALL reports all errors except E_STRICT/E_DEPRECATED by default)
ini_set('error_reporting', E_ALL);
echo "Error reporting is set to E_ALL<br>";

echo "<hr>";

echo "<h2>3. Getting All Configuration Settings</h2>";

// 3. Getting all configuration settings using ini_get_all()
// This can be useful for diagnostics, but the output is very large.
// We'll limit the output here.
$all_settings = ini_get_all();

echo "Example of a single entry from ini_get_all() for 'memory_limit':<br>";
echo "<pre>";
print_r($all_settings['memory_limit']);
echo "</pre>";

echo "<hr>";

echo "<h2>4. Finding the Loaded php.ini File</h2>";

// 4. Getting the path to the loaded php.ini file
$ini_path = php_ini_loaded_file();
echo "The configuration is loaded from: <strong>{$ini_path}</strong><br>";

?>