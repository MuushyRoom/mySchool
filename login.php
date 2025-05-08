<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $res1 = $conn->query("SELECT * FROM administrators WHERE username='$username'");
    $res2 = $conn->query("SELECT * FROM professors WHERE username='$username'");

    if ($res1->num_rows === 1) {
        $user = $res1->fetch_assoc();
        if ($password === $user['password']) {


      
            $_SESSION['first_name'] = $user['first_name'];
       

            $_SESSION["user_id"] = $user["acc_id"] ?? $user["prof_id"];
            $_SESSION["role"] = isset($user["acc_id"]) ? "admin" : "professor";
           
            header("Location: website.php");
            exit;
        }
    }
    if ($res2->num_rows === 1) {
        $user = $res2->fetch_assoc();
        if ($password === $user['password']) {


      
            $_SESSION['first_name'] = $user['first_name'];
       

            $_SESSION["user_id"] = $user["acc_id"] ?? $user["prof_id"];
            $_SESSION["role"] = isset($user["acc_id"]) ? "admin" : "professor";
           
            header("Location: website.php");
            exit;
        }
    }
    
    
    
    
    
    
    
    else{
    echo "Invalid credentials.";
    }
}
?>



<form method="post">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <input type="submit" value="Login">
</form>
