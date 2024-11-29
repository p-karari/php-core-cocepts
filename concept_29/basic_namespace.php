<?php

// basic_namespace.php

// This script demonstrates the most basic usage of namespaces in PHP: 
// defining a namespace, defining a class within it, and accessing that 
// class from the global scope.

echo "<h1>PHP Basic Namespace Demonstration 🚀</h1>";

// ---------------------------------------------------------------------
// 1. Define the Namespace and Class
// ---------------------------------------------------------------------

/**
 * Declares the start of the `MyApp\Tools` namespace. 
 * All code below this declaration (until another namespace declaration or the 
 * end of the file) belongs to this namespace.
 */
namespace MyApp\Tools {
    
    /**
     * Class Validator
     * A utility class for data validation within the application.
     */
    class Validator {
        
        public function isValidEmail(string $email): bool {
            // A basic check to simulate validation logic
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }
        
        public function getNamespace(): string {
            // The __NAMESPACE__ magic constant returns the current namespace.
            return __NAMESPACE__;
        }
    }
    
    // You can also define functions and constants within a namespace.
    const VERSION = "1.0.0";
    
    function logMessage(string $message): void {
        echo "<p style='color: blue;'>[LOG: " . date('H:i:s') . "] {$message}</p>";
    }
}

// ---------------------------------------------------------------------
// 2. Accessing the Namespaced Elements from the Global Scope
// ---------------------------------------------------------------------

// This code is now outside the `MyApp\Tools` block and defaults back to the 
// global namespace.

echo "<hr>";
echo "<h2>2. Accessing Namespaced Elements</h2>";

// 2a. Accessing the Class (Fully Qualified Name - FQN)
// To access the class, we must use its **Fully Qualified Name (FQN)**: 
// \Namespace\SubNamespace\ClassName
$validator = new \MyApp\Tools\Validator();

$testEmail1 = "test@example.com";
$testEmail2 = "invalid-email";

echo "<li>Testing Email '{$testEmail1}': " . ($validator->isValidEmail($testEmail1) ? "✅ Valid" : "❌ Invalid") . "</li>";
echo "<li>Testing Email '{$testEmail2}': " . ($validator->isValidEmail($testEmail2) ? "✅ Valid" : "❌ Invalid") . "</li>";
echo "<li>Validator's Namespace: <strong>" . $validator->getNamespace() . "</strong></li>";

// 2b. Accessing the Constant
echo "<li>Namespace Constant (\MyApp\Tools\VERSION): <strong>" . \MyApp\Tools\VERSION . "</strong></li>";

// 2c. Accessing the Function
\MyApp\Tools\logMessage("Validation routine finished.");

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Using the `use` Keyword (Aliasing for Convenience)
// ---------------------------------------------------------------------

echo "<h2>3. Using the `use` Keyword (Importing)</h2>";

/**
 * The `use` keyword imports a class into the current file's namespace 
 * (in this case, the global namespace), allowing access without the FQN.
 */
use MyApp\Tools\Validator;
use function MyApp\Tools\logMessage; // Import function (PHP 5.6+)
use const MyApp\Tools\VERSION as TOOL_VERSION; // Import constant with alias (PHP 5.6+)

// Now, we can instantiate the class using its short name.
$shortValidator = new Validator();
echo "<li>Short Name Access: " . ($shortValidator->isValidEmail("new@valid.com") ? "✅ Valid" : "❌ Invalid") . "</li>";

// Use imported function and constant
logMessage("Testing complete using short names.");
echo "<li>Aliased Constant (TOOL_VERSION): <strong>" . TOOL_VERSION . "</strong></li>";

?>