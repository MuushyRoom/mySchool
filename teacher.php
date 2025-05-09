<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

echo "Welcome, Teacher! " . $_SESSION['first_name'] . " | <a href='logout.php'>Logout</a>";

include('db.php');

// CRUD operations: Create, Read, Update, Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {



    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $level = $_POST['level'];
    $section = $_POST['section'];
    $student_email = $_POST['student_email'];
  
    $guardian_name = $_POST['guardian_name'];
    $guardian_contact = $_POST['guardian_contact'];
    $guardian_email = $_POST['guardian_email'];



   
  
    if ($_POST['action'] == 'add_student') {
     

        // Check if username already exists
        $check = $conn->query("SELECT * FROM students WHERE first_name = '$first_name' && last_name = '$last_name' && level = '$level' && section = '$section' 
        && student_email = '$student_email' && guardian_name = '$guardian_name' && guardian_contact = '$guardian_contact' && guardian_email = '$guardian_email' && student_email = '$student_email'");
    
        if ($check->num_rows > 0) {
            echo "Students already exists.";
        } else {
            $sql = "INSERT INTO students (id,first_name, last_name, level, section, student_email, guardian_name, guardian_contact, guardian_email)
             VALUES ('','$first_name', '$last_name', '$level', 
            '$section',  '$student_email','$guardian_name', '$guardian_contact', '$guardian_email')";
            if ($conn->query($sql) === TRUE) {
                echo "New student added successfully.";
                header('Location: teacher.php');
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    // Existing create student logic...
}
 
// Display students' records
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

echo "<h3>Students Table</h3>";
$students = $conn->query("SELECT * FROM students");

echo "<table border='1'><tr>
    <th>Student ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Level</th>
    <th>Section</th>
    <th>Student Email</th>
    <th>Guardian Name</th><th>Guardian Contact</th><th>Guardian Email</th>
    <th>Action</th>
</tr>";
while ($row = $students->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td>
        <td>{$row['level']}</td>
        <td>{$row['section']}</td>
        <td>{$row['student_email']}</td>
        <td>{$row['guardian_name']}</td>
        <td>{$row['guardian_contact']}</td>
         <td>{$row['guardian_email']}</td>
        <td>
    <a href='editStudent.php?id={$row['id']}'>Edit</a> |
   <a href='deleteStudent.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to remove this student?\")'>Remove</a>
    
    </td>
    </tr>";
}
echo "</table>";
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
   
    <title>Student Management View</title>
</head>
<body>

<h3>Add New Student </h3>
<form method="post" action="teacher.php">
    <input type="hidden" name="action" value="add_student">

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required><br>

    <label for="level">Level:</label>
    <input type="text" name="level" required><br>


    <label for="section">Section:</label>
    <input type="text" name="section" required><br>

    <label for="student_email">Student Email:</label>
    <input type="email" name="student_email" required><br>

    <label for="guardian_name">Guardian Name:</label>
    <input type="text" name="guardian_name" required><br>

    <label for="guardian_contact">Guardian Contact:</label>
    <input type="text" name="guardian_contact" required><br>

    <label for="guardian_email">Guardian Email:</label>
    <input type="email" name="guardian_email" required><br>

 

    <input type="submit" value="Create User">
</form>
   
</body>
</html>


