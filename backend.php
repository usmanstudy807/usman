<?php
session_start();

$conn = new mysqli("localhost","root","","student_portal");

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM students WHERE email='$username'";
$result = $conn->query($sql);

if($result->num_rows>0){
    $user = $result->fetch_assoc();

    if(password_verify($password,$user['password_hash'])){
        $_SESSION['student']=$user['username'];
        header("Location: courses.html");
        exit();
    }else{
        echo "Wrong Password";
    }
}else{
    echo "User not found";
}
?>