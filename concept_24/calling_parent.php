<?php

// calling_parent.php

// This script demonstrates how to call a method from the parent (superclass) 
// within a child (subclass) class using the **`parent::`** keyword in PHP OOP. 
// This is essential when overriding a method but still needing to reuse 
// or augment the parent's original logic.

echo "<h1>PHP Calling Parent Method Demo (parent::) 📞</h1>";

// ---------------------------------------------------------------------
// 1. Parent Class Definition
// ---------------------------------------------------------------------

/**
 * Class Post
 * Represents a base content entity, like a blog post.
 */
class Post {
    
    protected string $title;
    protected string $content;
    protected string $author;

    /**
     * Parent Constructor.
     */
    public function __construct(string $title, string $content, string $author) {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        echo "<p style='color: green;'>✅ Base Post '{$this->title}' created by **{$this->author}**.</p>";
    }
    
    /**
     * Parent method to display basic details.
     */
    public function getDetails(): string {
        return "POST: Title: '{$this->title}', Author: {$this->author}, Length: " . strlen($this->content) . " chars.";
    }

    /**
     * Parent method to prepare content (basic trimming).
     */
    protected function prepareContent(): string {
        return trim($this->content);
    }
}

// ---------------------------------------------------------------------
// 2. Child Class Definition
// ---------------------------------------------------------------------

/**
 * Class FeaturedPost
 * Extends Post and overrides its methods.
 */
class FeaturedPost extends Post {
    
    private string $editor;

    /**
     * Child Constructor: Calls parent::__construct to handle base initialization.
     */
    public function __construct(string $title, string $content, string $author, string $editor) {
        // **Calling the Parent Constructor**
        // MUST be the first call in the child constructor to ensure parent properties are initialized.
        parent::__construct($title, $content, $author);
        $this->editor = $editor;
        echo "<p style='color: green;'>✅ Featured Post edited by **{$this->editor}**.</p>";
    }

    /**
     * Method Overriding: Augments the parent's getDetails() method.
     */
    public function getDetails(): string {
        // **Calling the Parent Method**
        // Get the base details string from the parent class implementation.
        $baseDetails = parent::getDetails();
        
        // Add the child-specific details.
        return $baseDetails . " | **FEATURED** | Edited by: {$this->editor}";
    }
    
    /**
     * Overrides the protected method to add child-specific content preparation.
     */
    protected function prepareContent(): string {
        // **Calling the Parent Protected Method**
        // Get the trimmed content from the parent's method.
        $baseContent = parent::prepareContent();
        
        // Add child logic (e.g., adding a prefix).
        return "⭐ {$baseContent}";
    }

    /**
     * New method to display the final processed content.
     */
    public function getFinalContent(): string {
        return $this->prepareContent(); // Calls the overridden child method
    }
}

echo "<hr>";

// ---------------------------------------------------------------------
// 3. Object Usage and Testing
// ---------------------------------------------------------------------

echo "<h2>3. Usage: Calling parent:: from the Child</h2>";

$featuredArticle = new FeaturedPost(
    "The Future of PHP 9", 
    " The new features promise better performance and stricter types. ", 
    "Dave P.", 
    "Sarah K."
);

echo "<hr>";

// 3a. Calling the overridden public method
echo "<h3>Details (Uses parent::getDetails() internally):</h3>";
echo "<p><strong>" . $featuredArticle->getDetails() . "</strong></p>";

// 3b. Calling the new public method, which in turn calls the overridden protected method
echo "<h3>Final Content (Uses parent::prepareContent() internally):</h3>";
echo "<pre>Content: " . $featuredArticle->getFinalContent() . "</pre>";

echo "<p><em>Notice how the content was trimmed by the parent and then prefixed by the child's method, 
all controlled by the <code>parent::</code> keyword.</em></p>";
?>