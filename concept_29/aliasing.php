<?php

// aliasing.php

// This script demonstrates **Aliasing** in PHP Namespaces, which allows you to 
// assign a shorter, more convenient name (an alias) to a long class, function, 
// or constant name defined in a namespace. This is done using the **`use ... as`** syntax.

echo "<h1>PHP Namespace Aliasing Demonstration (use ... as) 🏷️</h1>";

// ---------------------------------------------------------------------
// 1. Defining Namespaced Elements
// ---------------------------------------------------------------------

// --- Namespace App\Utilities\Database ---
namespace App\Utilities\Database {
    
    // A class with a long FQN (Fully Qualified Name)
    class DatabaseConnectionManager {
        public function getStatus(): string {
            return "DB Manager: Connection is active.";
        }
    }
    
    // A constant
    const DEFAULT_TIMEOUT = 60;
}

// --- Namespace App\Utilities\Cache ---
namespace App\Utilities\Cache {
    
    // Another class with a potentially long name
    class CacheConfigurationLoader {
        public function loadSettings(): string {
            return "Cache Loader: Settings loaded successfully.";
        }
    }
    
    // A function
    function clearCache(): string {
        return "Cache cleared.";
    }
}

// ---------------------------------------------------------------------
// 2. Accessing and Aliasing Elements from the Global Scope
// ---------------------------------------------------------------------

// Switch back to the global namespace for execution.
namespace {
    
    echo "<hr>";
    echo "<h2>2. Aliasing Classes</h2>";

    // 2a. Direct FQN access (Verbose and repetitive)
    $dbManagerFQN = new \App\Utilities\Database\DatabaseConnectionManager();
    echo "<li>FQN Access: " . $dbManagerFQN->getStatus() . "</li>";

    // 2b. Aliasing the Database Manager
    // Alias the long class name to a short, meaningful name: `DBManager`
    use App\Utilities\Database\DatabaseConnectionManager as DBManager;
    
    // Aliasing the Cache Loader to avoid a long name: `CacheConfig`
    use App\Utilities\Cache\CacheConfigurationLoader as CacheConfig; 

    // Instantiate using the aliases
    $dbManager = new DBManager();
    $cacheLoader = new CacheConfig();
    
    echo "<li>Aliased DB Access: <strong>" . $dbManager->getStatus() . "</strong></li>";
    echo "<li>Aliased Cache Access: <strong>" . $cacheLoader->loadSettings() . "</strong></li>";

    echo "<hr>";

    // -----------------------------------------------------------------
    // 3. Aliasing Functions and Constants (PHP 5.6+)
    // -----------------------------------------------------------------

    echo "<h2>3. Aliasing Functions and Constants</h2>";
    
    // 3a. Aliasing a function
    // Alias the namespaced function `\App\Utilities\Cache\clearCache` to `flushCache`
    use function App\Utilities\Cache\clearCache as flushCache;
    
    // 3b. Aliasing a constant
    // Alias the namespaced constant `\App\Utilities\Database\DEFAULT_TIMEOUT` to `DB_TIMEOUT`
    use const App\Utilities\Database\DEFAULT_TIMEOUT as DB_TIMEOUT;

    // Use the aliased function
    echo "<li>Aliased Function Call: <strong>" . flushCache() . "</strong></li>";

    // Use the aliased constant
    echo "<li>Aliased Constant Value: <strong>" . DB_TIMEOUT . " seconds</strong></li>";
    
    echo "<hr>";
    
    // -----------------------------------------------------------------
    // 4. Aliasing to Resolve Conflicts
    // -----------------------------------------------------------------
    
    echo "<h2>4. Aliasing to Resolve Conflicts</h2>";

    // Imagine we had two classes both called `Timer` in different namespaces:
    
    // namespace App\Tools { class Timer {} }
    // namespace App\Billing { class Timer {} }
    
    // We can import both by aliasing one:
    
    // use App\Tools\Timer; // Imported as `Timer`
    // use App\Billing\Timer as BillingTimer; // Imported as `BillingTimer`
    
    // Since this file doesn't have the conflicting classes, we'll demonstrate aliasing 
    // to bring in a different element under the short name of another:
    
    use App\Utilities\Database\DatabaseConnectionManager; // Imported as `DatabaseConnectionManager`
    use App\Utilities\Cache\CacheConfigurationLoader; // Imported as `CacheConfigurationLoader`

    // Now, let's create a *second* alias for the Cache class just for fun:
    use App\Utilities\Cache\CacheConfigurationLoader as Loader;
    
    // Use the new short alias
    $loader = new Loader();
    echo "<li>Conflict Resolution Demo: Using second alias <strong>Loader</strong>: " . $loader->loadSettings() . "</li>";
}
?>