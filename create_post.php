<?php
session_start();

if(is_null($_SESSION['username'])){
    header("Location: login.php");
}
if($_SERVER['REQUEST_METHOD']=="POST"){
    $conn = mysqli_connect("localhost", "root", "secret", "forum_db");

    $errors = "";
    $poster = $_SESSION['username'];
    $title = $_POST['title'];
    $post_desc = $_POST['desc'];
    
    if(empty($title) or empty($post_desc)){
         $errors = "Invalid Input!";
    } else{
        $querry = mysqli_query($conn, "SELECT post_title FROM posting 
        WHERE post_title = '$title'");
        $data = mysqli_fetch_assoc($querry);

        if(!is_null($data['post_title'])){
            $errors = "Post name already exist";
        }else{
            $querry = mysqli_query($conn, "INSERT INTO posting (poster, post_title, post_desc)
            VALUES('$poster','$title','$post_desc');");
    
            if($querry){
                //echo "post created";
                header("Location: forum.php");
            }else{
                echo "its not working";
            }
        }
        
    }   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <a href="forum.php">Go back to forum</a>
    <h1>Create Post</h1>
    <p style="color:red"><?php if(isset($_POST['submit'])) echo $errors; ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <input type="text" name="title" placeholder="Post title"><br><br><br>
    <textarea name="desc" rows="25" cols="50" placeholder="Post Description"></textarea><br><br>
    <input type="submit" name="submit">

      

    </form>
</body>
</html>