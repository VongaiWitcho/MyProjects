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
        echo "<script>alert('Employee added successfully');</script>";
    } else {
        echo "<script>alert('Failed to add employee');</script>";
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
        echo "<script>alert('Employee updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update employee');</script>";
    }
}

// Handle DELETE request for deleting an employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "delete") {
    $id = $_POST["id"];
    $stmt = $db->prepare("DELETE FROM employees WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete employee"]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doble G - Employees Info</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('pic.PNG') no-repeat center center fixed;
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
        input[type="text"], input[type="email"], input[type="date"] { display: block; margin-bottom: 100px; padding: 8px; width: 40%; }
        input[type="submit"], .btn-logout { padding: 8px 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #FF0000; padding: 8px; text-align: left; }
        i { cursor: pointer; margin-right: 10px; font-size: 1.2em; }

        /* Set row color to lime green */
        .lime-green {
            background-color: limegreen;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Doble G - Employees Info</h1>
    <form id="employee-form" method="POST" action="">
        <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
        <input type="text" id="position" name="position" placeholder="Position" required>
        <input type="email" id="workemail" name="workemail" placeholder="Work Email" required>
        <input type="date" id="birthday" name="birthday" required>
        <input type="hidden" name="action" value="add">
        <input type="submit" value="+Add Employee" class="btn btn-success">
    </form>

    <table id="employees-table" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Work Email</th>
                <th>Birthday</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display employees
            $stmt = $db->query("SELECT * FROM employees");
            while ($employee = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr class='lime-green'>";
                echo "<td>" . htmlspecialchars($employee['id']) . "</td>";
                echo "<td>" . htmlspecialchars($employee['fullname']) . "</td>";
                echo "<td>" . htmlspecialchars($employee['position']) . "</td>";
                echo "<td>" . htmlspecialchars($employee['workemail']) . "</td>";
                echo "<td>" . htmlspecialchars($employee['birthday']) . "</td>";
                echo "<td>
                        <i class='fas fa-eye text-info' onclick='displayEmployee(" . $employee['id'] . ")' title='View'></i>
                        <i class='fas fa-pen text-warning' onclick='editEmployee(" . $employee['id'] . ", \"" . $employee['fullname'] . "\", \"" . $employee['position'] . "\", \"" . $employee['workemail'] . "\", \"" . $employee['birthday'] . "\")' title='Edit'></i>
                        <i class='fas fa-trash text-danger' onclick='deleteEmployee(" . $employee['id'] . ")' title='Delete'></i>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <button class="btn btn-secondary btn-logout" onclick="logout()">Logout</button>
</div>

<script>
    function deleteEmployee(id) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', id);

        fetch('', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Failed to delete employee');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }

    function displayEmployee(id) {
        fetch(`http://localhost/employeess.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                alert(`Full Name: ${data.fullname}\nPosition: ${data.position}\nWork Email: ${data.workemail}\nBirthday: ${data.birthday}`);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    function editEmployee(id, fullname, position, workemail, birthday) {
        document.getElementById('fullname').value = fullname;
        document.getElementById('position').value = position;
        document.getElementById('workemail').value = workemail;
        document.getElementById('birthday').value = birthday;
        document.getElementById('employee-form').action = '';
        let inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'id';
        inputId.value = id;
        document.getElementById('employee-form').appendChild(inputId);
        document.querySelector('input[name="action"]').value = 'update';
        document.querySelector('input[type="submit"]').value = 'Update Employee';
    }

    function logout() {
        window.location.href = 'Officefrondend.html';
    }
</script>

</body>
</html>
