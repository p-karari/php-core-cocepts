<?php

// write_log.php

// This script demonstrates writing log messages to a file, including 
// appending content, prepending a timestamp, and using file handling functions.

echo "<h1>PHP Logging Demonstration (Writing to File) 📝</h1>";

// Define the name of the log file
$log_file = "application.log";

// ---------------------------------------------------------------------
// 1. Function to Log a Message
// ---------------------------------------------------------------------

/**
 * Appends a timestamped message to the specified log file.
 * @param string $message The message content to log.
 * @param string $level The severity level (e.g., INFO, WARNING, ERROR).
 * @param string $file The log file path.
 * @return bool True on successful write, false otherwise.
 */
function write_log(string $message, string $level = 'INFO', string $file = 'application.log'): bool {
    // Format the timestamp: YYYY-MM-DD HH:MM:SS
    $timestamp = date('Y-m-d H:i:s');
    
    // Format the log line: [TIMESTAMP] [LEVEL] MESSAGE
    $log_line = "[{$timestamp}] [{$level}] " . trim($message) . PHP_EOL; // PHP_EOL is a cross-platform newline character

    // FILE_APPEND: Appends content to the file.
    // LOCK_EX: Obtains an exclusive lock on the file during the write operation to prevent data corruption when multiple processes write simultaneously.
    $result = file_put_contents($file, $log_line, FILE_APPEND | LOCK_EX);

    // file_put_contents returns the number of bytes written or false on failure.
    return $result !== false;
}

echo "<h2>2. Logging Example</h2>";

// ---------------------------------------------------------------------
// 2a. Log an INFO message
// ---------------------------------------------------------------------
$info_message = "User 'admin' logged into the system.";
if (write_log($info_message, 'INFO', $log_file)) {
    echo "<p style='color: green;'>✅ INFO Logged: {$info_message}</p>";
} else {
    echo "<p style='color: red;'>❌ Failed to write INFO log.</p>";
}

// ---------------------------------------------------------------------
// 2b. Log a WARNING message
// ---------------------------------------------------------------------
$warning_message = "Database connection took longer than 500ms.";
if (write_log($warning_message, 'WARNING', $log_file)) {
    echo "<p style='color: orange;'>✅ WARNING Logged: {$warning_message}</p>";
} else {
    echo "<p style='color: red;'>❌ Failed to write WARNING log.</p>";
}

// ---------------------------------------------------------------------
// 2c. Log an ERROR message
// ---------------------------------------------------------------------
$error_message = "Fatal error encountered during checkout process.";
if (write_log($error_message, 'ERROR', $log_file)) {
    echo "<p style='color: red;'>✅ ERROR Logged: {$error_message}</p>";
} else {
    echo "<p style='color: red;'>❌ Failed to write ERROR log.</p>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Display Log File Content
// ---------------------------------------------------------------------

echo "<h2>3. Current Log File Content</h2>";

if (file_exists($log_file)) {
    $content = file_get_contents($log_file);
    echo "<h3>Content of {$log_file}:</h3>";
    echo "<pre>" . htmlspecialchars($content) . "</pre>";
} else {
    echo "<p>Log file <strong>{$log_file}</strong> not found.</p>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Cleanup (Optional)
// ---------------------------------------------------------------------
/*
if (file_exists($log_file)) {
    if (unlink($log_file)) {
        echo "<p>🗑️ Cleanup: Log file deleted.</p>";
    }
}
*/

?>