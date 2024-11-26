<?php

// abstract_classes.php

// This script demonstrates **Abstract Classes** and **Abstract Methods** in PHP OOP.
// An abstract class cannot be instantiated directly and is designed only to be 
// inherited by subclasses. Abstract methods must be defined in the abstract class 
// but contain no body; they MUST be implemented by the first concrete (non-abstract) child class.

echo "<h1>PHP Abstract Classes Demo 🧩</h1>";

// ---------------------------------------------------------------------
// 1. Abstract Class Definition
// ---------------------------------------------------------------------

/**
 * abstract class DatabaseConnector
 * Cannot be instantiated. It defines the structure and common functionality 
 * for all database drivers (e.g., MySQL, PostgreSQL).
 */
abstract class DatabaseConnector {
    
    protected string $host;
    protected string $username;
    protected string $password;
    protected ?object $connection = null; // Can be null or an actual connection object
    
    public function __construct(string $host, string $username, string $password) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        echo "<p style='color: green;'>✅ Connector object partially initialized.</p>";
    }
    
    // 1a. Abstract Methods: Define the contract. 
    // They have no body (no {}) and MUST be implemented by concrete subclasses.
    abstract public function connect(): void;
    abstract public function disconnect(): void;
    abstract public function execute(string $sql): array;
    
    // 1b. Concrete Method: Implemented in the abstract class itself. 
    // This is shared logic for all subclasses.
    public function getStatus(): string {
        if ($this->connection) {
            return "Connected to {$this->host}.";
        } else {
            return "Disconnected.";
        }
    }
}

// ---------------------------------------------------------------------
// 2. Concrete Subclass Definition
// ---------------------------------------------------------------------

/**
 * class MySqlConnector
 * Must implement all abstract methods inherited from DatabaseConnector.
 */
class MySqlConnector extends DatabaseConnector {
    
    private string $dbName;
    
    public function __construct(string $host, string $username, string $password, string $dbName) {
        // Call the parent constructor
        parent::__construct($host, $username, $password);
        $this->dbName = $dbName;
    }
    
    // 2a. Implementation of the abstract connect() method
    public function connect(): void {
        // --- Simulated actual connection logic ---
        // $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
        $this->connection = (object)['driver' => 'MySQL', 'status' => 'active'];
        echo "<p style='color: blue;'>➡️ **MySQL** connection established to **{$this->dbName}**.</p>";
    }
    
    // 2b. Implementation of the abstract disconnect() method
    public function disconnect(): void {
        $this->connection = null; // Simulate closing the connection
        echo "<p style='color: brown;'>⬅️ **MySQL** connection closed.</p>";
    }
    
    // 2c. Implementation of the abstract execute() method
    public function execute(string $sql): array {
        if (!$this->connection) {
            trigger_error("Cannot execute query: Not connected.", E_USER_ERROR);
            return [];
        }
        // --- Simulated query execution ---
        echo "<p>SQL: <code>{$sql}</code> executed.</p>";
        return [['id' => 1, 'name' => 'Test Result']];
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Object Usage and Testing
// ---------------------------------------------------------------------

echo "<h2>3. Usage of Concrete Subclass (MySqlConnector)</h2>";

// 3a. Cannot instantiate the abstract class directly!
// $connector = new DatabaseConnector(...); // Fatal Error: Cannot instantiate abstract class DatabaseConnector

// 3b. Instantiate the concrete subclass
$mysql = new MySqlConnector("localhost", "root", "secret", "mydb");

// 3c. Call implemented abstract methods
$mysql->connect();
$result = $mysql->execute("SELECT * FROM users");

// 3d. Call inherited concrete method
echo "<li>Connection Status: <strong>" . $mysql->getStatus() . "</strong></li>";

echo "<hr>";

echo "<h2>4. Results and Disconnection</h2>";
echo "<h3>Query Results:</h3>";
echo "<pre>"; print_r($result); echo "</pre>";

$mysql->disconnect();
echo "<li>Connection Status: <strong>" . $mysql->getStatus() . "</strong></li>";
?>