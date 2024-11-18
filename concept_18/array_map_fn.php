<?php

// array_map_fn.php

// This script demonstrates the use of the array_map() function in combination 
// with the concise **Arrow Function (fn)** syntax (PHP 7.4+).

echo "<h1>PHP array_map() with Arrow Function (fn) 🏹</h1>";
echo "<p>Arrow functions provide a clean, one-line way to transform elements using array_map(), automatically inheriting external variables by value.</p>";

// ---------------------------------------------------------------------
// 1. Setup Data
// ---------------------------------------------------------------------

$items = [
    ['name' => 'Book', 'price' => 20],
    ['name' => 'Pen', 'price' => 5],
    ['name' => 'Notebook', 'price' => 15],
];

$discounts = [100, 200, 300, 400];

echo "<h2>Original Data:</h2>";
echo "<h3>Items:</h3><pre>"; print_r($items); echo "</pre>";
echo "<h3>Discounts:</h3><p>" . implode(", ", $discounts) . "</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Transformation with Arrow Function
// ---------------------------------------------------------------------

echo "<h2>2. Simple Transformation: Applying a Fixed Discount</h2>";

$global_discount_percentage = 0.10; // 10%

// Use array_map with an arrow function to calculate the price after a 10% discount.
// The $global_discount_percentage variable is automatically captured by value.
$discounted_items = array_map(fn($item) => [
    'name' => $item['name'],
    // Calculate new price: original price * (1 - 0.10)
    'final_price' => round($item['price'] * (1 - $global_discount_percentage), 2)
], $items);

echo "<h3>Items After 10% Discount:</h3><pre>";
print_r($discounted_items);
echo "</pre>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Transformation with Multiple Arguments
// ---------------------------------------------------------------------

echo "<h2>3. Multiple Argument Transformation (Adding to Array)</h2>";

$tax_rate = 0.05; // 5%

// array_map can take multiple arrays. The callback receives one element from each array.
// The arrow function calculates the final price + tax.
$final_prices_with_tax = array_map(
    fn($price, $discount) => round(($price - 10) * (1 + $tax_rate), 2), // Example: Apply $10 coupon then tax
    $discounts, // Array 1
    $discounts  // Array 2 (used just to show multi-arg capability, though not used in the fn)
);

echo "<h3>Discounts (Price - \$10 + 5% Tax):</h3>";
echo "<p>" . implode(" | ", $final_prices_with_tax) . "</p>";
// 100 -> (100-10)*1.05 = 94.50
// 200 -> (200-10)*1.05 = 199.50
// etc.
?>