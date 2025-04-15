<?php
        require_once('lib/database.php');
        if(!isset($_GET['action']) || empty($_GET['action'])){
                exit();
        }
        $action = $_GET['action'];
        $database = new Database();

        switch ($action) {
                case 'add_book':
                        $title = strip_tags(trim($_POST['title']));
                        $author = strip_tags(trim($_POST['author']));
                        $isbn = strip_tags(trim($_POST['isbn']));
                        $publisher = strip_tags(trim($_POST['publisher']));
                        $genre = strip_tags(trim($_POST['genre']));

                        $data = array(  
                                "title" => $title,
                                "author" => $author ,
                                "isbn" => $isbn ,
                                "publisher" =>$publisher ,
                                "genre" => $genre
                        );

                        $database->insertRows("books", $data);       
                        header('Location: books.php');
                        break;
                case 'edit_book':
                        $data = array(  
                                "title" => strip_tags(trim($_POST['title'])),
                                "author" => strip_tags(trim($_POST['author'])) ,
                                "isbn" => strip_tags(trim($_POST['isbn'])),
                                "publisher" => strip_tags(trim($_POST['publisher'])),
                                "genre" => strip_tags(trim($_POST['genre']))
                        );
                        $where['id'] = '=' . $_POST['id'];
                        $database->updateRows('books', $data, $where);
                        header('Location: books.php');
                        break;
                case'add_student':
                        $name = strip_tags($_POST['name']);
                        $password = strip_tags(trim($_POST['password']));
                        $department = strip_tags(trim($_POST['department']));
                        $phoneNumber =strip_tags(trim($_POST['phoneNumber']));
                        $email =strip_tags(trim($_POST['email']));

                        $data = array(  
                                "name" => $name,
                                "password" => $password,
                                "department" => $department,
                                "phone_number" => $phoneNumber,
                                "email" => $email
                        );

                        $database->insertRows("students", $data);       
                        header('Location: students.php');
                        break;
                case 'edit_student':
                        $data = array(
                                "name" => strip_tags(trim($_POST['name'])),
                                "password" => strip_tags(trim($_POST['password'])),
                                "department" => strip_tags(trim($_POST['department'])),
                                "phone_number" => strip_tags(trim($_POST['phoneNumber'])),
                                "email" => strip_tags(trim($_POST['email']))
                        );
                        $where['id'] = '=' . $_POST['id'];
                        $database->updateRows('students', $data, $where);
                        header('Location: students.php');
                        break;
                case 'delete_student':
                        $id = $_GET['id'];
                        $where['id'] = '='.$id;
                        $database->removeRows("students", $where);
                        header('Location: students.php');
                        break;
                case 'delete_book':
                        $id = $_GET['id'];
                        $where['id'] = '='.$id;
                        $database->removeRows("books", $where);
                        header('Location: books.php');
                        break;
                case 'reserve_book':
                        $data = array(
                                "book-id"=> strip_tags(trim($_POST['book-id']))
                        );
                        $database->insertRows('reservations', $data);
                        header('location: reserve-book.php');
                default:
                        # code...
                        break;
        }
?>