<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');


// Get student_id from URL or session
if (isset($_GET['student_id'])) {
    $student_id = intval($_GET['student_id']);
} elseif (isset($_SESSION['user_id'])) {
    $student_id = intval($_SESSION['user_id']);
} else {
    echo "No student ID provided.";
    exit;
}

// Now you can safely use $student_id in your query
$sql = "SELECT * FROM students WHERE student_id = $student_id";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    echo "Student not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
       body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .print-container {
            background: #fff;
            max-width: 600px;
            margin: 25px auto 25px auto;
            padding:  20px 40px 40px 20px;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        }
        h1 {
            text-align: center;
          margin-top: 0;
            color: #333;
        }
        fieldset {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 5px;
            padding: 5px 0px 5px 40px;
            background: #fafbfc;
        }
        legend {
           font-weight: bold;
            font-size: 20px;
            color: #1976d2;
            padding: 2px 4px;
        }
        label {
            display: block;
            margin-top: 13px;
            margin-bottom: 11px;
            font-weight: 600;
            color: #222;
        }
        input[readonly], input[disabled] {
           background-color: #fafbfc;
           font-weight: 530;
            border: none;
            color: #444;
            padding: 5px;
            font-size: 17px;
            border-radius: 4px;
            width: 60%;
        }
        img {
            display: block;
            margin: 0 auto;
            border-radius: 8px;
            border: 2px solid white;
        }
        .button-row {
            text-align: center;
            margin-top: 24px;
        }


.legend1{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.student-photo {
    height: 120px;
    width: 120px;
margin-right: 220px
}

.school-logo {
   
    height: 160px;
    width: 160px;
border: none;
        }

        .logout {
    background: #e53935 !important;
    color: #fff !important;
    margin-left: 10px;
}
.logout:hover {
    background: #b71c1c !important;
}
        button, a.button-link {
            background: #1976d2;
            color: #fff !important;
            border: none;
            padding: 10px 28px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin: 0 8px;
            text-decoration: none;
            transition: background 0.2s;
        }
        button:hover, a.button-link:hover {
            background: #125ea8;
        }
        @media print {
            body {
                background: #fff !important;
            }
            .print-container {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            .button-row, .button-link {
                display: none !important;
            }
           
        }
    </style>
</head>

<body>
    <div class="print-container" id="printForm">
        <h1 style="color: #125ea8;">myProfile</h1>
        <fieldset>
            <legend>Student Information</legend>
            <span class="legend1">

 <label>Photo:
            <img src="uploads/<?= $student['photo'] ?>" width="120" class="student-photo" alt="Student Photo">
            </label>
            <img src="logo/abcps_gray.png" alt="abcps logo" class="school-logo">
            </span>
           
            <label>Student ID: <input type="text" name="student_id" value="<?= $student['student_id'] ?>" readonly></label>
            <label>Full Name:<input type="text" name="firstname" value=" <?= $student['firstname'] ?> <?= $student['lastname'] ?>" readonly></label>
       
            <label>Email: <input type="email" name="student_email" value="<?= $student['student_email'] ?>" readonly></label>
            <label>Gender: <input type="text" name="gender" value="<?= $student['gender'] ?>" readonly></label>
            <label>Date of Birth: <input type="date" name="date_of_birth" value="<?= $student['date_of_birth'] ?>" readonly></label>
        </fieldset>
        <fieldset>
            <legend>Account Information</legend>
            <label>Username: <input type="text" name="username" value="<?= $student['username'] ?>" readonly></label>
            <label>Password: <input type="text" name="password" value="<?= $student['password'] ?>" readonly></label>
        </fieldset>
        <fieldset>
            <legend>Guardian Information</legend>
            <label>Guardian Name: <input type="text" name="guardian_name" value="<?= $student['guardian_name'] ?>" readonly></label>
            <label>Guardian Number: <input type="text" name="guardian_number" value="<?= $student['guardian_number'] ?>" readonly></label>
            <label>Guardian Email: <input type="email" name="guardian_email" value="<?= $student['guardian_email'] ?>" readonly></label>
        </fieldset>
        <fieldset>
            <legend>Level and Section</legend>
            <?php
            $levelText = '';
            if ($student['level_id'] == 1) {
                $levelText = "Grade 11";
            } elseif ($student['level_id'] == 2) {
                $levelText = "Grade 12";
            }
          $sectionText = '';
            if ($student['section_id'] == 2000) {
                $sectionText = "Ada Lovelace";
            } elseif ($student['section_id'] == 2001) {
                $sectionText = "Mark Zuckerberg";
            } elseif ($student['section_id'] == 2002) {
                $sectionText = "James Gosling";
            } elseif ($student['section_id'] == 2003) {
                $sectionText = "Bill Gates";
            } elseif ($student['section_id'] == 2004) {
                $sectionText = "Steve Jobs";
            }

          if ($student['section_id'] == 3000) {
                $sectionText = "Ada Lovelace";
            } elseif ($student['section_id'] == 3001) {
                $sectionText = "Mark Zuckerberg";
            } elseif ($student['section_id'] == 3002) {
                $sectionText = "James Gosling";
            } elseif ($student['section_id'] == 3003) {
                $sectionText = "Bill Gates";
            } elseif ($student['section_id'] == 3004) {
                $sectionText = "Steve Jobs";
            }
            ?>
            <label>Level Enrolled: <input type="text" name="level_id" value="<?= $levelText ?>" readonly></label>
            <label>Section Enrolled: <input type="text" name="section_id" value="<?= $sectionText ?>" readonly></label>
        </fieldset>
        <div class="button-row">
            <button type="button" onclick="window.print()">Print myProfile as PDF</button>
            <a href="website.php" class="button-link">Back to Dashboard</a><br><br>
            <a href="changePassword.php?student_id=<?= $student['student_id']  ?>" class="button-link">Change Password</a>
            <a href="https://mail.google.com/mail/u/0/#imp"  target="_blank" class="button-link">Contact Admin</a><br><br><br>
               <a href='logout.php' class='button-link logout'>Logout</a>

                
        </div>
    </div>
</body>
</html>