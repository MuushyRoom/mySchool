<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $prof_email = $_POST['prof_email'];
    $contact_number = $_POST['contact_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $section_id = $_POST['section_id'];
    $level_handled = $_POST['level_handled'];


    $photo = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';
    $tmp = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : '';
    if (!empty($photo) && !empty($tmp)) {
        move_uploaded_file($tmp, "uploads/" . $photo);
    }


       $username_check = $conn->query("SELECT * FROM professors WHERE username = '$username'");
    if ($username_check->num_rows > 0) {
        echo "<p style='color: red;'>Username already exists. Please choose a different username.</p>";
        echo "<a href='addProf.php'>Go back</a>";
        exit;
    }


    $query = "SELECT * FROM professors WHERE prof_email = '$prof_email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<p style='color: red;'>A professor with the same email already exists. Please use a different email.</p>";
        echo "<a href='addProf.php'>Go back</a>";
        exit;
    }


    $section_check = $conn->query("SELECT * FROM professors WHERE level_handled = '$level_handled' AND section_id = '$section_id'");
    if ($section_check->num_rows > 0) {
        echo "<p style='color: red;'>A professor is already assigned to this section and level. Please choose a different class and level.</p>";
        echo "<a href='addProf.php'>Go back</a>";
        exit;
    }

 

    $sql = "INSERT INTO professors (first_name, last_name, gender, prof_email, contact_number, username, password, section_id, level_handled, photo)
            VALUES ('$first_name', '$last_name', '$gender', '$prof_email', '$contact_number', '$username', '$password', '$section_id', '$level_handled', '$photo')";
    $conn->query($sql);


    header("Location: professors.php");
    exit;
} else {
    echo "<p style='color: red;'>Invalid request method. Please submit the form.</p>";
    exit;
}

?>