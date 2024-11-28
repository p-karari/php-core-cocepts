<?php

// traits.php

// This script demonstrates **Traits** in PHP OOP.
// Traits provide a mechanism for code reuse by allowing a class to inherit 
// methods and properties without using traditional inheritance. They solve the 
// "single inheritance" problem in PHP by enabling classes to use multiple sets 
// of methods.

echo "<h1>PHP Traits Demonstration (Code Reuse) 🧩</h1>";

// ---------------------------------------------------------------------
// 1. Define the Traits
// ---------------------------------------------------------------------

/**
 * Trait Notifiable
 * Provides functionality for sending notifications (e.g., email, SMS).
 */
trait Notifiable {
    
    // Trait property (will be added to the consuming class)
    protected string $defaultChannel = "Email";

    // Trait method
    public function sendNotification(string $message, string $recipient): void {
        echo "<p style='color: blue;'>➡️ **[Notifiable]** Sending '{$message}' to {$recipient} via {$this->defaultChannel}.</p>";
    }
    
    // Trait method
    public function setDefaultChannel(string $channel): void {
        $this->defaultChannel = $channel;
    }
}

/**
 * Trait Timestampable
 * Provides functionality for tracking creation and update times.
 */
trait Timestampable {
    
    // Trait properties
    protected string $createdAt;
    protected string $updatedAt;

    // Trait method
    public function markCreated(): void {
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    // Trait method
    public function markUpdated(): void {
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    public function getTimestamps(): string {
        return "Created: {$this->createdAt}, Last Updated: {$this->updatedAt}";
    }
}

// ---------------------------------------------------------------------
// 2. Class Definitions (Using Traits)
// ---------------------------------------------------------------------

echo "<hr>";
echo "<h2>2. Class A: User (Uses both Traits)</h2>";

/**
 * Class User
 * Consumes both Notifiable and Timestampable traits.
 */
class User {
    // Use the `use` keyword to incorporate the trait members.
    use Notifiable, Timestampable { 
        // Optional: Can use the `insteadof` operator for conflict resolution (see below)
    } 
    
    private string $email;
    
    public function __construct(string $email) {
        $this->email = $email;
        $this->markCreated(); // Calls method from Timestampable trait
        echo "<p style='color: green;'>✅ User {$email} created and timestamps marked.</p>";
    }
    
    public function notifyAdmin(string $msg): void {
        // Calls method from Notifiable trait
        $this->sendNotification($msg, $this->email); 
    }
}

echo "<hr>";
echo "<h2>3. Class B: Product (Uses only one Trait)</h2>";

/**
 * Class Product
 * Uses only the Timestampable trait.
 */
class Product {
    use Timestampable;
    
    public string $name;
    
    public function __construct(string $name) {
        $this->name = $name;
        $this->markCreated();
        $this->markUpdated();
        echo "<p style='color: green;'>✅ Product {$name} created.</p>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Usage and Verification
// ---------------------------------------------------------------------

echo "<h2>4. Usage of Trait Functionality</h2>";

// 4a. User object (has both notifiable and timestampable methods/properties)
$alice = new User("alice@example.com");

// Use Notifiable method
$alice->setDefaultChannel("SMS");
$alice->notifyAdmin("Welcome to the platform!");

// Use Timestampable method
echo "<li>Alice Timestamps: <strong>" . $alice->getTimestamps() . "</strong></li>";

echo "<hr>";

// 4b. Product object (has only timestampable methods/properties)
$widget = new Product("Amazing Widget");
$widget->name = "Super Widget"; // Update property
$widget->markUpdated(); // Mark the update time

// The Product object does NOT have sendNotification() or setDefaultChannel().
echo "<li>Widget Timestamps: <strong>" . $widget->getTimestamps() . "</strong></li>";

// ---------------------------------------------------------------------
// 5. Conflict Resolution Example (If two traits had the same method name)
// ---------------------------------------------------------------------
/*
// Define a conflicting trait
trait AnotherTrait {
    public function log(string $msg): void { echo "Another: {$msg}"; }
}

trait LoggerTrait {
    public function log(string $msg): void { echo "Logger: {$msg}"; }
}

class ConflictClass {
    use AnotherTrait, LoggerTrait {
        // Resolution: Use LoggerTrait's log method INSTEADOF AnotherTrait's log
        LoggerTrait::log insteadof AnotherTrait; 
        
        // Optional: Create an alias for the excluded method if we still want access
        AnotherTrait::log as anotherLog;
    }
}

$c = new ConflictClass();
$c->log("Test");        // Calls LoggerTrait's log
$c->anotherLog("Test"); // Calls AnotherTrait's log via alias
*/

?>