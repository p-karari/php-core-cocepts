<?php

// env_variables.php

// This script demonstrates how to access Environment Variables in PHP. 
// Environment variables are external system variables that can be used to 
// configure the application without changing its code, which is crucial for 
// deployment and security (e.g., storing database credentials).

echo "<h1>PHP Environment Variables Demonstration 🌍</h1>";
echo "<p>Environment variables allow dynamic configuration of the application based on the server's environment (e.g., development, staging, production).</p>";

// ---------------------------------------------------------------------
// 1. Accessing Variables using $_ENV (Superglobal)
// ---------------------------------------------------------------------

// The $_ENV superglobal holds variables provided to the script environment.
// Note: This array is not automatically populated in all PHP installations/server setups. 
// You may need to configure the server (e.g., Apache SetEnv or FPM) or use a 
// library (like DotEnv) to populate it reliably.

echo "<h2>1. \$_ENV Superglobal</h2>";

// Example of a system variable typically found
$path_env = $_ENV['PATH'] ?? 'PATH variable not directly available via $_ENV.';
echo "<li><strong>System PATH:</strong> <code>{$path_env}</code></li>";

// Example of a custom variable (often set by Docker/Kubernetes or server config)
$app_env = $_ENV['APP_ENV'] ?? 'APP_ENV not set in $_ENV.';
echo "<li><strong>APP_ENV (Custom):</strong> <code>{$app_env}</code></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Accessing Variables using getenv() (Function)
// ---------------------------------------------------------------------

// The getenv() function is the recommended and more reliable way to access 
// environment variables, as it reads directly from the environment.

echo "<h2>2. getenv() Function</h2>";

// The function attempts to read the variable from the environment.
$path_getenv = getenv('PATH');
echo "<li><strong>System PATH:</strong> <code>" . ($path_getenv ?: 'Not available via getenv().') . "</code></li>";

$app_env_getenv = getenv('APP_ENV');
echo "<li><strong>APP_ENV (Custom):</strong> <code>" . ($app_env_getenv ?: 'Not set via getenv().') . "</code></li>";

// You can set a temporary environment variable using putenv() for the duration of the script execution
if (!getenv('DEBUG_MODE')) {
    putenv('DEBUG_MODE=true');
    $debug_mode = getenv('DEBUG_MODE');
    echo "<li><strong>DEBUG_MODE (Set during script):</strong> <code>{$debug_mode}</code></li>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Accessing Variables using $_SERVER (Legacy/Alternative)
// ---------------------------------------------------------------------

// $_SERVER often includes environment variables, though it also contains 
// request-specific headers, making it less direct for pure environment variables.

echo "<h2>3. \$_SERVER Superglobal (Alternative Source)</h2>";

$server_path = $_SERVER['PATH'] ?? 'PATH variable not available via $_SERVER.';
echo "<li><strong>System PATH:</strong> <code>{$server_path}</code></li>";

echo "<hr>";

echo "<h2>4. Full \$_ENV Array Content (Debug)</h2>";
echo "<p>Note how much of this array is populated depends on your server configuration (e.g., PHP-FPM vs. mod_php).</p>";

echo "<pre>";
print_r($_ENV ?? '$_ENV array is unavailable.');
echo "</pre>";

?>