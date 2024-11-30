<?php

// try_catch_error.php

// This script demonstrates **Exception Handling** using the `try...catch` block 
// in PHP. It's the standard way to gracefully manage errors (exceptions) 
// that might occur during code execution, especially for risky operations like 
// file access, database connections, or invalid function calls.

echo "<h1>PHP try...catch Error Handling Demo 🛡️</h1>";

// ---------------------------------------------------------------------
// 1. Function That May Throw an Exception
// ---------------------------------------------------------------------

/**
 * Simulates a function that divides two numbers and throws an exception 
 * if the divisor is zero.
 * * @param float $numerator
 * @param float $divisor
 * @return float
 * @throws \Exception if the divisor is zero.
 */
function safeDivide(float $numerator, float $divisor): float {
    if ($divisor === 0.0) {
        // Throw an Exception object when an abnormal condition occurs.
        throw new \Exception("Cannot divide by zero.");
    }
    return $numerator / $divisor;
}

echo "<h2>1. Handling the Exception</h2>";

// ---------------------------------------------------------------------
// 2. The try...catch Block
// ---------------------------------------------------------------------

$a = 10;
$b = 0; // This will cause the exception

echo "<h3>Attempting division: {$a} / {$b}</h3>";

try {
    // 2a. The `try` block: Contains the code that might throw an exception.
    echo "<p style='color: gray;'>Inside the try block, calling safeDivide...</p>";
    $result = safeDivide($a, $b);
    
    // This line is skipped if an exception is thrown above.
    echo "<p style='color: green;'>✅ Result: {$result}</p>"; 

} catch (\Exception $e) {
    // 2b. The `catch` block: Executes ONLY if an exception of the specified 
    // type (or any class that inherits from it, like \Exception) is thrown in the `try` block.
    
    echo "<p style='color: red;'>❌ **Caught Exception!**</p>";
    
    // \Exception object contains details about the error
    echo "<li>Error Message: <strong>{$e->getMessage()}</strong></li>";
    echo "<li>File: <code>{$e->getFile()}</code> on line <strong>{$e->getLine()}</strong></li>";
    
    $result = "N/A";
}

echo "<h3>Result after handling: {$result}</h3>";
echo "<p>Execution continues normally here, demonstrating graceful failure.</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Handling Different Exception Types (Specific vs. Generic)
// ---------------------------------------------------------------------

echo "<h2>3. Multiple Catch Blocks (Type Specificity)</h2>";

class CustomFileNotFoundException extends \Exception {}
class CustomPermissionDeniedException extends \Exception {}

function openFile(string $filename): void {
    if ($filename === "missing.txt") {
        throw new CustomFileNotFoundException("File '{$filename}' does not exist.");
    }
    if ($filename === "locked.cfg") {
        throw new CustomPermissionDeniedException("Permission denied for '{$filename}'.");
    }
    echo "<p style='color: green;'>✅ Successfully processed file: {$filename}</p>";
}

try {
    // openFile("missing.txt"); // Test 1: File Not Found
    openFile("locked.cfg"); // Test 2: Permission Denied

} catch (CustomPermissionDeniedException $e) {
    // This block catches only the Permission Denied error.
    echo "<p style='color: red;'>⚠️ **PERMISSION ERROR:** Please check file access rights.</p>";
    
} catch (CustomFileNotFoundException $e) {
    // This block catches only the File Not Found error.
    echo "<p style='color: orange;'>⚠️ **FILE ERROR:** The required file was not located.</p>";
    
} catch (\Exception $e) {
    // This generic block catches any other exception that wasn't caught above.
    echo "<p style='color: red;'>❌ **GENERIC ERROR:** An unexpected error occurred.</p>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. The try...finally Block (PHP 5.5+)
// ---------------------------------------------------------------------

echo "<h2>4. The try...finally Block</h2>";

try {
    echo "<li>Try block started. (e.g., opened database connection)</li>";
    // throw new \Exception("Simulated mid-process failure.");
    echo "<li>Try block finished without error.</li>";
    
} catch (\Exception $e) {
    echo "<p style='color: red;'>❌ Caught error: {$e->getMessage()}</p>";

} finally {
    // The `finally` block executes regardless of whether an exception was 
    // thrown or caught. Ideal for cleanup tasks.
    echo "<p style='color: blue;'>➡️ **FINALLY:** Cleanup complete. (e.g., closed database connection)</p>";
}
?>