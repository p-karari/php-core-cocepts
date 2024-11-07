<?php

// for_loop.php

// The 'for' loop is used when you know exactly how many times you want to execute 
// a block of code.

echo "<h2>1. Basic Count Up Loop</h2>";

$limit = 5;

// Syntax: for (initialization; condition; increment)
for ($i = 1; $i <= $limit; $i++) {
    echo "Count is: {$i}<br>";
}

echo "<hr>";

echo "<h2>2. Count Down Loop with Decrement</h2>";

$start = 10;

for ($j = $start; $j >= 0; $j--) {
    echo "Countdown: {$j}<br>";
}

echo "<hr>";

echo "<h2>3. Loop with Step Increment (Skip 2)</h2>";

$max = 20;

for ($k = 0; $k <= $max; $k += 3) {
    echo "Current value (step 3): {$k}<br>";
}

echo "<hr>";

echo "<h2>4. Using 'for' to Process an Indexed Array</h2>";

$products = ["Milk", "Bread", "Eggs", "Cheese"];
$num_products = count($products);

// We iterate using the index to access the array elements.
for ($p = 0; $p < $num_products; $p++) {
    echo "Product index {$p}: {$products[$p]}<br>";
}

echo "<hr>";

echo "<h2>5. Multiple Variables in 'for' Loop</h2>";

// You can initialize and modify multiple variables, separated by commas.
for ($x = 0, $y = 10; $x <= $y; $x++, $y--) {
    // Loop runs as long as $x <= $y (5 times)
    echo "x: {$x}, y: {$y}, Sum: " . ($x + $y) . "<br>";
}

?>