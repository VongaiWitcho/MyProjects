<!DOCTYPE html>
<html>
<head>
    <title>Class Register</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { margin-bottom: 20px; }
        input[type="text"], input[type="email"], input[type="date"] { display: block; margin-bottom: 10px; padding: 8px; width: 300px; }
        input[type="submit"] { padding: 8px 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        button { padding: 8px 16px; margin-right: 5px; }
    </style>
</head>
<body>

<h1>Class Register</h1>

<form id="student-form" method="POST" action="">
    <input type="text" id="name" name="name" placeholder="Name" required>
    <input type="text" id="surname" name="surname" placeholder="Surname" required>
    <input type="email" id="email" name="email" placeholder="Email" required>
    <input type="date" id="birthday" name="birthday" required>
    <input type="submit" value="Add Student">
</form>

<table id="students-table">
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
        // Database connection
        try {
            $db = new PDO('mysql:host=localhost;dbname=website', 'root', 'root');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
            exit;
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                echo "<tr><td colspan='6'>Student added successfully</td></tr>";
            } else {
                echo "<tr><td colspan='6'>Failed to add student</td></tr>";
            }
        }

        // Fetch and display students
        $stmt = $db->query("SELECT * FROM students");
        while ($student = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($student['id']) . "</td>";
            echo "<td>" . htmlspecialchars($student['name']) . "</td>";
            echo "<td>" . htmlspecialchars($student['surname']) . "</td>";
            echo "<td>" . htmlspecialchars($student['email']) . "</td>";
            echo "<td>" . htmlspecialchars($student['birthday']) . "</td>";
            echo "<td>
                    <button onclick='displayStudent(" . $student['id'] . ")'>DISPLAY</button>
                    <button onclick='updateStudent(" . $student['id'] . ")'>UPDATE</button>
                    <button onclick='deleteStudent(" . $student['id'] . ")'>DELETE</button>
                  </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<script>
    function displayStudent(id) {
        fetch(`http://localhost/path-to-your-php-file.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                alert(`Name: ${data.name}\nSurname: ${data.surname}\nEmail: ${data.email}\nBirthday: ${data.birthday}`);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    function updateStudent(id) {
        const name = prompt("Enter new name:");
        const surname = prompt("Enter new surname:");
        const email = prompt("Enter new email:");
        const birthday = prompt("Enter new birthday:");

        const student = { name, surname, email, birthday };

        fetch(`http://localhost/path-to-your-php-file.php?id=${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(student)
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

    function deleteStudent(id) {
        fetch(`http://localhost/path-to-your-php-file.php?id=${id}`, {
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
</script>

</body>
</html>
