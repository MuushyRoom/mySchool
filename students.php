<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');

$role = $_SESSION["role"];


$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$section_filter = isset($_GET['section']) ? $_GET['section'] : 'all';
$gender_filter = isset($_GET['gender']) ? $_GET['gender'] : 'all';


$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where = [];
if ($filter == 'grade11') {
    $where[] = "level_name LIKE '%11%'";
} elseif ($filter == 'grade12') {
    $where[] = "level_name LIKE '%12%'";
}
if ($section_filter != 'all') {
    $where[] = "section_name = '" . $conn->real_escape_string($section_filter) . "'";
}
if ($gender_filter != 'all') {
    $where[] = "gender = '" . $conn->real_escape_string($gender_filter) . "'";
}
if ($search !== '') {
    $search_escaped = $conn->real_escape_string($search);
    if (is_numeric($search)) {
     
        $where[] = "(student_id LIKE '%$search_escaped%' OR guardian_number LIKE '%$search_escaped%')";
    } else {
    
        $where[] = "(firstname LIKE '%$search_escaped%' OR
         lastname LIKE '%$search_escaped%' 
         OR date_of_birth LIKE '%$search_escaped%'
         OR username LIKE '%$search_escaped%' 
         OR student_email LIKE '%$search_escaped%'
           OR guardian_email LIKE '%$search_escaped%'
        
           OR guardian_name LIKE '%$search_escaped%'
         )";
    }
}
$where_sql = count($where) ? "WHERE " . implode(' AND ', $where) : "";

$sql = "SELECT * FROM student_full_info $where_sql";
$result = $conn->query($sql);


$sections = [];
$section_query = $conn->query("SELECT DISTINCT section_name FROM student_full_info");
while ($row = $section_query->fetch_assoc()) {
    $sections[] = $row['section_name'];
}


$genders = ['Male', 'Female'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="studentStyles.css">
    <title><?php echo ($role == "admin") ? "Admin Dashboard" : "Dashboard"; ?></title>
</head>
<body>

    <header>


   <p style="color: white; text-align: left; padding-left: 15px; font-weight: 500;">
    Welcome, <?= ucfirst($role) ?>! <?= htmlspecialchars($_SESSION['firstname']) ?> 
    <a href='logout.php' style="margin: 0;" class='button-link logout'>Logout</a></p>
  
       <p style="color: white; text-align: right; padding-right: 15px; font-weight: 500;"> 
       ABCPS University</p>
    
    </header>

   

   
    <form method="get">
        <input type="text" name="search" placeholder="Quick search..." value="<?= isset($_GET['search']) ?
$_GET['search'] : '' ?>">
      
        <input type="hidden" name="filter" value="<?= htmlspecialchars($filter) ?>">
        <input type="hidden" name="section" value="<?= htmlspecialchars($section_filter) ?>">
        <input type="hidden" name="gender" value="<?= htmlspecialchars($gender_filter) ?>">
        <button type="submit">Search</button>
    </form>


    <h2>Filter Table</h2>
    <form method="get">
      
        <input type="hidden" name="search" value="<?= isset($_GET['search']) ?
$_GET['search'] : '' ?>">
        <label><input type="radio" name="filter" value="all" <?php if($filter=='all') echo 'checked'; ?> onchange="this.form.submit();"> All</label>
        <label><input type="radio" name="filter" value="grade11" <?php if($filter=='grade11') echo 'checked'; ?> onchange="this.form.submit();"> Grade 11</label>
        <label><input type="radio" name="filter" value="grade12" <?php if($filter=='grade12') echo 'checked'; ?> onchange="this.form.submit();"> Grade 12</label>
        &nbsp;&nbsp;
        <label>Section:
            <select name="section" onchange="this.form.submit();">
                <option value="all" <?= $section_filter=='all'?'selected':'' ?>>All</option>
                <?php foreach($sections as $section): ?>
                    <option value="<?= htmlspecialchars($section) ?>" <?= $section_filter==$section?'selected':'' ?>><?= htmlspecialchars($section) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        &nbsp;&nbsp;
        <label>Gender:
            <select name="gender" onchange="this.form.submit();">
                <option value="all" <?= $gender_filter=='all'?'selected':'' ?>>All</option>
                <?php foreach($genders as $gender): ?>
                    <option value="<?= $gender ?>" <?= $gender_filter==$gender?'selected':'' ?>><?= $gender ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </form>
 <h1>Students Overview</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>Student Id</th>
                <th>Photo</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Username</th>
                <th>Password</th>
                <th>Level Enrolled</th>
                <th>Section Enrolled</th>
                <th>Student Email</th>
                <th>Date of Birth</th>
                <th>Guardian Name</th>
                <th>Guardian Number</th>
                <th>Guardian Email</th>
                <th>Action</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['student_id'] ?></td>
                        <td><img src='uploads/<?= $row['photo'] ?>' width='80'></td>
                        <td><?= $row['firstname'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['password'] ?></td>
                        <td><?= $row['level_name'] ?></td>
                        <td><?= $row['section_name'] ?></td>
                        <td><?= $row['student_email'] ?></td>
                        <td><?= $row['date_of_birth'] ?></td>
                        <td><?= $row['guardian_name'] ?></td>
                        <td><?= $row['guardian_number'] ?></td>
                        <td><?= $row['guardian_email'] ?></td>
                        <td>
                            <a href="editStudent.php?student_id=<?= $row['student_id'] ?>">Edit</a> |
                            <a href="deleteStudent.php?student_id=<?= $row['student_id'] ?>" onclick="return confirm('Delete user?')">Delete</a> |
                            <a href="printData.php?student_id=<?= $row['student_id'] ?>">Print</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="15">No students found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div style="text-align:center; margin-bottom:40px;">
        <a href="addStudent.php" class="button-link">Add new Student</a>
        <a href="website.php" class="button-link">Go back</a>
    </div>
      <div class="footer">
            <p>&copy; ABCPS Student Information System.</p>
            <p>Created by Ronan Cuaresma.</p>
        </div>
</body>
</html>