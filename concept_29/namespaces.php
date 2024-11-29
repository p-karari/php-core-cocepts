<?php

// namespaces.php

// This script demonstrates **Namespaces** in PHP. Namespaces are essential 
// for organizing code and preventing naming collisions when combining different 
// libraries or large application modules.

echo "<h1>PHP Namespaces Demonstration 🌌</h1>";

// ---------------------------------------------------------------------
// 1. Defining Namespaces
// ---------------------------------------------------------------------

// --- Namespace App\Database ---

namespace App\Database {
    
    // Class defined within the App\Database namespace
    class Connection {
        public function connect(): string {
            return "Database connection established.";
        }
    }
    
    // Function defined within the App\Database namespace
    function getConnectionStatus(): string {
        return "Database status: UP";
    }
    
    // Constant defined within the App\Database namespace
    const DEFAULT_HOST = "db.local";
}

// --- Namespace App\Cache ---

namespace App\Cache {
    
    // Class defined within the App\Cache namespace (Note the class name conflict with \App\Database\Connection)
    class Connection {
        public function connect(): string {
            return "Cache connection established (Redis/Memcached).";
        }
    }
    
    // Function defined within the App\Cache namespace
    function getConnectionStatus(): string {
        return "Cache status: READY";
    }
    
    // Constant defined within the App\Cache namespace
    const DEFAULT_HOST = "cache.local";
}

// ---------------------------------------------------------------------
// 2. Global Code (Executing Context)
// ---------------------------------------------------------------------

// Reset the namespace context to the global namespace for execution.
namespace {
    
    echo "<hr>";
    echo "<h2>2. Accessing Namespaced Elements (Fully Qualified Names)</h2>";

    // 2a. Accessing Classes
    // Use the Fully Qualified Name (FQN) to explicitly reference classes.
    $dbConn = new \App\Database\Connection();
    $cacheConn = new \App\Cache\Connection();

    echo "<li>Database Connection: <strong>" . $dbConn->connect() . "</strong></li>";
    echo "<li>Cache Connection: <strong>" . $cacheConn->connect() . "</strong></li>";
    
    // The namespace successfully allowed two classes named 'Connection' to coexist!

    // 2b. Accessing Functions
    echo "<li>Database Status: <strong>" . \App\Database\getConnectionStatus() . "</strong></li>";
    echo "<li>Cache Status: <strong>" . \App\Cache\getConnectionStatus() . "</strong></li>";

    // 2c. Accessing Constants
    echo "<li>Database Host Constant: <strong>" . \App\Database\DEFAULT_HOST . "</strong></li>";
    echo "<li>Cache Host Constant: <strong>" . \App\Cache\DEFAULT_HOST . "</strong></li>";
    
    echo "<hr>";

    // -----------------------------------------------------------------
    // 3. Using the `use` Keyword (Aliasing)
    // -----------------------------------------------------------------

    echo "<h2>3. Using the `use` Keyword (Aliasing)</h2>";
    
    // Use the `use` keyword to import a class and give it a shorter alias (or its original name).
    use App\Database\Connection as DbConnection;
    use App\Cache\Connection as CacheConnection;
    // You can also import functions and constants with use (PHP 5.6+)
    use function App\Database\getConnectionStatus as getDbStatus;
    use const App\Cache\DEFAULT_HOST as CACHE_HOST;

    $dbConnAliased = new DbConnection();
    $cacheConnAliased = new CacheConnection();
    
    echo "<li>Aliased DB Connection: <strong>" . $dbConnAliased->connect() . "</strong></li>";
    echo "<li>Aliased Cache Connection: <strong>" . $cacheConnAliased->connect() . "</strong></li>";
    
    // Use aliased function and constant
    echo "<li>Aliased DB Status: <strong>" . getDbStatus() . "</strong></li>";
    echo "<li>Aliased Cache Host: <strong>" . CACHE_HOST . "</strong></li>";

    echo "<hr>";
    
    // -----------------------------------------------------------------
    // 4. Namespaced Code in Current File
    // -----------------------------------------------------------------
    
    echo "<h2>4. Defining a Class in the Global Namespace</h2>";
    
    // The current code is in the global namespace (because of `namespace { ... }`).
    class GlobalConfig {
        public const VERSION = "1.0";
    }
    
    // The GlobalConfig is accessed directly without a namespace prefix.
    echo "<li>Global Config Version: <strong>" . GlobalConfig::VERSION . "</strong></li>";
    
    echo "<p><em>Namespaces are typically defined in separate files (one namespace per file) 
    and then imported using <code>use</code>, as demonstrated here.</em></p>";
}
?>