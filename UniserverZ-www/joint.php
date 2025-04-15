<?php 
session_start();

// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=website', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
    exit;
}

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
        echo "<script>alert('Student added successfully');</script>";
    } else {
        echo "<script>alert('Failed to add student');</script>";
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
        echo "<script>alert('Student updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update student');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Register Info</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('maa.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #000;
            margin-top: 50px;
        }
        form { margin-bottom: 20px; }
        input[type="text"], input[type="email"], input[type="date"] { display: block; margin-bottom: 10px; padding: 8px; width: 100%; }
        input[type="submit"], .btn-logout { padding: 8px 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        i { cursor: pointer; margin-right: 10px; font-size: 1.2em; }
    </style>
</head>
<body>

<div class="container">
    <h1>Class Register</h1>
    <form id="student-form" method="POST" action="">
        <input type="text" id="name" name="name" placeholder="Name" required>
        <input type="text" id="surname" name="surname" placeholder="Surname" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="date" id="birthday" name="birthday" required>
        <input type="hidden" name="action" value="add">
        <input type="submit" value="+Add Employee" class="btn btn-primary">
    </form>

    <table id="students-table" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Birthday</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display students with Bootstrap classes
            $stmt = $db->query("SELECT * FROM students");
            $row_classes = ['table-active', 'table-primary', 'table-secondary', 'table-success', 'table-danger', 'table-warning', 'table-info', 'table-light', 'table-dark'];
            $row_index = 0;

            while ($student = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $row_class = $row_classes[$row_index % count($row_classes)];
                echo "<tr class='{$row_class}'>";
                echo "<td>" . htmlspecialchars($student['id']) . "</td>";
                echo "<td>" . htmlspecialchars($student['name']) . "</td>";
                echo "<td>" . htmlspecialchars($student['surname']) . "</td>";
                echo "<td>" . htmlspecialchars($student['email']) . "</td>";
                echo "<td>" . htmlspecialchars($student['birthday']) . "</td>";
                echo "<td>
                        <i class='fas fa-eye text-info' onclick='displayStudent(" . $student['id'] . ")' title='View'></i>
                        <i class='fas fa-pen text-warning' onclick='editStudent(" . $student['id'] . ", \"" . $student['name'] . "\", \"" . $student['surname'] . "\", \"" . $student['email'] . "\", \"" . $student['birthday'] . "\")' title='Edit'></i>
                        <i class='fas fa-trash text-danger' onclick='deleteStudent(" . $student['id'] . ")' title='Delete'></i>
                      </td>";
                echo "</tr>";

                $row_index++;
            }
            ?>
        </tbody>
    </table>
    <button class="btn btn-secondary btn-logout" onclick="logout()">Logout</button>
</div>

<script>
    function displayStudent(id) {
        fetch(`http://localhost/studentss.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                alert(`Name: ${data.name}\nSurname: ${data.surname}\nEmail: ${data.email}\nBirthday: ${data.birthday}`);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    function editStudent(id, name, surname, email, birthday) {
        document.getElementById('name').value = name;
        document.getElementById('surname').value = surname;
        document.getElementById('email').value = email;
        document.getElementById('birthday').value = birthday;
        document.getElementById('student-form').action = 'joint.php';
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = id;
        document.getElementById('student-form').appendChild(input);
        let actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = 'update';
        document.getElementById('student-form').appendChild(actionInput);
        document.querySelector('input[type="submit"]').value = 'Update Student';
    }

    function deleteStudent(id) {
        fetch(`http://localhost/studentss.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            location.reload();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }

    function logout() {
        window.location.href = 'login.php';
    }
</script>

</body>
</html>
