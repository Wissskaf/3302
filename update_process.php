<?php
include_once 'classes.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $articleCode = $_POST['articleCode'];
    $newCode = $_POST['code'];
    $newTitle = $_POST['title'];
    $newEditor = $_POST['editor'];
    $newDate = $_POST['date'];

    // Check if the 'jalal' session variable is set
    if (isset($_SESSION['jalal']) && is_array($_SESSION['jalal'])) {
        // Find the article with the specified code
        foreach ($_SESSION['jalal'] as $index => $article) {
            if ($article->getCode() == $articleCode) {
                // Update the article information
                $_SESSION['jalal'][$index]->setCode($newCode);
                $_SESSION['jalal'][$index]->setTitle($newTitle);
                $_SESSION['jalal'][$index]->setEditor($newEditor);
                $_SESSION['jalal'][$index]->setDate($newDate);

                // Optionally, you can update other fields as needed

                break;
            }
        }
    }

    // Redirect back to displayall.php after updating
    header("Location: displayall.php");
    exit();
} else {
    // Handle cases where the form is not submitted properly
    // Redirect back to displayall.php with an error message or other handling
    header("Location: displayall.php?error=1");
    exit();
}
?>
