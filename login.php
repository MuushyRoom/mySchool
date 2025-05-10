<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $res1 = $conn->query("SELECT * FROM administrators WHERE username='$username'");
 $res = $conn->query("SELECT * FROM professors WHERE username='$username'");

    if ($res1->num_rows === 1) {
        $user = $res1->fetch_assoc();
        if ($password === $user['password']) {


      
            $_SESSION['first_name'] = $user['first_name'];
       

            $_SESSION["user_id"] = $user["acc_id"] ?? $user["prof_id"];
            $_SESSION["role"] = isset($user["acc_id"]) ? "admin" : "professor";
           
            header("Location: website.php");
            exit;
        }
    } if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if ($password === $user['password']) {


      
            $_SESSION['first_name'] = $user['first_name'];
       

            $_SESSION["user_id"] = $user["acc_id"] ?? $user["prof_id"];
            $_SESSION["role"] = isset($user["acc_id"]) ?:"professor";
           
            header("Location: website.php");
            exit;
        }
    }

    else{
    echo "Invalid credentials.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Login</title>
</head>
<body>

<h1>Welcome to the mySchool Login Page</h1>
<p>Please enter your credentials to log in.</p>
    <h2>Login</h2>
<form method="post">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <input type="submit" value="Login">
</form>
</body>