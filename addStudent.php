<?php

session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $student_email = $_POST['student_email'];
    $date_of_birth = $_POST['date_of_birth'];
    $photo = $_FILES['photo']['name'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_number = $_POST['guardian_number'];
    $guardian_email = $_POST['guardian_email'];
    $level_id = $_POST['level_id'];
    $section_id = $_POST['section_id'];

    $check_username_query = "SELECT * FROM students WHERE username = '$username'";
    $check_username_result = $conn->query($check_username_query);

    // Check for duplicate email
    $check_email_query = "SELECT * FROM students WHERE student_email = '$student_email'";
    $check_email_result = $conn->query($check_email_query);

    if ($check_username_result->num_rows > 0) {
           echo "<h2 style='color:red;
           text-align:center;
           padding-top: 20px;
           ' >Username is already taken. Please choose a different one.</h2>";
    } elseif ($check_email_result->num_rows > 0) {
           echo "<div class='error'>email is already taken. Please choose a different one.</div>";
    }else {
        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

        // Insert data into the database
        $sql = "INSERT INTO students (firstname, lastname, gender, username, password, student_email, date_of_birth, photo, guardian_name, guardian_number, guardian_email, level_id, section_id) 
                VALUES ('$firstname', '$lastname', '$gender', '$username', '$password', '$student_email', '$date_of_birth', '$photo', '$guardian_name', '$guardian_number', '$guardian_email', '$level_id', '$section_id')";

        if ($conn->query($sql) === TRUE) {
            // Get the last inserted student_id
            $student_id = $conn->insert_id;

        
              header("Location: students.php");
            exit;
         
    
          
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addStudentStyles.css">
    <title>Add New Student</title>
</head>
<body>
    <h1>Add New Student</h1>
    <form method="POST" enctype="multipart/form-data">

    <fieldset>
    <legend>Student Information</legend>
    <label>Photo: <input type="file" name="photo"></label><br>
   <label>First Name: <input type="text" name="firstname" required></label><br>
        <label>Last Name: <input type="text" name="lastname" required></label><br>
     

        <label>Email: <input type="email" name="student_email" required></label><br>
           <label>Gender: 
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </label><br>
        <label>Date of Birth: <input type="date" name="date_of_birth" required></label><br>
    

    </fieldset>
    <fieldset>
    <legend>Account Creation</legend>
        <label>Username: <input type="text" minlength="7" name="username" pattern="^[a-zA-Z0-9_]+$" required></label><br>
        <label>Password: <input type="password" minlength="6" name="password" pattern="^[a-zA-Z0-9_]+$" required></label><br>
    </fieldset>

    <fieldset>
    <legend>Level and Section</legend>
     <label>Level: 
            <select name="level_id" required>
                <?php
                // Fetch levels from the database
                $level_query = "SELECT * FROM levels";
                $level_result = $conn->query($level_query);
                while ($level = $level_result->fetch_assoc()) {
                    echo "<option value='" . $level['level_id'] . "'>" . $level['level_name'] . "</option>";
                }
                ?>
            </select>
        </label><br>
        <label>Section: 
            <select name="section_id" required>
                <?php
                // Fetch sections from the database
                $section_query = "SELECT * FROM sections";
                $section_result = $conn->query($section_query);
                while ($section = $section_result->fetch_assoc()) {
                    echo "<option value='" . $section['section_id'] . "'>" . $section['section_name'] . "</option>";
                }
                ?>
            </select>
        </label><br>

    </fieldset>
    <fieldset>
                <legend>Guardian Information</legend>
     
        <label>Guardian Name: <input type="text" name="guardian_name" required></label><br>
        <label>Guardian Number: <input type="text" name="guardian_number" required></label><br>
        <label>Guardian Email: <input type="email" name="guardian_email" required></label><br>
    </fieldset>


       
        <button type="submit">Add Student</button>
         <a href="students.php">Back to Students</a>
    </form>
    <br>

</body>
</html>