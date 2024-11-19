<?php

// file_handling.php

// This script demonstrates basic file handling operations in PHP: 
// reading, writing, appending, checking existence, and deleting files.

echo "<h1>PHP Basic File Handling Demo 📁</h1>";

// Define the name of the file to be used for the demonstration
$filename = "demo_file.txt";
$data_to_write = "This is the initial content.\n";
$data_to_append = "This line was appended later.\n";

echo "<h2>1. Writing and Overwriting a File (Mode: 'w')</h2>";

// 1. Open the file in 'write' mode ('w'). 
//    'w' creates the file if it doesn't exist, and **overwrites** it if it does.
$handle = fopen($filename, 'w');

if ($handle) {
    // 2. Write the data to the file
    fwrite($handle, $data_to_write);
    
    // 3. Close the file handle to save changes
    fclose($handle);
    
    echo "<p style='color: green;'>✅ File <strong>{$filename}</strong> created and written successfully.</p>";
} else {
    echo "<p style='color: red;'>❌ Error: Could not open or create file for writing.</p>";
}

echo "<hr>";

echo "<h2>2. Checking File Existence (file_exists())</h2>";

if (file_exists($filename)) {
    echo "<p style='color: green;'>✅ File <strong>{$filename}</strong> exists.</p>";
} else {
    echo "<p style='color: red;'>❌ File <strong>{$filename}</strong> does not exist.</p>";
}

echo "<hr>";

echo "<h2>3. Appending to a File (Mode: 'a')</h2>";

// 1. Open the file in 'append' mode ('a'). 
//    'a' creates the file if it doesn't exist and adds data to the end.
$handle = fopen($filename, 'a');

if ($handle) {
    // 2. Write the new data
    fwrite($handle, $data_to_append);
    fclose($handle);
    
    echo "<p style='color: green;'>✅ Data successfully appended to <strong>{$filename}</strong>.</p>";
} else {
    echo "<p style='color: red;'>❌ Error: Could not open file for appending.</p>";
}

echo "<hr>";

echo "<h2>4. Reading the Entire File Content (file_get_contents())</h2>";

// file_get_contents() is the simplest way to read the entire contents of a file into a string.
$file_content = file_get_contents($filename);

if ($file_content !== false) {
    echo "<h3>Content of {$filename}:</h3>";
    echo "<pre>" . htmlspecialchars($file_content) . "</pre>";
} else {
    echo "<p style='color: red;'>❌ Error: Could not read file content.</p>";
}

echo "<hr>";

echo "<h2>5. Deleting a File (unlink())</h2>";

// unlink() permanently deletes the specified file.
if (file_exists($filename)) {
    if (unlink($filename)) {
        echo "<p style='color: green;'>✅ File <strong>{$filename}</strong> successfully deleted.</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: Could not delete file.</p>";
    }
} else {
    echo "<p>File was already missing. Skipping deletion.</p>";
}

// Final check to confirm deletion
if (!file_exists($filename)) {
    echo "<p>Final Check: File no longer exists.</p>";
}

?>