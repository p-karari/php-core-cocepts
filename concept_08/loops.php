<?php

// loops.php

// Loops are used to execute a block of code repeatedly as long as a condition is true.
$target_count = 5;
$items_list = ["Laptop", "Keyboard", "Mouse", "Monitor"];
$user_data = ["name" => "Sarah", "age" => 28, "city" => "London"];

echo "<h2>1. The while Loop</h2>";
// Executes a block of code as long as the condition is TRUE.
$i = 1;
while ($i <= $target_count) {
    echo "While iteration: {$i}<br>";
    $i++; // Important: increment the counter to avoid an infinite loop
}

echo "<hr>";

echo "<h2>2. The do...while Loop</h2>";
// Executes the block of code once, then checks the condition.
$j = 6;
do {
    echo "Do...while iteration: {$j}<br>";
    $j++;
} while ($j <= $target_count);
// Note: This executes once even though $j is initially > $target_count.

echo "<hr>";

echo "<h2>3. The for Loop</h2>";
// Executes a block of code a specified number of times.
// Syntax: for (initialization; condition; increment)
echo "For loop counting:<br>";
for ($k = 0; $k < $target_count; $k++) {
    echo "Index: {$k}<br>";
}

echo "<hr>";

echo "<h2>4. The foreach Loop (for Arrays)</h2>";
// Used specifically to iterate over elements in an array or object.

echo "<h3>Indexed Array Iteration:</h3>";
echo "<ul>";
foreach ($items_list as $item) {
    echo "<li>Item: {$item}</li>";
}
echo "</ul>";

echo "<h3>Associative Array Iteration (Key and Value):</h3>";
echo "Profile Details: ";
foreach ($user_data as $key => $value) {
    echo "{$key} => {$value}, ";
}
echo "<br>";

echo "<hr>";

echo "<h2>5. Loop Control Statements (break and continue)</h2>";
echo "<h3>Using continue (skip even numbers):</h3>";
for ($n = 1; $n <= 10; $n++) {
    if ($n % 2 == 0) {
        continue; // Skip the rest of the loop block for even numbers
    }
    echo "Odd number: {$n}<br>";
}

echo "<h3>Using break (stop at 5):</h3>";
for ($m = 1; $m <= 10; $m++) {
    if ($m > 5) {
        break; // Exit the loop entirely
    }
    echo "Number before break: {$m}<br>";
}
?>