<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');

// Load sections
$sections = $conn->query("SELECT * FROM sections");


echo "Welcome, Admin! " . $_SESSION['first_name'] . " | <a href='logout.php'>Logout</a>";

// --- Fetch Students with section name ---
$student_sql = "SELECT s.student_id, s.first_name, s.last_name, s.level, sec.section_name, 
                s.student_email, s.guardian_name, s.guardian_number, s.guardian_email, s.photo
                FROM students s
                JOIN sections sec ON s.section_id = sec.section_id
                ORDER BY s.student_id DESC";
$students = $conn->query($student_sql);


?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
    $role = $_SESSION["role"];
    if ($role == "admin") {
        echo "Admin Dashboard";
    } elseif ($role == "professor") {
        echo "Professor Dashboard";
    }?></title>
</head>
<body>




<h1>List of Professors</h1>
<table border="1" cellpadding="10">
<tr>
<th>Professor ID</th>
<th>Photo</th>
<th>First Name</th>
<th>Last Name</th>
<th>Professor's Email</th>
<th>Contact Number</th>
<th>Username</th>
<th>Password</th>
<th>Section Handled (ID)</th>
<th>Section Handled (Name)</th>
<th>Level Handled</th>

<th>Actions</th>
</tr>
<?php




$result = $conn->query("SELECT * FROM professors");
while ($row = $result->fetch_assoc() ) {

    if ($row['section_id'] == 1) {
        $row['section_name'] = "Rizal";
    } elseif ($row['section_id'] == 2) {
        $row['section_name'] = "Bonifacio";
    } elseif ($row['section_id'] == 3) {
        $row['section_name'] = "Aguinaldo";
    } elseif ($row['section_id'] == 4) {
        $row['section_name'] = "Mabini";
    } elseif ($row['section_id'] == 5) {
        $row['section_name'] = "Luna";
    }

echo "<tr>
<td>{$row['prof_id']}</td>
<td><img src='uploads/{$row['photo']}' width='80'></td>
<td>{$row['first_name']}</td>
<td>{$row['last_name']}</td>
<td>{$row['prof_email']}</td>
<td>{$row['contact_number']}</td>



<td>{$row['username']}</td>
<td>{$row['password']}</td>
<td>{$row['section_id']}</td>
<td>{$row['section_name']}</td>
<td>{$row['level_handled']}</td>
<td>
<a href='edit.php?id={$row['prof_id']}'>Edit</a> |
<a href='delete.php?id={$row['prof_id']}'>Delete</a>
</td>
</tr>";
}
?>
</table>

<a href="addProf.php">Add new Professor</a>
<a href="website.php">Go back</a>
</body>
</html>