<?php

// post_login.php

// This script simulates a simple user login process using an HTML form 
// submitted via the **POST** method and processes the credentials using the **$_POST** superglobal.

// ---------------------------------------------------------------------
// 1. PHP PROCESSING LOGIC
// ---------------------------------------------------------------------

$message = "";
$is_authenticated = false;
$username_input = ""; // Used to retain the user's input on failure

// Define simple hardcoded credentials for demonstration purposes
$valid_username = "user@example.com";
$valid_password = "secure_password_123"; 

// Check if the form has been submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1a. Safely retrieve and sanitize submitted data
    $username_input = htmlspecialchars(trim($_POST['username'] ?? ''));
    $password_input = $_POST['password'] ?? ''; // Passwords are not echoed, so only minimal sanitization (trimming) is typically applied here.

    // 1b. Validation and Authentication
    if (empty($username_input) || empty($password_input)) {
        $message = "<p style='color: red;'><strong>Error:</strong> Please enter both username and password.</p>";
    } else {
        // In a real application, you would use `password_verify()` against a hashed password 
        // stored in a database. For this simple demo, we use direct string comparison.
        if ($username_input === $valid_username && $password_input === $valid_password) {
            
            // Success: Start a session and mark the user as logged in
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username_input;

            $message = "<p style='color: green;'><strong>Login Successful!</strong> Welcome, {$username_input}.</p>";
            $is_authenticated = true;

            // Optional: Redirect the user to a dashboard page
            // header("Location: dashboard.php");
            // exit;

        } else {
            // Failure: Credentials do not match
            $message = "<p style='color: red;'><strong>Error:</strong> Invalid username or password.</p>";
        }
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
    <title>POST Login Example</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { 
            width: 300px; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            <?php echo $is_authenticated ? 'display: none;' : ''; ?> /* Hide form on successful login */
        }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 15px; background-color: darkblue; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h1>User Login 🔐</h1>

    <div class="message-area">
        <?php echo $message; ?>
    </div>

    <div class="form-container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <label for="username">Username (Email):</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                required
                value="<?php echo htmlspecialchars($username_input); ?>" 
                placeholder="Enter user@example.com"
            >

            <label for="password">Password:</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                required
                placeholder="Enter secure_password_123"
            >

            <button type="submit">Log In</button>

        </form>
    </div>
    
    <?php if ($is_authenticated): ?>
        <p>You are successfully logged in! <a href="logout.php">Log Out</a> (Requires a separate logout script to destroy the session).</p>
        <p><em>In a real scenario, you would be redirected automatically.</em></p>
    <?php endif; ?>

</body>
</html>