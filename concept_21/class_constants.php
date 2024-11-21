<?php

// class_constants.php

// This script demonstrates the use of Class Constants in PHP. 
// Class constants are fixed values associated with a class, not with a specific object instance.

echo "<h1>PHP Class Constants Demonstration 🧱</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition with Constants
// ---------------------------------------------------------------------

/**
 * Class Settings
 * Holds fixed configuration values for an application component.
 */
class Settings {
    
    // Define constants using the `const` keyword.
    // By convention, constant names are typically in all uppercase with underscores.
    // They are implicitly public and cannot be changed during runtime.
    const APP_NAME = "CMS_Project_X";
    const VERSION = "1.0.3";
    const MAX_USERS = 500;
    
    // Class constants can be used within class methods.
    public function getVersionInfo(): string {
        // Access constant using `self::CONSTANT_NAME`
        return self::APP_NAME . " is running version " . self::VERSION;
    }
}

/**
 * Class Status
 * Demonstrates visibility (since PHP 7.1) and accessing constants from outside.
 */
class Status {
    // Constants are implicitly `public` prior to PHP 7.1. 
    // Since PHP 7.1, you can explicitly define visibility (public, protected, private).
    public const CODE_SUCCESS = 200;
    protected const CODE_WARNING = 300;
    private const CODE_ERROR = 400;

    public function getInternalError(): int {
        // Accessing private constant from within the class
        return self::CODE_ERROR;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Accessing Public Constants Directly
// ---------------------------------------------------------------------

echo "<h2>2. Accessing Public Constants</h2>";

// Constants are accessed directly on the class name using the Scope Resolution Operator (::).
// This does NOT require an object instance.

echo "<li>Application Name: <strong>" . Settings::APP_NAME . "</strong></li>";
echo "<li>Application Version: <strong>" . Settings::VERSION . "</strong></li>";
echo "<li>Success Code: <strong>" . Status::CODE_SUCCESS . "</strong></li>";

// Attempting to change a constant will result in a fatal error:
// Settings::MAX_USERS = 600; // Fatal error: Cannot redefine class constant

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Accessing Constants within Methods (Using self::)
// ---------------------------------------------------------------------

echo "<h2>3. Constants within Class Methods</h2>";

// Create an instance to call the method.
$settings_instance = new Settings();

echo "<li>Version Information: <strong>" . $settings_instance->getVersionInfo() . "</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Visibility and Internal Access
// ---------------------------------------------------------------------

echo "<h2>4. Constant Visibility (PHP 7.1+)</h2>";

$status_instance = new Status();

// 4a. Accessing the public constant from outside
echo "<li>Public Success Code: <strong>" . Status::CODE_SUCCESS . "</strong></li>";

// 4b. Accessing the private constant via a public method
echo "<li>Private Error Code (via method): <strong>" . $status_instance->getInternalError() . "</strong></li>";

// 4c. Attempting to access protected/private constants directly from outside
echo "<li>Protected Warning Code: ";
// echo Status::CODE_WARNING; // This would cause a fatal error/notice
echo "<em>(Cannot be accessed directly from outside)</em></li>";

?>