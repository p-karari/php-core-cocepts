<?php

// getters_setters.php

// This script demonstrates the use of **Getter** and **Setter** methods 
// to control access and modification of **private** class properties. 
// This is a key principle of encapsulation in OOP.

echo "<h1>PHP Getters and Setters Demonstration 🔑🔒</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition
// ---------------------------------------------------------------------

/**
 * Class Account
 * Manages a user's bank account with controlled access to the balance.
 */
class Account {
    
    // Private property to encapsulate and protect the sensitive data.
    private float $balance;
    private string $accountHolder;

    public function __construct(string $holder, float $initialBalance = 0.0) {
        $this->accountHolder = $holder;
        $this->setBalance($initialBalance); // Use the setter for initialization
        echo "<p style='color: green;'>✅ Account created for **{$holder}**.</p>";
    }
    
    // -----------------------------------------------------------------
    // 2. Setter Method: Controls Write Access and enforces Validation
    // -----------------------------------------------------------------
    
    /**
     * Setter for the private $balance property.
     * Enforces the rule that the balance cannot be negative.
     * @param float $amount The new balance value.
     * @return void
     */
    private function setBalance(float $amount): void {
        if ($amount < 0) {
            // Prevent invalid state by refusing to set a negative balance.
            trigger_error("Attempted to set a negative balance! Operation rejected.", E_USER_WARNING);
            return;
        }
        $this->balance = $amount;
    }
    
    // Public method to modify the balance (deposit)
    public function deposit(float $amount): void {
        if ($amount > 0) {
            $newBalance = $this->balance + $amount;
            $this->setBalance($newBalance);
            echo "<p style='color: blue;'>➡️ Deposited \${$amount}.</p>";
        } else {
            trigger_error("Deposit amount must be positive.", E_USER_WARNING);
        }
    }
    
    // Public method to modify the balance (withdrawal)
    public function withdraw(float $amount): bool {
        if ($amount > 0 && $this->balance >= $amount) {
            $newBalance = $this->balance - $amount;
            $this->setBalance($newBalance); // The setter will accept this non-negative value
            echo "<p style='color: blue;'>⬅️ Withdrew \${$amount}.</p>";
            return true;
        }
        echo "<p style='color: red;'>❌ Withdrawal failed. Insufficient funds or invalid amount.</p>";
        return false;
    }
    
    // -----------------------------------------------------------------
    // 3. Getter Method: Controls Read Access and performs Formatting
    // -----------------------------------------------------------------

    /**
     * Getter for the private $balance property.
     * Returns the balance formatted as a currency string.
     * @return string The formatted balance.
     */
    public function getBalance(): string {
        // Accessing the private property for internal use (formatting)
        return "$" . number_format($this->balance, 2);
    }
    
    public function getAccountHolder(): string {
        return $this->accountHolder;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Usage and Testing
// ---------------------------------------------------------------------

$myAccount = new Account("Alice Smith", 500.00);

echo "<h2>4. Testing Getters and Setters</h2>";

// 4a. Reading the balance using the Getter
echo "<li>Current Balance for **{$myAccount->getAccountHolder()}**: <strong>{$myAccount->getBalance()}</strong></li>";

// 4b. Modifying the balance using the public Setter wrappers (deposit)
$myAccount->deposit(150.75);
echo "<li>Balance after deposit: <strong>{$myAccount->getBalance()}</strong></li>";

// 4c. Modifying the balance using the public Setter wrappers (withdraw success)
$myAccount->withdraw(50.00);
echo "<li>Balance after successful withdrawal: <strong>{$myAccount->getBalance()}</strong></li>";

// 4d. Testing Encapsulation (Direct access blocked)
// echo $myAccount->balance; // Fatal Error: Cannot access private property Account::$balance

// 4e. Testing Setter Validation (withdraw failure)
$myAccount->withdraw(1000.00); // Should fail due to insufficient funds

echo "<li>Final Balance: <strong>{$myAccount->getBalance()}</strong></li>";
?>