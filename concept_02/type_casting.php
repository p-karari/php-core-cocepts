<?php

// typecasting.php

// 1. Initial Variables with different types
$str_number = "100";  // String
$float_val = 15.75;   // Float
$int_val = 50;        // Integer
$bool_val = true;     // Boolean
$array_val = ["a", "b"]; // Array

echo "<h2>Original Values and Types</h2>";
var_dump($str_number, $float_val, $int_val, $bool_val, $array_val);
echo "<hr>";

// --- A. Explicit Type Casting ---

echo "<h2>1. Cast to (int) or (integer)</h2>";
$cast_int_1 = (int) $str_number;  // "100" -> 100
$cast_int_2 = (int) $float_val;   // 15.75 -> 15 (truncates decimal part)
$cast_int_3 = (int) $bool_val;    // true -> 1
$cast_int_4 = (int) "abc";        // Non-numeric string -> 0

var_dump($cast_int_1, $cast_int_2, $cast_int_3, $cast_int_4);
echo "<hr>";

echo "<h2>2. Cast to (float) or (double)</h2>";
$cast_float_1 = (float) $str_number;  // "100" -> 100.0
$cast_float_2 = (float) $int_val;     // 50 -> 50.0
$cast_float_3 = (float) false;    // false -> 0.0

var_dump($cast_float_1, $cast_float_2, $cast_float_3);
echo "<hr>";

echo "<h2>3. Cast to (string)</h2>";
$cast_str_1 = (string) $int_val;     // 50 -> "50"
$cast_str_2 = (string) $bool_val;    // true -> "1"
$cast_str_3 = (string) $array_val;   // Array -> "Array" (not very useful)

var_dump($cast_str_1, $cast_str_2, $cast_str_3);
echo "<hr>";

echo "<h2>4. Cast to (bool) or (boolean)</h2>";
$cast_bool_1 = (bool) 1;        // Non-zero integer -> true
$cast_bool_2 = (bool) 0;        // Zero integer -> false
$cast_bool_3 = (bool) "hello";  // Non-empty string -> true
$cast_bool_4 = (bool) "";       // Empty string -> false
$cast_bool_5 = (bool) [];       // Empty array -> false

var_dump($cast_bool_1, $cast_bool_2, $cast_bool_3, $cast_bool_4, $cast_bool_5);
echo "<hr>";

// --- B. Implicit Type Juggling (Automatic Conversion) ---

echo "<h2>Implicit Type Juggling (Context-Dependent)</h2>";
$sum = $str_number + $int_val; // String "100" is automatically converted to int 100
echo "String + Int: {$sum} (Type: " . gettype($sum) . ")<br>";

$concat = $int_val . $float_val; // Both converted to string for concatenation
echo "Int . Float: {$concat} (Type: " . gettype($concat) . ")<br>";

// Strict comparison (===) prevents implicit type juggling
echo "<br><h3>Comparison Examples:</h3>";
if ($str_number == $int_val) {
    echo "Double equals (==) is TRUE: {$str_number} == {$int_val} (Implicit type juggling)<br>";
} else {
    echo "Double equals (==) is FALSE.<br>";
}

if ($str_number === $int_val) {
    echo "Triple equals (===) is TRUE.<br>";
} else {
    echo "Triple equals (===) is FALSE: Types are different.<br>";
}

?>