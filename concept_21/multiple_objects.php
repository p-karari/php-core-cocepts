<?php

// multiple_objects.php

// This script demonstrates creating and managing multiple distinct objects 
// (instances) from the same class, showing that each object holds its 
// own unique state (property values).

echo "<h1>PHP Multiple Objects Demonstration 📦📦📦</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition
// ---------------------------------------------------------------------

/**
 * Class CartItem
 * Represents an item added to an online shopping cart.
 */
class CartItem {
    
    // Properties to hold the state of each item
    public int $itemId;
    public string $name;
    public float $price;
    public int $quantity;
    
    /**
     * Constructor to initialize a new CartItem object.
     */
    public function __construct(int $id, string $name, float $price, int $quantity) {
        $this->itemId = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }
    
    /**
     * Calculates the total cost for this specific item (price * quantity).
     * @return float The subtotal.
     */
    public function getSubtotal(): float {
        return $this->price * $this->quantity;
    }
    
    /**
     * Displays a summary of the item's details.
     * @return void
     */
    public function displaySummary(): void {
        $subtotal = number_format($this->getSubtotal(), 2);
        $formatted_price = number_format($this->price, 2);
        echo "<li><strong>{$this->name}</strong> (ID: {$this->itemId}) - Unit Price: \${$formatted_price}, Quantity: {$this->quantity}, Subtotal: <strong>\${$subtotal}</strong></li>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Creating Multiple Objects
// ---------------------------------------------------------------------

echo "<h2>2. Creating Unique Instances (Objects)</h2>";

// 2a. First object: A Laptop
$item1 = new CartItem(101, "High-End Laptop", 1200.00, 1);

// 2b. Second object: A Keyboard
$item2 = new CartItem(205, "Mechanical Keyboard", 85.50, 2);

// 2c. Third object: A Mouse
$item3 = new CartItem(310, "Gaming Mouse", 45.00, 3);

echo "<p>Three distinct objects have been created from the same CartItem class.</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Modifying and Using Individual Objects
// ---------------------------------------------------------------------

echo "<h2>3. Individual Object State and Behavior</h2>";

// Display initial summary
echo "<h3>Cart Summary (Initial):</h3>";
echo "<ul>";
$item1->displaySummary();
$item2->displaySummary();
$item3->displaySummary();
echo "</ul>";

// Modify the state of one object without affecting the others
$item2->quantity = 1; 
echo "<p style='color: blue;'>➡️ **Modified Item 2:** Quantity changed to 1 (from 2).</p>";

// Calculate and display the new subtotal for the modified item
$new_subtotal_item2 = number_format($item2->getSubtotal(), 2);
echo "<li>New Subtotal for Item 2: <strong>\${$new_subtotal_item2}</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Using Objects within an Array
// ---------------------------------------------------------------------

echo "<h2>4. Managing Objects in an Array (Shopping Cart)</h2>";

// Store all objects in an array to represent a shopping cart
$shopping_cart = [$item1, $item2, $item3];
$grand_total = 0.00;

echo "<h3>Final Shopping Cart Breakdown:</h3>";
echo "<ul>";
foreach ($shopping_cart as $item) {
    // Call the method on each object in the array
    $item->displaySummary(); 
    $grand_total += $item->getSubtotal();
}
echo "</ul>";

echo "<h3>Grand Total: <strong>\$" . number_format($grand_total, 2) . "</strong></h3>";

?>