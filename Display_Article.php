<?php 


include_once 'classes.php';


// Check if the session with the name "jalal" is set
if (!isset($_SESSION['jalal'])) {
    // Handle the case when the session is not set, redirect or display an error message
    die("Session 'jalal' not found.");
} else {
    $articles = $_SESSION['jalal'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display_Article</title>
</head>
<body>
    <h1>Display articles by code</h1>
    <form action="mainpage.php">
     <label for="code"> 
        code: <input type="text" name="code" id="code">
        <input type="submit" name="exit" id="exit" value="exit">
     </label>
    </form>
</body>
</html>
