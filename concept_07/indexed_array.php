<?php

// indexed-array.php

// Indexed arrays are arrays whose elements are accessed via numeric keys, 
// starting from 0 by default.

echo "<h2>1. Defining and Accessing Indexed Arrays</h2>";

// 1. Array declaration using the short syntax (PHP 5.4+)
$colors = ["Red", "Green", "Blue", "Yellow"];

// Accessing elements
echo "The first color is: " . $colors[0] . "<br>"; // Red
echo "The last color is: " . $colors[3] . "<br>"; // Yellow

echo "<hr>";

echo "<h2>2. Modifying and Adding Elements</h2>";

// 2. Modifying an existing element
$colors[1] = "Emerald Green";
echo "Modified second color: " . $colors[1] . "<br>";

// 3. Adding an element using empty brackets (appends to the end with the next integer key)
$colors[] = "Purple";
echo "New last color (index " . (count($colors) - 1) . "): " . $colors[4] . "<br>";

// 4. Explicitly assigning an index (can skip numbers)
$inventory = [];
$inventory[0] = "Laptop";
$inventory[5] = "Monitor"; // Index 1 to 4 are skipped but still available
$inventory[] = "Keyboard"; // This automatically gets index 6 (next available)

echo "Inventory at index 5: " . $inventory[5] . "<br>";
echo "Inventory at index 6: " . $inventory[6] . "<br>";

echo "<hr>";

echo "<h2>3. Looping through an Indexed Array</h2>";

echo "<h3>Using foreach (Preferred for most cases)</h3>";
echo "<ul>";
foreach ($colors as $color) {
    echo "<li>Color: {$color}</li>";
}
echo "</ul>";

echo "<h3>Using for loop (When index is explicitly needed)</h3>";
echo "<ol>";
for ($i = 0; $i < count($inventory); $i++) {
    // Need to check if the index exists because we skipped 1-4
    if (isset($inventory[$i])) {
        echo "<li>Index {$i}: {$inventory[$i]}</li>";
    }
}
echo "</ol>";
?>