<?php

// if-else-else.php

// The if-elseif-else structure is used for multi-way decision making. 
// Only one block of code (the first condition that evaluates to true) will be executed.

echo "<h2>Movie Rating Example</h2>";

$age = 17;
$movie_title = "Action Movie";

// 1. Check the first condition ($age >= 18)
if ($age >= 18) {
    echo "<p>You are {$age} years old. You can watch the movie '{$movie_title}' (Rated R).</p>";
    $ticket_price = 15.00;
} 
// 2. If the first is false, check the second condition ($age >= 13)
elseif ($age >= 13) {
    echo "<p>You are {$age} years old. You can watch the movie '{$movie_title}' with a parent or guardian (Rated PG-13).</p>";
    $ticket_price = 10.00;
} 
// 3. If all preceding conditions are false, execute the 'else' block
else {
    echo "<p>You are {$age} years old. You are restricted from watching '{$movie_title}' (Rated G/PG recommended).</p>";
    $ticket_price = 0.00;
}

echo "<hr>";

echo "<h2>Day of Week Example (Using Logical Operators)</h2>";

$day = "Wed";

if ($day === "Sat" || $day === "Sun") {
    $status = "It's the weekend! Time to rest.";
} elseif ($day === "Mon") {
    $status = "It's Monday. Time to start the week.";
} else {
    // This covers Tue, Wed, Thu, Fri
    $status = "It's a regular workday.";
}

echo "Today is {$day}. Status: <strong>{$status}</strong><br>";

echo "<hr>";

echo "<h2>Alternative Syntax Example (for Templating)</h2>";
$level = 8; // User's access level

?>

<h3>System Access Check</h3>

<?php if ($level > 10): ?>
    <p style="color: green;"><strong>Level <?= $level ?>: Full Administrative Access.</strong></p>
<?php elseif ($level > 5): ?>
    <p style="color: blue;">Level <?= $level ?>: Editor Privileges.</p>
<?php else: ?>
    <p style="color: red;">Level <?= $level ?>: Restricted View Only.</p>
<?php endif; ?>

<?php
// PHP code resumes here
?>