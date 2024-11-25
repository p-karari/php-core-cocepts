<?php

// static_members.php

// This script demonstrates **Static Members** (properties and methods) in PHP OOP.
// Static members belong to the class itself, not to any specific object instance. 
// They are accessed using the Scope Resolution Operator (::).

echo "<h1>PHP Static Members (::) Demo 🏛️</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition with Static Members
// ---------------------------------------------------------------------

/**
 * Class Logger
 * A utility class often implemented with static members for easy, application-wide access.
 */
class Logger {
    
    // 1a. Static Property: Holds a shared state across all parts of the application.
    // Must be prefixed with the `static` keyword.
    private static int $logCount = 0;
    
    // 1b. Non-Static (Instance) Property: Belongs to a specific object.
    private string $instanceId;

    public function __construct() {
        $this->instanceId = uniqid('log_');
    }
    
    // 1c. Static Method: Performs operations related to the class itself or static properties.
    // Must be prefixed with the `static` keyword.
    public static function log(string $message, string $level = 'INFO'): void {
        // Accessing static properties within a static method uses `self::$propertyName`.
        self::$logCount++; 
        $timestamp = date('H:i:s');
        
        $output = "[{$timestamp}] [{$level}] {$message} (Total Logs: " . self::$logCount . ")";
        
        // Log to file (simulated)
        // file_put_contents('app.log', $output . PHP_EOL, FILE_APPEND);
        
        echo "<p style='color: blue;'>➡️ **STATIC LOG:** {$output}</p>";
    }

    // 1d. Non-Static (Instance) Method: Cannot directly access non-static properties 
    // without an instance, but *can* call static methods.
    public function logInstanceActivity(string $activity): void {
        $message = "Instance {$this->instanceId} reports activity: {$activity}";
        // Calling a static method from an instance method is fine.
        self::log($message, 'DEBUG');
    }
    
    // 1e. Static Getter
    public static function getLogCount(): int {
        return self::$logCount;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Accessing Static Members (Class Level)
// ---------------------------------------------------------------------

echo "<h2>2. Accessing Static Members (Class::Method)</h2>";

// Static members are called directly on the class name using the `::` operator.
// No object instance is required to call these.

Logger::log("Application starting up.");
Logger::log("Configuration loaded successfully.", "INFO");

$current_count = Logger::getLogCount();
echo "<li>Current Log Count (via static getter): <strong>{$current_count}</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Mixing Static and Instance Usage
// ---------------------------------------------------------------------

echo "<h2>3. Mixing Instance and Static Calls</h2>";

// 3a. Create two instances
$loggerA = new Logger();
$loggerB = new Logger();

// 3b. Use instance methods, which internally call the static log() method
$loggerA->logInstanceActivity("Data fetch completed."); // Increments logCount
$loggerB->logInstanceActivity("User validation initiated."); // Increments logCount

// 3c. Check the shared static property again
$final_count = Logger::getLogCount();
echo "<li>Final Log Count: <strong>{$final_count}</strong></li>";
echo "<p><em>The count reflects logs from both static calls and instance calls, as it's a **shared** static property.</em></p>";

// 3d. Trying to access non-static from static (FORBIDDEN)
// Note: You cannot access instance properties ($this->instanceId) from a static method 
// (Logger::log) because static methods run without a specific object context.

?>