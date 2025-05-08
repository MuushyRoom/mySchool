<h3>Add Student</h3>
<form method="post" action="insertNewProf.php" enctype="multipart/form-data"  >


    <label>Upload Image:</label>
    <input type="file" name="photo" accept="image/*"><br>
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    

    <input type="email" name="prof_email" placeholder="Professor's Email"><br>
    <input type="text" name="contact_number" placeholder="Contact Number"><br>

    <input type="text" name="username" placeholder="Username"><br>
    <input type="text" name="password" placeholder="Password" required><br>



    <label>Section Handled:</label>
<select name="section_id" required>
    <option value="">-- Select Level --</option>
    <option value="1">Rizal</option>
    <option value="2">Bonifacio</option>
    <option value="3">Aguinaldo</option>
    <option value="4">Mabini</option>
    <option value="5">Luna</option>

</select><br>

    <label>Level Handled:</label>
<select name="level_handled" required>
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
    <option value="Grade 11">Grade 11</option>
    <option value="Grade 12">Grade 12</option>
    <option value="College">College</option>
</select><br>



 

    <input type="submit" name="submit" value="Add Professor">
    
</form>

<a href="professors.php">Go back</a>

