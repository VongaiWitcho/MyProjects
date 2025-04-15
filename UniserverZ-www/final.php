<?php

header("Content-Type: application/json");

// Database connection
try {
    $db = new PDO('mysql:host=Uniform Server;port=3306;dbname=website', 'root', '');
} catch(PDOException $e) {
    echo $e->getMessage();
}

$method = $_SERVER["REQUEST_METHOD"];
$input = json_decode(file_get_contents('php://input'), true);
$token = "123";

if ($method == "GET" && $_GET["id"] == "") {

    $statement = $db->query("SELECT * FROM students");
    $students = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($students);

}

if ($method == "GET" && $_GET["id"] > 0) {

    $id = $_GET["id"];
    $statement = $db->prepare("SELECT * FROM students WHERE id = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $student = $statement->fetch(PDO::FETCH_ASSOC);
    echo json_encode($student);

}

if ($method == "POST") {

    $name = $input["name"];
    $surname = $input["surname"];
    $email = $input["email"];
    $birthday = $input["birthday"];

    $query = "INSERT INTO students (name, surname, email, birthday) VALUES (:name, :surname, :email, :birthday)";
    $statement = $db->prepare($query);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':surname', $surname);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':birthday', $birthday);
    $statement->execute();
    echo json_encode(array("message" => "Student added successfully"));

}

if ($method == "PUT" && $_GET["id"] > 0 && $token == $input["token"]) {

    $id = $_GET["id"];
    $name = $input["name"];
    $surname = $input["surname"];
    $email = $input["email"];
    $birthday = $input["birthday"];

    $query = "UPDATE students SET name = :name, surname = :surname, email = :email, birthday = :birthday WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':surname', $surname);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':birthday', $birthday);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    echo json_encode(array("message" => "Student updated successfully"));

}

if ($method == "DELETE" && $_GET["id"] > 0) {

    $id = $_GET["id"];
    $query = "DELETE FROM students WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    echo json_encode(array("message" => "Student deleted successfully"));

}
