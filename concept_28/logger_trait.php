<?php

// logger_trait.php

// This script demonstrates creating and using a **Logger Trait**. A trait is an 
// excellent mechanism to inject logging functionality into multiple, otherwise 
// unrelated classes without using inheritance.

echo "<h1>PHP Logger Trait Demo 🪵</h1>";

// ---------------------------------------------------------------------
// 1. Define the Logger Trait
// ---------------------------------------------------------------------

/**
 * Trait SimpleLogger
 * Provides a standardized way for any class to log messages.
 */
trait SimpleLogger {
    
    // A trait can define properties that are added to the consuming class.
    private string $logPrefix = "APP"; 

    /**
     * Common logging method shared by all classes that use this trait.
     * @param string $message The message to log.
     * @param string $level The severity level (INFO, WARNING, ERROR).
     * @return void
     */
    protected function log(string $message, string $level = 'INFO'): void {
        $timestamp = date('H:i:s');
        
        // Accessing the private property defined in the trait
        $output = "[{$this->logPrefix} | {$timestamp}] [{$level}] {$message}";
        
        // In a real application, this would write to a file, database, or external service.
        echo "<p style='color: " . $this->getLogColor($level) . ";'>{$output}</p>";
    }
    
    /**
     * Internal helper method for formatting (can also be private/protected).
     */
    private function getLogColor(string $level): string {
        return match (strtoupper($level)) {
            'ERROR' => 'red',
            'WARNING' => 'orange',
            default => 'green',
        };
    }
}

// ---------------------------------------------------------------------
// 2. Class 1: DataProcessor (Uses the trait)
// ---------------------------------------------------------------------

/**
 * Class DataProcessor
 * Uses the SimpleLogger trait to log processing steps.
 */
class DataProcessor {
    // Use the `use` keyword to incorporate the trait's members.
    use SimpleLogger; 

    public function process(array $data): void {
        $count = count($data);
        
        // The log() method is now available as if it were defined in DataProcessor.
        $this->log("Starting processing of {$count} items.", 'INFO');
        
        if ($count === 0) {
            $this->log("No data received. Exiting early.", 'WARNING');
            return;
        }
        
        // Simulate a long operation
        sleep(1);
        
        $this->log("Data integrity checks complete.", 'DEBUG');
    }
}

// ---------------------------------------------------------------------
// 3. Class 2: PaymentGateway (Uses the same trait)
// ---------------------------------------------------------------------

/**
 * Class PaymentGateway
 * Uses the same SimpleLogger trait for transactional logging.
 */
class PaymentGateway {
    use SimpleLogger;
    
    // This class sets the logPrefix property that was defined in the trait.
    // Since the property is not private in the trait, it can be defined here 
    // to override the default value ("APP").
    private string $logPrefix = "PAYMENT"; 

    public function charge(float $amount, string $customer): bool {
        $this->log("Initiating charge of \${$amount} for {$customer}.", 'INFO');
        
        if ($amount > 1000) {
            $this->log("High-value transaction detected for {$customer}.", 'WARNING');
        }
        
        // Simulate a failure
        if (rand(1, 10) === 1) {
            $this->log("Transaction failed due to gateway timeout.", 'ERROR');
            return false;
        }
        
        $this->log("Charge successful. Transaction ID: " . uniqid(), 'INFO');
        return true;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Usage and Code Reuse
// ---------------------------------------------------------------------

echo "<h2>4. Usage of Classes with the Logger Trait</h2>";

// 4a. Use the DataProcessor
$processor = new DataProcessor();
$processor->process([1, 2, 3]);

echo "<hr>";

// 4b. Use the PaymentGateway
$gateway = new PaymentGateway();
$gateway->charge(50.00, "Alice");
$gateway->charge(1250.00, "Bob"); // Triggers the high-value warning

echo "<p><em>Both classes gained logging functionality from the single <code>SimpleLogger</code> trait, demonstrating efficient code reuse without deep inheritance.</em></p>";
?>