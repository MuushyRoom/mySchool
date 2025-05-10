<?php
include "db.php";
$student_id = $_GET['student_id'];
$result = $conn->query("SELECT * FROM students WHERE student_id=$student_id");
$row = $result->fetch_assoc();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Data</title>
</head>
<body>
    



<form action="updateStudent.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="student_id" value="<?= $row['student_id'] ?>">



Current Image: <img src="uploads/<?= $row['photo'] ?>" width="50"><br>
Change Image: <input type="file" name="photo"><br><br>

First Name: <input type="text" name="first_name" value="<?= $row['first_name'] ?>"><br><br>
Last Name: <input type="text" name="last_name" value="<?= $row['last_name'] ?>"><br><br>


<label for="gender">Gender:</label><br>
<input type="radio" name="gender" value="Male" <?= $row['gender'] == 'Male' ? 'checked' : '' ?>> Male<br>
<input type="radio" name="gender" value="Female" <?= $row['gender'] == 'Female' ? 'checked' : '' ?>> Female<br><br>
<input type="radio" name="gender" value="Other" <?= $row['gender'] == 'Other' ? 'checked' : '' ?>> Other<br><br>


<label for="level">Grade Enrolled:</label>
<select name="level">
<?php foreach (['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6', 'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'] as $l) {
$sel = $row['level'] == $l ? "selected" : "";
echo "<option value='$l' $sel>$l</option>";
} ?>
</select><br><br>


<label for="section_id">Section Enrolled</label>

<select name="section_id">
<?php
foreach (['1' => 'Rizal', '2' => 'Bonifacio', '3' => 'Aguinaldo', '4' => 'Mabini', '5' => 'Luna'] as $id => $name) {
    $sel = $row['section_id'] == $id ? "selected" : "";
    echo "<option value='$id' $sel>$name</option>";
} 
?>
</select><br><br>

<label for="student_email">Student Email:</label>
<input type="text" name="student_email" value="<?= $row['student_email'] ?>" placeholder="Student Email"><br><br>


<label for="guardian_name">Guardian's Name</label>
<input type="text" name="guardian_name" value="<?= $row['guardian_name'] ?>" placeholder="Guardian Name"><br><br>

<label for="guardian_number">Guardian's Phone Number</label>
<input type="text" name="guardian_number" value="<?= $row['guardian_number'] ?>" placeholder="Guardian Contact"><br><br>

<label for="guardian_email">Guardian's Name</label>
<input type="text" name="guardian_email" value="<?= $row['guardian_email'] ?>" placeholder="Guardian Email"><br><br>

<input type="submit" value="Update">
</form>
<a href="students.php">Go back</a>


</body>
</html>

