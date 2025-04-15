<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuTable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('maa.png'); /* Specify the path to your background image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white; /* Set text color to white for better visibility */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for the container */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        table {
            color: black; /* Set text color for table rows */
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Menu List</h2>
        <a class="btn btn-primary" href="/createweb.php" role="button">Add</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>link</th>
                    <th>content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost:3306";
                $username = "root";
                $password = "root";
                $database = "www";

                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                // Read all rows from the database table
                $sql = "SELECT * FROM menu";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // Read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['link']}</td>
                            <td>{$row['content']}</td>
    
                            <td>
                                <a class='btn btn-primary btn-sm' href='/editweb.php?id={$row['id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/deleteweb.php?id={$row['id']}'>Delete</a>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
