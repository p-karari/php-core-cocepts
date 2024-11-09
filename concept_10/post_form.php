<?php

// post-form.php

// This file contains both the HTML form (POST method) and the PHP logic 
// to process the form data using the $_POST superglobal.

// ---------------------------------------------------------------------
// 1. PHP PROCESSING LOGIC
// ---------------------------------------------------------------------

$message = "";
$username = "";
$email = "";

// Check if the form has been submitted (i.e., if the 'submit' button is set in $_POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Safety: Sanitize and store the submitted data
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));

    // Validation: Check if required fields are not empty
    if (empty($username) || empty($email)) {
        $message = "<p style='color: red;'><strong>Error:</strong> Both username and email are required.</p>";
    } else {
        // Success: Process the data
        $message = "<p style='color: green;'><strong>Success!</strong> Data received and processed:</p>";
        $message .= "<ul>";
        $message .= "<li>Username: <strong>{$username}</strong></li>";
        $message .= "<li>Email: <strong>{$email}</strong></li>";
        $message .= "</ul>";
        
        // Clear the data from the form fields on successful submission
        $username = "";
        $email = "";
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
    <title>POST Form Example</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 15px; background-color: navy; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h1>User Data Submission (POST Method)</h1>

    <div class="message-area">
        <?php echo $message; ?>
    </div>

    <div class="form-container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <label for="username">Username:</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                required
                value="<?php echo htmlspecialchars($username); ?>" 
                placeholder="Enter username"
            >

            <label for="email">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                required
                value="<?php echo htmlspecialchars($email); ?>" 
                placeholder="Enter email"
            >

            <button type="submit" name="submit">Submit Data</button>

        </form>
    </div>

</body>
</html>