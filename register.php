
<?php
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn = mysqli_connect("localhost","root","secret","forum_db");
    if(isset($_POST['submit'])){

        $errors = "";
      $username = htmlspecialchars($_POST['username']);
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);

  if(empty($username) or empty($email) or empty($password) or !filter_var($email, 
    FILTER_VALIDATE_EMAIL)){
    $errors = "Invalid Input";
   }else{
    $query=mysqli_query($conn,"SELECT  username FROM register_db WHERE 
    username='$username';");
    $query1=mysqli_query($conn,"SELECT email FROM register_db WHERE 
    email='$email';");
    $data = mysqli_fetch_assoc($query);
    $data1 = mysqli_fetch_assoc($query1);

    if(!is_null($data['username'])){
         $errors = "Username already exist!";
    }elseif(!is_null($data1['email'])){
        $errors = "E-mail already exist";
    }else{
     $pass = password_hash($password, PASSWORD_DEFAULT);
     //$hash = password_hash($password,PASSWORD_DEFAULT); 
    $query = mysqli_query($conn, "INSERT INTO register_db (username, email, password)
    VALUES('$username','$email','$pass');"); 

    if($query){
        //echo "User created!";
        echo "<script>alert('User created')</script>";
    }else{
        echo "its not working";
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
    <title>Registration</title>
</head>
<body>
    <h1>Register Here</h1>
    <p style="color:red"><?php if(isset($_POST['submit'])) echo $errors; ?></p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="text" name="username" placeholder="Username" autocomplete="off"><br>
        <input type="email" name="email" placeholder="Email" autocomplete="off"> <br>
        <input type="password" name="password" placeholder="Password" autocomplete="off"> <br />
        <br />
        <input type="submit" name="submit">
    </form>
</body>
</html>
   