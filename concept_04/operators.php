<?php

// operators.php

// Operators are symbols that tell the PHP parser to perform an operation 
// on one or more values (operands).

echo "<h2>1. Arithmetic Operators</h2>";
$a = 10;
$b = 3;

echo "Addition (10 + 3): " . ($a + $b) . "<br>";    // 13
echo "Subtraction (10 - 3): " . ($a - $b) . "<br>"; // 7
echo "Multiplication (10 * 3): " . ($a * $b) . "<br>"; // 30
echo "Division (10 / 3): " . ($a / $b) . "<br>";    // 3.333...
echo "Modulus (10 % 3): " . ($a % $b) . "<br>";     // 1 (remainder)
echo "Exponentiation (10 ** 3): " . ($a ** $b) . "<br>"; // 1000 (10 to the power of 3)

echo "<hr>";

echo "<h2>2. Assignment Operators</h2>";
$c = 5;
echo "Initial \$c: {$c}<br>";

$c += 5; // $c = $c + 5;
echo "Add and Assign (\$c += 5): {$c}<br>"; // 10

$c *= 2; // $c = $c * 2;
echo "Multiply and Assign (\$c *= 2): {$c}<br>"; // 20

$str = "Hello";
$str .= " World"; // $str = $str . " World";
echo "Concatenate and Assign: {$str}<br>"; // "Hello World"

echo "<hr>";

echo "<h2>3. Comparison Operators</h2>";
$x = 10;
$y = "10";
$z = 20;

echo "Equal (10 == '10'): " . ($x == $y ? 'True' : 'False') . "<br>"; // True (type juggling)
echo "Identical (10 === '10'): " . ($x === $y ? 'True' : 'False') . "<br>"; // False (different types)
echo "Not Equal (10 != 20): " . ($x != $z ? 'True' : 'False') . "<br>"; // True
echo "Greater Than (20 > 10): " . ($z > $x ? 'True' : 'False') . "<br>"; // True
echo "Spaceship (<=>) (10 <=> 20): " . ($x <=> $z) . "<br>"; // -1 (Left is smaller)

echo "<hr>";

echo "<h2>4. Increment/Decrement Operators</h2>";
$i = 5;

echo "Post-increment (\$i++): " . $i++ . "<br>"; // Prints 5, then increments $i to 6
echo "Value of \$i after post-increment: {$i}<br>"; // 6

$j = 5;
echo "Pre-increment (++\$j): " . ++$j . "<br>"; // Increments $j to 6, then prints 6
echo "Value of \$j after pre-increment: {$j}<br>"; // 6

echo "<hr>";

echo "<h2>5. Logical Operators</h2>";
$is_admin = true;
$is_editor = false;
$is_logged_in = true;

// AND (&&) - True if both are true
echo "AND (\$admin && \$logged): " . ($is_admin && $is_logged_in ? 'True' : 'False') . "<br>"; // True

// OR (||) - True if at least one is true
echo "OR (\$admin || \$editor): " . ($is_admin || $is_editor ? 'True' : 'False') . "<br>"; // True

// NOT (!) - Reverses the boolean result
echo "NOT (!\$editor): " . (!$is_editor ? 'True' : 'False') . "<br>"; // True

echo "<hr>";

echo "<h2>6. Null Coalescing Operator (??)</h2>";
// Returns its first operand if it exists and is not NULL; otherwise, returns its second operand.

$username_set = "Guest";
$username_unset = null; // Could also be an uninitialized variable

$display_name_1 = $username_set ?? "Anonymous";
$display_name_2 = $username_unset ?? "Anonymous";

echo "Username 1: {$display_name_1}<br>"; // Guest
echo "Username 2: {$display_name_2}<br>"; // Anonymous

echo "<hr>";

echo "<h2>7. Ternary Operator</h2>";
// Shortcut for an if/else block
$status = 404;
$message = ($status == 200) ? "Success" : "Error";
echo "Status message: {$message}<br>";
?>