<?php

// visibility.php

// This script demonstrates the concept of **Visibility** (or **Access Modifiers**) 
// in PHP Object-Oriented Programming (OOP), using the keywords: 
// public, protected, and private.

echo "<h1>PHP Visibility (Access Modifiers) Demo 👁️‍🗨️</h1>";

// ---------------------------------------------------------------------
// 1. Base Class Definition
// ---------------------------------------------------------------------

/**
 * Class Document
 * Defines properties and methods with different visibility levels.
 */
class Document {
    
    // 1a. Public: Accessible from anywhere (inside the class, subclasses, and outside instances).
    public string $title;
    
    // 1b. Protected: Accessible only from within the defining class and by inherited (child) classes.
    protected string $author;
    
    // 1c. Private: Accessible only from within the defining class itself.
    private int $wordCount;
    
    public function __construct(string $title, string $author, int $wordCount) {
        $this->title = $title;
        $this->author = $author;
        $this->setWordCount($wordCount);
        echo "<p style='color: green;'>✅ Document '{$title}' created.</p>";
    }
    
    // Public method to access and modify the private property (Setter)
    private function setWordCount(int $count): void {
        $this->wordCount = $count;
    }

    // Public method to access the private property (Getter)
    public function getWordCount(): int {
        // Private properties are fully accessible within the class.
        return $this->wordCount; 
    }
    
    // Public method to display the protected property
    public function getAuthorInfo(): string {
        // Protected properties are fully accessible within the class.
        return "Authored by: {$this->author}"; 
    }
}

// ---------------------------------------------------------------------
// 2. Child Class Definition (Inheritance)
// ---------------------------------------------------------------------

/**
 * Class Ebook
 * Inherits from Document to test protected visibility.
 */
class Ebook extends Document {
    
    public function getEbookDetails(): string {
        // Accessing the PROTECTED property $author is ALLOWED in the child class.
        $base_info = $this->getAuthorInfo();
        
        // Accessing the PRIVATE property $wordCount is NOT ALLOWED and would cause a fatal error.
        // $private_count = $this->wordCount; 
        
        return "Ebook Title: {$this->title}, " . $base_info;
    }

    public function tryAccessingParentPrivate(): void {
        // Attempting to access the private property directly:
        // echo $this->wordCount; // This line would cause a Fatal Error: Cannot access private property
        echo "<p style='color: orange;'>⚠️ **Note:** Attempting to access the parent's **private** \$wordCount property directly from here is blocked.</p>";
        
        // Must use the parent's public getter method instead:
        echo "Word Count (via public getter): " . $this->getWordCount();
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Testing Access from Outside the Classes (Instance Access)
// ---------------------------------------------------------------------

echo "<h2>3. Outside Access (Public Only)</h2>";

$myDocument = new Document("Annual Report", "Dr. Smith", 15000);

// 3a. Accessing PUBLIC property (ALLOWED)
echo "<li>Public Title (Direct Access): <strong>{$myDocument->title}</strong></li>";
$myDocument->title = "Revised Annual Report";
echo "<li>Public Title (After Change): <strong>{$myDocument->title}</strong></li>";

// 3b. Accessing PRIVATE property (FORBIDDEN - Fatal Error/Notice)
echo "<li>Private Word Count (Direct Access): <em>(Attempting to access directly... will fail)</em></li>";
// echo $myDocument->wordCount; // Causes a Fatal Error: Cannot access private property
echo "<li>Private Word Count (Via Public Getter): <strong>{$myDocument->getWordCount()}</strong></li>";

// 3c. Accessing PROTECTED property (FORBIDDEN - Fatal Error/Notice)
echo "<li>Protected Author (Direct Access): <em>(Attempting to access directly... will fail)</em></li>";
// echo $myDocument->author; // Causes a Fatal Error: Cannot access protected property
echo "<li>Protected Author (Via Public Getter): <strong>{$myDocument->getAuthorInfo()}</strong></li>";

echo "<hr>";

// ---------------------------------------------------------------------
// 4. Testing Access from Child Class (Inheritance)
// ---------------------------------------------------------------------

echo "<h2>4. Access from Subclass (Ebook)</h2>";

$myEbook = new Ebook("PHP for Beginners", "Jane Doe", 5000);

// 4a. Accessing Protected property from within the child's method (ALLOWED)
echo "<li>Ebook Details: <strong>" . $myEbook->getEbookDetails() . "</strong></li>";

// 4b. Demonstrating private restriction in child class
$myEbook->tryAccessingParentPrivate();

?>