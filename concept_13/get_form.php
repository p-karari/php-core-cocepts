<?php

// get_form.php

// This file contains both the HTML form (GET method) and the PHP logic 
// to process the form data using the $_GET superglobal.

echo "<h1>User Data Submission (GET Method) 📨</h1>";

// ---------------------------------------------------------------------
// 1. PHP PROCESSING LOGIC
// ---------------------------------------------------------------------

$message = "";
$search_term = "";
$sort_order = "";

// Check if the form has been submitted by checking for the 'submit' button's presence
// Note: With GET, the data is always in the URL if the form is submitted.
if (isset($_GET['submit'])) {
    
    // Safety: Sanitize and store the submitted data
    $search_term = htmlspecialchars(trim($_GET['search'] ?? ''));
    $sort_order = htmlspecialchars(trim($_GET['sort'] ?? ''));

    // Validation: Check if the search term is not empty
    if (empty($search_term)) {
        $message = "<p style='color: red;'><strong>Error:</strong> The search term cannot be empty.</p>";
    } else {
        // Success: Process the data
        $message = "<p style='color: green;'><strong>Search Performed!</strong> The data is visible in the URL bar.</p>";
        $message .= "<ul>";
        $message .= "<li>Search Term: <strong>{$search_term}</strong></li>";
        $message .= "<li>Sort Order: <strong>{$sort_order}</strong></li>";
        $message .= "</ul>";
    }
}

// ---------------------------------------------------------------------
// 2. HTML FORM AND OUTPUT
// ---------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GET Form Example</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { width: 400px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], select { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 15px; background-color: darkgoldenrod; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <div class="message-area">
        <?php echo $message; ?>
    </div>

    <div class="form-container">
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <label for="search">Search Products:</label>
            <input 
                type="text" 
                id="search" 
                name="search" 
                required
                value="<?php echo htmlspecialchars($search_term); ?>" 
                placeholder="e.g., Laptop, Monitor, Keyboard"
            >

            <label for="sort">Sort By:</label>
            <select id="sort" name="sort">
                <option value="price_asc" <?php if ($sort_order === 'price_asc') echo 'selected'; ?>>Price: Low to High</option>
                <option value="price_desc" <?php if ($sort_order === 'price_desc') echo 'selected'; ?>>Price: High to Low</option>
                <option value="name_asc" <?php if ($sort_order === 'name_asc') echo 'selected'; ?>>Name: A-Z</option>
            </select>

            <button type="submit" name="submit">Search</button>
            
            <p><small><em>(Note the URL will change after submission)</em></small></p>

        </form>
    </div>

</body>
</html>