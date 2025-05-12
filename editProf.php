<?php
include "db.php";
$prof_id = $_GET['prof_id'];
$result = $conn->query("SELECT * FROM professors WHERE prof_id=$prof_id");
$row = $result->fetch_assoc();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Professors</title>
</head>
<body>
    


<h2>Edit Professor Data</h2>
<form action="updateProf.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="prof_id" value="<?= $row['prof_id'] ?>">

<fieldset>
<legend>Personal Information</legend>

<label for="photo">Current Image:</label>
<img src="uploads/<?= $row['photo'] ?>" width="50"><br>

 <label for="photo">Change Image:</label>
 <input type="file" name="photo"><br><br>

 <label for="first_name">First Name: </label>
<input type="text" name="first_name" value="<?= $row['first_name'] ?>"  placeholder="First Name" required><br><br>

<label for="last_name">Last Name:</label>

<input type="text" name="last_name" value="<?= $row['last_name'] ?>" placeholder="Last Name" required><br><br>

<label for="gender">Gender:</label><br>
<input type="radio" name="gender" value="Male" <?= $row['gender'] == 'Male' ? 'checked' : '' ?>> Male<br>
<input type="radio" name="gender" value="Female" <?= $row['gender'] == 'Female' ? 'checked' : '' ?>> Female<br>
<input type="radio" name="gender" value="Other" <?= $row['gender'] == 'Other' ? 'checked' : '' ?>> Other<br><br>

<label for="prof_email">Professors's Email:</label>
<input type="text" name="prof_email" value="<?= $row['prof_email'] ?>" placeholder="Professors's Email" required><br><br>

<label for="contact_number">Contact Number:</label>
<input type="text" name="contact_number" value="<?= $row['contact_number'] ?>" placeholder="Contact Number" required><br><br>

</fieldset>



<fieldset>
<legend>Login Information</legend>

<label for="username">Username:</label>
<input type="text" name="username" value="<?= $row['username'] ?>" placeholder="Username" required><br><br>

<label for="password">Password:</label>
<input type="text" name="password" value="<?= $row['password'] ?>" placeholder="Password" required><br><br>


</fieldset>


<fieldset>
<legend>Section & Level Handled</legend>

<label for="level_handled">Grade Handled:</label>
<select name="level_handled">
<?php foreach (['Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6', 'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'] as $l) {
$sel = $row['level_handled'] == $l ? "selected" : "";
echo "<option value='$l' $sel>$l</option>";
} ?>
</select><br><br>


<label for="section_id">Section Handled:</label>

<select name="section_id">
<?php
foreach (['1' => 'Rizal', '2' => 'Bonifacio', '3' => 'Aguinaldo', '4' => 'Mabini', '5' => 'Luna'] as $id => $name) {
    $sel = $row['section_id'] == $id ? "selected" : "";
    echo "<option value='$id' $sel>$name</option>";
} 
?>
</select><br><br>

</fieldset>






<input type="submit" value="Update">
</form>
<a href="professors.php">Go back</a>


</body>
</html>

