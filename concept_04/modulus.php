<?php

// modulus.php

// The modulus operator (%) returns the remainder of a division.

echo "<h2>1. Basic Modulus Operation</h2>";
$dividend = 17;
$divisor = 5;

// $remainder = 17 % 5;
// 17 divided by 5 is 3 with a remainder of 2.
$remainder = $dividend % $divisor;

echo "{$dividend} % {$divisor} = <strong>{$remainder}</strong><br>"; // Output: 2

echo "<hr>";

echo "<h2>2. Checking for Even or Odd Numbers</h2>";

$number_1 = 14;
$number_2 = 9;

// If a number % 2 is 0, it's even.
$is_even_1 = ($number_1 % 2 == 0);
$is_even_2 = ($number_2 % 2 == 0);

echo "Is {$number_1} even? " . ($is_even_1 ? 'Yes' : 'No') . "<br>"; // Output: Yes
echo "Is {$number_2} even? " . ($is_even_2 ? 'Yes' : 'No') . "<br>"; // Output: No

echo "<hr>";

echo "<h2>3. Cycling Values (Circular Array Indexing)</h2>";

$total_items = 7;
$max_index = 3; // We want indices 0, 1, 2, 3

echo "Cycling through 0, 1, 2, 3 for 7 items:<br>";

for ($i = 0; $i < $total_items; $i++) {
    // The result will always be between 0 and 3
    $cycle_index = $i % ($max_index + 1); 
    echo "Iteration {$i} -> Index: {$cycle_index}<br>";
}

echo "<hr>";

echo "<h2>4. Modulus with Negative Numbers</h2>";

$neg_dividend = -10;
$pos_divisor = 3;
$pos_dividend = 10;
$neg_divisor = -3;

// The result takes the sign of the DIVIDEND in PHP.
$rem_1 = $neg_dividend % $pos_divisor; // -10 / 3 = -3.33... (remainder is -1)
$rem_2 = $pos_dividend % $neg_divisor; // 10 / -3 = -3.33... (remainder is 1)
$rem_3 = $neg_dividend % $neg_divisor; // -10 / -3 = 3.33... (remainder is -1)

echo "(-10) % 3 = <strong>{$rem_1}</strong><br>"; // Output: -1
echo "10 % (-3) = <strong>{$rem_2}</strong><br>"; // Output: 1
echo "(-10) % (-3) = <strong>{$rem_3}</strong><br>"; // Output: -1

?>