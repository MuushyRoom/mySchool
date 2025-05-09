<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');

// Load sections
$sections = $conn->query("SELECT * FROM sections");


echo "Welcome, Admin! " . $_SESSION['first_name'] . " | <a href='logout.php'>Logout</a>";


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
<th>Professor's ID</th>
<th>Photo</th>
<th>First Name</th>
<th>Last Name</th>
<th>Professors's Email</th>
<th>Contact Number</th>
<th>Username</th>
<th>Password</th>
<th>Level Handled</th>
<th>Section Handled (ID)</th>
<th>Section Handled (Name)</th>

<th>Actions</th>
</tr>
<?php
// Search filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM professors";


if (!empty($search)) {
$query .= " WHERE prof_id LIKE '%$search%' || first_name LIKE '%$search%' || last_name LIKE '%$search%' || prof_email LIKE '%$search%'
|| contact_number LIKE '%$search%' || username LIKE '%$search%' || password LIKE '%$search%' || level_handled LIKE '%$search%' 
|| section_id LIKE '%$search%'"
;
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
<td><?= $row['prof_id'] ?></td>
<td><img src='uploads/<?=$row['photo']?>' width='80'></td>

<td><?= $row['first_name'] ?></td>
<td><?= $row['last_name'] ?></td>
<td><?= $row['prof_email'] ?></td>
<td><?= $row['contact_number'] ?></td>
<td><?= $row['username'] ?></td>
<td><?= $row['password'] ?></td>
<td><?= $row['level_handled'] ?></td>
<td><?= $row['section_id'] ?></td>
<td><?= $row['section_name'] ?></td>

<td>
<a href="editProf.php?prof_id=<?= $row['prof_id'] ?>">Edit</a> |
<a href="editProf.php?prof_id=<?= $row['prof_id'] ?>" onclick="return confirm('Delete user?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</table>










<a href="addProf.php">Add new Professor</a>
<a href="website.php">Go back</a>
</body>
</html>