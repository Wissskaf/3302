<?php
include_once 'classes.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $articleCode = $_POST['articleCode'];

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
                
                <title>Update Article</title>
            </head>
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
            <body>
                <h1>Update Article</h1>
                <form method="POST" action="update_process.php">
                    <input type="hidden" name="articleCode" value="<?php echo $article->getCode(); ?>">
                    
                    <label for="code">Code:</label>
                    <input type="text" id="code" name="code" value="<?php echo $article->getCode(); ?>" required><br>

                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $article->getTitle(); ?>" required><br>

                    <label for="editor">Editor:</label>
                    <input type="text" id="editor" name="editor" value="<?php echo $article->getEditor(); ?>" required><br>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="<?php echo $article->getDate(); ?>" required><br>

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
