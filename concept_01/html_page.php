<?php

// html_page.php

// 1. Define PHP variables that will be used in the HTML content
$page_title = "Dynamic PHP Page Example";
$username = "User123";
$items = ["Apple", "Banana", "Cherry", "Date"];
$is_admin = true;

// 2. Start of HTML structure - PHP outputs the HTML directly
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; }
        .greeting { color: navy; }
        .admin-note { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <h1 class="greeting">Welcome, <?= $username; ?>!</h1>

    <?php if ($is_admin): ?>
        <p class="admin-note">
            You have administrator privileges. Be careful!
        </p>
    <?php else: ?>
        <p>You are viewing this page as a standard user.</p>
    <?php endif; ?>

    <h2>List of Items</h2>
    <ul>
    <?php
    foreach ($items as $index => $item) {
        // Outputting list items using PHP
        echo "<li>Item #" . ($index + 1) . ": <strong>" . htmlspecialchars($item) . "</strong></li>";
    }
    ?>
    </ul>

    <footer>
        <p>
            Page generated on: <?php echo date("Y-m-d H:i:s"); ?>
        </p>
    </footer>

</body>
</html>