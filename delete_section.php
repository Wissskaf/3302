<?php
include_once 'classes.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteSection'])) {
    $articleCode = $_POST['articleCode'];
    $sectionCode = $_POST['sectionCode'];

    // Find the article with the specified code
    foreach ($_SESSION['jalal'] as $index => $article) {
        if ($article->getCode() == $articleCode) {
            // Find the section with the specified code
            foreach ($article->getSections() as $sectionIndex => $section) {
                if ($section->getCode() == $sectionCode) {
                    // Remove the section from the article
                    unset($_SESSION['jalal'][$index]->getSections()[$sectionIndex]);

                    // Optionally, you can reindex the array
                    $_SESSION['jalal'][$index]->setSections(array_values($_SESSION['jalal'][$index]->getSections()));

                    // Redirect back to view_sections.php after deleting the section
                    header("Location: view_sections.php?code={$articleCode}");
                    exit();
                }
            }
        }
    }
}

// Handle cases where the form is not submitted properly
// Redirect back to view_sections.php with an error message or other handling
header("Location: view_sections.php?error=1");
exit();
?>
