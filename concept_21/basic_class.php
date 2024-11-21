<?php

// basic_class.php

// This script demonstrates the most fundamental aspects of defining a class
// in PHP, including properties, a constructor, and a method.

echo "<h1>PHP Basic Class Definition Demo 🧑‍💻</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition
// ---------------------------------------------------------------------

/**
 * Class User
 * A simple blueprint for a user object.
 */
class User {
    
    // 1a. Properties (Attributes/Variables of the class)
    // The 'public' keyword is an access modifier, meaning these can be accessed 
    // and modified from outside the class.
    public int $id;
    public string $username;
    public string $email;
    
    // 1b. Constructor Method (__construct)
    /**
     * The constructor is a special method automatically called when a new object
     * is created (instantiated) from the class.
     * @param int $id User's ID.
     * @param string $username User's preferred username.
     * @param string $email User's email address.
     */
    public function __construct(int $id, string $username, string $email) {
        // The $this keyword refers to the current object instance.
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        echo "<p style='color: green;'>✅ User object created for: <strong>{$username}</strong></p>";
    }
    
    // 1c. Method (Behavior/Functionality of the class)
    /**
     * A method to generate a simple greeting message.
     * @return string A personalized greeting.
     */
    public function greet(): string {
        return "Hello, {$this->username}! Your ID is {$this->id}.";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Object Instantiation and Usage
// ---------------------------------------------------------------------

echo "<h2>2. Creating and Using Objects</h2>";

// 2a. Instantiating the first object
$user1 = new User(1, "alice_dev", "alice@example.com");

// 2b. Instantiating the second object
$user2 = new User(2, "bob_tester", "bob@example.com");

echo "<hr>";

// 2c. Accessing properties directly
echo "<h3>User 1 Details:</h3>";
echo "<ul>";
echo "<li>ID: <strong>{$user1->id}</strong></li>";
echo "<li>Username: <strong>{$user1->username}</strong></li>";
echo "<li>Email: <strong>{$user1->email}</strong></li>";
echo "</ul>";

// 2d. Calling a method
echo "<h3>User 2 Greeting:</h3>";
echo "<p><strong>" . $user2->greet() . "</strong></p>";

// 2e. Modifying a property
$user2->username = "bob_admin";
echo "<p>User 2 Username updated to: <strong>{$user2->username}</strong></p>";

?>