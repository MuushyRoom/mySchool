<?php
include "db.php";
$student_id = $_GET['student_id'];
$conn->query("DELETE FROM students WHERE student_id=$student_id");
header("Location: students.php");
?>