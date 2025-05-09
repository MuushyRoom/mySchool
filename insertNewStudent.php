<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$level = $_POST['level'];
$section_id = $_POST['section_id'];
$student_email = $_POST['student_email'];
$guardian_name = $_POST['guardian_name'];
$guardian_number = $_POST['guardian_number'];
$guardian_email = $_POST['guardian_email'];



$photo = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
move_uploaded_file($tmp, "uploads/" . $photo);
$sql = "INSERT INTO students (first_name, last_name, student_email, guardian_name, guardian_number, guardian_email, photo)
VALUES ('$first_name', '$last_name', '$student_email', '$guardian_name', '$guardian_number', '$guardian_email', '$photo')"; 
$conn->query($sql);
header("Location: students.php");


?>