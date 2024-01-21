<?php
include_once 'classes.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Retrieve the article code from the URL parameter
$articleCode = isset($_GET['code']) ? $_GET['code'] : '';

// Check if the 'jalal' session variable is set
if (isset($_SESSION['jalal']) && is_array($_SESSION['jalal'])) {
    // Find the article with the specified code
    $selectedArticle = null;
    foreach ($_SESSION['jalal'] as $article) {
        if ($article->getCode() == $articleCode) {
            $selectedArticle = $article;
            break;
        }
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $articleCode = $_POST['articleCode'];

    $articleFound = false;
    foreach ($_SESSION['jalal'] as $article) {
        if ($article instanceof article && $article->getCode() == $articleCode) {
            $articleFound = true;

            $sectionCode = $_POST['sectionCode'];
            $sectionTitle = $_POST['sectionTitle'];
            $sectionText = $_POST['text'];

            $newSection = new section($sectionCode, $sectionTitle, $sectionText);

            // Optionally, you can add the new section to the article
            $article->addSection($newSection);

            // Echo success message outside the loop
            echo "<p>Section added to the article.</p>";
            break;
        }
    }

    if (!$articleFound) {
        echo "<p>Article not found.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Section</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-top: 50px;
        }

        form {
            margin-top: 30px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input, textarea {
            padding: 8px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #0066cc;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #004080;
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
</head>
<body>
    <h1>Add Section for Article <?php echo $article->getCode(); ?></h1>
    <form action="add_section.php?code=<?php echo $articleCode; ?>" method="POST">
        <input type="hidden" name="articleCode" value="<?php echo $articleCode; ?>">
        <label for="sectionCode">
            Section Code: <input type="text" name="sectionCode" id="sectionCode" value="" >
        </label>
        <label for="sectionTitle">
            Section Title: <input type="text" name="sectionTitle" id="sectionTitle">
        </label>
        <label for="text">
            Text: <textarea name="text" id="text"></textarea>
        </label>
        <label for="submit">
            <input type="submit" name="submit" id="submit" value="Add Section">
        </label>
    </form>
    <a href="displayall.php">Display All</a>
</body>
</html>
