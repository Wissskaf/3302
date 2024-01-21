<?php
include_once 'classes.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['code'])) {
    $articleCode = $_GET['code'];

    // Find the article with the specified code
    $selectedArticle = null;
    foreach ($_SESSION['jalal'] as $article) {
        if ($article->getCode() == $articleCode) {
            $selectedArticle = $article;
            break;
        }
    }

    if ($selectedArticle) {
        // Display article information
        echo "<h1>Sections for Article {$selectedArticle->getCode()}</h1>";
        echo "<p>Title: {$selectedArticle->getTitle()}</p>";
        echo "<p>Editor: {$selectedArticle->getEditor()}</p>";
        echo "<p>Date: {$selectedArticle->getDate()}</p>";

        // Display sections
        $sections = $selectedArticle->getSections();
        if (!empty($sections)) {
            echo "<h2>Sections</h2>";
            echo "<ul>";
            foreach ($sections as $section) {
                echo "<li>";
                echo "<strong>Section Code:</strong> {$section->getCode()}<br>";
                echo "<strong>Section Title:</strong> {$section->getSection()}<br>";
                echo "<strong>Text:</strong> {$section->getText()}";

                // Add a form for deleting the section
                echo "<form method='POST' action='delete_section.php'>";
                echo "<input type='hidden' name='articleCode' value='{$articleCode}'>";
                echo "<input type='hidden' name='sectionCode' value='{$section->getCode()}'>";
                echo "<button type='submit' name='deleteSection'>Delete Section</button>";
                echo "</form>";

                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No sections available for this article.</p>";
        }
        
    } else {
        echo "<p>Article not found.</p>";
    }
} else {
    echo "<p>Invalid request. Article code not provided.</p>";
}
?>
<html>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #0066cc;
            color: #fff;
        }

        a {
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: #004080;
        }
    </style>
</html>
