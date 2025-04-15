<?php include('header.php'); ?>

<h1>Add a new Book</h1>

<form method="POST" action="process.php?action=add_book" enctype="multipart/form-data">
        <div class="form-row">
                <label for="title">Title</label>
                <input type="text" class="form-input" id="title" name="title">
        </div>
        <div class="form-row">
                <label for="author">Author</label>
                <input type="text" class="form-input" id="author" name="author">
        </div>
        <div class="form-row">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-input" id="isbn" name="isbn">
        </div>
        <div class="form-row">
                <label for="publisher">Publisher</label>
                <input type="text" class="form-input" id="publisher" name="publisher">
        </div>
        <div class="form-row">
                <label for="genre">Genre</label>
                <input type="text" class="form-input" id="genre" name="genre">
        </div>
        <div class="submit-row">
                <input type="submit" value="Submit" class="form-submit">
        </div>
</form>