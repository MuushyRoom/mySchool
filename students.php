<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');

// Load sections
$sections = $conn->query("SELECT * FROM sections");

  $role = $_SESSION["role"];

echo "Welcome, $role! " . $_SESSION['first_name'] . " | <a href='logout.php'>Logout</a>";

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




<form method="GET" style="margin-top:20px;">
<input type="text" name="search" placeholder="Search by name..." value="<?= isset($_GET['search']) ?
$_GET['search'] : '' ?>">
<input type="submit" value="Search">
</form>

<table  border="1" cellpadding="10">
<tr>
<th>Student ID</th>
<th>Photo</th>
<th>First Name</th>
<th>Last Name</th>
<th>Gender</th>
<th>Level</th>
<th>Section ID</th>
<th>Section Name</th>
<th>Student Email</th>
<th>Guardian Name</th>
<th>Guardian Contact</th>
<th>Guardian Email</th>

<th>Actions</th>
</tr>
<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT s.*, sec.section_name 
          FROM students s
          JOIN sections sec ON s.section_id = sec.section_id";

if (!empty($search)) {

    $validGenders = ['Male', 'Female', 'Other'];
    if (in_array($search, $validGenders)) {
        $query .= " WHERE s.gender = '$search'";
    } elseif (is_numeric($search)) {
       
        $query .= " WHERE s.section_id = '$search' OR s.level = '$search'";
    } else {
        // General search across other fields
        $query .= " WHERE s.student_id LIKE '%$search%' 
                    OR s.first_name LIKE '%$search%' 
                    OR s.last_name LIKE '%$search%' 
                    OR s.student_email LIKE '%$search%' 
                    OR s.guardian_name LIKE '%$search%' 
                    OR s.guardian_number LIKE '%$search%' 
                    OR s.guardian_email LIKE '%$search%' 
                    OR sec.section_name LIKE '%$search%'";
    }
}
$result = $conn->query($query);

while($row = $result->fetch_assoc()):


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
?>
<tr>
<td><?= $row['student_id'] ?></td>
<td><img src='uploads/<?=$row['photo']?>' width='80'></td>

<td><?= $row['first_name'] ?></td>
<td><?= $row['last_name'] ?></td>
<td><?= $row['gender'] ?></td>
<td><?= $row['level'] ?></td>
<td><?= $row['section_id'] ?></td>
<td><?= $row['section_name'] ?></td>
<td><?= $row['student_email'] ?></td>
<td><?= $row['guardian_name'] ?></td>
<td><?= $row['guardian_number'] ?></td>
<td><?= $row['guardian_email'] ?></td>

<td>
<a href="editStudent.php?student_id=<?= $row['student_id'] ?>">Edit</a> |
<a href="deleteStudent.php?student_id=<?= $row['student_id'] ?>" onclick="return confirm('Delete user?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</table>









<a href="addStudent.php">Add new Student</a> <br>
<a href="website.php">Go back</a>
</body>
</html>