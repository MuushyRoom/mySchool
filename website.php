<?php
include('db.php');
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");

$role = $_SESSION["role"];
$first_name = $_SESSION["first_name"];
echo "<h2>Welcome, $role $first_name</h2>";
echo "<a href='logout.php'>Logout</a><br><br>";

if ($role === "admin") {
    echo "<a href='students.php'>Manage Students</a><br>";
    echo "<a href='professors.php'>Manage Professors</a><br>";
 
} elseif ($role === "professor") {
    echo "<a href='students.php'>Manage Students</a><br>";
 
}
?>

