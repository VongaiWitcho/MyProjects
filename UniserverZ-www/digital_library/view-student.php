<?php include('header.php'); ?>

<h1>View Student</h1>
<table class="view-table">
        <?php
                $id = $_GET['id'];
                $where['id'] = '=' . $id;
                $student = $database->getRow('students', '*', $where );
        ?>
                <tr class="form-row">
                        <td class="view-title-label">Name :</td>
                        <td class="view-data-label"><?php echo $student['name'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">Password :</td>
                        <td class="view-data-label"><?php echo $student['password'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">Department :</td>
                        <td class="view-data-label"><?php echo $student['department'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">Phone  Number:</td>
                        <td class="view-data-label"><?php echo $student['phone_number'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">Email :</td>
                        <td class="view-data-label"><?php echo $student['email'] ?></td>
                </tr>
                <tr class="form-row">
                        <td><a href="edit-student.php?id=<?php echo $student['id']; ?>"
                                class="table-button">Edit</a></td>
                        <td><a href="process.php?action=delete_student&id=<?php echo $student['id']; ?>"
                                class="table-button">Delete</a></td>
                </tr>
</table>
