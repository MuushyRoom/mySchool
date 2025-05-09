<?php
include "db.php";

$prof_id = $_POST['prof_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$level_handled = $_POST['level_handled']; 
$section_id = $_POST['section_id']; 
$prof_email = $_POST['prof_email'];
$contact_number = $_POST['contact_number'];
$username = $_POST['username'];
$password = $_POST['password'];


if ($_FILES['photo']['name']) {
    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $photo);
    $conn->query("UPDATE professors SET 
        first_name='$first_name', 
        last_name='$last_name', 
        gender='$gender',
        level_handled='$level_handled', 
        section_id='$section_id',
        prof_email='$prof_email', 
        username='$username', 
        password='$password', 
        photo='$photo' 
        WHERE prof_id=$prof_id");
} else {
    $conn->query("UPDATE professors SET 
        first_name='$first_name', 
        last_name='$last_name', 
        gender='$gender',
        level_handled='$level_handled', 
        section_id='$section_id',
        prof_email='$prof_email', 
        username='$username', 
        password='$password'
        WHERE prof_id=$prof_id");
}

header("Location: professors.php");
?>