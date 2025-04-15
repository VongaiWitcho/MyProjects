<?php include ('header.php'); ?>

<h1>Add a new Student</h1>
<form method="POST" action="process.php?action=add_student" enctype="multipart/form-data">
        <div class="form-row">
                <label for="name">Name</label>
                <input type="text" class="form-input" id="name" name="name">
        </div>
        <div class="form-row">
                <label for="password">Password</label>
                <input type="text" class="form-input" id="password" name="password">
        </div>
        <div class="form-row">
                <label for="department">Department</label>
                <input type="text" class="form-input" id="department" name="department">
        </div>
        <div class="form-row">
                <label for="phonenumber">Phone Number</label>
                <input type="text" class="form-input" id="phoneNumber" name="phoneNumber">
        </div>
        <div class="form-row">
                <label for="email">Email</label>
                <input type="text" class="form-input" id="email" name="email">
        </div>
        <div class="submit-row">
                <input type="submit" value="Submit" class="form-submit">
        </div>
</form>