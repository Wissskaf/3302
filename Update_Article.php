<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Article</title>
</head>
<body>
<?php
    // Retrieve the code from the URL parameter
    $code = isset($_GET['code']) ? htmlspecialchars($_GET['code']) : '';

    // Output the code in a hidden field for processing on submission
    echo '<input type="hidden" name="code" value="' . $code . '">';
    ?>
    <form action="update_process.php" method="POST">
        <label for="code">
            Code Article: <input type="text" id="code" name="code" value="<?php echo $code; ?>"readonly>
        </label><br>
        <label for="title">
            Title Section: <input type="text" name="title" id="title">
        </label><br>
        <label for="text">
            Text: <br><textarea name="text" id="text" rows="5" cols="40"></textarea>
        </label><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
