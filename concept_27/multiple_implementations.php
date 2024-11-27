<?php

// multiple_implementations.php

// This script demonstrates **Polymorphism** in PHP by showing how different 
// classes can implement the same **Interface**, each providing its own 
// unique implementation of the contract methods.

echo "<h1>PHP Multiple Implementations & Polymorphism Demo 🎭</h1>";

// ---------------------------------------------------------------------
// 1. Interface Definition (The Contract)
// ---------------------------------------------------------------------

/**
 * Interface RendererInterface
 * Defines a contract for any class responsible for converting data into a specific output format.
 */
interface RendererInterface {
    
    // Method to set the data to be rendered
    public function setData(array $data): void;
    
    // Method to return the data in a specific format
    public function render(): string;
}

// ---------------------------------------------------------------------
// 2. Implementation 1: JSON Renderer
// ---------------------------------------------------------------------

/**
 * Class JsonRenderer
 * Implements the contract to output data as JSON.
 */
class JsonRenderer implements RendererInterface {
    
    private array $data = [];
    
    public function setData(array $data): void {
        $this->data = $data;
        echo "<p style='color: green;'>✅ JsonRenderer data set.</p>";
    }
    
    public function render(): string {
        // Unique implementation: uses json_encode
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}

// ---------------------------------------------------------------------
// 3. Implementation 2: XML Renderer
// ---------------------------------------------------------------------

/**
 * Class XmlRenderer
 * Implements the contract to output data as a simple XML string.
 */
class XmlRenderer implements RendererInterface {
    
    private array $data = [];
    
    public function setData(array $data): void {
        $this->data = $data;
        echo "<p style='color: green;'>✅ XmlRenderer data set.</p>";
    }
    
    public function render(): string {
        // Unique implementation: formats as XML
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<root>\n";
        
        foreach ($this->data as $key => $value) {
            // Simple handling for key-value pairs
            $xml .= "\t<" . htmlspecialchars($key) . ">" . htmlspecialchars((string)$value) . "</" . htmlspecialchars($key) . ">\n";
        }
        $xml .= "</root>";
        return $xml;
    }
}

// ---------------------------------------------------------------------
// 4. Implementation 3: HTML List Renderer
// ---------------------------------------------------------------------

/**
 * Class HtmlListRenderer
 * Implements the contract to output data as an HTML unordered list.
 */
class HtmlListRenderer implements RendererInterface {
    
    private array $data = [];
    
    public function setData(array $data): void {
        $this->data = $data;
        echo "<p style='color: green;'>✅ HtmlListRenderer data set.</p>";
    }
    
    public function render(): string {
        // Unique implementation: formats as HTML <ul>
        $html = "<ul>\n";
        foreach ($this->data as $key => $value) {
            $html .= "\t<li><strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars((string)$value) . "</li>\n";
        }
        $html .= "</ul>";
        return $html;
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 5. Polymorphic Usage (The Power of Interfaces)
// ---------------------------------------------------------------------

echo "<h2>5. Polymorphic Usage: The DataProcessor</h2>";

$userData = [
    'user_id' => 123,
    'username' => 'JohnDoe',
    'last_login' => '2025-10-14',
    'status' => 'active'
];

/**
 * Function that accepts ANY object implementing RendererInterface.
 * The function doesn't need to know *how* the rendering happens.
 */
function processAndDisplay(RendererInterface $renderer, array $data): void {
    $className = get_class($renderer);
    echo "<h3>Rendering with: {$className}</h3>";
    
    $renderer->setData($data);
    $output = $renderer->render();
    
    // Display the output based on the format
    if ($className === 'HtmlListRenderer') {
        echo $output;
    } else {
        echo "<pre>" . htmlspecialchars($output) . "</pre>";
    }
}

// Instantiate and use all implementations interchangeably
processAndDisplay(new JsonRenderer(), $userData);
processAndDisplay(new XmlRenderer(), $userData);
processAndDisplay(new HtmlListRenderer(), $userData);

?>