<?php
include_once 'classes.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $articleCode = $_POST['articleCode'];

    // Check if the 'jalal' session variable is set
    if (isset($_SESSION['jalal']) && is_array($_SESSION['jalal'])) {
        // Find the article with the specified code
        $articleIndex = null;
        foreach ($_SESSION['jalal'] as $index => $article) {
            if ($article->getCode() == $articleCode) {
                $articleIndex = $index;
                break;
            }
        }

        // Check if the article is found
        if ($articleIndex !== null) {
            // Remove the article from the session array
            unset($_SESSION['jalal'][$articleIndex]);

            // Optionally, you can reindex the array
            $_SESSION['jalal'] = array_values($_SESSION['jalal']);
        }
    }

    // Redirect back to displayall.php after deletion
    header("Location: displayall.php");
    exit();
} else {
    // Handle cases where the form is not submitted properly
    // Redirect back to displayall.php with an error message or other handling
    header("Location: displayall.php?error=1");
    exit();
}
?>
