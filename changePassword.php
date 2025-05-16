<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');

// Fetch current user info
$student_id = $_SESSION["user_id"];
$role = $_SESSION["role"] ?? 'student';


    $sql = "SELECT * FROM admin WHERE admin_id = $student_id";

    $sql = "SELECT * FROM students WHERE student_id = $student_id";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

$messageError = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION["user_id"];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

 
        // Check for duplicate username in admin table, excluding current admin
        $username_check = $conn->query("SELECT * FROM admin WHERE username = '$username' AND acc_id != $student_id");
        if ($username_check->num_rows > 0) {
            echo "<div class='error'>Username already exists. Please choose a different one.</div>";
        }
        // Check for duplicate username in students table, excluding current student
        $username_check = $conn->query("SELECT * FROM students WHERE username = '$username' AND student_id != $student_id");
        if ($username_check->num_rows > 0) {
            echo "<div class='error'>Username already exists. Please choose a different one.</div>";
        } else {
            $conn->query("UPDATE students SET username='$username', password='$password' WHERE student_id=$student_id");
              echo "<div class='success'>Changed Password Successfully</div>";
            
        }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Username & Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 400px;
            margin: 60px auto 0 auto;
            padding: 32px 28px 24px 28px;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            color: #1976d2;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #222;
            font-size: 1rem;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 0px 12px 5px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            background: #fafbfc;
        }
        
.school-logo {
        display: block;
    margin-left: auto;
    margin-right: auto;
    height: 240px;
    width: 240px;
        }

        input[type="submit"] {
            width: 100%;
            background: #1976d2;
            color: #fff;
            border: none;
            padding: 12px 0;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        input[type="submit"]:hover {
            background: #125ea8;
        }
        .error {
            color: #e53935;
            background: #ffeaea;
            border: 1px solid #e53935;
            border-radius: 4px;
            padding: 8px 12px;
            margin-bottom: 16px;
            text-align: center;
        }
        .success {
            color: #388e3c;
            background: #e8f5e9;
            border: 1px solid #388e3c;
            border-radius: 4px;
            padding: 8px 12px;
            margin-bottom: 16px;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #1976d2;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
 
    <div class="container">
 <img src="logo/abcps.png" alt="ABCPS Logo" class="school-logo">
        <h2>Change Username & Password</h2>
    
        <form method="post">
            <label>Username:
                <input type="text" name="username"  minlength="7" pattern="^[a-zA-Z0-9_]+$" required>
            </label>
            <label>New Password:
                <input type="password" name="password" minlength="6" pattern="^[a-zA-Z0-9_]+$" required>
            </label>
            <input type="submit" value="Update">
        </form>
        <?php if ($role === 'admin'): ?>
            <a href="website.php" class="back-link">Back to Dashboard</a>
        <?php else: ?>
            <a href="myProfile.php?student_id=<?= $student_id ?>" class="back-link">Back to Profile</a>
        <?php endif; ?>
    </div>
</body>
</html>