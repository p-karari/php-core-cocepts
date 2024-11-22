<?php

// constructor_init.php

// This script demonstrates the primary role of the __construct() method 
// in PHP classes: **initializing object properties** upon instantiation.

echo "<h1>PHP Constructor Initialization Demo ⚙️</h1>";

// ---------------------------------------------------------------------
// 1. Class Definition
// ---------------------------------------------------------------------

/**
 * Class Configuration
 * Represents settings that must be set when the object is created.
 */
class Configuration {
    
    // Properties with type declarations
    public string $environment;
    public string $databaseHost;
    private int $maxConnections;
    
    // -----------------------------------------------------------------
    // The Constructor
    // -----------------------------------------------------------------
    /**
     * Initializes the object's properties using values passed as arguments.
     * This is crucial for ensuring the object starts in a valid and usable state.
     *
     * @param string $env The application environment (e.g., 'dev', 'prod').
     * @param string $host The database server address.
     * @param int $maxConn The maximum number of database connections allowed.
     */
    public function __construct(string $env, string $host, int $maxConn) {
        // 1. Assigning argument values to the object's properties
        $this->environment = $env;
        $this->databaseHost = $host;
        
        // 2. Performing internal setup/validation before assignment (for private property)
        $this->maxConnections = $this->validateConnections($maxConn);
        
        echo "<p style='color: green;'>✅ Configuration object initialized for <strong>{$this->environment}</strong>.</p>";
    }
    
    /**
     * Internal method for validation.
     * @param int $maxConn
     * @return int
     */
    private function validateConnections(int $maxConn): int {
        return max(1, $maxConn); // Ensure at least 1 connection
    }

    // -----------------------------------------------------------------
    // Public Accessors (Getters)
    // -----------------------------------------------------------------
    
    public function getMaxConnections(): int {
        return $this->maxConnections;
    }
    
    public function displaySettings(): void {
        echo "<ul>";
        echo "<li>Environment: <strong>{$this->environment}</strong></li>";
        echo "<li>Database Host: <strong>{$this->databaseHost}</strong></li>";
        echo "<li>Max Connections: <strong>{$this->getMaxConnections()}</strong></li>";
        echo "</ul>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Instantiating Objects and Initialization
// ---------------------------------------------------------------------

echo "<h2>2. Creating Objects with Initial Data</h2>";

// 2a. Development Configuration
// The constructor receives the values and assigns them immediately.
$dev_config = new Configuration("development", "localhost:3306", 10); 
echo "<h3>Development Config:</h3>";
$dev_config->displaySettings();

echo "<hr>";

// 2b. Production Configuration
// A separate object with different state values.
$prod_config = new Configuration("production", "db.prod.aws.com", 100); 
echo "<h3>Production Config:</h3>";
$prod_config->displaySettings();

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Testing Initialization Logic
// ---------------------------------------------------------------------

echo "<h2>3. Testing Initialization with Invalid Input</h2>";

// Pass a potentially invalid connection count (0) to test the validation in the constructor.
$test_config = new Configuration("test", "test.db", 0);
echo "<h3>Test Config:</h3>";
$test_config->displaySettings();
echo "<p><em>The constructor's validation ensured Max Connections was initialized to 1 instead of 0.</em></p>";

?>