<?php require_once('lib/database.php'); $database = new Database(); ?>
<!DOCTYPE html>
<html lang="en">

        <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>My Digital Library</title>
                <link rel="stylesheet" href="./style.css">
        </head>

        <body>
                <nav>
                        <a href="./index.php" class="home-link">
                                <img src="./img/logo.png" class="logo">
                        </a>
                        <span class="nav-list">
                                <a href="./students.php" class="navlink">Students</a>
                                <a href="./books.php" class="navlink">Books</a>
                        </span>
                </nav>
                <main>