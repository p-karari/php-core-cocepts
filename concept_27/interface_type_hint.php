<?php

// interface_type_hint.php

// This script demonstrates **Interface Type Hinting** (Polymorphism) in PHP.
// By type hinting a function argument with an interface name, the function 
// guarantees that it will receive an object that implements that interface, 
// ensuring the required methods are available, regardless of the object's 
// concrete class.

echo "<h1>PHP Interface Type Hinting (Polymorphism) Demo 🤝</h1>";

// ---------------------------------------------------------------------
// 1. Interface Definition (The Contract)
// ---------------------------------------------------------------------

/**
 * Interface Payable
 * Defines a contract for any class that can be paid.
 */
interface Payable {
    
    // Method to get the amount due
    public function getAmount(): float;
    
    // Method to display a summary of the payment item
    public function getSummary(): string;
}

// ---------------------------------------------------------------------
// 2. Concrete Class 1: Invoice
// ---------------------------------------------------------------------

/**
 * Class Invoice
 * Implements the Payable interface.
 */
class Invoice implements Payable {
    
    private int $invoiceNumber;
    private float $totalAmount;
    
    public function __construct(int $number, float $amount) {
        $this->invoiceNumber = $number;
        $this->totalAmount = $amount;
    }
    
    // Interface implementation
    public function getAmount(): float {
        return $this->totalAmount;
    }
    
    // Interface implementation
    public function getSummary(): string {
        return "Invoice #{$this->invoiceNumber} (Goods & Services)";
    }
}

// ---------------------------------------------------------------------
// 3. Concrete Class 2: Salary
// ---------------------------------------------------------------------

/**
 * Class Salary
 * Implements the Payable interface.
 */
class Salary implements Payable {
    
    private string $employeeName;
    private float $netPay;
    
    public function __construct(string $name, float $pay) {
        $this->employeeName = $name;
        $this->netPay = $pay;
    }
    
    // Interface implementation (Different logic for amount calculation)
    public function getAmount(): float {
        // Assume this includes all deductions
        return $this->netPay;
    }
    
    // Interface implementation (Different summary format)
    public function getSummary(): string {
        return "Monthly Salary for {$this->employeeName}";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Function Using Interface Type Hinting
// ---------------------------------------------------------------------

echo "<h2>4. Payment Processor Function</h2>";

/**
 * Function processPayment
 * **Type Hinted with the Interface Payable.** This function will accept ANY 
 * object that implements the Payable interface, demonstrating polymorphism.
 *
 * @param Payable $paymentItem An object guaranteed to have getAmount() and getSummary().
 */
function processPayment(Payable $paymentItem): void {
    $summary = $paymentItem->getSummary();
    $amount = $paymentItem->getAmount();
    $formattedAmount = number_format($amount, 2);
    $className = get_class($paymentItem);
    
    echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
    echo "<h3>Processing Type: {$className}</h3>";
    echo "<li>Item: <strong>{$summary}</strong></li>";
    echo "<li>Amount Due: <strong>\${$formattedAmount}</strong></li>";
    echo "<p style='color: blue;'>➡️ Logic: Successfully debited \${$formattedAmount} and updated ledger.</p>";
    echo "</div>";
}

// ---------------------------------------------------------------------
// 5. Usage (Passing Different Objects to the Same Function)
// ---------------------------------------------------------------------

echo "<h2>5. Testing Polymorphism</h2>";

// 5a. Create an Invoice object
$invoice = new Invoice(20251001, 75.50);

// 5b. Create a Salary object
$salary = new Salary("Jane Doe", 4500.00);

// The same function handles both objects seamlessly because both adhere to the Payable contract.
processPayment($invoice);
processPayment($salary);

echo "<hr>";

// ---------------------------------------------------------------------
// 6. Type Hint Enforcement
// ---------------------------------------------------------------------

echo "<h2>6. Type Hint Enforcement</h2>";

// Define a class that DOES NOT implement the interface
class Report {}

$report = new Report();

echo "<p>Attempting to call <code>processPayment(\$report)</code>...</p>";
echo "<p style='color: red;'>❌ **FATAL ERROR/TYPE ERROR:** If you run this line, PHP will throw a 
<code>TypeError</code> because the <code>Report</code> class does not implement the 
<code>Payable</code> interface, enforcing the contract at runtime.</p>";
// Uncomment the line below to see the TypeError:
// processPayment($report); 

?>