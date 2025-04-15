<?php include('header.php'); ?>

<h1>Edit Book Details</h1>

<form method="POST" action="process.php?action=edit_book" enctype="multipart/form-data">
        <?php
                $id = $_GET['id'];
                $where['id'] = '=' . $id;
                $book = $database->getRow('books', '*', $where );
        ?>
        <input type="text" class="form-input hidden" id="id" name="id" value="<?php echo $book['id'] ?>">
        <div class="form-row">
                <label for="title">Title</label>
                <input type="text" class="form-input" id="title" name="title" value="<?php echo $book['title'] ?>">
        </div>
        <div class="form-row">
                <label for="author">Author</label>
                <input type="text" class="form-input" id="author" name="author" value="<?php echo $book['author'] ?>">
        </div>
        <div class="form-row">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-input" id="isbn" name="isbn" value="<?php echo $book['isbn'] ?>">
        </div>
        <div class="form-row">
                <label for="publisher">Publisher</label>
                <input type="text" class="form-input" id="publisher" name="publisher" value="<?php echo $book['publisher'] ?>">
        </div>
        <div class="form-row">
                <label for="genre">Genre</label>
                <input type="text" class="form-input" id="genre" name="genre" value="<?php echo $book['genre'] ?>">
        </div>
        <div class="submit-row">
                <input type="submit" value="Submit" class="form-submit">
        </div>
</form>