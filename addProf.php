<h2>Add Professor</h2>
<form method="post" action="insertNewProf.php" enctype="multipart/form-data">

    <fieldset>
        <legend>Personal Information</legend>
    <label>Upload Image:</label>
    <input type="file" name="photo" accept="image/*"><br><br>


    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" placeholder="First Name" required><br><br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" placeholder="Last Name" required><br><br>

    <label for="gender">Gender:</label><br>
    <input type="radio" name="gender" value="Male"> Male<br>
    <input type="radio" name="gender" value="Female"> Female<br>
    <input type="radio" name="gender" value="Other"> Other<br><br>


    <label for="prof_email">Professor's Email</label>
    <input type="email" name="prof_email" placeholder="Professor's Email"><br><br>
    <label for="contact_number">Contact Number</label>
    <input type="text" name="contact_number" placeholder="Contact Number"><br><br>

</fieldset>



<fieldset>
<legend>Login Information</legend>

    <label for="username">Username</label>
    <input type="text" name="username" placeholder="Username"><br>
    <label for="password">Password</label>
    <input type="text" name="password" placeholder="Password" required><br>

</fieldset>


<fieldset>
<legend>Section & Level Handled</legend>
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


    </select><br>

</fieldset>






    <input type="submit" name="submit" value="Add Professor">

</form>

<a href="professors.php">Go back</a>