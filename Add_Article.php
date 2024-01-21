<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once 'classes.php';

if (!isset($_SESSION['jalal'])) {
    $_SESSION['jalal'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $title = $_POST['title'];
    $editor = $_POST['editor'];
    $date = $_POST['date'];

    $newArticle = new article($code, $title, $editor, $date);
    $_SESSION['jalal'][] = $newArticle;

    echo "<p>Article Created</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
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
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
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
    <h1>Add an Article</h1>
    <form action="Add_Article.php" method="POST">
        <label for="code">
            Code: <input type="text" name="code" id="code">
        </label>
        <label for="title">
            Title: <input type="text" name="title" id="title">
        </label>
        <label for="editor">
            Editor: <input type="text" name="editor" id="editor">
        </label>
        <label for="date">
            Date: <input type="date" name="date" id="date">
        </label>
        <label for="submit">
            <input type="submit" name="submit" id="submit" value="Add article">
        </label>
    </form>
    <a href="displayall.php">Display All</a>
</body>
</html>
