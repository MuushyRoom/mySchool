<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'teacher')) {
    header('Location: login.php');
    exit;
}

echo "Welcome, Administrator! " . $_SESSION['username'] . " | <a href='logout.php'>Logout</a>";

include('db.php');





// CRUD operations: Create, Read, Update, Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'create_user') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
    
        $check = $conn->query("SELECT * FROM users WHERE username = '$username'");
        if ($check->num_rows > 0) {
            echo "Username already exists.";
        } else {
            $sql = "INSERT INTO users (username, password, role, email, first_name, last_name)
                    VALUES ('$username', '$password', '$role', '$email', '$first_name', '$last_name')";
    
            if ($conn->query($sql) === TRUE) {
                echo "New user added successfully.";
                header('Location: admin.php');
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}

// Display users' records
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<h2>Users List</h2>";
echo "<table border='1'>
<tr>
<th>id</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Role</th>
<th>Username</th>
<th>Password</th>
<th>Date of Account Creation</th>
<th>Actions</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['first_name']}</td>
    <td>{$row['last_name']}</td>
    <td>{$row['email']}</td>
    <td>{$row['role']}</td>
    <td>{$row['username']}</td>
    <td>{$row['password']}</td>
     <td>{$row['created_at']}</td>
<td>
    <a href='editUser.php?id={$row['id']}'>Edit</a> |
      <a href='deleteUser.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to remove this user?\")'>Remove</a>
    
    </td>
    </tr>";
}
echo "</table>";
















?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
</head>
<body>
<h3>Add New User</h3>
<form method="post" action="admin.php">
    <input type="hidden" name="action" value="create_user">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="role">User Role:</label>
    <input type="radio" name="role" value="admin" required> Administrator
    <input type="radio" name="role" value="teacher" required> Teacher<br>

    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

  

    <input type="submit" value="Add Users">
</form>
</body>
</html>

