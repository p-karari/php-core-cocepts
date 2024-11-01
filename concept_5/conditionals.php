<?php

// conditionals.php

// Conditionals allow you to execute different blocks of code based on whether 
// a specified condition is true or false.

echo "<h2>1. If Statement</h2>";
$age = 18;

if ($age >= 18) {
    echo "You are an adult.<br>";
}

echo "<hr>";

echo "<h2>2. If-Else Statement</h2>";
$score = 75;

if ($score >= 90) {
    echo "Grade: A<br>";
} else {
    echo "Grade is below A.<br>";
}

echo "<hr>";

echo "<h2>3. If-Elseif-Else Statement</h2>";
$time = date("H"); // Current hour (0 to 23)
$greeting = "";

if ($time < 12) {
    $greeting = "Good morning";
} elseif ($time < 18) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good evening";
}
echo "Current time is {$time}h. Greeting: {$greeting}.<br>";

echo "<hr>";

echo "<h2>4. Ternary Operator (Shorthand If-Else)</h2>";
$is_logged_in = true;

// Syntax: (condition) ? value_if_true : value_if_false
$status_message = $is_logged_in ? "Welcome back!" : "Please log in.";
echo "Status: {$status_message}<br>";

echo "<hr>";

echo "<h2>5. Switch Statement</h2>";
$day_of_week = date("N"); // 1 (Mon) through 7 (Sun)
$day_name = "";

switch ($day_of_week) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        $day_name = "Weekday";
        break;
    case 6:
    case 7:
        $day_name = "Weekend";
        break;
    default:
        $day_name = "Unknown day";
        // No break needed here as it's the last case
}
echo "Day number: {$day_of_week}. Type: {$day_name}.<br>";

echo "<hr>";

echo "<h2>6. Alternative Syntax (for Templates)</h2>";
// Note the colon (:) instead of opening brace ({) and endif; instead of closing brace (})
$user_role = 'admin';
?>

<?php if ($user_role === 'admin'): ?>
    <p style="color: red;"><strong>Admin Panel Access Granted.</strong></p>
<?php elseif ($user_role === 'editor'): ?>
    <p style="color: blue;">Editor Panel Access Granted.</p>
<?php else: ?>
    <p>Standard User Access.</p>
<?php endif; ?>

<?php
// PHP code resumes
?>