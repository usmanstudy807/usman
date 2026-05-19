<?php
$conn = new mysqli("localhost","root","","student_portal");

if($conn->connect_error){
    die("Database connection failed");
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

/* Check username already exists */
$check = "SELECT * FROM students WHERE username='$username'";
$result = $conn->query($check);

if($result->num_rows > 0){
    echo "<h2 style='color:red;'>Username already exists!</h2>";
    echo "<p><a href='register.html'>Go Back</a></p>";
}
else{
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO students(username,email,password_hash)
            VALUES('$username','$email','$password_hash')";

    if($conn->query($sql) === TRUE){
        echo "<h2 style='color:green;'>Successfully Registered!</h2>";
        echo "<p>Redirecting to login page...</p>";

        /* 2 second baad login page par bhej dega */
        header("refresh:2;url=index.html");
    }
    else{
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>