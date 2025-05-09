<?php
session_start();
include 'db.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
$user = $result->fetch_assoc();

if ($password === $user['password']){

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['role'] = $user['role'];

    if ($_SESSION['role'] == 'admin') {
        header('Location: admin.php');
    } else {
        header('Location: teacher.php');
    }
}
else {
$error = "Invalid password.";
}






} else {
$error = "User not found.";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2 style ="text-align: center;">Login</h2>
<form method="POST">
Username: <input type="text" name="username" required><br><br>
Password: <input type="password" name="password" required><br><br>
<input type="submit" value="Login">
</form>
<p style="color:red; text-align:center"><?= $error ?></p>
</body>
</html>