<?php

// interfaces.php

// This script demonstrates **Interfaces** in PHP OOP.
// An interface defines a contract: it specifies which methods a class must implement, 
// but not how those methods are implemented. This enforces structure and 
// enables loose coupling via Polymorphism.

echo "<h1>PHP Interfaces Demonstration 📜</h1>";

// ---------------------------------------------------------------------
// 1. Interface Definition (The Contract)
// ---------------------------------------------------------------------

/**
 * Interface LoggerInterface
 * Defines the contract for any class that is intended to log messages.
 */
interface LoggerInterface {
    
    // Interface methods must be public and cannot contain a body (no {}).
    public function log(string $message, string $level): void;
    
    public function retrieveLogs(int $limit): array;
}

/**
 * Interface Configurable
 * Defines a contract for any class that can be configured.
 */
interface Configurable {
    public function setConfig(array $config): void;
    public function getConfig(): array;
}

// ---------------------------------------------------------------------
// 2. Concrete Class 1 (Implementing a Single Interface)
// ---------------------------------------------------------------------

/**
 * Class FileLogger
 * Implements the LoggerInterface. It MUST define all methods specified 
 * in the interface with the exact same signature (parameters and return type).
 */
class FileLogger implements LoggerInterface {
    
    private string $filePath = "app.log";
    
    // Required implementation of log()
    public function log(string $message, string $level): void {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
        // Simulate writing to a file
        // file_put_contents($this->filePath, $logEntry, FILE_APPEND);
        echo "<p style='color: blue;'>➡️ **FileLogger** wrote: {$logEntry}</p>";
    }
    
    // Required implementation of retrieveLogs()
    public function retrieveLogs(int $limit): array {
        echo "<p>Retrieving up to {$limit} entries from file...</p>";
        // Simulation
        return ["Log 1", "Log 2", "Log 3"];
    }
}

// ---------------------------------------------------------------------
// 3. Concrete Class 2 (Implementing Multiple Interfaces)
// ---------------------------------------------------------------------

/**
 * Class DatabaseLogger
 * Implements both LoggerInterface and Configurable. 
 * It MUST implement all methods from both interfaces.
 */
class DatabaseLogger implements LoggerInterface, Configurable {
    
    private array $configuration = [];

    // Implementation of setConfig() from Configurable
    public function setConfig(array $config): void {
        $this->configuration = $config;
        echo "<p style='color: green;'>✅ **DBLogger** configured with host: {$config['host']}</p>";
    }
    
    // Implementation of getConfig() from Configurable
    public function getConfig(): array {
        return $this->configuration;
    }
    
    // Implementation of log() from LoggerInterface
    public function log(string $message, string $level): void {
        if (empty($this->configuration)) {
            echo "<p style='color: red;'>❌ DBLogger not configured. Cannot log.</p>";
            return;
        }
        // Simulate database insertion
        echo "<p style='color: blue;'>➡️ **DatabaseLogger** inserted [{$level}] log to {$this->configuration['host']}.</p>";
    }

    // Implementation of retrieveLogs() from LoggerInterface
    public function retrieveLogs(int $limit): array {
        echo "<p>Querying database for up to {$limit} log entries...</p>";
        return ["DB Log A", "DB Log B"];
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Polymorphism and Usage
// ---------------------------------------------------------------------

echo "<h2>4. Polymorphism and Usage</h2>";

// 4a. Function expecting an interface type
function processLog(LoggerInterface $logger): void {
    $logger->log("User login attempt.", "INFO");
    $logs = $logger->retrieveLogs(5);
    echo "<li>Processed logs count: " . count($logs) . "</li>";
}

// 4b. Use FileLogger (Type-hinting works because it implements the interface)
echo "<h3>Using FileLogger:</h3>";
$fileLogger = new FileLogger();
processLog($fileLogger);

echo "<hr>";

// 4c. Use DatabaseLogger
echo "<h3>Using DatabaseLogger:</h3>";
$dbLogger = new DatabaseLogger();

// DatabaseLogger can be configured because it implements Configurable
$dbLogger->setConfig(['host' => 'prod-db', 'user' => 'admin']);

// DatabaseLogger can be passed to processLog because it implements LoggerInterface
processLog($dbLogger);

// 4d. Verification
if ($dbLogger instanceof Configurable) {
    echo "<p>✅ DBLogger also fulfills the Configurable contract.</p>";
}
?>