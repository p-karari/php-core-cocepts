<?php

// protected_access.php

// This script demonstrates the use of the **protected** access modifier 
// for class properties and methods in PHP OOP.
// Protected members are accessible within the defining class and by its subclasses, 
// but NOT by outside code (object instances).

echo "<h1>PHP Protected Visibility Demo 🛡️</h1>";

// ---------------------------------------------------------------------
// 1. Base (Parent) Class Definition
// ---------------------------------------------------------------------

/**
 * Class Vehicle
 * The base class defining shared, protected properties.
 */
class Vehicle {
    
    public string $type;
    
    // Protected property: Accessible in Vehicle and any class that extends Vehicle.
    protected string $engineType; 
    
    // Protected method: Can be called internally or by subclasses.
    protected function startEngine(): string {
        return "Engine ({$this->engineType}) is starting...";
    }
    
    public function __construct(string $type, string $engineType) {
        $this->type = $type;
        $this->engineType = $engineType;
        echo "<p style='color: green;'>✅ Vehicle '{$this->type}' created.</p>";
    }
    
    // Public method that uses the protected method internally
    public function ignition(): string {
        return "Vehicle ignition sequence initiated. " . $this->startEngine();
    }
}

// ---------------------------------------------------------------------
// 2. Subclass (Child) Definition
// ---------------------------------------------------------------------

/**
 * Class Car
 * Extends Vehicle and accesses its protected members.
 */
class Car extends Vehicle {
    
    public int $doors;
    
    public function __construct(string $engineType, int $doors) {
        // Call the parent constructor
        parent::__construct("Car", $engineType);
        $this->doors = $doors;
    }
    
    /**
     * Method in the subclass that directly accesses the protected property 
     * and calls the protected method defined in the parent class.
     */
    public function drive(): string {
        // Accessing protected property ($engineType) - ALLOWED
        $engine_info = "The {$this->type} is powered by a {$this->engineType} engine.";
        
        // Calling protected method (startEngine) - ALLOWED
        $start_msg = $this->startEngine(); 
        
        return "{$start_msg} {$engine_info} It has {$this->doors} doors.";
    }

    // Public method to override and display custom start logic
    public function ignition(): string {
        return "Car Ignition: " . parent::ignition(); // Call parent's public method
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Testing Access from Outside the Classes (Instance Access)
// ---------------------------------------------------------------------

echo "<h2>3. Outside Access Attempts (Forbidden)</h2>";

$myCar = new Car("V6 Petrol", 4);

// 3a. Accessing PUBLIC property (ALLOWED)
echo "<li>Public Type: <strong>{$myCar->type}</strong></li>";

// 3b. Accessing PROTECTED property directly (FORBIDDEN - Fatal Error/Notice)
echo "<li>Protected Engine Type (Direct Access): <em>(Attempting direct access...)</em></li>";

try {
    // echo $myCar->engineType; // Fatal Error: Cannot access protected property Vehicle::$engineType
    echo "<p style='color: red;'>❌ FAILED: Direct access to protected property **\$engineType** is blocked.</p>";
} catch (Error $e) {}


// 3c. Calling PROTECTED method directly (FORBIDDEN - Fatal Error/Notice)
echo "<li>Protected Method (startEngine()): <em>(Attempting direct call...)</em></li>";
try {
    // $myCar->startEngine(); // Fatal Error: Call to protected method Vehicle::startEngine()
    echo "<p style='color: red;'>❌ FAILED: Direct call to protected method **startEngine()** is blocked.</p>";
} catch (Error $e) {}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Controlled Access via Subclass Methods
// ---------------------------------------------------------------------

echo "<h2>4. Access via Subclass Methods (Allowed)</h2>";

// 4a. Calling the method that uses the protected members internally
echo "<li>Car Drive Status: <strong>" . $myCar->drive() . "</strong></li>";
echo "<p><em>The <code>drive()</code> method successfully accessed and used the protected <code>\$engineType</code> and <code>startEngine()</code>.</em></p>";

// 4b. Calling the public ignition method
echo "<li>Car Ignition: <strong>" . $myCar->ignition() . "</strong></li>";

?>