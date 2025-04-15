<?php include ('header.php'); ?>

<h1>Edit Student Details</h1>
<form method="POST" action="process.php?action=edit_student" enctype="multipart/form-data">
        <?php
                $id = $_GET['id'];
                $where['id'] = '=' . $id;
                $student = $database->getRow('students', '*', $where );
        ?>
        <input type="text" class="form-input hidden" id="id" name="id" value="<?php echo $student['id'] ?>">
        <div class="form-row">
                <label for="name">Name</label>
                <input type="text" class="form-input" id="name" name="name" value="<?php echo $student['name'] ?>">
        </div>
        <div class="form-row">
                <label for="password">Password</label>
                <input type="text" class="form-input" id="password" name="password" value="<?php echo $student['password'] ?>">
        </div>
        <div class="form-row">
                <label for="department">Department</label>
                <input type="text" class="form-input" id="department" name="department" value="<?php echo $student['department'] ?>">
        </div>
        <div class="form-row">
                <label for="phonenumber">Phone Number</label>
                <input type="text" class="form-input" id="phoneNumber" name="phoneNumber" value="<?php echo $student['phone_number'] ?>">
        </div>
        <div class="form-row">
                <label for="email">Email</label>
                <input type="text" class="form-input" id="email" name="email" value="<?php echo $student['email'] ?>">
        </div>
        <div class="submit-row">
                <input type="submit" value="Submit" class="form-submit">
        </div>
</form>