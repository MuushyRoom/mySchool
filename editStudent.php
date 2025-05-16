<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');

// Get the student_id from the URL
$student_id = $_GET['student_id'];

// Fetch the student's current details
$sql = "SELECT * FROM students WHERE student_id = $student_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    echo "Error: Student not found.";
    exit;
}

// Handle form submission for updating the student's information
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $student_email = $_POST['student_email'];
    $date_of_birth = $_POST['date_of_birth'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_number = $_POST['guardian_number'];
    $guardian_email = $_POST['guardian_email'];
    $level_id = $_POST['level_id'];
    $section_id = $_POST['section_id'];

    // Handle file upload if a new photo is uploaded
    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    } else {
        $photo = $student['photo']; // Keep the existing photo if no new photo is uploaded
    }

    // Check for duplicate username
    $check_username_query = "SELECT * FROM students WHERE username = '$username' AND student_id != $student_id";
    $check_username_result = $conn->query($check_username_query);

    // Check for duplicate email
    $check_email_query = "SELECT * FROM students WHERE student_email = '$student_email' AND student_id != $student_id";
    $check_email_result = $conn->query($check_email_query);

    if ($check_username_result->num_rows > 0) {
      echo "<div class='error'>Username already exists. Please choose a different one.</div>";
    } elseif ($check_email_result->num_rows > 0) {
          echo "<div class='error'>email is already taken. Please choose a different one.</div>";
    } else {
        // Update the student's information in the database
        $sql = "UPDATE students 
                SET firstname = '$firstname', 
                    lastname = '$lastname', 
                    gender = '$gender', 
                    username = '$username', 
                     password = '$password', 
                    student_email = '$student_email', 
                    date_of_birth = '$date_of_birth', 
                    photo = '$photo', 
                    guardian_name = '$guardian_name', 
                    guardian_number = '$guardian_number', 
                    guardian_email = '$guardian_email', 
                    level_id = '$level_id', 
                    section_id = '$section_id' 
                WHERE student_id = $student_id";

        if ($conn->query($sql) === TRUE) {
           header("Location: students.php");
        } else {
            echo "Error updating student: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editStudent.css">
    <title>Edit Student</title>
</head>

<body>
    <h1>Edit Student Information</h1>
    <form method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Student Information</legend>
            <img src="uploads/<?= $student['photo'] ?>" width="100" alt="Student Photo"><br>
            <label>Photo: <input type="file" name="photo"></label><br>
            <label>First Name: <input type="text" name="firstname" value="<?= $student['firstname'] ?>" required></label><br>
            <label>Last Name: <input type="text" name="lastname" value="<?= $student['lastname'] ?>" required></label><br>
            <label>Email: <input type="email" name="student_email" value="<?= $student['student_email'] ?>" required></label><br>
            <label>Gender:
                <select name="gender" required>
                    <option value="Male" <?= $student['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $student['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
            </label><br>
            <label>Date of Birth: <input type="date" name="date_of_birth" value="<?= $student['date_of_birth'] ?>" required></label><br>
        </fieldset>

        <fieldset>
            <legend>Account Information</legend>
            <label>Username: <input type="text" name="username" minlength="7" pattern="^[a-zA-Z0-9_]+$" value="<?= $student['username'] ?>" required></label><br>
              <label>Password: <input type="text" name="password"  minlength="6" pattern="^[a-zA-Z0-9_]+$" value="<?= $student['password'] ?>" required></label><br>
        </fieldset>

        <fieldset>
            <legend>Guardian Information</legend>
            <label>Guardian Name: <input type="text" name="guardian_name" value="<?= $student['guardian_name'] ?>" required></label><br>
            <label>Guardian Number: <input type="text" name="guardian_number" value="<?= $student['guardian_number'] ?>" required></label><br>
            <label>Guardian Email: <input type="email" name="guardian_email" value="<?= $student['guardian_email'] ?>" required></label><br>
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
                        $selected = $student['level_id'] == $level['level_id'] ? 'selected' : '';
                        echo "<option value='" . $level['level_id'] . "' $selected>" . $level['level_name'] . "</option>";
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
                        $selected = $student['section_id'] == $section['section_id'] ? 'selected' : '';
                        echo "<option value='" . $section['section_id'] . "' $selected>" . $section['section_name'] . "</option>";
                    }
                    ?>
                </select>
            </label><br>
        </fieldset>

        <button type="submit">Update Student</button>
         <a href="students.php">Back to Students</a>
    </form>
    <br>
     <div class="footer">
            <p>&copy; ABCPS Student Information System.</p>
            <p>Created by Ronan Cuaresma.</p>
        </div>
</body>

</html>