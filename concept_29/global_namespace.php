<?php

// global_namespace.php

// This script demonstrates the **Global Namespace** in PHP. 
// When no namespace is explicitly declared, PHP code resides in the global 
// namespace. All built-in PHP classes, functions, and constants (like `strlen`, 
// `DateTime`, `E_ALL`) are defined here.

echo "<h1>PHP Global Namespace Demonstration 🌎</h1>";

// ---------------------------------------------------------------------
// 1. Defining Elements in the Global Namespace
// ---------------------------------------------------------------------

/**
 * Class GlobalConfig
 * Defined without any namespace declaration, so it's in the global scope.
 */
class GlobalConfig {
    
    // Constant defined in the global namespace
    public const DEFAULT_SETTING = "production"; 
    
    public function getInfo(): string {
        return "This is a class from the **Global Namespace**.";
    }
}

/**
 * Function defined in the global namespace.
 */
function global_helper_function(string $message): void {
    echo "<p style='color: blue;'>➡️ **Global Function:** " . strtoupper($message) . "</p>";
}

// ---------------------------------------------------------------------
// 2. Accessing Global Elements
// ---------------------------------------------------------------------

echo "<h2>2. Accessing Global Elements</h2>";

// Elements in the global namespace are accessed directly without any prefix.

// 2a. Accessing the Global Class
$config = new GlobalConfig();
echo "<li>Global Class Method: <strong>" . $config->getInfo() . "</strong></li>";

// 2b. Accessing the Global Constant
echo "<li>Global Class Constant: <strong>" . GlobalConfig::DEFAULT_SETTING . "</strong></li>";

// 2c. Calling the Global Function
global_helper_function("A message from the global scope.");

// 2d. Calling built-in PHP functions (also in the global namespace)
$string = "Hello PHP";
echo "<li>Built-in Function (strlen): Length of '{$string}' is <strong>" . strlen($string) . "</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Accessing Global Elements from within a Namespaced Context
// ---------------------------------------------------------------------

namespace App\Module {
    
    echo "<h2>3. Accessing Global from within `App\Module`</h2>";
    
    class Processor {
        public function run(): void {
            echo "<li>Current Namespace: <strong>" . __NAMESPACE__ . "</strong></li>";
            
            // To call a global function/class/constant from within a namespace, 
            // you must prefix it with a **backslash (`\`)**. This is the
            // Fully Qualified Name (FQN) for the global namespace.
            
            // Accessing the global class (prefix with \)
            $config = new \GlobalConfig();
            echo "<li>Namespaced Code Accessing Global Class: <strong>" . $config->getInfo() . "</strong></li>";
            
            // Calling the global function (prefix with \)
            \global_helper_function("Called from inside a namespace.");
            
            // Calling a built-in PHP function (prefix with \ is optional but recommended)
            echo "<li>Calling Built-in (\date): Current time is <strong>" . \date('H:i:s') . "</strong></li>";
        }
    }
    
    $processor = new Processor();
    $processor->run();
}

?>