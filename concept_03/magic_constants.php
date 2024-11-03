<?php

// magic_constants.php

// Magic constants are special predefined constants in PHP that change
// depending on where they are used. They are case-insensitive and start
// and end with two underscores (__).

echo "<h2>1. File and Directory</h2>";

// __FILE__: The full path and filename of the file.
echo "The current file is: <strong>" . __FILE__ . "</strong><br>";

// __DIR__: The directory of the file.
echo "The directory is: <strong>" . __DIR__ . "</strong><br>";

// __LINE__: The current line number of the file.
echo "This output is on line: <strong>" . __LINE__ . "</strong><br>";

echo "<hr>";

echo "<h2>2. Function and Method Scope</h2>";

function exampleFunction() {
    // __FUNCTION__: The name of the current function.
    echo "Inside function: <strong>" . __FUNCTION__ . "</strong><br>";
}

exampleFunction();

class ExampleClass {
    public function exampleMethod() {
        // __CLASS__: The name of the current class.
        echo "Inside class: <strong>" . __CLASS__ . "</strong><br>";

        // __METHOD__: The name of the current class method.
        echo "Inside method: <strong>" . __METHOD__ . "</strong><br>";
    }
}

$obj = new ExampleClass();
$obj->exampleMethod();

echo "<hr>";

echo "<h2>3. Namespace and Trait (Advanced)</h2>";

// Note: If this file was within a namespace, __NAMESPACE__ would return it.
// Since it's not, it returns an empty string.
echo "Current namespace: <strong>" . __NAMESPACE__ . "</strong> (Empty in global scope)<br>";

// Example of __TRAIT__ (Requires a trait definition)
trait Logger {
    public function log() {
        // __TRAIT__: The name of the trait.
        echo "Logging from trait: <strong>" . __TRAIT__ . "</strong><br>";
    }
}

class User {
    use Logger;
}

$user = new User();
$user->log();

echo "<hr>";

echo "<h2>4. Class Name Resolution</h2>";

// CLASS::class (Not a magic constant, but related: fetches fully qualified class name)
echo "Fully qualified class name: <strong>" . ExampleClass::class . "</strong><br>";

?>