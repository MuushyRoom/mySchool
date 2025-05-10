<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $student_id = $_POST['student_id'];
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

    // Check for duplicate email, excluding the current student
    $query = "SELECT * FROM students WHERE student_email = '$student_email' AND student_id != $student_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<p style='color: red;'>A student with the same email already exists. Please use a different email.</p>";
     echo "<a href='editStudent.php?student_id=$student_id'>Go Back</a>";
        exit;
    }

    // Handle photo upload
    if ($_FILES['photo']['name']) {
        move_uploaded_file($tmp, "uploads/" . $photo);
        $conn->query("UPDATE students SET 
            first_name='$first_name', 
            last_name='$last_name', 
            gender='$gender',
            level='$level', 
            section_id='$section_id',
            student_email='$student_email',
            guardian_name='$guardian_name', 
            guardian_number='$guardian_number', 
            guardian_email='$guardian_email', 
            photo='$photo' 
            WHERE student_id=$student_id");
    } else {
        $conn->query("UPDATE students SET 
            first_name='$first_name', 
            last_name='$last_name', 
            gender='$gender',
            level='$level', 
            section_id='$section_id',
            student_email='$student_email',
            guardian_name='$guardian_name', 
            guardian_number='$guardian_number', 
            guardian_email='$guardian_email' 
            WHERE student_id=$student_id");
    }

    header("Location: students.php");
    exit;
}

?>