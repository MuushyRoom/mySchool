<?php
session_start();
if (!isset($_SESSION["user_id"])) header("Location: login.php");
include('db.php');

// Get the student_id from the URL
$student_id = $_GET['student_id'];

// Fetch the student's current details
$sql = "SELECT * FROM students WHERE student_id = $student_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    echo "Error: Student not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Student</title>


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
            margin: 25px auto 0 auto;
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
            padding: 2px 8px;
        }
        label {
            display: block;
            margin-top: 13px;
            margin-bottom: 13px;
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
.footer {
    text-align: center;
    color: #888;
    margin-top: 40px;
    font-size: 0.95rem;
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

        
.legend1{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.student-photo {
    height: 140px;
    width: 140px;
margin-right: 200px
}

.school-logo {
   

    height: 160px;
    width: 160px;
border: none;
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
            .footer {
                display: none !important;
    text-align: center !important;
    color: #888 !important;
    margin-top: 40px !important;
    font-size: 0.95rem !important;
}


        }

                

    </style>
</head>

<body>
    <div class="print-container" id="printForm">
        
        <fieldset>
            <legend>Student Information</legend>
            <span class="legend1">
            <label>Photo:
            <img src="uploads/<?= $student['photo'] ?>" class="student-photo" width="120" alt="Student Photo">
            </label>
        <img src="logo/abcps_gray.png" alt="ABCPS Logo" class="school-logo">
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
            <button type="button" onclick="window.print()">Print as PDF</button>
            <a href="students.php" class="button-link">Back to Students</a>
        </div>
    </div>
  <div class="footer">
            <p>&copy; ABCPS Student Information System.</p>
            <p>Created by Ronan Cuaresma.</p>
        </div>
</body>
</html>