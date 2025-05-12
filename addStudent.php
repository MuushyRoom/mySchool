<h3>Add Student</h3>
<form method="post" action="insertNewStudent.php" enctype="multipart/form-data">









<fieldset>
<Legend>Student Information</Legend>


    <label>Upload Image:</label>
    <input type="file" name="photo" accept="image/*"><br><br>
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" placeholder="First Name" required><br><br>
    <Label for="last_name">Last Name:</Label>
    <input type="text" name="last_name" placeholder="Last Name" required><br><br>


    <label for="student_email">Student Email:</label>
    <input type="email" name="student_email" placeholder="Student Email"><br><br>


    <label for="gender">Gender:</label>
    <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br><br>


</fieldset>

   <fieldset>
    <legend>Guardian's Information</legend>

   <label for="guardian_name">Guardian Name:</label>
    <input type="text" name="guardian_name" placeholder="Guardian Name" required><br><br>

    <label for="guardian_number">Guardian Number:</label>
    <input type="text" name="guardian_number" placeholder="Guardian Contact" required><br><br>
    <label for="guardian_email">Guardian Email:</label>
    <input type="email" name="guardian_email" placeholder="Guardian Email"><br><br>



    </fieldset>


    <fieldset>
    <legend>Grade Level & Section</legend>

   <label>Level:</label>
    <select name="level" required>
        <option value="">-- Select Level --</option>
        <option value="Grade 1">Grade 1</option>
        <option value="Grade 2">Grade 2</option>
        <option value="Grade 3">Grade 3</option>
        <option value="Grade 4">Grade 4</option>
        <option value="Grade 5">Grade 5</option>
        <option value="Grade 6">Grade 6</option>
        <option value="Grade 7">Grade 7</option>
        <option value="Grade 8">Grade 8</option>
        <option value="Grade 9">Grade 9</option>
        <option value="Grade 10">Grade 10</option>


    </select><br><br>

    <label>Sections:</label>
    <select name="section_id" required>
        <option value="">-- Select Level --</option>
        <option value="1">Rizal</option>
        <option value="2">Bonifacio</option>
        <option value="3">Aguinaldo</option>
        <option value="4">Mabini</option>
        <option value="5">Luna</option>

    </select><br><br>


    </fieldset>
 
 
 
    <input type="submit" name="submit" value="Add Student">

</form>

<a href="students.php">Go back</a>