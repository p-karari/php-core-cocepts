<?php

// variable_output.php

// 1. Define different types of variables
$integer_var = 42;
$float_var = 10.5;
$string_var = "PHP is fun";
$boolean_var = true;
$array_var = ["Apple", "Orange", "Grape"];
$null_var = null;

echo "<h2>Variable Output Examples</h2>";
echo "---<br>";

// 2. Simple output using echo (for scalars: int, float, string, bool)
echo "<h3>1. Using echo:</h3>";
echo "Integer: " . $integer_var . "<br>"; // Concatenation
echo "Float: {$float_var}<br>"; // Interpolation in double quotes
echo 'String: ' . $string_var . '<br>'; // Single quotes + concatenation

// Boolean 'true' outputs '1', 'false' outputs '' (nothing)
echo "Boolean (true): " . $boolean_var . "<br>";

// 3. Outputting structure and type information using var_dump()
echo "<h3>2. Using var_dump():</h3>";
// var_dump is essential for debugging as it shows type, size, and value
echo "<pre>"; // Use <pre> for readable output of var_dump/print_r
var_dump($integer_var);
var_dump($array_var);
var_dump($null_var);
echo "</pre>";

// 4. Outputting arrays and objects in a human-readable format using print_r()
echo "<h3>3. Using print_r():</h3>";
echo "<pre>";
print_r($array_var);
echo "</pre>";

// 5. Outputting with printf() for formatted string output (like C's printf)
echo "<h3>4. Using printf():</h3>";
$product = "Widget";
$price = 19.99;
$quantity = 5;

// %s for string, %d for integer, %.2f for float with 2 decimal places
printf("We sold %d units of the %s, totaling $%.2f.<br>", $quantity, $product, ($price * $quantity));

// 6. Using the short echo tag (<?=) - requires short_open_tag to be enabled in php.ini
// This is often used inside HTML templates
echo "<h3>5. Using Short Echo Tag:</h3>";
?>
<p>The current value of the integer variable is: <?= $integer_var ?></p>
<?php

// 7. Outputting text with the print function (works almost identically to echo)
print "<h3>6. Using print:</h3>";
print "Print works just like echo, but can only take one argument and returns 1.<br>";

?>