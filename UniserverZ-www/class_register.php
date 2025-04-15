
<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}
?>

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
<p>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>! <a href="logout.php">Logout</a></p>

<!-- The rest of the class register code remains unchanged -->

</body>
</html>
