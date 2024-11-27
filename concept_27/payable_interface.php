<?php

// payable_interface.php

// This script demonstrates the use of a PHP **Interface** to define a 
// "payable" contract. Any class that implements this interface promises 
// to provide the methods necessary for processing a payment or calculating 
// a total amount owed.

echo "<h1>PHP Payable Interface Demo 💰</h1>";

// ---------------------------------------------------------------------
// 1. Interface Definition (The Contract)
// ---------------------------------------------------------------------

/**
 * Interface Payable
 * Enforces methods required for any entity that involves financial transactions.
 */
interface Payable {
    
    // Method to calculate the total amount due, usually including taxes, fees, etc.
    public function getPayableAmount(): float;
    
    // Method to return a descriptive identifier for the transaction (e.g., an order number).
    public function getPaymentReference(): string;
    
    // Method to process the payment (implementation varies).
    public function processPayment(float $amountPaid): bool;
}

// ---------------------------------------------------------------------
// 2. Concrete Class 1: Order (A Payable Entity)
// ---------------------------------------------------------------------

/**
 * Class Order
 * Implements the Payable interface to handle order payments.
 */
class Order implements Payable {
    
    private int $orderId;
    private float $subtotal;
    private float $taxRate = 0.10; // 10% tax
    
    public function __construct(int $id, float $subtotal) {
        $this->orderId = $id;
        $this->subtotal = $subtotal;
        echo "<p style='color: green;'>✅ Order #{$id} created (Subtotal: \${$subtotal}).</p>";
    }
    
    // Implementation of the Payable methods:
    
    public function getPayableAmount(): float {
        // Calculate total amount including tax
        $total = $this->subtotal * (1 + $this->taxRate);
        return round($total, 2);
    }
    
    public function getPaymentReference(): string {
        return "ORDER-{$this->orderId}";
    }
    
    public function processPayment(float $amountPaid): bool {
        $requiredAmount = $this->getPayableAmount();
        if ($amountPaid >= $requiredAmount) {
            echo "<p style='color: blue;'>➡️ **Payment SUCCESSFUL** for Ref: {$this->getPaymentReference()}. Amount: \${$amountPaid} (Required: \${$requiredAmount}).</p>";
            return true;
        }
        echo "<p style='color: red;'>❌ **Payment FAILED**. Insufficient amount paid: \${$amountPaid} (Required: \${$requiredAmount}).</p>";
        return false;
    }
}

// ---------------------------------------------------------------------
// 3. Concrete Class 2: Subscription (Another Payable Entity)
// ---------------------------------------------------------------------

/**
 * Class Subscription
 * Implements the Payable interface to handle recurring subscription fees.
 */
class Subscription implements Payable {
    
    private string $userId;
    private float $monthlyFee;
    
    public function __construct(string $userId, float $monthlyFee) {
        $this->userId = $userId;
        $this->monthlyFee = $monthlyFee;
        echo "<p style='color: green;'>✅ Subscription for User **{$userId}** created (Fee: \${$monthlyFee}).</p>";
    }
    
    // Implementation of the Payable methods:
    
    public function getPayableAmount(): float {
        // Subscription is a flat fee
        return $this->monthlyFee;
    }
    
    public function getPaymentReference(): string {
        return "SUB-{$this->userId}-" . date('Ym');
    }
    
    public function processPayment(float $amountPaid): bool {
        $requiredAmount = $this->getPayableAmount();
        if ($amountPaid == $requiredAmount) {
            echo "<p style='color: blue;'>➡️ **Subscription Payment SUCCESSFUL** for Ref: {$this->getPaymentReference()}.</p>";
            return true;
        }
        echo "<p style='color: red;'>❌ **Subscription Payment FAILED**. Incorrect amount.</p>";
        return false;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Polymorphism (Function expecting a Payable Interface)
// ---------------------------------------------------------------------

echo "<h2>4. Polymorphic Payment Processor</h2>";

/**
 * Function that can process payments for ANY object implementing Payable.
 * @param Payable $entity The entity (Order, Subscription, Invoice, etc.)
 */
function runPaymentProcessor(Payable $entity): void {
    $reference = $entity->getPaymentReference();
    $amount = $entity->getPayableAmount();
    
    echo "<h3>Processing Payment for Reference: {$reference}</h3>";
    echo "<li>Required Amount: <strong>\${$amount}</strong></li>";
    
    // Simulate payment attempt: paying exactly the required amount
    $entity->processPayment($amount); 
}

// 4a. Process the Order
$customerOrder = new Order(5501, 89.99);
runPaymentProcessor($customerOrder);

echo "<hr>";

// 4b. Process the Subscription
$userSubscription = new Subscription("user42", 19.99);
runPaymentProcessor($userSubscription);

?>