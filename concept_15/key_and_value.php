<?php

// key_and_value.php

// This script demonstrates the use of the key() and current() functions 
// to retrieve the key and value of the internal array pointer's current element.

echo "<h1>PHP Array Pointer: key() and current() 🔑💰</h1>";

$user_profile = [
    "id" => 401,
    "username" => "neo_dev",
    "status" => "active",
    "role" => "administrator"
];

echo "<h2>Original Associative Array:</h2>";
echo "<pre>";
print_r($user_profile);
echo "</pre>";

echo "<hr>";

echo "<h2>1. Initial State (Reset)</h2>";

// Reset the pointer to the beginning. The reset() function also returns the 
// value of the first element.
$initial_value = reset($user_profile);
$initial_key = key($user_profile);

echo "1. Value after reset(): <strong>{$initial_value}</strong><br>"; // 401
echo "2. Key after reset(): <strong>{$initial_key}</strong><br>"; // id

echo "<hr>";

echo "<h2>2. Iterating with next(), key(), and current()</h2>";

echo "<h3>Manually Iterating:</h3>";

// Loop through a few steps to demonstrate movement
for ($i = 1; $i <= 3; $i++) {
    // Advance the pointer to the next element
    $next_value = next($user_profile); 
    
    // Check if we reached the end
    if ($next_value === false) {
        echo "<p style='color: red;'>Stopped: Reached the end of the array.</p>";
        break;
    }
    
    $current_key = key($user_profile);
    $current_value = current($user_profile);

    echo "Iteration {$i}:<br>";
    echo "   Current Key: <strong>{$current_key}</strong><br>";
    echo "   Current Value: <strong>{$current_value}</strong><br>";
}
// After 3 iterations, the pointer should be at 'role' (index 3).

echo "<hr>";

echo "<h2>3. Using key() and current() at the End</h2>";

// Use end() to move the pointer to the last element
end($user_profile);
echo "3. After end(), Key is: <strong>" . key($user_profile) . "</strong><br>"; // role
echo "4. After end(), Value is: <strong>" . current($user_profile) . "</strong><br>"; // administrator

// Move the pointer past the end
next($user_profile);
$end_key = key($user_profile);
$end_value = current($user_profile);

// When the pointer is past the end, key() returns NULL and current() returns FALSE.
echo "5. After moving past end, key() returns: <strong>" . var_export($end_key, true) . "</strong><br>"; // NULL
echo "6. After moving past end, current() returns: <strong>" . var_export($end_value, true) . "</strong><br>"; // false

echo "<hr>";

echo "<h2>4. Comparison with foreach</h2>";

echo "<p>The <code>foreach</code> loop is the preferred method as it handles the pointer implicitly, ensuring both the key and value are accessible simultaneously without manual management:</p>";
echo "<ul>";
foreach ($user_profile as $k => $v) {
    echo "<li><strong>{$k}</strong> = {$v}</li>";
}
echo "</ul>";

?>