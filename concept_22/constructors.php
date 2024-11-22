<?php

// constructors.php

// This script demonstrates the use of constructors (__construct) in PHP classes, 
// including the traditional approach and the property promotion feature (PHP 8+).

echo "<h1>PHP Class Constructors Demonstration 🏗️</h1>";

// ---------------------------------------------------------------------
// 1. Traditional Constructor (Pre-PHP 8)
// ---------------------------------------------------------------------

echo "<h2>1. Traditional Constructor</h2>";

/**
 * Class ServerLog
 * Uses the traditional method to define properties and then assign them 
 * values inside the constructor.
 */
class ServerLog {
    
    public string $level;
    public string $message;
    public string $timestamp;

    /**
     * Traditional constructor: requires properties to be declared separately.
     */
    public function __construct(string $level, string $message) {
        // Assigning arguments to properties using $this
        $this->level = $level;
        $this->message = $message;
        $this->timestamp = date('Y-m-d H:i:s');
        
        echo "<p style='color: green;'>✅ Log entry initialized traditionally.</p>";
    }

    public function getLogEntry(): string {
        return "[{$this->timestamp}] [{$this->level}] {$this->message}";
    }
}

// Create an object using the traditional constructor
$logEntry1 = new ServerLog("ERROR", "File not found.");

echo "<li>Log Entry 1: <strong>" . $logEntry1->getLogEntry() . "</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 2. Constructor Property Promotion (PHP 8.0+)
// ---------------------------------------------------------------------

echo "<h2>2. Constructor Property Promotion (PHP 8+)</h2>";

/**
 * Class APIClient
 * Uses constructor property promotion to combine property declaration, 
 * access modification, and assignment in a single constructor signature.
 */
class APIClient {
    
    // Properties are NOT declared outside the constructor.

    /**
     * Constructor using Property Promotion.
     * Declaring the access modifier (public/protected/private) directly in the 
     * constructor arguments turns them into properties of the class.
     * @param string $api_key The client's secret API key (private).
     * @param string $endpoint The base API URL (protected).
     * @param int $timeout The connection timeout (public).
     */
    public function __construct(
        private string $api_key, 
        protected string $endpoint,
        public int $timeout = 30 // Can also have default values
    ) {
        // No need for $this->api_key = $api_key; etc. PHP does it automatically.
        echo "<p style='color: green;'>✅ API Client initialized with property promotion.</p>";
    }

    public function getBaseUrl(): string {
        // Accessing the protected property from inside the class
        return "Connecting to: {$this->endpoint}";
    }
    
    public function getTimeout(): string {
        // Accessing the public property
        return "Timeout set to: {$this->timeout} seconds";
    }

    // Since $this->api_key is private, we can't display it directly here without a getter.
}

// Create an object using property promotion
$client1 = new APIClient("secret-xyz-123", "https://api.service.com/v1");

echo "<li>Client 1: <strong>" . $client1->getBaseUrl() . "</strong></li>";
echo "<li>Client 1: <strong>" . $client1->getTimeout() . "</strong></li>";
// echo $client1->api_key; // This would cause a fatal error as api_key is private.

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Nullable and Type-Hinted Constructor Arguments
// ---------------------------------------------------------------------

echo "<h2>3. Nullable Arguments</h2>";

/**
 * Class UserProfile
 * Demonstrates nullable type hints for optional arguments.
 */
class UserProfile {
    // Note the `?` before the type to allow null
    public function __construct(
        public int $user_id,
        public ?string $bio = null // Bio is optional and can be null
    ) {
        echo "<p style='color: green;'>✅ User Profile initialized.</p>";
    }
}

$userA = new UserProfile(101);
$userB = new UserProfile(102, "Loves PHP and OOP.");

echo "<li>User A Bio: <strong>" . var_export($userA->bio, true) . "</strong></li>";
echo "<li>User B Bio: <strong>{$userB->bio}</strong></li>";

?>