<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db.php');

echo 'Welcome, Teacher! ' . $_SESSION['first_name'] . ' | <a href="logout.php">Logout</a>';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc(); // Assign the fetched data to $student
    } else {
        echo "Student not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $level = $_POST['level'];
    $section = $_POST['section'];
    $student_email = $_POST['student_email'];
    $guardian_name = $_POST['guardian_name'];
    $guardian_contact = $_POST['guardian_contact'];
    $guardian_email = $_POST['guardian_email'];

    $sql = "UPDATE students SET 
        first_name='$first_name', 
        last_name='$last_name', 
        level='$level', 
        section='$section',
        student_email='$student_email',
        guardian_name='$guardian_name', 
        guardian_contact='$guardian_contact', 
        guardian_email='$guardian_email'
        
        WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Student record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<form method="post" action="teacher.php">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="<?php echo $student['first_name']; ?>" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="<?php echo $student['last_name']; ?>" required><br>

    <label for="level">Level:</label>
    <input type="text" name="level" value="<?php echo $student['level']; ?>" required><br>

    <label for="section">Section:</label>
    <input type="text" name="section" value="<?php echo $student['section']; ?>" required><br>

    <label for="student_email">Student Email:</label>
    <input type="email" name="student_email" value="<?php echo $student['student_email']; ?>"><br>

    <label for="guardian_name">Guardian Name:</label>
    <input type="text" name="guardian_name" value="<?php echo $student['guardian_name']; ?>" required><br>

    <label for="guardian_contact">Guardian Contact:</label>
    <input type="text" name="guardian_contact" value="<?php echo $student['guardian_contact']; ?>" required><br>

    <label for="guardian_email">Guardian Email:</label>
    <input type="email" name="guardian_email" value="<?php echo $student['guardian_email']; ?>"><br>

    <input type="submit" value="Update Student">
</form>