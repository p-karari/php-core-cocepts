<?php

// connect.php

// This script demonstrates the essential steps to establish a connection 
// to a MySQL database using the **PHP Data Objects (PDO)** extension, 
// including crucial error handling.

echo "<h1>PDO Database Connection Demonstration 🤝</h1>";

// ---------------------------------------------------------------------
// 1. Database Configuration
// ---------------------------------------------------------------------

// ⚠️ IMPORTANT: Replace these values with your actual database credentials.
$host = 'localhost';      // The database host (often 'localhost' or an IP)
$db = 'testdb';           // The database name
$user = 'testuser';       // The database username
$pass = 'password';       // The database password
$charset = 'utf8mb4';     // Character set for communication

// Data Source Name (DSN) string: specifies the driver, host, database name, and charset.
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Connection options (Configuration for PDO behavior)
$options = [
    // Throw PDOException on errors, which is the safest and most robust way to handle them.
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    // Return rows as associative arrays by default.
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    // Disable emulated prepared statements for better security and performance.
    \PDO::ATTR_EMULATE_PREPARES   => false,
];

// ---------------------------------------------------------------------
// 2. Establishing the Connection with Exception Handling
// ---------------------------------------------------------------------

$pdo = null; // Initialize the connection variable

echo "<h2>2. Attempting Connection...</h2>";

try {
    // Attempt to create a new PDO instance, which establishes the connection.
    $pdo = new \PDO($dsn, $user, $pass, $options);
    
    echo "<p style='color: green;'>✅ **SUCCESS:** Successfully connected to the database `{$db}`.</p>";
    
    // Perform a simple check query to confirm the connection is active
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    echo "<li>Database Server Version: <strong>{$version}</strong></li>";

} catch (\PDOException $e) {
    // Catch specific PDO exceptions for clean error reporting.
    
    echo "<p style='color: red;'>❌ **CONNECTION FAILED!**</p>";
    
    // Log the error detail internally, but only show a generic message to the user.
    error_log("PDO Connection Error: " . $e->getMessage()); 
    
    echo "<li>Error Code: {$e->getCode()}</li>";
    echo "<li>Connection could not be established. Please check your credentials and DSN string.</li>";
    
    // Stop script execution as the database is essential
    die(); 
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Connection Closure
// ---------------------------------------------------------------------

// The PDO object automatically manages connection pooling and closure. 
// However, explicitly setting the variable to null is the clearest way 
// to ensure the connection is closed when it's no longer needed.
if ($pdo !== null) {
    $pdo = null; 
    echo "<h2>3. Connection Closed</h2>";
    echo "<p>The database connection has been gracefully closed by setting the \$pdo object to null.</p>";
}

?>