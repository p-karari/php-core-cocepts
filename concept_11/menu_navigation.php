<?php

// menu-navigation.php

// This script demonstrates how to create a simple, dynamic navigation menu 
// using PHP arrays and conditional logic to highlight the current active page.

// ---------------------------------------------------------------------
// 1. Configuration: Define the pages and their metadata
// ---------------------------------------------------------------------

// Define an associative array where keys are menu IDs and values are page details.
$menu_items = [
    'home' => [
        'title' => 'Home',
        'url' => 'index.php'
    ],
    'about' => [
        'title' => 'About Us',
        'url' => 'about.php'
    ],
    'services' => [
        'title' => 'Our Services',
        'url' => 'services.php'
    ],
    'contact' => [
        'title' => 'Contact',
        'url' => 'contact.php'
    ]
];

// ---------------------------------------------------------------------
// 2. Determine the Active Page
// ---------------------------------------------------------------------

// Simulate the current page. In a real application, you'd extract this from the URL, 
// usually $_SERVER['REQUEST_URI'] or a $_GET parameter.
// For this standalone example, we'll manually set a variable.
$current_page_id = 'services'; // <--- CHANGE THIS VALUE to test different active links

// ---------------------------------------------------------------------
// 3. Render the Navigation Menu
// ---------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dynamic Navigation Menu</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .navigation { list-style-type: none; margin: 0; padding: 0; background-color: #333; overflow: hidden; }
        .navigation li { float: left; }
        .navigation li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navigation li a:hover { background-color: #555; }
        .navigation .active a { background-color: #04AA6D; color: white; } /* Active style */
    </style>
</head>
<body>

    <h2>Navigation Menu</h2>

    <ul class="navigation">
        <?php foreach ($menu_items as $id => $item): ?>
            <?php
                // Check if the current item's ID matches the active page ID
                $class_name = ($id === $current_page_id) ? 'active' : '';
            ?>
            
            <li class="<?php echo $class_name; ?>">
                <a href="<?php echo htmlspecialchars($item['url']); ?>">
                    <?php echo htmlspecialchars($item['title']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>Current Active Page Simulation:</h3>
    <p>The variable <code>$current_page_id</code> is set to: <strong><?php echo $current_page_id; ?></strong></p>
    <p>Refresh the page and change <code>$current_page_id</code> in the PHP code to see the active link change.</p>

</body>
</html>