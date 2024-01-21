
<?php
include ("classes.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the 'jalal' session variable is set
if (isset($_SESSION['jalal']) && is_array($_SESSION['jalal'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display All Articles</title>
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
</head>
<body>
    <h1>All Articles</h1>
    <table>
        <tr>
            <th>Code</th>
            <th>Title</th>
            <th>Editor</th>
            <th>Date</th>
            <th>Delete Article</th>
            <th>Update Article</th>
            <th>Add Section</th>
            <th>View Sections</th>
        </tr>

        <?php
        // Loop through each article in the array and display its information
        foreach ($_SESSION['jalal'] as $article) {
            echo "<tr>";
            echo "<td>{$article->getCode()}</td>";
            echo "<td>{$article->getTitle()}</td>";
            echo "<td>{$article->getEditor()}</td>";
            echo "<td>{$article->getDate()}</td>";
            // Placeholder links, replace these with your actual delete/update/add section actions or pages
            echo "<td>
            <form method='POST' action='delete.php'>
                <input type='hidden' name='articleCode' value='{$article->getCode()}'>
                <button type='submit' name='delete'>Delete</button>
            </form>
        </td>";
        echo "<td>
        <form method='POST' action='update.php'>
            <input type='hidden' name='articleCode' value='{$article->getCode()}'>
            <button type='submit' name='update'>Update</button>
        </form>
    </td>";
            echo "<td><a href='Add_Section.php?code={$article->getCode()}'>Add Section</a></td>";
            echo "<td><a href='view_sections.php?code={$article->getCode()}'>View Sections</a></td>";


            echo "</tr>";
        }
        
        ?>
    </table>
    <a href="Add_Article.php">Add an Article</a>
</body>
</html>

<?php
} else {
    echo "<p>No articles available</p>";
}
?>
