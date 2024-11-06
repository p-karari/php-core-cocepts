<?php

// array-functions.php

// PHP provides a huge number of built-in functions for array manipulation and inspection.

$indexed_array = ["Apple", "Banana", "Cherry", "Date", "Apple"];
$associative_array = ["id" => 1, "name" => "Alex", "role" => "Admin"];
$numbers = [5, 2, 8, 1, 4];
$keys_to_flip = ["a", "b", "c"];

echo "<h2>1. Inspection and Counting</h2>";

// count(): Returns the number of elements in an array.
$count = count($indexed_array);
echo "Count of indexed_array: {$count}<br>"; // Output: 5

// is_array(): Checks if a variable is an array.
$is_an_array = is_array($indexed_array);
echo "Is \$indexed_array an array? " . ($is_an_array ? 'Yes' : 'No') . "<br>";

// in_array(): Checks if a value exists in an array.
$has_banana = in_array("Banana", $indexed_array);
echo "Does \$indexed_array contain 'Banana'? " . ($has_banana ? 'Yes' : 'No') . "<br>";

// array_key_exists(): Checks if a key/index exists in an array.
$has_id = array_key_exists("id", $associative_array);
echo "Does \$associative_array have key 'id'? " . ($has_id ? 'Yes' : 'No') . "<br>";

echo "<hr>";

echo "<h2>2. Adding and Removing Elements</h2>";

$stack = [10, 20];

// array_push(): Pushes one or more elements onto the end of an array (like a stack).
array_push($stack, 30, 40);
echo "After push: " . implode(", ", $stack) . "<br>"; // 10, 20, 30, 40

// array_pop(): Pops and returns the last element of the array.
$last_element = array_pop($stack);
echo "Popped element: {$last_element}<br>"; // 40
echo "After pop: " . implode(", ", $stack) . "<br>"; // 10, 20, 30

// array_unshift(): Adds one or more elements to the beginning of an array.
array_unshift($stack, 5);
echo "After unshift: " . implode(", ", $stack) . "<br>"; // 5, 10, 20, 30

// array_shift(): Shifts and returns the first element of the array.
$first_element = array_shift($stack);
echo "Shifted element: {$first_element}<br>"; // 5
echo "After shift: " . implode(", ", $stack) . "<br>"; // 10, 20, 30

echo "<hr>";

echo "<h2>3. Sorting and Reordering</h2>";

// sort(): Sorts an indexed array in ascending order (re-indexing keys).
$sort_numbers = $numbers; // Copy the array
sort($sort_numbers);
echo "Sorted numbers: " . implode(", ", $sort_numbers) . "<br>"; // 1, 2, 4, 5, 8

// asort(): Sorts an associative array by VALUE (maintains key association).
$sort_assoc = $associative_array; // Copy
asort($sort_assoc);
echo "Sorted associative (by value): ";
print_r($sort_assoc);
echo "<br>";

// ksort(): Sorts an associative array by KEY.
ksort($sort_assoc);
echo "Sorted associative (by key): ";
print_r($sort_assoc);
echo "<br>";

echo "<hr>";

echo "<h2>4. Key and Value Operations</h2>";

// array_keys(): Returns all the keys of an array.
$keys = array_keys($associative_array);
echo "Keys: " . implode(", ", $keys) . "<br>"; // id, name, role

// array_values(): Returns all the values of an array.
$values = array_values($associative_array);
echo "Values: " . implode(", ", $values) . "<br>"; // 1, Alex, Admin

// array_flip(): Exchanges all keys with their corresponding values.
$flipped_array = array_flip($keys_to_flip); // a => 0, b => 1, c => 2 (from indexed keys)
echo "Flipped array: ";
print_r($flipped_array);
echo "<br>";
?>