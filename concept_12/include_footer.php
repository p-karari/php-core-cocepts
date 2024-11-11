<?php

// include-footer.php

// This file demonstrates the use of the `include` statement to separate
// the common footer content into its own file for better code organization.
// This file acts as the main page.

// ---------------------------------------------------------------------
// 1. Create the dummy footer file for demonstration
// ---------------------------------------------------------------------
$footer_content = <<<HTML
<footer style="margin-top: 30px; padding: 10px; border-top: 1px solid #ccc; text-align: center; background-color: #f4f4f4;">
    <p>&copy; <?php echo date('Y'); ?> Dynamic Website Demo.</p>
    <p>All rights reserved. Script loaded at: <?php echo date('H:i:s'); ?></p>
</footer>
HTML;

file_put_contents("footer.php", $footer_content);

// ---------------------------------------------------------------------
// 2. Main Page Content
// ---------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page with Included Footer</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .content { min-height: 200px; padding: 20px; }
        h1 { color: #333; }
    </style>
</head>
<body>

    <header style="background-color: navy; color: white; padding: 20px;">
        <h1>Main Page Header</h1>
        <p>This is the start of the main page content.</p>
    </header>

    <div class="content">
        <h2>Content Section</h2>
        <p>This is the primary, page-specific content that changes from page to page. In a real application, this part would contain unique data like articles, user profiles, or product listings.</p>
        <p>The **`include`** statement ensures that the **`footer.php`** file will be pulled in below this line, separating presentation logic from the rest of the page structure.</p>
    </div>

    <?php
        // The include statement pulls the content of 'footer.php' 
        // and executes any PHP code within it at this exact point.
        include "footer.php"; 
    ?>
    
</body>
</html>

<?php
// ---------------------------------------------------------------------
// 4. Clean up the dummy file (optional)
// ---------------------------------------------------------------------
@unlink("footer.php");
?>