<?php

// dependency_injection.php

// This script demonstrates **Dependency Injection (DI)**, a design pattern 
// where the dependencies (objects that a class needs to function) are 
// "injected" into the class rather than being created by the class itself. 
// This greatly improves flexibility, testability, and maintainability.

echo "<h1>PHP Dependency Injection (DI) Demo 💉</h1>";
echo "<p>DI ensures components are loosely coupled by providing dependencies 
externally, usually via the constructor (Constructor Injection).</p>";

// ---------------------------------------------------------------------
// 1. Dependency Interface
// ---------------------------------------------------------------------
// Define an interface for the service that the main class depends on. 
// This makes the system flexible, as any class implementing this interface 
// can be used.

interface LoggerInterface {
    public function log(string $message): void;
}

echo "<h2>1. Dependency: Logger Interface</h2>";

// ---------------------------------------------------------------------
// 2. Concrete Dependency Classes
// ---------------------------------------------------------------------

/**
 * Class FileLogger
 * A concrete implementation of the LoggerInterface.
 */
class FileLogger implements LoggerInterface {
    public function log(string $message): void {
        $timestamp = date('Y-m-d H:i:s');
        // In a real app, this would write to a log file.
        echo "<p style='color: brown;'>[FILE LOG {$timestamp}] {$message}</p>";
    }
}

/**
 * Class DatabaseLogger
 * Another concrete implementation for a different logging strategy.
 */
class DatabaseLogger implements LoggerInterface {
    public function log(string $message): void {
        // In a real app, this would insert a record into a database table.
        echo "<p style='color: blue;'>[DB LOG] Inserting log entry: {$message}</p>";
    }
}

echo "<h2>2. Concrete Dependencies (FileLogger, DatabaseLogger)</h2>";
echo "<hr>";

// ---------------------------------------------------------------------
// 3. Dependent Class (The Client)
// ---------------------------------------------------------------------

/**
 * Class UserService
 * This class needs a Logger to record its actions.
 */
class UserService {
    
    // The dependency is type-hinted to the interface, not a concrete class.
    private LoggerInterface $logger;
    
    // **Constructor Injection** (The most common form of DI)
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
        echo "<p>✅ UserService created and injected with a <strong>" . get_class($logger) . "</strong>.</p>";
    }
    
    public function createUser(string $username): void {
        // ... imagine database insertion logic here ...
        
        $logMessage = "User '{$username}' successfully created.";
        
        // Use the injected dependency
        $this->logger->log($logMessage);
    }
}

echo "<h2>3. Dependent Class: UserService (The Client)</h2>";
echo "<hr>";

// ---------------------------------------------------------------------
// 4. Instantiation and Injection (The Composition Root)
// ---------------------------------------------------------------------

echo "<h2>4. Usage: Injecting Dependencies</h2>";

// 4a. Use the FileLogger implementation
$fileLogger = new FileLogger();
// Inject the FileLogger instance into the UserService
$userService1 = new UserService($fileLogger); 

$userService1->createUser("Alice");

echo "<hr>";

// 4b. Use the DatabaseLogger implementation
$dbLogger = new DatabaseLogger();
// Inject the DatabaseLogger instance into a NEW UserService
$userService2 = new UserService($dbLogger);

$userService2->createUser("Bob");

echo "<hr>";

echo "<h2>Conclusion</h2>";
echo "<p>The <code>UserService</code> is highly flexible. We can switch between 
<code>FileLogger</code> and <code>DatabaseLogger</code> without changing a single 
line of code inside the <code>UserService</code> class itself, achieving 
<strong>Inversion of Control</strong>.</p>";

?>