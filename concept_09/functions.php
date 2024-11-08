<?php

// functions.php

// Functions are blocks of code designed to perform a particular task.
// They help in organizing code, increasing reusability, and reducing repetition.

echo "<h2>1. Basic Function Definition and Call</h2>";

// 1. Defining a function with no parameters and no return value
function welcome_message() {
    echo "Hello! Welcome to the PHP function demo.<br>";
}

// Calling the function
welcome_message();

echo "<hr>";

echo "<h2>2. Function with Parameters</h2>";

// 2. Defining a function that accepts arguments (parameters)
function greet_user(string $name, string $time_of_day = "morning") {
    // $time_of_day has a default value, making the second parameter optional
    echo "Good {$time_of_day}, {$name}!<br>";
}

// Calling the function with and without the optional parameter
greet_user("Alice");
greet_user("Bob", "evening");

echo "<hr>";

echo "<h2>3. Function with a Return Value</h2>";

// 3. Defining a function that returns a value (and specifies the return type: int)
function calculate_area(int $width, int $height): int {
    $area = $width * $height;
    return $area;
}

// Calling the function and storing the result
$w = 5;
$h = 10;
$result = calculate_area($w, $h);

echo "Area of a {$w}x{$h} rectangle is: <strong>{$result}</strong><br>";

echo "<hr>";

echo "<h2>4. Passing Arguments by Reference</h2>";

// 4. Using the ampersand (&) to allow a function to modify the actual variable
function add_bonus(int &$score) {
    $score += 50; // Directly modifies the $score variable passed in
}

$player_score = 100;
add_bonus($player_score);

echo "Player Score after bonus: <strong>{$player_score}</strong><br>"; // Output: 150

echo "<hr>";

echo "<h2>5. Variable Function (Calling a function by its string name)</h2>";

// 5. Using a variable to hold the name of a function to call it dynamically
$function_name = 'greet_user';

// The variable must contain a string that matches the function name
if (is_callable($function_name)) {
    $function_name("Charlie", "afternoon"); // Calls greet_user()
}
?>