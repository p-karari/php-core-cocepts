<?php

// multiple_traits.php

// This script demonstrates how a single PHP class can incorporate methods 
// and properties from multiple independent **Traits**. This is the primary 
// mechanism PHP uses to achieve code reuse across different inheritance hierarchies, 
// effectively solving the "single inheritance" limitation.

echo "<h1>PHP Multiple Traits Demonstration 🤝🤝</h1>";

// ---------------------------------------------------------------------
// 1. Trait Definition A: Caching
// ---------------------------------------------------------------------

/**
 * Trait Cachable
 * Provides methods for basic data caching (simulated).
 */
trait Cachable {
    
    // Trait property
    private array $cache = [];
    
    // Trait method
    public function cacheData(string $key, $value): void {
        $this->cache[$key] = $value;
        echo "<p style='color: blue;'>➡️ **[Cachable]** Data stored in cache with key '{$key}'.</p>";
    }
    
    // Trait method
    public function getCachedData(string $key) {
        return $this->cache[$key] ?? null;
    }
}

// ---------------------------------------------------------------------
// 2. Trait Definition B: Debugging
// ---------------------------------------------------------------------

/**
 * Trait Debuggable
 * Provides methods for inspecting the internal state of an object.
 */
trait Debuggable {
    
    // Trait method
    public function dumpState(): void {
        echo "<p style='color: brown;'>➡️ **[Debuggable]** Dumping object state:</p>";
        // Uses PHP's Reflection to inspect the object properties
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();
        
        echo "<pre>";
        foreach ($properties as $prop) {
            // Need to set the property accessible for private/protected properties
            $prop->setAccessible(true);
            $value = $prop->getValue($this);
            $formatted_value = is_array($value) ? print_r($value, true) : (string)$value;
            echo "  - {$prop->getName()} ({$prop->getDeclaringClass()->getName()}): " . rtrim($formatted_value) . "\n";
        }
        echo "</pre>";
    }
}

// ---------------------------------------------------------------------
// 3. Class Definition (Consuming Multiple Traits)
// ---------------------------------------------------------------------

echo "<hr>";
echo "<h2>3. Class: ReportGenerator (Uses Cachable & Debuggable)</h2>";

/**
 * Class ReportGenerator
 * Incorporates methods from both Cachable and Debuggable traits.
 */
class ReportGenerator {
    // The `use` keyword allows incorporating members from multiple traits.
    use Cachable, Debuggable; 
    
    public string $reportName;
    private int $dataSize;
    
    public function __construct(string $name, int $size) {
        $this->reportName = $name;
        $this->dataSize = $size;
        echo "<p style='color: green;'>✅ ReportGenerator '{$this->reportName}' initialized.</p>";
    }
    
    // New class method utilizing trait methods
    public function generate(): string {
        $key = "report_{$this->reportName}";
        
        $cached = $this->getCachedData($key); // Method from Cachable
        
        if ($cached) {
            return "Retrieved cached report for {$this->reportName}: {$cached}.";
        }
        
        // Simulate a complex generation process
        $result = "Generated report data for {$this->dataSize} records.";
        $this->cacheData($key, $result); // Method from Cachable
        
        return $result;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Object Usage and Verification
// ---------------------------------------------------------------------

echo "<h2>4. Usage: Combining Trait Functionality</h2>";

$salesReport = new ReportGenerator("Q3 Sales", 50000);

// 4a. Use Cachable methods (via generate)
echo "<li>First run: " . $salesReport->generate() . "</li>";
echo "<li>Second run (from cache): " . $salesReport->generate() . "</li>";

echo "<hr>";

// 4b. Use Debuggable method
echo "<h3>Inspecting State:</h3>";
$salesReport->dumpState(); // Method from Debuggable

echo "<p><em>The <code>ReportGenerator</code> class gained caching logic, cache storage, 
and debugging tools simply by listing the traits in its <code>use</code> statement.</em></p>";
?>