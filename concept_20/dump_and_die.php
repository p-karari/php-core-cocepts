<?php

// dump_and_die.php

// This script demonstrates the use of the `dd()` (Dump and Die) function, 
// which is a highly popular utility, especially in frameworks like Laravel, 
// for quickly debugging variables and halting script execution.

echo "<h1>PHP Dump and Die (dd) Demonstration 🐛</h1>";

// ---------------------------------------------------------------------
// 1. Define the dd() function
// ---------------------------------------------------------------------

// Since dd() is not a native PHP function (it's custom, often from a framework 
// or composer package), we define a simple, common implementation here.

if (!function_exists('dd')) {
    /**
     * Dumps the contents of a variable and terminates the script.
     * Uses var_dump() for detailed output.
     *
     * @param mixed ...$vars One or more variables to dump.
     * @return void
     */
    function dd(...$vars) {
        echo "<pre style='background-color: #333; color: #fff; padding: 15px; border: 1px solid #c00; font-size: 14px; font-family: monospace;'>";
        // Loop through all passed variables
        foreach ($vars as $var) {
            // Use var_dump for detailed information (type, size, content)
            var_dump($var);
        }
        echo "</pre>";
        // Halt script execution immediately after dumping
        exit; 
    }
}

// ---------------------------------------------------------------------
// 2. Setup Variables
// ---------------------------------------------------------------------

$user = [
    'id' => 42,
    'name' => 'Neo',
    'status' => 'active',
    'roles' => ['admin', 'dev']
];

$session_id = 'a1b2c3d4e5f6';
$count = 12;

echo "<h2>2. Code Execution Before dd()</h2>";
echo "<p>This content is displayed because it executes before the <code>dd()</code> call.</p>";

// ---------------------------------------------------------------------
// 3. Using dd() to Inspect and Halt
// ---------------------------------------------------------------------

// --- FIRST dd() EXAMPLE (Inspecting one variable) ---
/*
echo "<h2>3. First dd(\$user) Call (UNCOMMENT TO TEST)</h2>";
echo "<p style='color: blue;'>The script will halt immediately after dumping the \$user array.</p>";
dd($user); 
// The code below this line will NOT execute
*/

// --- SECOND dd() EXAMPLE (Inspecting multiple variables) ---
/*
echo "<h2>4. Second dd(\$session_id, \$count) Call (UNCOMMENT TO TEST)</h2>";
echo "<p style='color: blue;'>The script will halt immediately after dumping the \$session_id and \$count.</p>";
dd($session_id, $count);
// The code below this line will NOT execute
*/

// ---------------------------------------------------------------------
// 4. Code Execution After dd() (Never Reached)
// ---------------------------------------------------------------------

echo "<h2>5. Code Execution After dd()</h2>";
echo "<p style='color: red;'><strong>❌ ERROR: If you see this text, the <code>dd()</code> function was NOT executed or did not contain <code>exit;</code>.</strong></p>";

?>