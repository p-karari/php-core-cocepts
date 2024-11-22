<?php

// destructor_logging.php

// This script demonstrates the use of the destructor method (__destruct) 
// in a PHP class to perform crucial cleanup or logging tasks just before 
// an object is destroyed or the script execution finishes.

echo "<h1>PHP Destructor for Logging Demo 🗑️</h1>";

// Define the log file name
$log_file = "destructor_activity.log";

// ---------------------------------------------------------------------
// 1. Log Function (Helper)
// ---------------------------------------------------------------------

/**
 * A simple helper function to append a line to the external log file.
 */
function append_to_log(string $line): void {
    global $log_file;
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[{$timestamp}] {$line}" . PHP_EOL;
    // Use file_put_contents with FILE_APPEND and LOCK_EX for safe writing
    @file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}

// ---------------------------------------------------------------------
// 2. Class Definition with Destructor
// ---------------------------------------------------------------------

/**
 * Class SessionManager
 * Manages a user session and uses the destructor to log the session end.
 */
class SessionManager {
    
    private string $sessionId;
    private string $username;
    
    /**
     * Constructor: Initializes the object and logs the session start.
     */
    public function __construct(string $username) {
        $this->sessionId = uniqid('sess_', true);
        $this->username = $username;
        
        echo "<p style='color: green;'>✅ Session **{$this->sessionId}** started for user **{$this->username}**.</p>";
        append_to_log("INFO: Session {$this->sessionId} started for user {$this->username}.");
    }
    
    /**
     * Public method to perform some action.
     */
    public function performAction(string $action): void {
        echo "<p>➡️ Session **{$this->sessionId}** performing action: {$action}</p>";
        append_to_log("ACTION: Session {$this->sessionId} performed '{$action}'.");
    }
    
    // -----------------------------------------------------------------
    // The Destructor Method
    // -----------------------------------------------------------------
    /**
     * The destructor is automatically called when the object is explicitly 
     * destroyed (unset) or when the script terminates.
     */
    public function __destruct() {
        // Logging the session end is a classic use case for the destructor.
        $message = "INFO: Session {$this->sessionId} for user {$this->username} ended.";
        append_to_log($message);
        echo "<p style='color: brown;'>🗑️ **DESTRUCTOR:** Logged session end for **{$this->username}**.</p>";
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Script Execution and Object Lifecycle
// ---------------------------------------------------------------------

echo "<h2>3. Script Execution</h2>";

// 3a. Create the first object
$sessionA = new SessionManager("Alice");
$sessionA->performAction("View Profile");

// 3b. Create the second object
$sessionB = new SessionManager("Bob");
$sessionB->performAction("Update Settings");

echo "<hr>";

echo "<h2>4. Explicit Destruction (unset)</h2>";

// When an object is explicitly destroyed via `unset()`, the destructor runs immediately.
echo "<p>Calling <code>unset(\$sessionA)</code>...</p>";
unset($sessionA); // Destructor for $sessionA runs here

echo "<p>Code continues to run...</p>";

echo "<hr>";

// ---------------------------------------------------------------------
// 5. Implicit Destruction
// ---------------------------------------------------------------------

echo "<h2>5. Implicit Destruction (Script End)</h2>";

// The destructor for $sessionB will run here, just before the script fully exits, 
// as $sessionB goes out of scope/is garbage collected.

echo "<p><em>Script is about to finish. The destructor for **\$sessionB** will run now.</em></p>";

// ---------------------------------------------------------------------
// 6. Display Log File Content and Cleanup
// ---------------------------------------------------------------------

echo "<hr>";
echo "<h2>6. Final Log File Content</h2>";

if (file_exists($log_file)) {
    $content = file_get_contents($log_file);
    echo "<h3>Content of {$log_file}:</h3>";
    echo "<pre>" . htmlspecialchars($content) . "</pre>";
    
    // Clean up the log file
    unlink($log_file);
    echo "<p>🗑️ **Cleanup:** Deleted log file.</p>";
}
?>