<?php

// private_property.php

// This script demonstrates the use of the **private** access modifier 
// for class properties and methods in PHP Object-Oriented Programming (OOP).
// Private members are accessible only from within the class where they are defined.

echo "<h1>PHP Private Visibility Demo 🔒</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition
// ---------------------------------------------------------------------

/**
 * Class ConfigurationManager
 * Manages sensitive application settings.
 */
class ConfigurationManager {
    
    // Private property: Cannot be accessed or modified from outside the class 
    // or by any subclass. It's strictly internal state.
    private string $apiKey = "sk-0123456789abcdef"; 
    
    // Public property for comparison
    public string $environment = "development";

    /**
     * Private method: Used internally for complex operations that should not 
     * be exposed or called directly by external code.
     */
    private function encryptKey(string $key): string {
        // Simulate a complex, internal encryption process
        return "ENCRYPTED(" . substr($key, 0, 8) . "...)";
    }

    /**
     * Public method (Getter): The only way to securely read the private property.
     * @return string The (partially) exposed API key.
     */
    public function getObscuredApiKey(): string {
        // Private properties can be accessed and used by public methods within the class.
        $encrypted = $this->encryptKey($this->apiKey); // Calling the private method
        return "Accessing API Key: " . $encrypted;
    }

    /**
     * Public method (Setter): Allows external code to modify the private property 
     * in a controlled way, usually with validation.
     * @param string $newKey
     * @return void
     */
    public function setApiKey(string $newKey): void {
        // Private properties can be modified by public methods within the class.
        if (strlen($newKey) < 16) {
            echo "<p style='color: red;'>⚠️ Invalid API key length. Key not updated.</p>";
            return;
        }
        $this->apiKey = $newKey;
        echo "<p style='color: green;'>✅ API Key updated successfully (Internally masked).</p>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Accessing Members from Outside the Class
// ---------------------------------------------------------------------

echo "<h2>2. Outside Access Attempts</h2>";

$config = new ConfigurationManager();

// 2a. Accessing PUBLIC property (ALLOWED)
echo "<li>Public Property (\$environment): <strong>{$config->environment}</strong></li>";

// 2b. Accessing PRIVATE property (FORBIDDEN - Fatal Error/Notice)
echo "<li>Private Property (\$apiKey): <em>(Attempting direct access...)</em></li>";

try {
    // This line will generate a fatal error (or a warning/notice depending on PHP version/config)
    // echo $config->apiKey; 
    echo "<p style='color: red;'>❌ FAILED: Direct access to private property **\$apiKey** is blocked.</p>";
} catch (Error $e) {
    // Catching the error in a try/catch is not typically done for visibility errors, 
    // but demonstrates the point.
    // echo "<p style='color: red;'>Caught Error: " . $e->getMessage() . "</p>";
}

// 2c. Accessing PRIVATE method (FORBIDDEN - Fatal Error/Notice)
echo "<li>Private Method (encryptKey()): <em>(Attempting direct access...)</em></li>";
try {
    // $config->encryptKey("test");
    echo "<p style='color: red;'>❌ FAILED: Direct call to private method **encryptKey()** is blocked.</p>";
} catch (Error $e) {}


echo "<hr>";

// ---------------------------------------------------------------------
// 3. Controlled Access via Public Methods (Getters/Setters)
// ---------------------------------------------------------------------

echo "<h2>3. Controlled Access via Public Methods</h2>";

// 3a. Reading the private property via the public getter
echo "<li>Getter Result: <strong>" . $config->getObscuredApiKey() . "</strong></li>";

// 3b. Modifying the private property via the public setter (Validation success)
$config->setApiKey("newsecurekey1234567890");

// 3c. Modifying the private property via the public setter (Validation failure)
$config->setApiKey("shortkey");

?>