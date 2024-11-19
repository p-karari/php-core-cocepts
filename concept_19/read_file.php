<?php

// read_file.php

// This script demonstrates different ways to read the content of a file in PHP.

echo "<h1>PHP File Reading Demonstration 📖</h1>";

// Define the file name to be used for the demonstration
$filename = "sample_data.txt";
$file_content = "Line 1: Hello World.\nLine 2: PHP File Read Demo.\nLine 3: End of file.";

// ---------------------------------------------------------------------
// 1. Setup: Create a dummy file for reading
// ---------------------------------------------------------------------
file_put_contents($filename, $file_content);
echo "<p>✅ Setup: Created file <strong>{$filename}</strong> with content for demonstration.</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Method 1: Reading the Entire File (file_get_contents())
// ---------------------------------------------------------------------

echo "<h2>1. Reading Entire File (file_get_contents())</h2>";
echo "<p>This is the simplest way to read an entire file into a single string.</p>";

$content_string = file_get_contents($filename);

if ($content_string !== false) {
    echo "<h3>Content:</h3>";
    echo "<pre>" . htmlspecialchars($content_string) . "</pre>";
} else {
    echo "<p style='color: red;'>❌ Error reading file using file_get_contents().</p>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Method 2: Reading File Line by Line (file())
// ---------------------------------------------------------------------

echo "<h2>2. Reading File Line by Line (file())</h2>";
echo "<p>The <code>file()</code> function reads the file into an array, where each element is a line.</p>";

// FILE_IGNORE_NEW_LINES prevents newline characters from being added to the array elements.
$content_array = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if ($content_array !== false) {
    echo "<h3>Content (Array Structure):</h3>";
    echo "<pre>";
    print_r($content_array);
    echo "</pre>";
    
    echo "<h3>Displaying Lines:</h3>";
    foreach ($content_array as $index => $line) {
        echo "<li>Line " . ($index + 1) . ": <strong>" . htmlspecialchars($line) . "</strong></li>";
    }
} else {
    echo "<p style='color: red;'>❌ Error reading file using file().</p>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Method 3: Reading File with Low-Level Functions (fopen, fgets, fclose)
// ---------------------------------------------------------------------

echo "<h2>3. Low-Level Reading (fopen, fgets, fclose)</h2>";
echo "<p>This is typically used for large files or when fine-grained control is needed (e.g., reading a specific amount of bytes).</p>";

$handle = fopen($filename, "r"); // Open file in read mode ('r')

if ($handle) {
    echo "<h3>Content (Using fgets loop):</h3>";
    $line_count = 1;
    
    // fgets() reads a single line from the file pointer until it reaches EOF.
    while (!feof($handle)) {
        $line = fgets($handle);
        if ($line !== false) {
            echo "<li>Line {$line_count}: <strong>" . htmlspecialchars(trim($line)) . "</strong></li>";
            $line_count++;
        }
    }
    
    fclose($handle); // Always close the file handle
} else {
    echo "<p style='color: red;'>❌ Error: Could not open file using fopen().</p>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 5. Cleanup
// ---------------------------------------------------------------------
@unlink($filename);
echo "<p>🗑️ Cleanup: Deleted temporary file <strong>{$filename}</strong>.</p>";

?>