<?php include('header.php'); $database = new Database();?>

<h1>Books</h1>
<table>
        <thead>
                <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Publisher</th>
                        <th>Genre</th>
                        <th>Actions</th>

                </tr>
        </thead>

        <?php $books = $database->getRows("books");foreach($books as $book) { ?>
                <tbody>
                        <td><?php echo $book['id']; ?></td>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['author']; ?></td>
                        <td><?php echo $book['isbn']; ?></td>
                        <td><?php echo $book['publisher']; ?></td>
                        <td><?php echo $book['genre']; ?></td>
                        <td>
                                <a href="view-book.php?id=<?php echo $book['id']; ?>"
                                        class="table-button">View</a>
                                <a href="edit-book.php?id=<?php echo $book['id']; ?>"
                                        class="table-button">Edit</a>
                                <a href="process.php?action=delete_book&id=<?php echo $book['id']; ?>"
                                        class="table-button">Delete</a>
                        </td>
                </tbody>
        <?php } ?>
</table>
<a href="./add-book.php" class="button-below-table">Add Book</a>
<a href="./reserve-book.php" class="button-below-table">Reserve Book</a>