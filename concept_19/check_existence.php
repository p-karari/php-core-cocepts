<?php

// check_existence.php

// This script demonstrates how to check the existence of files and directories 
// using PHP's file_exists() and is_dir() functions.

echo "<h1>PHP File and Directory Existence Check 🔍</h1>";

// ---------------------------------------------------------------------
// 1. Setup: Create dummy files and directories for testing
// ---------------------------------------------------------------------

$file_exists = "test_file.txt";
$file_missing = "non_existent_file.log";
$dir_exists = "test_directory";
$dir_missing = "non_existent_dir";

// Create the test file and directory
file_put_contents($file_exists, "This file is just for existence testing.");
@mkdir($dir_exists); // Use @ to suppress warning if directory already exists

echo "<p>✅ Setup complete. Testing with: <strong>{$file_exists}</strong> and <strong>{$dir_exists}</strong></p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Checking File Existence (file_exists())
// ---------------------------------------------------------------------

echo "<h2>2. Checking Existence (file_exists())</h2>";
echo "<p><code>file_exists()</code> checks if a file or directory exists.</p>";

// 2a. Check for a file that exists
if (file_exists($file_exists)) {
    echo "<li>File <strong>{$file_exists}</strong>: <span style='color: green;'><strong>Exists</strong></span>.</li>";
} else {
    echo "<li>File <strong>{$file_exists}</strong>: <span style='color: red;'>Does Not Exist</span>.</li>";
}

// 2b. Check for a file that does not exist
if (file_exists($file_missing)) {
    echo "<li>File <strong>{$file_missing}</strong>: <span style='color: green;'>Exists</span>.</li>";
} else {
    echo "<li>File <strong>{$file_missing}</strong>: <span style='color: red;'><strong>Does Not Exist</strong></span>.</li>";
}

// 2c. file_exists() can also detect directories
if (file_exists($dir_exists)) {
    echo "<li>Directory <strong>{$dir_exists}</strong>: <span style='color: green;'><strong>Exists</strong></span> (detected by file_exists).</li>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Checking Specifically for a Directory (is_dir())
// ---------------------------------------------------------------------

echo "<h2>3. Checking Specifically for a Directory (is_dir())</h2>";
echo "<p><code>is_dir()</code> checks if the path exists AND is a directory.</p>";

// 3a. Check for a directory that exists
if (is_dir($dir_exists)) {
    echo "<li>Directory <strong>{$dir_exists}</strong>: <span style='color: green;'><strong>Is a Directory</strong></span>.</li>";
} else {
    echo "<li>Directory <strong>{$dir_exists}</strong>: <span style='color: red;'>Is Not a Directory</span>.</li>";
}

// 3b. Check if the existing file is reported as a directory (should be false)
if (is_dir($file_exists)) {
    echo "<li>File <strong>{$file_exists}</strong>: <span style='color: green;'>Is a Directory</span>.</li>";
} else {
    echo "<li>File <strong>{$file_exists}</strong>: <span style='color: red;'><strong>Is Not a Directory</strong></span>.</li>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Cleanup
// ---------------------------------------------------------------------
echo "<h2>4. Cleanup</h2>";
if (file_exists($file_exists)) {
    unlink($file_exists);
    echo "<li>🗑️ Deleted <strong>{$file_exists}</strong>.</li>";
}
if (is_dir($dir_exists)) {
    rmdir($dir_exists); // rmdir() removes an empty directory
    echo "<li>🗑️ Deleted <strong>{$dir_exists}</strong>.</li>";
}
?>