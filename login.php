<?php 
if($_SERVER["REQUEST_METHOD"]=='POST'){
    $conn = mysqli_connect("localhost","root","secret","forum_db");
if(isset($_POST['button'])){
        $errors = "";
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

if(empty($username) || empty($password)) {
   $errors = "invalid inputs!"; 
}else {
    $query = mysqli_query($conn,"SELECT username,password FROM register_db WHERE username = '$username';"); 
    $data = mysqli_fetch_assoc($query);

    if(is_null($data["username"])){
        $errors = "Username does not exist";
    }else{
        if(password_verify($password, $data["password"])){
            echo "Welcome $username!";
        }
        else{
            $errors = "Password desn't exist";
        }
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
    <title>login</title>
</head>
<body>
    
    <h1>Login In</h1>
    <p style="color:red"><?php if(isset($_POST['button'])) echo $errors; ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
        <input type="text" name="username" placeholder="Enter Username"><br><br>
        <input type="password" name="password" placeholder="Enter password"><br><br>
        <input type="submit" name="button">
    </form>
</body>
</html>