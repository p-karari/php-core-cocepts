<?php

// type_hints_strict.php

// This script demonstrates the use of type declarations (type hints) 
// in function parameters and return values, and how the `declare(strict_types=1);` 
// statement enforces strict type checking in PHP.

// ---------------------------------------------------------------------
// 1. Enabling Strict Typing (MUST be the very first executable statement)
// ---------------------------------------------------------------------

declare(strict_types=1);

echo "<h1>PHP Type Hints and Strict Mode (declare(strict_types=1);)</h1>";
echo "<p>When <code>strict_types=1</code> is set, PHP will NOT attempt to coerce values (e.g., converting '5' to 5). Arguments must strictly match the declared type, or a <strong>TypeError</strong> is thrown.</p>";

// ---------------------------------------------------------------------
// 2. Function with Scalar Type Hints (int, float, string, bool)
// ---------------------------------------------------------------------

function add_numbers(int $a, float $b): float {
    return $a + $b;
}

echo "<h2>2. Strict Scalar Type Checks</h2>";

// 2a. Correct usage (Types match exactly)
$result_correct = add_numbers(10, 5.5);
echo "1. Correct (int 10, float 5.5): Result = <strong>{$result_correct}</strong><br>"; // Output: 15.5

// 2b. Potential TypeError (Passing a string instead of an integer)
echo "2. Incorrect (string '10', float 5.5): ";
try {
    // If strict_types=0, PHP converts '10' to 10. If strict_types=1, it throws TypeError.
    $result_error = add_numbers('10', 5.5);
    echo "Result = {$result_error} (This should not happen in strict mode)<br>";
} catch (TypeError $e) {
    echo "<span style='color: red;'><strong>Caught TypeError:</strong> {$e->getMessage()}</span><br>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Function with Complex Type Hints (array, object, iterable)
// ---------------------------------------------------------------------

function process_list(array $items): int {
    // Check if all elements are strings
    foreach ($items as $item) {
        if (!is_string($item)) {
            // Internal logic check, separate from strict type enforcement
            throw new InvalidArgumentException("All array elements must be strings.");
        }
    }
    return count($items);
}

echo "<h2>3. Array Type Check</h2>";

// 3a. Correct usage (Passes an array)
$list_correct = ["A", "B", "C"];
$count_correct = process_list($list_correct);
echo "3. Correct (Passing array): Count = <strong>{$count_correct}</strong><br>";

// 3b. Potential TypeError (Passing null instead of an array)
echo "4. Incorrect (Passing null): ";
try {
    // If strict_types=1, passing NULL for an array type hint is an immediate TypeError (since PHP 7.1).
    $count_error = process_list(null);
    echo "Count = {$count_error} (This should not happen in strict mode)<br>";
} catch (TypeError $e) {
    echo "<span style='color: red;'><strong>Caught TypeError:</strong> {$e->getMessage()}</span><br>";
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Checking Return Type Hint
// ---------------------------------------------------------------------

function get_status(bool $active): string {
    if ($active) {
        return "Online";
    }
    // Attempt to return an integer when 'string' is expected
    return 0; // This will trigger a TypeError in strict mode because 0 is not a string
}

echo "<h2>4. Strict Return Type Check</h2>";

echo "5. Invalid Return Type: ";
try {
    $status = get_status(false);
    echo "Status = {$status}<br>"; // This line won't be reached if TypeError is thrown
} catch (TypeError $e) {
    echo "<span style='color: red;'><strong>Caught TypeError:</strong> {$e->getMessage()}</span><br>";
}

// NOTE: Strict mode affects the function definition file. If `add_numbers` was defined in
// another file without `declare(strict_types=1);`, passing a string would be allowed!
?>