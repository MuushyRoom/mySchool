<?php
include('db.php');
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");

$role = $_SESSION["role"];
$firstname = $_SESSION["firstname"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Information System</title>
<link rel="stylesheet" href="websiteStyles.css">
</head>
<body>
  
  
    <div class="container">
      
        <img src="logo/abcps.png" alt="ABCPS Logo" class="school-logo">
          <h1 style="text-align: center; color: #1976d2; font-weight: 500;">School Information System</h1>
         <div class="role">
            Logged in as: <strong><?= ucfirst($role) ?> <?= htmlspecialchars($firstname) ?></strong>
        </div>
        <div class="links">
            <?php if ($role === 'admin'): ?>
                <a href="students.php" class="button-link">Manage Students</a><br>
                <a href='logout.php' class='logout'>Logout</a>
            <?php elseif ($role === 'student'): ?>
                <?php
                // Fetch the student_id for the logged-in student using user_id
                $student_id = $_SESSION['user_id'];
                $student_query = $conn->query("SELECT * FROM students WHERE student_id = '$student_id' LIMIT 1");
                if ($student_query && $student_query->num_rows > 0) {
                    $student_row = $student_query->fetch_assoc();
                    $student_id = $student_row['student_id'];
                    echo "<a href='myProfile.php?student_id=$student_id' class='button-link'>My Profile</a><br>";
                    echo "<a href='logout.php' class='logout'>Logout</a>";
                } else {
                    echo "<div style='color:#e53935;'>Student profile not found.</div>";
                }
                ?>
            <?php endif; ?>
        </div>
        <div class="footer">
            <p>&copy; ABCPS Student Information System.</p>
            <p>Created by Ronan Cuaresma.</p>
        </div>
    </div>
</body>
</html>

