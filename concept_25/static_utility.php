<?php

// static_utility.php

// This script demonstrates creating a **Utility Class** in PHP using 
// **static methods and properties**. Utility classes group related functions 
// that perform tasks without needing an object instance, making them easy to 
// call throughout an application.

echo "<h1>PHP Static Utility Class Demo 🛠️</h1>";

// ---------------------------------------------------------------------
// 1. Defining a Static Utility Class
// ---------------------------------------------------------------------

/**
 * Class MathHelper
 * Provides mathematical utility functions. All members are static, so no 
 * instance of MathHelper needs to be created.
 */
class MathHelper {
    
    // Static property: Shared constant value
    public static float $PI = 3.14159; 

    /**
     * Static Method: Calculates the circumference of a circle.
     * @param float $radius
     * @return float
     */
    public static function calculateCircumference(float $radius): float {
        // Accessing the static property using self::
        return 2 * self::$PI * $radius;
    }

    /**
     * Static Method: Converts degrees to radians.
     * @param float $degrees
     * @return float
     */
    public static function degreesToRadians(float $degrees): float {
        return $degrees * (self::$PI / 180);
    }
    
    /**
     * Static Method: Calculates the average of an array of numbers.
     * @param array $numbers
     * @return float
     */
    public static function average(array $numbers): float {
        if (empty($numbers)) {
            return 0.0;
        }
        return array_sum($numbers) / count($numbers);
    }
}

// ---------------------------------------------------------------------
// 2. Using the Static Utility Class
// ---------------------------------------------------------------------

echo "<h2>2. Calling Utility Methods (Class::Method)</h2>";

$radius = 10.0;
$degrees = 90.0;
$scores = [85, 92, 78, 95];

// 2a. Calling static methods directly on the class
$circumference = MathHelper::calculateCircumference($radius);
echo "<li>Circumference of a circle with radius {$radius}: <strong>" . number_format($circumference, 2) . "</strong></li>";

$radians = MathHelper::degreesToRadians($degrees);
echo "<li>{$degrees} degrees in radians: <strong>" . number_format($radians, 4) . "</strong></li>";

$avg_score = MathHelper::average($scores);
echo "<li>Average of scores " . implode(", ", $scores) . ": <strong>{$avg_score}</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Accessing Static Properties
// ---------------------------------------------------------------------

echo "<h2>3. Accessing Static Properties (Class::Property)</h2>";

// Access the static property directly
echo "<li>The static value of PI is: <strong>" . MathHelper::$PI . "</strong></li>";

// Change the static property (affects all subsequent calls)
MathHelper::$PI = 3.14;
echo "<li>PI changed to: <strong>" . MathHelper::$PI . "</strong></li>";

$new_circumference = MathHelper::calculateCircumference($radius);
echo "<li>New Circumference with simplified PI: <strong>" . number_format($new_circumference, 2) . "</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Instantiation is Unnecessary
// ---------------------------------------------------------------------

echo "<h2>4. Instantiation Check</h2>";

// You can create an instance, but it is unnecessary and misses the point 
// of a utility class (unless the constructor is private).
// The class method must still be called statically.
// $helper = new MathHelper(); 
// echo $helper->calculateCircumference(5); // This still works but is discouraged.

echo "<p><em>Note: No instance (object) of <code>MathHelper</code> was created 
to perform these calculations. Utility methods are called directly via the class name.</em></p>";

?>