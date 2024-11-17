<?php

// array_callback.php

// This script demonstrates the use of Anonymous Functions (Closures) as 
// callbacks for built-in PHP array functions. This is a powerful technique 
// for customizing array manipulation logic.

echo "<h1>PHP Array Callback Functions Demo ⚙️</h1>";

$products = [
    ['name' => 'Laptop', 'price' => 1200, 'in_stock' => true],
    ['name' => 'Monitor', 'price' => 350, 'in_stock' => true],
    ['name' => 'Keyboard', 'price' => 75, 'in_stock' => false],
    ['name' => 'Mouse', 'price' => 25, 'in_stock' => true],
];

$prices = [100, 50, 250, 75];

echo "<h2>Original Data:</h2>";
echo "<h3>Products:</h3><pre>"; print_r($products); echo "</pre>";
echo "<h3>Prices:</h3><p>" . implode(", ", $prices) . "</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 1. array_filter(): Filtering Elements
// ---------------------------------------------------------------------

echo "<h2>1. array_filter() (Selecting Elements)</h2>";
echo "<p>Filters elements of an array using a callback function. The callback must return <code>true</code> to keep the element.</p>";

$in_stock_products = array_filter($products, function($product) {
    // Return true if the 'in_stock' key is true
    return $product['in_stock'];
});

echo "<h3>In-Stock Products:</h3><pre>";
print_r($in_stock_products);
echo "</pre>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. array_map(): Modifying Elements
// ---------------------------------------------------------------------

echo "<h2>2. array_map() (Transforming Elements)</h2>";
echo "<p>Applies the callback function to every element of the array and returns a new array with the transformed elements.</p>";

$tax_rate = 0.10;

// Use the 'use' keyword to bring the external $tax_rate into the closure's scope
$prices_with_tax = array_map(function($price) use ($tax_rate) {
    // Add 10% tax
    return round($price * (1 + $tax_rate), 2);
}, $prices);

echo "<h3>Prices with 10% Tax:</h3><p>" . implode(", ", $prices_with_tax) . "</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. array_reduce(): Aggregating Values
// ---------------------------------------------------------------------

echo "<h2>3. array_reduce() (Aggregating to a Single Value)</h2>";
echo "<p>Iteratively reduces the array to a single value using a callback, optionally starting with an initial value (accumulator).</p>";

// Calculate the total price of all products
$total_price = array_reduce($products, function($carry, $product) {
    // $carry is the accumulator (starts at 0.00)
    return $carry + $product['price'];
}, 0.00); // The 0.00 is the initial value

echo "Total Price of All Products: <strong>\${$total_price}</strong>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. usort(): Custom Sorting
// ---------------------------------------------------------------------

echo "<h2>4. usort() (Custom Sorting)</h2>";
echo "<p>Sorts an array by values using a user-defined comparison function.</p>";

$products_to_sort = $products; // Work on a copy
usort($products_to_sort, function($a, $b) {
    // Compare based on price (ascending order)
    if ($a['price'] == $b['price']) {
        return 0; // Prices are equal
    }
    return ($a['price'] < $b['price']) ? -1 : 1; // Return -1 for less, 1 for greater
});

echo "<h3>Products Sorted by Price (Ascending):</h3><pre>";
print_r($products_to_sort);
echo "</pre>";

?>