<?php

// inheritance.php

// This script demonstrates **Inheritance** in PHP Object-Oriented Programming (OOP).
// Inheritance allows a new class (child/subclass) to inherit properties and methods 
// from an existing class (parent/superclass). This promotes code reuse and 
// establishes an "is-a" relationship (e.g., a Dog IS A Mammal).

echo "<h1>PHP OOP Inheritance Demo 🧬</h1>";

// ---------------------------------------------------------------------
// 1. Parent (Base) Class Definition
// ---------------------------------------------------------------------

/**
 * Class Animal
 * The base class defining common properties and methods for all animals.
 */
class Animal {
    
    public string $name;
    protected string $sound;
    
    public function __construct(string $name, string $sound) {
        $this->name = $name;
        $this->sound = $sound;
        echo "<p style='color: green;'>✅ Base Animal **{$this->name}** created.</p>";
    }
    
    /**
     * A common method inherited by all subclasses.
     */
    public function eat(): string {
        return "{$this->name} is eating.";
    }

    /**
     * A method to access the protected property.
     */
    protected function getSound(): string {
        return $this->sound;
    }
}

// ---------------------------------------------------------------------
// 2. Child (Derived) Class Definition
// ---------------------------------------------------------------------

/**
 * Class Dog
 * Inherits from Animal using the `extends` keyword.
 */
class Dog extends Animal {
    
    public string $breed;
    
    /**
     * The child constructor must call the parent constructor if the parent
     * has one and requires initialization.
     */
    public function __construct(string $name, string $breed) {
        // Call the parent's constructor using parent:: to initialize parent properties.
        parent::__construct($name, "Woof"); 
        $this->breed = $breed;
        echo "<p style='color: green;'>✅ Child Dog **{$this->name}** (Breed: {$this->breed}) created.</p>";
    }
    
    /**
     * **Method Overriding:** Redefining an inherited method to provide 
     * specialized behavior for the child class.
     */
    public function eat(): string {
        // We can still use the parent's implementation if needed: parent::eat()
        return "{$this->name} is hungrily chewing its dog food.";
    }
    
    /**
     * New method specific to the Dog class.
     */
    public function bark(): string {
        // Accessing the protected parent method is allowed.
        return "{$this->name} says: **" . $this->getSound() . "**!";
    }
}

/**
 * Class Cat
 * Another class inheriting from Animal.
 */
class Cat extends Animal {
    
    public function __construct(string $name) {
        parent::__construct($name, "Meow");
    }

    // Example of method overriding without using the parent's code
    public function eat(): string {
        return "{$this->name} is elegantly sipping milk.";
    }

    public function meow(): string {
        return "{$this->name} purrs and says: " . $this->getSound();
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Object Usage
// ---------------------------------------------------------------------

echo "<h2>3. Using Inherited Objects</h2>";

// 3a. Create a Dog object
$dog = new Dog("Buddy", "Labrador");

// Dog uses its own overridden eat() method
echo "<li>Dog eats: <strong>" . $dog->eat() . "</strong></li>"; 
// Dog uses its specific bark() method
echo "<li>Dog barks: <strong>" . $dog->bark() . "</strong></li>";
// Dog uses the inherited $name property
echo "<li>Dog's Breed: <strong>" . $dog->breed . "</strong></li>"; 

echo "<hr>";

// 3b. Create a Cat object
$cat = new Cat("Whiskers");

// Cat uses its own overridden eat() method
echo "<li>Cat eats: <strong>" . $cat->eat() . "</strong></li>";
// Cat uses its specific meow() method
echo "<li>Cat meows: <strong>" . $cat->meow() . "</strong></li>";

// 3c. Create a generic Animal object for comparison
$animal = new Animal("Lion", "Roar");
// Lion uses the original parent eat() method
echo "<li>Lion eats: <strong>" . $animal->eat() . "</strong></li>"; 

?>