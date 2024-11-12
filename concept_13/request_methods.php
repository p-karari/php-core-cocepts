<?php

// request_methods.php

// This script demonstrates how to determine the HTTP request method used to access the page 
// using the $_SERVER['REQUEST_METHOD'] superglobal and how to handle different methods.

echo "<h1>HTTP Request Method Checker 🌐</h1>";

// 1. Get the HTTP Request Method
// $_SERVER['REQUEST_METHOD'] returns the method (GET, POST, PUT, DELETE, etc.)
$request_method = $_SERVER['REQUEST_METHOD'];

echo "<p>The page was accessed using the method: <strong>{$request_method}</strong></p>";

echo "<hr>";

// 2. Conditional Handling based on the Method

if ($request_method === 'GET') {
    // ---------------------------------------------------------------------
    // Handle GET Request (Page loading, simple link clicks, URL access)
    // ---------------------------------------------------------------------
    echo "<h2>GET Request Detected (Loading Page or Reading Data)</h2>";
    echo "<p>This method is typically used to <strong>retrieve</strong> data (e.g., loading a webpage or fetching a resource).</p>";
    
    // Check for any data passed via URL query string
    if (!empty($_GET)) {
        echo "<h3>GET Data Received:</h3>";
        echo "<pre>";
        print_r($_GET);
        echo "</pre>";
    } else {
        echo "<p>No URL parameters (\$_GET) were sent.</p>";
    }

    echo "<hr>";
    echo "<h3>Test POST Submission:</h3>";
    // Provide a simple form to test the POST method
    echo '<form method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
    echo '<label for="data">Enter Data:</label>';
    echo '<input type="text" id="data" name="test_data" value="Form Submission">';
    echo '<button type="submit">Submit (POST)</button>';
    echo '</form>';

} elseif ($request_method === 'POST') {
    // ---------------------------------------------------------------------
    // Handle POST Request (Form submission, creating/updating data)
    // ---------------------------------------------------------------------
    echo "<h2 style='color: green;'>POST Request Detected (Submitting Data)</h2>";
    echo "<p>This method is typically used to <strong>submit</strong> data (e.g., submitting a form, creating a new record).</p>";
    
    // Check for data passed via form submission
    if (!empty($_POST)) {
        echo "<h3>POST Data Received:</h3>";
        echo "<ul>";
        // Iterate through the $_POST array to display submitted data
        foreach ($_POST as $key => $value) {
            echo "<li><strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>Warning: A POST request was made, but the \$_POST array is empty (Check form field names).</p>";
    }

} else {
    // ---------------------------------------------------------------------
    // Handle Other Methods (PUT, DELETE, HEAD, etc.)
    // ---------------------------------------------------------------------
    echo "<h2 style='color: orange;'>Other Request Method Detected</h2>";
    echo "<p>Method <strong>{$request_method}</strong> is less common for standard web browsing and is often used by APIs (e.g., PUT for updates, DELETE for deletion).</p>";
}

?>