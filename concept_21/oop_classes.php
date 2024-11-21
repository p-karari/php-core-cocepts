<?php

// oop_classes.php

// This script demonstrates the fundamentals of Object-Oriented Programming (OOP) in PHP, 
// including defining a class, properties, methods, and instantiating objects.

echo "<h1>PHP OOP: Classes and Objects Demo 🏛️</h1>";

// ---------------------------------------------------------------------
// 1. Defining a Class
// ---------------------------------------------------------------------

/**
 * Class Product
 * Represents a basic product entity with properties and methods.
 */
class Product {
    
    // -----------------------------------------------------------------
    // 1a. Properties (Attributes)
    // -----------------------------------------------------------------
    // Properties define the data that an object holds.
    // Access Modifiers: public, protected, private
    public string $name;
    private float $price;
    protected int $id;
    public static string $currency = "USD"; // Static property belongs to the class itself, not an instance.
    
    // -----------------------------------------------------------------
    // 1b. Constructor Method (__construct)
    // -----------------------------------------------------------------
    /**
     * The constructor method is automatically called when a new object is created.
     * @param string $name The product name.
     * @param float $price The product price.
     */
    public function __construct(string $name, float $price) {
        $this->name = $name;
        $this->setPrice($price); // Use a setter for price validation
        $this->id = rand(1000, 9999); // Set a random ID
        echo "<p style='color: green;'>✅ New Product '{$this->name}' (ID: {$this->id}) created.</p>";
    }
    
    // -----------------------------------------------------------------
    // 1c. Methods (Behaviors)
    // -----------------------------------------------------------------
    
    /**
     * Sets the private price property with basic validation.
     * @param float $price
     * @return void
     */
    private function setPrice(float $price): void {
        if ($price > 0) {
            $this->price = $price;
        } else {
            $this->price = 0.0;
            trigger_error("Price must be positive; setting to 0.0.", E_USER_WARNING);
        }
    }
    
    /**
     * Public method to get the formatted price.
     * @return string
     */
    public function getFormattedPrice(): string {
        // Accessing properties using $this->propertyName
        return Product::$currency . " " . number_format($this->price, 2);
    }

    /**
     * Public method to display product details.
     * @return void
     */
    public function displayDetails(): void {
        echo "<li>Name: <strong>{$this->name}</strong></li>";
        echo "<li>Price: <strong>" . $this->getFormattedPrice() . "</strong></li>";
        // Attempting to access $this->id directly from outside would fail (it's protected/private).
        echo "<li>Internal ID (protected): <em>{$this->id}</em></li>"; 
    }
    
    // -----------------------------------------------------------------
    // 1d. Static Method
    // -----------------------------------------------------------------

    /**
     * Static method to change the class-wide currency.
     * Static methods are called on the class, not the object.
     * @param string $new_currency
     * @return void
     */
    public static function setGlobalCurrency(string $new_currency): void {
        // Accessing static properties using self::$propertyName or ClassName::$propertyName
        self::$currency = $new_currency; 
        echo "<p style='color: blue;'>🌍 Global currency changed to: <strong>{$new_currency}</strong></p>";
    }

    // -----------------------------------------------------------------
    // 1e. Destructor Method (__destruct)
    // -----------------------------------------------------------------
    // Automatically called when the object is destroyed or garbage collected.
    public function __destruct() {
        // echo "<p style='color: brown;'>🗑️ Product '{$this->name}' is being destroyed.</p>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Instantiating Objects (Creating Instances)
// ---------------------------------------------------------------------

echo "<h2>2. Creating Objects</h2>";

// 2a. Create the first object
$book = new Product("PHP Cookbook", 35.99);

// 2b. Create the second object
$monitor = new Product("4K Monitor", 450.00);

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Accessing Properties and Calling Methods
// ---------------------------------------------------------------------

echo "<h2>3. Using Objects</h2>";

// 3a. Accessing public properties directly
$book->name = "PHP Advanced Cookbook"; // We can change the public property
echo "<h3>Book Details:</h3>";
echo "<ul>";
// Call public methods
$book->displayDetails();
echo "</ul>";

echo "<h3>Monitor Details:</h3>";
echo "<ul>";
$monitor->displayDetails();
echo "</ul>";

// 3b. Trying to access private/protected properties directly (will cause a fatal error/notice)
// echo $book->price; // This would cause a fatal error outside the class

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Using Static Members
// ---------------------------------------------------------------------

echo "<h2>4. Static Properties and Methods</h2>";

// 4a. Read static property
echo "<li>Initial Currency: <strong>" . Product::$currency . "</strong></li>";

// 4b. Call static method to change the property
Product::setGlobalCurrency("EUR");

// 4c. The change is reflected in all existing objects
echo "<h3>Price check after currency change:</h3>";
echo "<li>Book Price: <strong>" . $book->getFormattedPrice() . "</strong></li>";
echo "<li>Monitor Price: <strong>" . $monitor->getFormattedPrice() . "</strong></li>";

?>