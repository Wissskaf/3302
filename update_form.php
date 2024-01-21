<?php
include_once 'classes.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['code'])) {
    $articleCode = $_GET['code'];

    // Check if the 'jalal' session variable is set
    if (isset($_SESSION['jalal']) && is_array($_SESSION['jalal'])) {
        // Find the article with the specified code
        $article = null;
        foreach ($_SESSION['jalal'] as $index => $article) {
            if ($article->getCode() == $articleCode) {
                break;
            }
        }

        // Check if the article is found
        if ($article !== null) {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Update Article</title>
            </head>
            <body>
                <h1>Update Article</h1>
                <form method="POST" action="update_process.php">
                    <input type="hidden" name="articleCode" value="<?php echo $article->getCode(); ?>">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $article->getTitle(); ?>" required><br>

                    <label for="editor">Editor:</label>
                    <input type="text" id="editor" name="editor" value="<?php echo $article->getEditor(); ?>" required><br>

                    <!-- Add other fields as needed -->

                    <button type="submit" name="update">Update</button>
                </form>
            </body>
            </html>
            <?php
            exit();
        }
    }
}

// Redirect back to displayall.php if the article is not found
header("Location: displayall.php?error=1");
exit();
?>
