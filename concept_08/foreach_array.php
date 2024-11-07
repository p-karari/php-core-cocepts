<?php

// foreach_array.php

// The 'foreach' loop is the easiest and most common way to iterate over 
// elements in arrays (indexed or associative) and objects.

echo "<h2>1. Iterating Over an Indexed Array (Value Only)</h2>";

$fruits = ["Mango", "Grape", "Pineapple", "Kiwi"];

echo "List of Fruits:<br>";
// Syntax 1: foreach (array as value)
foreach ($fruits as $fruit) {
    echo "- {$fruit}<br>";
}

echo "<hr>";

echo "<h2>2. Iterating Over an Associative Array (Key and Value)</h2>";

$product = [
    "name" => "Wireless Mouse",
    "price" => 25.99,
    "color" => "Black",
    "stock" => 150
];

echo "Product Details:<br>";
// Syntax 2: foreach (array as key => value)
foreach ($product as $key => $value) {
    // Check if the value is numeric, and format it for cleaner output
    if (is_numeric($value)) {
        $output_value = is_float($value) ? "\${$value}" : $value;
    } else {
        $output_value = ucfirst($value);
    }
    
    echo "<strong>" . ucfirst($key) . ":</strong> {$output_value}<br>";
}

echo "<hr>";

echo "<h2>3. Iterating by Reference (Modifying the Array)</h2>";

$numbers = [1, 2, 3, 4, 5];

echo "Original numbers: " . implode(", ", $numbers) . "<br>";

// Use the ampersand (&) to modify the array elements directly
foreach ($numbers as &$num) {
    $num *= 2; // Multiply each element by 2
}
// Remove the reference to prevent unintended side effects later
unset($num); 

echo "Doubled numbers: " . implode(", ", $numbers) . "<br>"; // Output: 2, 4, 6, 8, 10

echo "<hr>";

echo "<h2>4. Nested Foreach for Multidimensional Arrays</h2>";

$users = [
    ["id" => 1, "username" => "Alice"],
    ["id" => 2, "username" => "Bob"],
];

echo "User Data:<br>";
foreach ($users as $index => $user) {
    echo "User #{$index}: ";
    // Inner loop to iterate over the key/value pairs of each user array
    foreach ($user as $key => $value) {
        echo "{$key}={$value} ";
    }
    echo "<br>";
}
?>