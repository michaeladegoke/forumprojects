<?php
session_start();

if(is_null($_SESSION['username'])){
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="forum.php">Go back to the forum</a>.
    <?php
    $conn = mysqli_connect("localhost", "root", "secret", "forum_db");

    $title = $_GET['title'];

    if(is_null($title)){
        header("Location: forum.php");
    }
    $querry = mysqli_query($conn, "SELECT poster, post_title, post_desc FROM posting WHERE 
    post_title='$title';");
    $data = mysqli_fetch_assoc($querry);

    if(is_null($data['post_title'])) {
        header("Location: forum.php");
    }

    echo "<h1>".$data['post_title']."</h1>";
    echo "<sup> by <b>".$data['poster']."</b></sup><br><br><br><hr>";
    echo "<p>".$data['post_desc']."</p>";
    
    ?>
</body>
</html>