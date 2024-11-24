<?php

// basic_inheritance.php

// This script demonstrates the most basic form of inheritance in PHP OOP, 
// where a child class inherits public and protected properties and methods 
// from a parent class.

echo "<h1>PHP Basic Inheritance Demo 🧬</h1>";

// ---------------------------------------------------------------------
// 1. Parent (Base) Class Definition
// ---------------------------------------------------------------------

/**
 * Class Asset
 * Represents a generic company asset.
 */
class Asset {
    
    // Public property: accessible everywhere
    public string $name;
    
    // Protected property: accessible only in Asset and its subclasses
    protected int $purchaseYear; 
    
    public function __construct(string $name, int $year) {
        $this->name = $name;
        $this->purchaseYear = $year;
        echo "<p style='color: green;'>✅ Asset **{$this->name}** created.</p>";
    }
    
    /**
     * Public method to calculate the asset's age.
     */
    public function getAge(): int {
        return date('Y') - $this->purchaseYear;
    }
    
    /**
     * Protected method for internal details, accessible by child classes.
     */
    protected function getBaseDetails(): string {
        return "Purchased in {$this->purchaseYear}.";
    }
}

// ---------------------------------------------------------------------
// 2. Child (Derived) Class Definition
// ---------------------------------------------------------------------

/**
 * Class Computer
 * Inherits from Asset using the `extends` keyword.
 */
class Computer extends Asset {
    
    public string $serialNumber;
    
    /**
     * Child constructor. It must ensure the parent is properly initialized.
     */
    public function __construct(string $name, int $year, string $serial) {
        // Call the parent's constructor to set $name and $purchaseYear.
        parent::__construct($name, $year); 
        $this->serialNumber = $serial;
        echo "<p style='color: green;'>✅ Computer asset initialized with serial **{$this->serialNumber}**.</p>";
    }
    
    /**
     * New method specific to the Computer class.
     * This method uses inherited properties and methods.
     */
    public function displayAssetReport(): void {
        // Accessing the public property inherited from Asset
        echo "<h3>Report for: {$this->name}</h3>"; 
        
        // Calling the public method inherited from Asset
        echo "<li>Age: {$this->getAge()} years old.</li>"; 
        
        // Calling the protected method inherited from Asset (Allowed in child class)
        echo "<li>Details: " . $this->getBaseDetails() . "</li>"; 
        
        // Accessing the new property
        echo "<li>Serial Number: {$this->serialNumber}</li>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Object Usage
// ---------------------------------------------------------------------

echo "<h2>3. Using the Child Object (Computer)</h2>";

// Instantiate the child class, passing all required arguments (for both parent and child)
$laptop = new Computer("Dell XPS Laptop", 2022, "A123-B456-C789");

echo "<hr>";

// The child object has access to all its own methods and the parent's public methods.
$laptop->displayAssetReport();

// Direct access to the public inherited property is allowed.
echo "<li>Public Inherited Property (\$name): <strong>{$laptop->name}</strong></li>";

// Direct call to the public inherited method is allowed.
echo "<li>Public Inherited Method (getAge): <strong>{$laptop->getAge()}</strong></li>";

// Note: Attempting to access the protected property $purchaseYear or method 
// getBaseDetails() directly here would result in a fatal error.

?>