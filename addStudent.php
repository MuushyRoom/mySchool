<h3>Add Student</h3>
<form method="post" action="insertNewStudent.php" enctype="multipart/form-data"  >


    <label>Upload Image:</label>
    <input type="file" name="photo" accept="image/*"><br>
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    

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

 
</select><br>

<label>Sections:</label>
<select name="section_id" required>
    <option value="">-- Select Level --</option>
    <option value="1">Rizal</option>
    <option value="2">Bonifacio</option>
    <option value="3">Aguinaldo</option>
    <option value="4">Mabini</option>
    <option value="5">Luna</option>

</select><br>
    <label for="gender">Gender:</label>
      <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br>
    <input type="email" name="student_email" placeholder="Student Email"><br>
    <input type="text" name="guardian_name" placeholder="Guardian Name" required><br>
    <input type="text" name="guardian_number" placeholder="Guardian Contact" required><br>
    <input type="email" name="guardian_email" placeholder="Guardian Email"><br>
    <input type="submit" name="submit" value="Add Student">
    
</form>

<a href="students.php">Go back</a>
