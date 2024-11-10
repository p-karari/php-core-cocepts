<?php

// fallthrough.php

// The concept of "fall-through" in PHP's switch statement occurs when a 'break' 
// statement is intentionally or accidentally omitted from a 'case' block.
// This causes execution to continue into the next 'case' block until a 'break' 
// or the end of the switch statement is encountered.

echo "<h2>1. Intentional Fall-Through (Combining Cases)</h2>";

$tier = "silver";
$benefits = "Your membership includes: ";

// Fall-through is useful for applying the same logic to multiple different cases.
switch ($tier) {
    case "platinum":
        $benefits .= "Priority Support, ";
        // No break here - falls through to the next case
    case "gold":
        $benefits .= "Premium Content Access, ";
        // No break here - falls through to the next case
    case "silver":
        $benefits .= "Basic Content Access, ";
        // No break here - falls through to the next case
    case "bronze":
        $benefits .= "Email Newsletter.";
        break; // Execution stops here for all tiers
    default:
        $benefits = "Invalid tier selected.";
}

echo "Tier '{$tier}': <strong>{$benefits}</strong><br>"; 
// Output: Your membership includes: Basic Content Access, Email Newsletter.

echo "<hr>";

echo "<h2>2. Accidental Fall-Through (The Bug)</h2>";

$status_code = 200;
$action_required = "";

switch ($status_code) {
    case 200:
        $action_required = "Success: Data fetched.";
        // !!! ACCIDENTAL OMISSION OF 'break' HERE !!!
    case 301:
        $action_required = "Redirect: Location changed.";
        break;
    case 404:
        $action_required = "Error: Resource not found.";
        break;
    default:
        $action_required = "Unknown status.";
}

echo "Status Code '{$status_code}': <strong>{$action_required}</strong><br>"; 
// Output: Redirect: Location changed.
// This is WRONG! Because 200 fell through to 301, the 200 result was overwritten.

echo "<hr>";

echo "<h2>3. PHP 8.0+ Match Expression (Preventing Fall-Through)</h2>";

// The 'match' expression (introduced in PHP 8.0) is often preferred for simple 
// comparisons because it does NOT fall through. It returns a value.

$grade = "B";

$grade_message = match ($grade) {
    "A" => "Excellent work!",
    "B", "C" => "Good job, you passed.", // Multiple values handled with a comma
    "D" => "Needs improvement.",
    default => "Failed or unknown grade.",
};

echo "Grade '{$grade}': <strong>{$grade_message}</strong><br>"; 
// Output: Good job, you passed. (No fall-through possible)
?>