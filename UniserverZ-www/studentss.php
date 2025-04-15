<?php
session_start();

// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=website', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

header('Content-Type: application/json');

// Handle form submission for adding a student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "add") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];

    $stmt = $db->prepare("INSERT INTO students (name, surname, email, birthday) VALUES (:name, :surname, :email, :birthday)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':birthday', $birthday);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to add student']);
    }
}

// Handle form submission for updating a student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "update") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];

    $stmt = $db->prepare("UPDATE students SET name = :name, surname = :surname, email = :email, birthday = :birthday WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':birthday', $birthday);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to update student']);
    }
}

// Handle delete operation
if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $db->prepare("DELETE FROM students WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to delete student']);
    }
}

// Handle get operation to display a student
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $db->prepare("SELECT * FROM students WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($student) {
        echo json_encode($student);
    } else {
        echo json_encode(['error' => 'Student not found']);
    }
}
?>
