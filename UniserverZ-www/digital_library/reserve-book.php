<?php include('header.php'); $database = new Database();?>
<h1>Reserve Book</h1>

<form method="POST" action="process.php?action=reserve_book" enctype="multipart/form-data">
        <?php $books = $database->getRows("books");$reservedBooks = $database->getRows("reservations");?>
        <div class="form-row">
                <label for="book-id">Select Book</label>
                <select id="book-id" name="book-id">
                        <option value="" selected disabled></option>
                        <?php
                                foreach($books as $book){
                                        $bookReserved = false;
                                        foreach($reservedBooks as $reservedBook){
                                                if($book['id'] === $reservedBook['book-id']) $bookReserved = true;
                                        }
                                        if(!$bookReserved){
                        ?>
                                <option value="<?php echo $book['id'] ?>"><?php echo $book['title'] ?> </option>
                        <?php
                                        }
                                }
                        ?>
                </select>
        </div>
        
        <p class="reservation-info-label">Only Books that are not reserved will be shown</p>
        <div>
                <input type="submit" class="form-submit">
        </div>
</form>