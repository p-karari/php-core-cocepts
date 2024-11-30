<?php

// pdo_intro.php

// This script provides a basic introduction to the PHP Data Objects (PDO) extension, 
// which defines a lightweight, consistent interface for accessing databases in PHP.
// It covers connection, error handling, and a simple query.

echo "<h1>PHP Data Objects (PDO) Introduction 💾</h1>";

// ---------------------------------------------------------------------
// 1. Configuration
// ---------------------------------------------------------------------

// Database credentials for a local MySQL database (adjust as necessary)
$host = 'localhost';
$db = 'testdb';
$user = 'testuser';
$pass = 'password';
$charset = 'utf8mb4';

// Data Source Name (DSN) string
// Format: driver:host=hostname;dbname=database_name;charset=encoding
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Options for the PDO connection
$options = [
    // Set default fetch mode to associative arrays
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Turn on exceptions for error reporting (best practice)
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // Disable emulated prepared statements (important for security and performance)
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// ---------------------------------------------------------------------
// 2. Database Connection (Exception Handling)
// ---------------------------------------------------------------------

$pdo = null;

try {
    // Attempt to create a new PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    echo "<p style='color: green;'>✅ **SUCCESS:** Connected to the database '{$db}' via PDO.</p>";

} catch (\PDOException $e) {
    // Catch PDO-specific exceptions and display a user-friendly error message.
    // NEVER display $e->getMessage() directly on a live site as it may expose credentials.
    echo "<p style='color: red;'>❌ **CONNECTION ERROR:** Could not connect to the database.</p>";
    echo "<p><em>Error Detail (for debugging only):</em> " . $e->getMessage() . "</p>";
    
    // Stop script execution if the connection fails
    die(); 
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Simple Query Execution (CREATE TABLE)
// ---------------------------------------------------------------------

echo "<h2>3. Query Execution (CREATE & INSERT)</h2>";

try {
    // 3a. Create a simple table if it doesn't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS pdo_users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
    echo "<p>Table `pdo_users` ensured to exist.</p>";

    // 3b. Simple INSERT (using exec() is only safe for statements without user input)
    // We wrap it in a transaction to prevent duplicate errors if run multiple times.
    $pdo->beginTransaction();
    $insertResult = $pdo->exec("
        INSERT IGNORE INTO pdo_users (username, email) 
        VALUES ('alice', 'alice@example.com');
    ");
    $pdo->commit();
    
    if ($insertResult !== false && $insertResult > 0) {
        echo "<p>✅ Inserted Alice successfully (Rows affected: {$insertResult}).</p>";
    } else {
        echo "<p>No new data inserted (Alice likely already exists).</p>";
    }
    
    echo "<hr>";

    // -----------------------------------------------------------------
    // 4. Retrieving Data (query() method for simple SELECT)
    // -----------------------------------------------------------------

    echo "<h2>4. Retrieving Data (query())</h2>";

    // Use the query() method for simple SELECT statements without parameters.
    $stmt = $pdo->query('SELECT id, username, email FROM pdo_users LIMIT 5');
    
    echo "<h3>PDO Users:</h3>";
    echo "<ul>";
    
    // Loop through the results. PDO::FETCH_ASSOC is the default here due to $options.
    while ($row = $stmt->fetch()) {
        echo "<li>ID: {$row['id']} | Username: {$row['username']} | Email: {$row['email']}</li>";
    }
    
    echo "</ul>";

} catch (\PDOException $e) {
    // Rollback the transaction if anything went wrong during the INSERT
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    echo "<p style='color: red;'>❌ **QUERY ERROR:** An issue occurred during database operation.</p>";
    echo "<p><em>SQLSTATE ({$e->getCode()}):</em> " . $e->getMessage() . "</p>";
}

// ---------------------------------------------------------------------
// 5. Connection Closure
// ---------------------------------------------------------------------

// The connection is closed automatically when the $pdo object is destroyed 
// (e.g., when the script ends, or explicitly by setting it to null).
$pdo = null;
echo "<p>Connection closed.</p>";
?>