<?php include('header.php'); ?>

<h1>View Students</h1>
<table>
        <thead>
                <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Phone No.</th>
                        <th>Action</th>
                </tr>
        </thead>
        <tbody>

                <?php $studentS=$database->getRows("students"); foreach($studentS as $student) { ?>
                        <tr>
                                <td><?php echo $student['id']; ?>.</td>
                                <td><?php echo $student['name']; ?></td>
                                <td><?php echo $student['department']; ?></td>
                                <td><?php echo $student['email']; ?></td>
                                <td><?php echo $student['phone_number']; ?></td>
                                <td>
                                        <a href="view-student.php?id=<?php echo $student['id']; ?>"
                                                class="table-button">View</a>
                                        <a href="edit-student.php?id=<?php echo $student['id']; ?>"
                                                class="table-button">Edit</a>
                                        <a href="process.php?action=delete_student&id=<?php echo $student['id']; ?>"
                                                class="table-button">Delete</a>
                                </td>
                        </tr>
                <?php } ?>
        </tbody>
</table>
<a href="./add-student.php" class="button-below-table">Add Student</a>