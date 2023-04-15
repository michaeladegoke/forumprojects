
<?php
    

    $conn = mysqli_connect("localhost","root","secret","forum_db");
    if(isset($_POST['submit'])){

        
      $username = htmlspecialchars($_POST['username']);
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);

      $errors = array();

      $user = "SELECT username FROM register_test WHERE username='$username'";
      $uresult = mysqli_query($conn, $user);

      $ema = "SELECT email FROM register_test WHERE email='$email'";
      $eresult = mysqli_query($conn, $ema);

      if(empty($username)){
          $errors['u'] = "Username required";
      }else if(mysqli_num_rows($uresult) > 0){
        $errors['u'] = "Username already exist";
      }

      if(empty($email)){
        $errors['e'] = "Email required";
    }else if(mysqli_num_rows($eresult) > 0){
        $errors['e'] = "E-mail already exist";
    }

    if(empty($password)){
        $errors['p'] = "password required";
    }

    if(count($errors) == 0){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO register_test (username, email, password)
                 VALUES('$username','$email','$password')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>alert('User created')</script>";
        }else{
            echo "<script>alert('failed')</script>";
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
    <title>Registration</title>
</head>
<body>
    <h1>Register Here</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div>
            <input type="text" name="username" placeholder="Username" autocomplete="off"><br>
            <p style="color:red"><?php if(isset($errors['u'])) echo $errors['u']; ?></p>
        </div>
        <div>
        <input type="email" name="email" placeholder="Email" autocomplete="off"> <br>
        <p style="color:red"><?php if(isset($errors['e'])) echo $errors['e']; ?></p>
        </div>
        <div>
        <input type="password" name="password" placeholder="Password" autocomplete="off"> <br />
        <p style="color:red"><?php if(isset($errors['p'])) echo $errors['p']; ?></p>
        <br />
        </div>
        <input type="submit" name="submit">
    </form><br>
    <a href="login.php">Login</a>
</body>
</html>
   