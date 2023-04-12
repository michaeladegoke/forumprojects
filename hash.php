<?php
if(isset($_POST['submit'])){
    if($_POST['password']) {
        $password = $_POST["password"];
    
        echo "Your password is $password";
    
        $password = password_hash($password,PASSWORD_DEFAULT);
    
        echo "<br><br><br>";
    
        echo "Your hash password is $password";
        echo "<br><br><br>";

        $savedpassword = "testpassword";
        if(password_verify($savedpassword,$password)){
            echo "<br><br><br>";
            echo "Your Passwor is correct";     

        }else {
            echo "Invalid Password! Try again";
            echo "<br><br><br>";
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
    <title>Hash</title>
</head>
<body>
    <form method="POST">
       <label for="password">Whats Your Password?</label><br><br>
       <input type="password" name="password" id="password"><br><br>
       <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>