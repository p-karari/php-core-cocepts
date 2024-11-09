<?php

// get-variables.php

// This script demonstrates how to receive and process data sent via 
// the HTTP GET method, typically through URL query parameters or an HTML form 
// using method="get".

// The data is accessed using the $_GET superglobal array.

echo "<h2>PHP GET Variable Demonstration</h2>";

// ---------------------------------------------------------------------
// 1. Check for the Request Method
// ---------------------------------------------------------------------

// Ensure the request method is GET, although $_GET will be populated regardless
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Check if the URL contains any GET parameters at all
    if (empty($_GET)) {
        echo "<p>No GET parameters detected in the URL.</p>";
        echo "<p>Try accessing this page with a URL like: <code>get-variables.php?product=Laptop&price=999.99</code></p>";
    } else {
        echo "<p style='color: green;'><strong>GET data received.</strong></p>";
        
        // ---------------------------------------------------------------------
        // 2. Accessing Individual Variables Safely
        // ---------------------------------------------------------------------
        
        // Use the null coalescing operator (??) to safely check if a key exists 
        // and assign a default value if it doesn't.
        $product_name = htmlspecialchars($_GET['product'] ?? 'Unknown Product');
        $price_input = htmlspecialchars($_GET['price'] ?? '0.00');
        
        // Ensure the price is treated as a float for calculations/formatting
        $price = filter_var($price_input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        
        echo "<h3>Extracted Data:</h3>";
        echo "<ul>";
        echo "<li><strong>Product:</strong> {$product_name}</li>";
        echo "<li><strong>Price:</strong> \${$price}</li>";
        echo "</ul>";

        // ---------------------------------------------------------------------
        // 3. Processing the Entire $_GET Array
        // ---------------------------------------------------------------------

        echo "<h3>All GET Parameters (Raw):</h3>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Key</th><th>Value</th></tr>";
        
        // Iterate over all key-value pairs in the $_GET array
        foreach ($_GET as $key => $value) {
            // Sanitize key and value before outputting to HTML
            $safe_key = htmlspecialchars($key);
            $safe_value = htmlspecialchars($value);
            echo "<tr><td>{$safe_key}</td><td>{$safe_value}</td></tr>";
        }
        
        echo "</table>";
    }
} else {
    echo "<p style='color: red;'>This script expects a GET request.</p>";
}

// ---------------------------------------------------------------------
// 4. Example Form (Demonstration purposes)
// ---------------------------------------------------------------------
?>
<hr>
<h3>Test Form (Submitting via GET)</h3>
<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="product">Product Name:</label>
    <input type="text" id="product" name="product" value="Headphones" required><br><br>
    
    <label for="price">Price:</label>
    <input type="text" id="price" name="price" value="45.50" required><br><br>
    
    <button type="submit">Submit Data (via URL)</button>
</form>