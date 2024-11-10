<?php

// switch-statements.php

// The 'switch' statement is used to perform different actions based on different 
// conditions of a single expression. It is an alternative to long if-elseif-else chains.

echo "<h2>1. Basic Switch Statement (Checking a Variable)</h2>";

$favorite_color = "blue";
$message = "";

switch ($favorite_color) {
    case "red":
        $message = "Red is a color of passion and energy.";
        break; // Stop execution here and exit the switch block
    case "blue":
        $message = "Blue is a color of calmness and loyalty.";
        break;
    case "green":
        $message = "Green is associated with nature and growth.";
        break;
    default:
        $message = "Your favorite color is {$favorite_color}. That's an interesting choice!";
        // No break needed here as it's the last block
}

echo "Your color choice: <strong>{$message}</strong><br>";

echo "<hr>";

echo "<h2>2. Switch Statement with Fall-Through (Combining Cases)</h2>";

$day_of_week = date("N"); // 1 (Mon) through 7 (Sun)
$type_of_day = "";

switch ($day_of_week) {
    // Cases 1 through 5 will "fall through" to the next executable block.
    case 1: // Monday
    case 2: // Tuesday
    case 3: // Wednesday
    case 4: // Thursday
    case 5: // Friday
        $type_of_day = "Weekday: Business as usual.";
        break; // Execution stops here for cases 1 through 5
    case 6: // Saturday
    case 7: // Sunday
        $type_of_day = "Weekend: Time to relax!";
        break;
    default:
        $type_of_day = "Invalid day number.";
}

echo "Today is day number {$day_of_week}. It is a <strong>{$type_of_day}</strong><br>";

echo "<hr>";

echo "<h2>3. Switch with Expressions in Case</h2>";

// Since PHP 8.0, the 'match' expression is generally preferred for this, 
// but it is still possible in switch statements.
$age = 17;
$access = "";

switch (true) { // The expression to switch on is the boolean value TRUE
    case ($age >= 18): // Case 1: Check if the expression $age >= 18 is TRUE
        $access = "Full access granted.";
        break;
    case ($age >= 16): // Case 2: Check if the expression $age >= 16 is TRUE
        $access = "Limited access (must be accompanied by an adult).";
        break;
    default:
        $access = "Access denied.";
}

echo "Age: {$age}. Access Status: <strong>{$access}</strong><br>";

echo "<hr>";

echo "<h2>4. Missing 'break' Example (Illustrating Fall-Through)</h2>";

$ranking = 2;
$prize = "You won: ";

switch ($ranking) {
    case 1:
        $prize .= "A Gold Medal, ";
        // NO BREAK HERE! Fall-through occurs.
    case 2:
        $prize .= "A T-Shirt, ";
        // NO BREAK HERE! Fall-through occurs.
    case 3:
        $prize .= "A High-Five.";
        break;
    default:
        $prize = "No prize awarded.";
}

echo "Ranking: {$ranking}. Prize: <strong>{$prize}</strong><br>";
// Output for rank 2 will be: You won: A T-Shirt, A High-Five.

?>