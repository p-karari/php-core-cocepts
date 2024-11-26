<?php

// abstract_vehicle.php

// This script demonstrates the use of an Abstract Class to define a standard 
// structure (a contract) for different types of vehicles, ensuring all 
// concrete vehicle classes implement key functionalities.

echo "<h1>PHP Abstract Vehicle Class Demo 🚗🏍️</h1>";

// ---------------------------------------------------------------------
// 1. Abstract Class Definition
// ---------------------------------------------------------------------

/**
 * abstract class Vehicle
 * Defines the essential structure and shared behavior for all vehicles.
 */
abstract class Vehicle {
    
    // Properties shared by all vehicles
    protected string $model;
    protected string $color;
    protected int $speed = 0;
    
    // Constructor to initialize shared properties
    public function __construct(string $model, string $color) {
        $this->model = $model;
        $this->color = $color;
        echo "<p style='color: green;'>✅ Vehicle base initialized: {$this->color} {$this->model}.</p>";
    }
    
    // -----------------------------------------------------------------
    // Abstract Methods (Contract): MUST be implemented by subclasses
    // -----------------------------------------------------------------
    
    /**
     * Abstract method to start the vehicle's engine.
     */
    abstract public function start(): string;
    
    /**
     * Abstract method to simulate acceleration.
     */
    abstract public function accelerate(int $speedIncrease): void;
    
    /**
     * Abstract method to display the vehicle type and unique characteristics.
     */
    abstract public function getVehicleType(): string;
    
    // -----------------------------------------------------------------
    // Concrete Method (Shared Logic): Already implemented
    // -----------------------------------------------------------------
    
    /**
     * Shared method to get the current status of the vehicle.
     */
    public function getStatus(): string {
        return "The {$this->color} {$this->model} is currently traveling at {$this->speed} mph.";
    }
}

// ---------------------------------------------------------------------
// 2. Concrete Subclass 1: Car
// ---------------------------------------------------------------------

/**
 * class Car
 * Concrete implementation of the Vehicle abstract class.
 */
class Car extends Vehicle {
    
    private int $doors;
    
    public function __construct(string $model, string $color, int $doors) {
        parent::__construct($model, $color);
        $this->doors = $doors;
    }
    
    // Implementation of abstract methods
    public function start(): string {
        return "Engine starts with a key ignition.";
    }
    
    public function accelerate(int $speedIncrease): void {
        $this->speed += $speedIncrease;
        echo "<p style='color: blue;'>➡️ Car accelerating. Speed is now {$this->speed} mph.</p>";
    }
    
    public function getVehicleType(): string {
        return "Four-wheeled Car ({$this->doors} doors)";
    }
}

// ---------------------------------------------------------------------
// 3. Concrete Subclass 2: Motorcycle
// ---------------------------------------------------------------------

/**
 * class Motorcycle
 * Another concrete implementation of the Vehicle abstract class.
 */
class Motorcycle extends Vehicle {
    
    public function __construct(string $model, string $color) {
        parent::__construct($model, $color);
    }
    
    // Implementation of abstract methods
    public function start(): string {
        return "Engine starts with a kickstand switch.";
    }
    
    public function accelerate(int $speedIncrease): void {
        // Motorcycles accelerate faster
        $this->speed += $speedIncrease * 2; 
        echo "<p style='color: blue;'>➡️ Motorcycle roaring ahead. Speed is now {$this->speed} mph.</p>";
    }
    
    public function getVehicleType(): string {
        return "Two-wheeled Motorcycle";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Object Usage and Testing
// ---------------------------------------------------------------------

echo "<h2>4. Testing Concrete Implementations</h2>";

// 4a. Instantiate a Car
$bmw = new Car("BMW 3-Series", "Black", 4);
echo "<li>Type: " . $bmw->getVehicleType() . "</li>";
echo "<li>Start: " . $bmw->start() . "</li>";
$bmw->accelerate(20);
$bmw->accelerate(40);
echo "<li>Final Status: " . $bmw->getStatus() . "</li>";

echo "<hr>";

// 4b. Instantiate a Motorcycle
$harley = new Motorcycle("Harley-Davidson Fat Boy", "Red");
echo "<li>Type: " . $harley->getVehicleType() . "</li>";
echo "<li>Start: " . $harley->start() . "</li>";
// Note: Only 20 is passed, but the Motorcycle implementation multiplies it by 2
$harley->accelerate(20); 
echo "<li>Final Status: " . $harley->getStatus() . "</li>";

?>