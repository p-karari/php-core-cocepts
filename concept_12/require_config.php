<?php

// requireconfig.php

// This file demonstrates the crucial use of 'require' to load essential 
// configuration settings. If the configuration file is missing, the application 
// cannot function, so a fatal error (halt) is desired.

echo "<h1>Using require to Load Essential Configuration ⚙️</h1>";

// ---------------------------------------------------------------------
// 1. Setup: Create the configuration file for the demo
// ---------------------------------------------------------------------
$config_content = <<<PHP
<?php
/** * config_settings.php - Essential application settings.
 * This file MUST exist for the application to run.
 */

\$config = [
    'db_host' => '127.0.0.1',
    'db_user' => 'app_user',
    'db_pass' => 'secure_password_123',
    'app_name' => 'Secure App'
];

\$is_config_loaded = true;

?>
PHP;

// Write the content to the dummy file
file_put_contents("config_settings.php", $config_content);

echo "<h2>2. Requiring the Configuration File</h2>";

// ---------------------------------------------------------------------
// 2. The 'require' Statement
// ---------------------------------------------------------------------

// Use 'require' because if config_settings.php is missing, the rest of 
// the script (e.g., database connection) will fail catastrophically.
// require_once is often preferred to ensure it's only included once.
require_once "config_settings.php"; 

// ---------------------------------------------------------------------
// 3. Using the Loaded Variables
// ---------------------------------------------------------------------

// Check if the file was loaded successfully by checking a variable set inside it
if (isset($is_config_loaded) && $is_config_loaded) {
    echo "<p style='color: green;'>✅ Configuration file <strong>config_settings.php</strong> required successfully.</p>";
    
    // Access the settings array loaded from the required file
    $app_name = $config['app_name'];
    $db_host = $config['db_host'];

    echo "<h3>Application Status:</h3>";
    echo "<ul>";
    echo "<li>Application Name: <strong>{$app_name}</strong></li>";
    echo "<li>Database Host: <strong>{$db_host}</strong></li>";
    echo "</ul>";
    
    // Demonstrate a function that relies on the required config
    function connect_database($config) {
        // In a real app, this would use mysqli_connect or similar
        return "Simulated connection to {$config['db_host']} as user {$config['db_user']}...";
    }

    echo "<p>Database Connection: " . connect_database($config) . "</p>";

} else {
    // This 'else' block should typically not be reached if the file exists, 
    // as 'require' ensures the code inside the file runs.
    echo "<p style='color: red;'>Configuration variables not found after inclusion.</p>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Testing the Failure Condition (Commented out)
// ---------------------------------------------------------------------

echo "<h2>4. Testing Failure (Why require is used)</h2>";
echo "<p>If we try to <code>require</code> a non-existent file, the script will halt immediately with a <strong>Fatal Error</strong>. This prevents sensitive code or partial page rendering when configuration is missing.</p>";

/*
// UNCOMMENT THE LINES BELOW TO TEST FATAL ERROR
echo "<p style='color: red;'>Attempting to require a file that does not exist...</p>";
require "non_existent_config.php"; 
echo "<p>❌ This line would NOT be reached.</p>";
*/

// ---------------------------------------------------------------------
// 5. Cleanup (optional)
// ---------------------------------------------------------------------
@unlink("config_settings.php");
?>