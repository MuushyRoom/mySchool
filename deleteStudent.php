<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM students WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Student record deleted successfully.";
        header('Location: teacher.php'); // Redirect back to the teacher page
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>