<?php

// method_overriding.php

// This script demonstrates **Method Overriding** in PHP OOP, where a child 
// class redefines a method that is already present in its parent class. 
// This allows the child class to provide a specific implementation for a 
// method inherited from its superclass.

echo "<h1>PHP Method Overriding Demo 🔄</h1>";

// ---------------------------------------------------------------------
// 1. Parent (Base) Class Definition
// ---------------------------------------------------------------------

/**
 * Class Employee
 * Represents a generic employee with base functionality.
 */
class Employee {
    
    protected string $name;
    protected float $salary;

    public function __construct(string $name, float $salary) {
        $this->name = $name;
        $this->salary = $salary;
        echo "<p style='color: green;'>✅ Employee **{$this->name}** created.</p>";
    }
    
    /**
     * Base method for calculating annual bonus (simple flat rate).
     * @return float The calculated bonus.
     */
    public function calculateBonus(): float {
        // Base bonus is 10% of the annual salary
        return $this->salary * 0.10;
    }
    
    /**
     * Base method to display standard employee details.
     */
    public function getDetails(): string {
        $bonus = number_format($this->calculateBonus(), 2);
        $salary = number_format($this->salary, 2);
        return "{$this->name} (Standard Employee) | Salary: \${$salary} | Base Bonus: \${$bonus}";
    }
}

// ---------------------------------------------------------------------
// 2. Child Class Definition (Method Overriding)
// ---------------------------------------------------------------------

/**
 * Class Manager
 * Inherits from Employee but overrides calculateBonus() and getDetails().
 */
class Manager extends Employee {
    
    // Manager has a higher bonus rate
    protected float $managementBonusRate = 0.25; 
    
    public function __construct(string $name, float $salary) {
        // Call the parent constructor
        parent::__construct($name, $salary);
    }
    
    /**
     * **OVERRIDING calculateBonus()**
     * Provides a specialized implementation (a higher rate) for Managers.
     */
    public function calculateBonus(): float {
        // Manager's bonus is 25% of the annual salary
        return $this->salary * $this->managementBonusRate;
    }
    
    /**
     * **OVERRIDING getDetails()**
     * Provides specialized details, but still uses the parent's logic for some parts.
     */
    public function getDetails(): string {
        // 1. Call the parent's getDetails() method to reuse common components
        $baseDetails = parent::getDetails();
        
        // 2. Calculate the Manager's specific bonus using the OVERRIDDEN method
        $managerBonus = number_format($this->calculateBonus(), 2);
        
        // 3. Return the specialized, combined detail string
        return "Manager: {$this->name} | Total Bonus (25%): \${$managerBonus} | Base details (10%): ({$baseDetails})";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Object Usage and Comparison
// ---------------------------------------------------------------------

echo "<h2>3. Usage and Comparison of Objects</h2>";

// 3a. Standard Employee object
$emp1 = new Employee("Alice", 50000.00);

echo "<h3>Employee (Alice):</h3>";
echo "<li>Details: <strong>" . $emp1->getDetails() . "</strong></li>";
echo "<li>Calculated Bonus (10%): <strong>\$" . number_format($emp1->calculateBonus(), 2) . "</strong></li>"; // Output: 5000.00

echo "<hr>";

// 3b. Manager object (Child class)
$mgr1 = new Manager("Bob", 80000.00);

echo "<h3>Manager (Bob):</h3>";
echo "<li>Details: <strong>" . $mgr1->getDetails() . "</strong></li>";
echo "<li>Calculated Bonus (25% - Overridden): <strong>\$" . number_format($mgr1->calculateBonus(), 2) . "</strong></li>"; // Output: 20000.00

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Using parent:: keyword
// ---------------------------------------------------------------------

echo "<h2>4. Reusing Parent Logic (parent::)</h2>";

echo "<li>Manager's base details (via <code>parent::getDetails()</code> within Manager):<br><strong>" . $mgr1->getDetails() . "</strong></li>";
echo "<p><em>Note how the Manager's <code>getDetails()</code> method uses <code>parent::getDetails()</code> to incorporate the base employee information, demonstrating code reuse.</em></p>";

?>