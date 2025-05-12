<?php
include('db.php');
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
a {
    text-decoration: none;
    color: blue;
    font-size: 20px;
}


</style>
</head>
<body>
    


<?php 


$student_count_query = "SELECT COUNT(*) AS total_students FROM students";
$student_count_result = $conn->query($student_count_query);
$student_count = $student_count_result->fetch_assoc()['total_students'];


$professor_count_query = "SELECT COUNT(*) AS total_professors FROM professors";
$professor_count_result = $conn->query($professor_count_query);
$professor_count = $professor_count_result->fetch_assoc()['total_professors'];

$role = $_SESSION["role"];
$first_name = $_SESSION["first_name"];
echo "<h2>Welcome, $role $first_name</h2>";
echo "<a href='logout.php'>Logout</a><br><br>";



if ($role === "admin") {
    echo "<a href='students.php'>Manage Students ($student_count)</a><br>";
    echo "<a href='professors.php'>Manage Professors ($professor_count)</a> <br>";
} elseif ($role === "professor") {
    echo "<a href='students.php'>Manage Students ($professor_count)</a><br>";
}




?>




</body>
</html>

