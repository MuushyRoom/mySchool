<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $res1 = $conn->query("SELECT * FROM admin WHERE username='$username'");
    if ($res1->num_rows === 1) {
        $user = $res1->fetch_assoc();
        if ($password === $user['password']) {
        
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION["user_id"] = $user["acc_id"];
            $_SESSION["role"] = "admin";

            header("Location: website.php");
            exit;
        }
    }

    // Check if the user is a student
    $res = $conn->query("SELECT * FROM students WHERE username='$username'");
    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if ($password === $user['password']) {
     
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION["user_id"] = $user["student_id"];
            $_SESSION["role"] = "student";

            header("Location: website.php");
            exit;
        }
    }

  
    echo "<h2 style='color:red; text-align: center; padding-top: 20px;'>Invalid credentials.</h2>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="loginStyles.css">
    <title>Login</title>
   
</head>
<body>
    <div class="login-container">
 <img src="logo/abcps.png" class="school-logo" alt="ABCPS Logo">

        <div class="login-title">Welcome to ABCPS University</div>
        <div class="login-desc">Please enter your credentials to log in.</div>
        <form method="post">
            <label>Username:
                <input type="text" name="username" autocomplete="off" required>
            </label>
            <label>Password:
                <input type="password" name="password" autocomplete="off" required>
            </label>
            <input type="submit" value="Login" class="login-btn">
        </form>
        <div class="login-footer">
             <p>&copy; ABCPS Student Information System.</p>
            <p>Created by Ronan Cuaresma.</p>
        </div>
    </div>
</body>
</html>