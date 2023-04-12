<?php
$conn = new mysqli('localhost', 'root', 'secret', 'forum');

if(!$conn){
    die(mysqli_error($conn));
}
?>