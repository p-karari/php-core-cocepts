<?php

// resolving_conflicts.php

// This script demonstrates how to resolve naming conflicts when a PHP class 
// uses multiple **Traits** that define methods or properties with the same name. 
// PHP provides the `insteadof` and `as` operators for this purpose.

echo "<h1>PHP Traits: Conflict Resolution Demo ⚔️</h1>";

// ---------------------------------------------------------------------
// 1. Define Conflicting Traits
// ---------------------------------------------------------------------

/**
 * Trait Logger
 * Provides a basic logging method.
 */
trait Logger {
    public function log(string $message): void {
        echo "<p style='color: blue;'>[LOGGER] Logged: {$message}</p>";
    }
}

/**
 * Trait Notifier
 * Provides a notification method which also happens to be called 'log'.
 */
trait Notifier {
    public function log(string $message): void {
        echo "<p style='color: brown;'>[NOTIFIER] Notified: {$message}</p>";
    }
}

// ---------------------------------------------------------------------
// 2. Class Definition with Conflict Resolution
// ---------------------------------------------------------------------

echo "<hr>";
echo "<h2>2. The Conflict</h2>";

/**
 * Class Service
 * Uses both Logger and Notifier, creating a conflict on the `log` method.
 * A fatal error would occur if no resolution is provided in the `use` statement.
 */
class Service {
    
    // PHP requires explicit conflict resolution here.
    use Logger, Notifier {
        // 2a. `insteadof`: Choose which implementation to use as the default `log` method.
        // We choose Logger's log implementation for the default call: $service->log()
        Logger::log insteadof Notifier;
        
        // 2b. `as`: Provide an alias for the excluded method to keep it accessible.
        // We rename the Notifier's log method to `notifyUser` to expose it under a new name.
        Notifier::log as notifyUser;
    }
    
    // Class-specific method that uses both resolved methods
    public function performTask(string $task): void {
        // Call the default (Logger) implementation
        $this->log("Task '{$task}' started."); 
        
        // Call the aliased (Notifier) implementation
        $this->notifyUser("Task '{$task}' is running."); 
    }
    
    // A class method can also override a trait method completely.
    public function log(string $message): void {
        echo "<p style='color: green;'>[SERVICE OVERRIDE] Task Status: {$message}</p>";
        // We can call the original Logger log method using the `parent::` syntax 
        // if we didn't override it, but since we did, we can just use the new logic.
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Usage and Verification
// ---------------------------------------------------------------------

echo "<h2>3. Usage of Resolved Methods</h2>";

$service = new Service();

// 3a. Calling the method defined in the Class (Overriding)
echo "<h3>Calling the Class's own `log()`:</h3>";
$service->log("System initialization complete."); // Calls Service::log()

echo "<hr>";

// 3b. Calling the aliased method (`Notifier::log` via `notifyUser`)
echo "<h3>Calling the Aliased Method (`notifyUser`):</h3>";
$service->notifyUser("The system is now live."); // Calls Notifier::log

echo "<hr>";

// 3c. Calling the method that uses both internally
echo "<h3>Calling the Wrapper Method (`performTask`):</h3>";
// This demonstrates the power of resolution inside the class:
// The call to $this->log will use Service::log (due to override).
// The call to $this->notifyUser will use Notifier::log (due to alias).
$service->performTask("Database Backup");

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Overriding Trait Methods
// ---------------------------------------------------------------------

echo "<h2>4. Overriding Trait Methods (No Resolution Needed)</h2>";

/**
 * Class Report
 * Completely overrides the `log` method from the Logger trait.
 */
class Report {
    use Logger;
    
    public function log(string $message): void {
        // Class method takes precedence over a trait method.
        echo "<p style='color: purple;'>[REPORT] Custom logging for report: {$message}</p>";
    }
}

$report = new Report();
$report->log("Generating end-of-day summary."); // Calls Report::log, ignoring Logger::log
echo "<p><em>The <code>Report::log()</code> method overrides the trait method by simply being defined in the class itself.</em></p>";
?>