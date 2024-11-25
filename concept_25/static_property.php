<?php

// static_property.php

// This script demonstrates the use of **Static Properties** in PHP OOP.
// Static properties hold data that is shared across all instances of a class 
// and belong to the class itself, not to any specific object.

echo "<h1>PHP Static Property Demonstration 🧱</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition with a Static Property
// ---------------------------------------------------------------------

/**
 * Class Request
 * Tracks the total number of requests processed by all instances of this class.
 */
class Request {
    
    // 1a. Static Property: Shared across all objects and accessed via the class name.
    // It must be declared using the `static` keyword.
    // Use `protected` here to allow access in the class and subclasses, but not outside.
    protected static int $requestCounter = 0; 
    
    // 1b. Instance Property: Unique to each object.
    private string $instanceId;

    public function __construct() {
        $this->instanceId = uniqid('req_');
        
        // 1c. Increment the shared static property every time a new object is created.
        // Access static property using `self::$propertyName`.
        self::$requestCounter++; 
        
        echo "<p style='color: green;'>✅ Request **{$this->instanceId}** initialized.</p>";
    }
    
    /**
     * Public method to process the request and log the shared counter.
     */
    public function process(): void {
        echo "<li>Instance **{$this->instanceId}** processing...</li>";
        // Accessing the static property again within an instance method
        echo "<li>Current Global Request Count: **" . self::$requestCounter . "**</li>";
    }

    /**
     * Public static method (Getter) to access the protected static property from outside.
     * @return int The total number of requests.
     */
    public static function getTotalRequests(): int {
        // Accessing static property using `self::$propertyName`.
        return self::$requestCounter;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Accessing and Manipulating the Static Property
// ---------------------------------------------------------------------

echo "<h2>2. Object Instantiation and Shared State</h2>";

// 2a. Create the first object (Counter = 1)
$requestA = new Request();

// 2b. Create the second object (Counter = 2)
$requestB = new Request();

// 2c. Call process on the first object (It sees Counter = 2)
$requestA->process();

// 2d. Create the third object (Counter = 3)
$requestC = new Request();

// 2e. Call process on the second object (It sees Counter = 3)
$requestB->process();

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Accessing the Static Property Directly (Class Level)
// ---------------------------------------------------------------------

echo "<h2>3. Direct Static Access (Class::Property)</h2>";

// Accessing the static property directly using the static method (Getter).
// No object instance is required.
$final_count = Request::getTotalRequests();
echo "<li>Final Total Requests (via static method): <strong>{$final_count}</strong></li>";
echo "<p><em>The static property <code>\$requestCounter</code> holds a single value shared by **all** three objects.</em></p>";

// Note: Attempting to access the protected property directly from outside 
// would result in a Fatal Error:
// echo Request::$requestCounter; // Fails because it is protected

?>