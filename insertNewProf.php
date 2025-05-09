<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$prof_email = $_POST['prof_email'];
$contact_number = $_POST['contact_number'];
$username = $_POST['username'];
$password = $_POST['password'];
$section_id = $_POST['section_id'];
$level_handled = $_POST['level_handled'];


$photo = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
move_uploaded_file($tmp, "uploads/" . $photo);
$sql = "INSERT INTO professors (first_name, last_name, gender,prof_email, contact_number, username, password, section_id, level_handled, photo)
 VALUES ('$first_name', '$last_name','$gender', '$prof_email', '$contact_number', '$username', '$password', '$section_id', '$level_handled', '$photo')";  

$conn->query($sql);
header("Location: professors.php");


?>