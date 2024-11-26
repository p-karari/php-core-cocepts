<?php

// inheritance_tree.php

// This script demonstrates a multi-level inheritance tree in PHP OOP, 
// showing how properties and methods are inherited across multiple generations 
// of classes.

echo "<h1>PHP Multi-Level Inheritance Tree Demo 🌲</h1>";

// ---------------------------------------------------------------------
// 1. Grandparent Class (Level 1: The most general)
// ---------------------------------------------------------------------

/**
 * Class Equipment
 * The base class for all assets.
 */
class Equipment {
    
    public string $assetTag;
    protected string $manufacturer = "Generic Corp"; 
    
    public function __construct(string $tag) {
        $this->assetTag = $tag;
        echo "<p style='color: green;'>✅ **Level 1 (Equipment)** created: {$this->assetTag}</p>";
    }
    
    public function getAssetId(): string {
        return "Asset Tag: {$this->assetTag}";
    }
    
    protected function getBaseManufacturer(): string {
        return "Manufacturer: {$this->manufacturer}";
    }
}

// ---------------------------------------------------------------------
// 2. Parent Class (Level 2: Specializes the Grandparent)
// ---------------------------------------------------------------------

/**
 * Class Computer
 * Inherits from Equipment and specializes it for computing devices.
 */
class Computer extends Equipment {
    
    protected string $operatingSystem;
    
    public function __construct(string $tag, string $os) {
        // Call the Grandparent's constructor to initialize $assetTag
        parent::__construct($tag); 
        $this->operatingSystem = $os;
        $this->manufacturer = "Tech Giant Inc."; // Overrides the protected property
        echo "<p style='color: green;'>✅ **Level 2 (Computer)** initialized with OS: {$this->operatingSystem}</p>";
    }

    /**
     * Overrides and augments the inherited getAssetId().
     */
    public function getAssetId(): string {
        // Can call the original parent method for base information
        $baseId = parent::getAssetId(); 
        return "{$baseId} | OS: {$this->operatingSystem}";
    }
    
    protected function getComputerDetails(): string {
        // Accesses the protected property inherited (and overridden) from Equipment
        $manufacturer = $this->getBaseManufacturer();
        return "{$manufacturer} | OS: {$this->operatingSystem}";
    }
}

// ---------------------------------------------------------------------
// 3. Child Class (Level 3: The most specific)
// ---------------------------------------------------------------------

/**
 * Class Laptop
 * Inherits from Computer and adds laptop-specific details.
 */
class Laptop extends Computer {
    
    public int $screenSize;
    
    public function __construct(string $tag, string $os, int $screen) {
        // Call the Parent's constructor (Computer), which in turn calls Equipment's constructor
        parent::__construct($tag, $os); 
        $this->screenSize = $screen;
        echo "<p style='color: green;'>✅ **Level 3 (Laptop)** initialized with Screen: {$this->screenSize}\"</p>";
    }
    
    /**
     * New method that utilizes properties and methods from all ancestors.
     */
    public function getFullReport(): void {
        echo "<h3>Full Report:</h3>";
        echo "<ul>";
        // 1. Get detailed ID from Parent (Computer) which includes Grandparent (Equipment) data
        echo "<li>ID Info: <strong>" . $this->getAssetId() . "</strong></li>"; 
        
        // 2. Get manufacturer and OS details from Parent (Computer) protected method
        echo "<li>Base Details: <strong>" . $this->getComputerDetails() . "</strong></li>"; 
        
        // 3. Add own specific property
        echo "<li>Specifics: Screen Size: <strong>{$this->screenSize}\"</strong></li>";
        echo "</ul>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Object Instantiation and Usage
// ---------------------------------------------------------------------

echo "<h2>4. Instantiating the Child Class (Laptop)</h2>";

// The Laptop constructor handles the initialization of all properties 
// across all three levels of the hierarchy.
$devLaptop = new Laptop("LPT-789", "Linux", 15);

echo "<hr>";

// Use the methods of the most derived class.
$devLaptop->getFullReport();

// Direct access to the public property inherited from the Grandparent
echo "<li>Direct Access to Grandparent Property: <strong>{$devLaptop->assetTag}</strong></li>";

// Direct access to the public method inherited (and overridden) from the Grandparent
echo "<li>Direct Call to Overridden Method: <strong>" . $devLaptop->getAssetId() . "</strong></li>";

?>