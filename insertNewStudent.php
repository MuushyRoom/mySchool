<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');






if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$level = $_POST['level'];
$section_id = $_POST['section_id'];
$student_email = $_POST['student_email'];
$guardian_name = $_POST['guardian_name'];
$guardian_number = $_POST['guardian_number'];
$guardian_email = $_POST['guardian_email'];



$photo = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
move_uploaded_file($tmp, "uploads/" . $photo);

    $query = "SELECT * FROM students WHERE 
              student_email = '$student_email'
              
              ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<p style='color: red;'>A student with the same details already exists. Please check your input.</p>";
          echo "<a href='addStudent.php'>Go back</a>";
    } else {
 
$sql = "INSERT INTO students (first_name, last_name, gender, level, section_id,student_email, guardian_name, guardian_number, guardian_email, photo)
VALUES ('$first_name', '$last_name', '$gender', '$level', '$section_id', '$student_email', '$guardian_name', '$guardian_number', '$guardian_email', '$photo')"; 
$conn->query($sql);
header("Location: students.php");
        exit;
    }
}








?>