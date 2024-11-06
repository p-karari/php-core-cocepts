<?php

// arrays.php

// Arrays are used to store multiple values in a single variable.
// PHP supports indexed, associative, and multidimensional arrays.

echo "<h2>1. Indexed Arrays (Numeric Keys)</h2>";

// 1. Defining an indexed array (keys start at 0 by default)
$fruits = ["Apple", "Banana", "Cherry"]; 
// Older syntax: $fruits = array("Apple", "Banana", "Cherry");

// Accessing elements by index
echo "First fruit: " . $fruits[0] . "<br>";
echo "Second fruit: " . $fruits[1] . "<br>";

// Adding a new element (appends to the end)
$fruits[] = "Date";
echo "New last fruit: " . $fruits[3] . "<br>";

echo "<hr>";

echo "<h2>2. Associative Arrays (Named Keys)</h2>";

// 2. Defining an associative array (key-value pairs)
$person = [
    "name" => "Alice",
    "age" => 30,
    "city" => "New York"
];

// Accessing elements by key
echo "Name: " . $person["name"] . "<br>";
echo "Age: " . $person["age"] . "<br>";

// Modifying an element
$person["age"] = 31;
echo "New Age: " . $person["age"] . "<br>";

// Adding a new key-value pair
$person["occupation"] = "Developer";
echo "Occupation: " . $person["occupation"] . "<br>";

echo "<hr>";

echo "<h2>3. Multidimensional Arrays</h2>";

// 3. Defining a multidimensional array (an array of arrays)
$students = [
    ["name" => "Bob", "grade" => "A"], // Index 0
    ["name" => "Charlie", "grade" => "B"], // Index 1
    ["name" => "Dana", "grade" => "A+"]  // Index 2
];

// Accessing elements: Array[RowIndex/Key][ColumnKey]
echo "Bob's Grade: " . $students[0]["grade"] . "<br>";
echo "Dana's Name: " . $students[2]["name"] . "<br>";

echo "<hr>";

echo "<h2>4. Utility Functions</h2>";

// 4. Utility Functions
echo "Total elements in \$fruits: " . count($fruits) . "<br>";

// Display the array structure for debugging
echo "<h3>Printing \$person array:</h3>";
echo "<pre>";
print_r($person);
echo "</pre>";

// Checking if a key exists
if (array_key_exists("city", $person)) {
    echo "The key 'city' exists in \$person.<br>";
}

// Checking if a value exists
if (in_array("Banana", $fruits)) {
    echo "'Banana' is in \$fruits.<br>";
}

?>