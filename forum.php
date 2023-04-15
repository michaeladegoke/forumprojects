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
    <title>My Forum</title>
</head>
<body>
    <p>Welcome <b><?php echo $_SESSION['username']; ?></b> !</p>
    <a href="create_post.php">Creat a new post</a><br><br><br><hr><br><br><br>

    <?php
    $conn = mysqli_connect("localhost", "root", "secret", "forum_db");

    $querry = mysqli_query($conn, "SELECT post_title, poster FROM posting");
    while($data = mysqli_fetch_assoc($querry)){
        echo "<h1><a href='show_content.php?title=".$data['post_title']."'>".$data['post_title']."</a> <sub>by ".$data['poster']."
        </sub></h1><br><br>";
    }
    ?> 
</body>
</html>