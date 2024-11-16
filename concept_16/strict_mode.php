<?php

// strict_mode.php

// This script demonstrates how to enable and the effect of
// PHP's **strict type mode** using `declare(strict_types=1);`.

// ---------------------------------------------------------------------
// 1. Enabling Strict Mode
// ---------------------------------------------------------------------

/**
 * The 'declare(strict_types=1);' directive MUST be the very first 
 * executable statement in the file. It affects how type declarations
 * are handled within this file (and functions defined in it).
 * * If omitted or set to 0, PHP uses **coercive mode**, allowing types 
 * like '5' (string) to be automatically converted to 5 (int).
 * * In strict mode, automatic coercion is disabled, and type mismatches 
 * will throw a **TypeError**.
 */
declare(strict_types=1);

echo "<h1>PHP Strict Type Mode Demo (declare(strict_types=1);) 🔒</h1>";
echo "<p>Strict mode enforces that passed arguments and returned values must **exactly** match the declared type, preventing PHP from automatically changing types (coercion).</p>";

// ---------------------------------------------------------------------
// 2. Function Definition with Type Hints
// ---------------------------------------------------------------------

/**
 * A function requiring a specific integer and a specific float argument.
 * * @param int $x An integer value.
 * @param float $y A float value.
 * @return float The sum of the two numbers.
 */
function strict_add(int $x, float $y): float {
    return $x + $y;
}

echo "<h2>2. Strict Mode Behavior (Type Mismatch)</h2>";

// ---------------------------------------------------------------------
// 2a. Correct Usage
// ---------------------------------------------------------------------
$a = 5;      // int
$b = 10.5;   // float
$result_ok = strict_add($a, $b);
echo "<li>Correct Call: strict_add({$a} [int], {$b} [float]) = <strong>{$result_ok}</strong> (Result is float)</li>";

// ---------------------------------------------------------------------
// 2b. Type Mismatch (Triggers TypeError in Strict Mode)
// ---------------------------------------------------------------------
$a_string = "5"; // string
$b_int = 10;     // int (Wrong type, should be float)

echo "<li>Coercion Attempt: strict_add('{$a_string}' [string], {$b_int} [int])</li>";

try {
    // In coercive mode, PHP would convert '5' to 5 and 10 to 10.0 and return 15.0.
    // In STRICT MODE, this throws a TypeError immediately.
    $result_error = strict_add($a_string, $b_int);
    echo "<p>Result: {$result_error} (If this prints, strict mode failed!)</p>";
} catch (TypeError $e) {
    echo "<p style='color: red;'><strong>Caught TypeError:</strong> {$e->getMessage()}</p>";
    echo "<p>✅ Strict mode successfully prevented the automatic conversion (coercion) of <code>string</code> to <code>int</code> and <code>int</code> to <code>float</code>.</p>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Strict Return Type Check
// ---------------------------------------------------------------------

/**
 * Function expected to return a string.
 * @param bool $success
 * @return string
 */
function get_status_strict(bool $success): string {
    if ($success) {
        return "Complete";
    }
    // Attempt to return a boolean instead of a string
    return false; // This will trigger a TypeError in strict mode
}

echo "<h2>3. Strict Return Type Check</h2>";
echo "<li>Calling get_status_strict(false) which tries to return a **bool** instead of a **string**:</li>";

try {
    $status = get_status_strict(false);
    echo "Status: {$status} (This line should not be reached)<br>";
} catch (TypeError $e) {
    echo "<p style='color: red;'><strong>Caught TypeError:</strong> {$e->getMessage()}</p>";
    echo "<p>✅ Strict mode successfully caught the return type mismatch.</p>";
}

// ---------------------------------------------------------------------
// 4. Important Note on Scope
// ---------------------------------------------------------------------

echo "<hr>";
echo "<h2>4. Scope of Strict Mode</h2>";
echo "<p><strong>Crucially:</strong> The <code>declare(strict_types=1);</code> directive only applies to the code in **this file** when the function is *called* from this file. If this function was defined in a non-strict file and called from this strict file, the strict file's rules would still apply to the arguments passed.</p>";
?>