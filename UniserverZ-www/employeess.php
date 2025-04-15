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

// Handle form submission for adding an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "add") {
    $fullname = $_POST["fullname"];
    $position = $_POST["position"];
    $workemail = $_POST["workemail"];
    $birthday = $_POST["birthday"];

    $stmt = $db->prepare("INSERT INTO employees (fullname, position, workemail, birthday) VALUES (:fullname, :position, :workemail, :birthday)");
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':workemail', $workemail);
    $stmt->bindParam(':birthday', $birthday);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to add employee']);
    }
}

// Handle form submission for updating an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "update") {
    $id = $_POST["id"];
    $fullname = $_POST["fullname"];
    $position = $_POST["position"];
    $workemail = $_POST["workemail"];
    $birthday = $_POST["birthday"];

    $stmt = $db->prepare("UPDATE employees SET fullname = :fullname, position = :position, workemail = :workemail, birthday = :birthday WHERE id = :id");
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':workemail', $workemail);
    $stmt->bindParam(':birthday', $birthday);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to update employee']);
    }
}

// Handle delete operation
if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $db->prepare("DELETE FROM employees WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to delete employee']);
    }
}

// Handle get operation to display an employee
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $db->prepare("SELECT * FROM employees WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($employee) {
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Employee not found']);
    }
}
?>
