<?php
include "db.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $photo = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';
    $tmp = isset($_FILES['photo']['tmp_name']) ? $_FILES['photo']['tmp_name'] : '';




  // Check for duplicate username, excluding the current professor
    $username_check = $conn->query("SELECT * FROM professors WHERE username = '$username' AND prof_id != $prof_id");
    if ($username_check->num_rows > 0) {
        echo "<p style='color: red;'>The username is already taken. Please choose a different username.</p>";
        echo "<a href='editProf.php?prof_id=$prof_id'>Go Back</a>";
        exit;
    }


    // Check for duplicate email, excluding the current professor
    $query = "SELECT * FROM professors WHERE prof_email = '$prof_email' AND prof_id != $prof_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<p style='color: red;'>A professor with the same email already exists. Please use a different email.</p>";
        echo "<a href='editProf.php?prof_id=$prof_id'>Go Back</a>";
        exit;
    }

    // Check for duplicate section and level handled
    $section_check = $conn->query("SELECT * FROM professors WHERE level_handled = '$level_handled' AND section_id = '$section_id' AND prof_id != $prof_id");
    if ($section_check->num_rows > 0) {
        echo "<p style='color: red;'>A professor is already assigned to this section and level. Please choose a different section or level.</p>";
        echo "<a href='editProf.php?prof_id=$prof_id'>Go Back</a>";
        exit;
    }

  

    // Handle photo upload
    if (!empty($photo) && !empty($tmp)) {
        move_uploaded_file($tmp, "uploads/" . $photo);
        $conn->query("UPDATE professors SET 
            first_name='$first_name', 
            last_name='$last_name', 
            gender='$gender',
            level_handled='$level_handled', 
            section_id='$section_id',
            prof_email='$prof_email', 
            contact_number='$contact_number',
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
            contact_number='$contact_number',
            username='$username', 
            password='$password'
            WHERE prof_id=$prof_id");
    }

    header("Location: professors.php");
    exit;
}
?>