<?php include('header.php'); ?>

<h1>View Book</h1>
<table class="view-table">
        <?php
                $id = $_GET['id'];
                $where['id'] = '=' . $id;
                $book = $database->getRow('books', '*', $where );
        ?>
                <tr class="form-row">
                        <td class="view-title-label">ID :</td>
                        <td class="view-data-label"><?php echo $book['id'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">Title :</td>
                        <td class="view-data-label"><?php echo $book['title'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">Author :</td>
                        <td class="view-data-label"><?php echo $book['author'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">ISBN:</td>
                        <td class="view-data-label"><?php echo $book['isbn'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">Publisher :</td>
                        <td class="view-data-label"><?php echo $book['publisher'] ?></td>
                </tr>
                <tr class="form-row">
                        <td class="view-title-label">Genre :</td>
                        <td class="view-data-label"><?php echo $book['genre'] ?></td>
                </tr>
                <tr class="form-row">
                        <td><a href="edit-book.php?id=<?php echo $book['id']; ?>"
                                class="table-button">Edit</a></td>
                        <td><a href="process.php?action=delete_book&id=<?php echo $book['id']; ?>"
                                class="table-button">Delete</a></td>
                </tr>
</table>
