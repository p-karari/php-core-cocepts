<?php

// enforcing_structure.php

// This script demonstrates how to enforce a specific structure and contract 
// across multiple classes using **Interfaces** and **Abstract Classes** in PHP OOP.
// This is critical for building scalable, maintainable, and loosely coupled applications.

echo "<h1>PHP Enforcing Structure: Interfaces & Abstract Classes 📝</h1>";

// ---------------------------------------------------------------------
// 1. Interface Definition (The "Can Do" Contract)
// ---------------------------------------------------------------------

/**
 * Interface Exportable
 * Defines a contract for any class that is capable of being exported.
 */
interface Exportable {
    
    // Abstract method: MUST be public and implemented by the class.
    public function toArray(): array;
    
    // Abstract method: MUST be public and implemented by the class.
    public function toJson(): string;
}

// ---------------------------------------------------------------------
// 2. Abstract Class Definition (The "Is A" Base & Shared Logic)
// ---------------------------------------------------------------------

/**
 * abstract class Entity
 * Defines common properties and shared methods for application entities.
 * It also implements the Exportable interface, forcing its children to fulfill it.
 */
abstract class Entity implements Exportable {
    
    protected int $id;
    protected string $createdAt;
    
    public function __construct(int $id) {
        $this->id = $id;
        $this->createdAt = date('Y-m-d H:i:s');
    }
    
    // Concrete method: Shared functionality for all entities
    public function getBaseDetails(): string {
        return "ID: {$this->id}, Created: {$this->createdAt}";
    }
    
    // Abstract method: MUST be implemented by children to get unique details
    abstract protected function getUniqueDetails(): string;
    
    // Implementation of the interface's toJson() method (shared logic)
    // The child only needs to implement toArray().
    public function toJson(): string {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}

// ---------------------------------------------------------------------
// 3. Concrete Subclass (Fulfilling the Structure)
// ---------------------------------------------------------------------

/**
 * class User
 * Inherits from Entity and MUST implement the remaining abstract methods 
 * from Entity and the Exportable interface.
 */
class User extends Entity {
    
    private string $username;
    private string $email;
    
    public function __construct(int $id, string $username, string $email) {
        parent::__construct($id);
        $this->username = $username;
        $this->email = $email;
        echo "<p style='color: green;'>✅ User '{$this->username}' created.</p>";
    }
    
    // Implementation of the abstract method from Entity
    protected function getUniqueDetails(): string {
        return "Username: {$this->username}, Email: {$this->email}";
    }
    
    // Implementation of the abstract method from Exportable interface
    public function toArray(): array {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'created_at' => $this->createdAt,
            'status' => 'active'
        ];
    }

    public function displayFullDetails(): void {
        echo "<li>Base: {$this->getBaseDetails()}</li>";
        echo "<li>Unique: {$this->getUniqueDetails()}</li>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Usage and Verification
// ---------------------------------------------------------------------

echo "<h2>4. Object Usage and Contract Verification</h2>";

$alice = new User(101, "alice_dev", "alice@corp.com");

echo "<h3>User Details:</h3>";
$alice->displayFullDetails();

echo "<hr>";

// 4a. Verify Interface methods (Exportable Contract)
echo "<h2>5. Testing Exportable Contract</h2>";

if ($alice instanceof Exportable) {
    echo "<p style='color: blue;'>✅ Object **is** an Exportable entity.</p>";
}

// 4b. Test toArray() (implemented by User)
$array_output = $alice->toArray();
echo "<h3>toArray() Output:</h3>";
echo "<pre>"; print_r($array_output); echo "</pre>";

// 4c. Test toJson() (implemented by Abstract Entity)
$json_output = $alice->toJson();
echo "<h3>toJson() Output (Shared Logic):</h3>";
echo "<pre>"; echo htmlspecialchars($json_output); echo "</pre>";

?>