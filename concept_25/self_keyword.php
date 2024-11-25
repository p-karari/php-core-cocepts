<?php

// self_keyword.php

// This script demonstrates the use of the **`self`** keyword in PHP OOP.
// `self` is used to refer to the class itself from within the class, 
// primarily to access **static** members (properties and methods) and 
// **class constants**.

echo "<h1>PHP `self` Keyword Demonstration 🏷️</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition with Static Members and Constants
// ---------------------------------------------------------------------

/**
 * Class Configuration
 * Holds and manages application-wide static settings.
 */
class Configuration {
    
    // 1a. Class Constants (fixed values)
    const DEFAULT_TIMEOUT = 30;
    const MAX_RETRIES = 5;
    
    // 1b. Static Properties (shared state)
    private static string $environment = "development";
    private static int $instanceCount = 0;
    
    public function __construct() {
        // Accessing and modifying a static property from an instance method
        // Use `self::` to refer to the static property of the class.
        self::$instanceCount++; 
        echo "<p style='color: green;'>✅ Configuration instance created. (Total instances: " . self::$instanceCount . ")</p>";
    }
    
    // -----------------------------------------------------------------
    // 1c. Instance Method: Accessing Static Members and Constants
    // -----------------------------------------------------------------
    
    public function displaySettings(): void {
        echo "<h3>Instance ID: {$this->getInstanceId()}</h3>";
        
        // Accessing a Class Constant using `self::CONSTANT_NAME`
        $timeout = self::DEFAULT_TIMEOUT;
        $retries = self::MAX_RETRIES;
        
        // Accessing a Static Property using `self::$propertyName`
        $env = self::$environment;
        
        echo "<ul>";
        echo "<li>Environment (Static Property): <strong>{$env}</strong></li>";
        echo "<li>Default Timeout (Constant): <strong>{$timeout} seconds</strong></li>";
        echo "<li>Max Retries (Constant): <strong>{$retries}</strong></li>";
        echo "</ul>";
    }
    
    private function getInstanceId(): string {
        // This is an instance-specific property, so it uses `$this->`
        return spl_object_hash($this);
    }
    
    // -----------------------------------------------------------------
    // 1d. Static Method: Accessing Static Members and Constants
    // -----------------------------------------------------------------
    
    /**
     * Static method to change the shared environment.
     * @param string $newEnv
     */
    public static function setEnvironment(string $newEnv): void {
        // Accessing static property from a static method using `self::`
        self::$environment = $newEnv;
        echo "<p style='color: blue;'>➡️ **STATIC:** Environment changed to <strong>{$newEnv}</strong>.</p>";
    }
    
    /**
     * Static method to retrieve a constant.
     * @return int
     */
    public static function getMaxRetriesConstant(): int {
        // Accessing constant from a static method using `self::`
        return self::MAX_RETRIES;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Usage and Demonstration
// ---------------------------------------------------------------------

echo "<h2>2. Object Usage (Accessing `self` via Instance)</h2>";

// 2a. Create the first instance (counter = 1)
$config1 = new Configuration();
$config1->displaySettings();

// 2b. Create the second instance (counter = 2)
$config2 = new Configuration();
$config2->displaySettings();

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Static Usage (Modifying Shared State)
// ---------------------------------------------------------------------

echo "<h2>3. Static Access (Modifying Shared State)</h2>";

// Use the static method to change the shared environment setting
Configuration::setEnvironment("production");

// The `self::$environment` is changed for the entire class.
echo "<li>Max Retries (via static method): <strong>" . Configuration::getMaxRetriesConstant() . "</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Verification
// ---------------------------------------------------------------------

echo "<h2>4. Verification (New state reflected in all instances)</h2>";

// The change is reflected in all instances, as $environment is a static property.
echo "<h3>Config 1 Verification:</h3>";
$config1->displaySettings();

echo "<h3>Config 2 Verification:</h3>";
$config2->displaySettings();

?>