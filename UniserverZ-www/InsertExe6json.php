<?php

header("Content-Type: application/json");

try {
    $db = new PDO('mysql:host=localhost;dbname=www','root','root');
}

catch(PDOException $e) {
    echo $e->getMessage();
}

$method = $_SERVER["REQUEST_METHOD"];
$input = json_decode(file_get_contents('php://input'), true);

if ($method == "GET") {

    $statement = $db->query("SELECT * FROM usersj");
    $new_array = array();
    foreach($statement as $row) {
        $new_array[] = array(
            "id" => $row["id"],
            "name" => $row["name"],
            "fname" => $row["fname"]
        );
    }
    $statement->closeCursor();

    echo json_encode($new_array);

}

if ($method == "POST") {

    $query = "INSERT INTO usersj (name, fname) VALUES (:name, :fname)";
    $statement = $db->prepare($query);
    $statement->bindParam(':name', $input["name"]);
    $statement->bindParam(':fname', $input["fname"]);
    $statement->execute();

    echo json_encode(array("message" => "Record inserted successfully."));

}

if ($method == "PUT") {

    parse_str(file_get_contents("php://input"), $put_vars);
    $id = $put_vars["id"];
    $name = $put_vars["name"];
    $fname = $put_vars["fname"];

    $query = "UPDATE usersj SET name = :name, fname = :fname WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindParam(':name', $name);
    $statement->bindParam(':fname', $fname);
    $statement->bindParam(':id', $id);
    $statement->execute();

    echo json_encode(array("message" => "Record updated successfully."));

}

?>
