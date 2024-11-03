<?php

// assignment.php

// The assignment operator (=) is used to set the value of a variable.

echo "<h2>1. Basic Assignment (=)</h2>";

// Assigning a literal value
$product_name = "Widget X"; 
$product_price = 49.99;    
$is_available = true;     

echo "Product: {$product_name}<br>";
echo "Price: {$product_price}<br>";
echo "Available: " . ($is_available ? 'Yes' : 'No') . "<br>";

// Assigning the value of one variable to another
$backup_name = $product_name; 
echo "Backup Name: {$backup_name}<br>";

echo "<hr>";

echo "<h2>2. Combined Assignment Operators</h2>";

$count = 10;
$factor = 3;
$text = "Start";

// a) Addition and Assignment (+=)
$count += 5; // $count = $count + 5; (10 + 5 = 15)
echo "Count += 5: {$count}<br>"; 

// b) Subtraction and Assignment (-=)
$count -= 2; // $count = $count - 2; (15 - 2 = 13)
echo "Count -= 2: {$count}<br>"; 

// c) Multiplication and Assignment (*=)
$factor *= 4; // $factor = $factor * 4; (3 * 4 = 12)
echo "Factor *= 4: {$factor}<br>";

// d) Division and Assignment (/=)
$factor /= 3; // $factor = $factor / 3; (12 / 3 = 4)
echo "Factor /= 3: {$factor}<br>";

// e) Modulus and Assignment (%=)
$factor %= 3; // $factor = $factor % 3; (4 % 3 = 1)
echo "Factor %= 3: {$factor}<br>";

// f) Concatenation and Assignment (.=)
$text .= " End"; // $text = $text . " End";
echo "Text .= ' End': {$text}<br>";

echo "<hr>";

echo "<h2>3. Assignment by Reference (=&)</h2>";

$original_data = "Hello Reference";
// $ref_data is now an alias for $original_data
$ref_data = &$original_data; 

echo "Original Data before change: {$original_data}<br>";

// Changing $ref_data changes $original_data
$ref_data = "Value Changed Via Reference"; 

echo "Original Data after change: <strong>{$original_data}</strong><br>"; 
echo "Reference Data: <strong>{$ref_data}</strong><br>"; 

// Changing $original_data also changes $ref_data
$original_data = "New Original Value";

echo "Reference Data reflects new original: <strong>{$ref_data}</strong><br>";

?>