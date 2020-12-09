<?php

if (isset($_POST)) {

    $data = json_decode(file_get_contents('php://input'), true);

    switch ($data["op"]) {
        case "read":
            read($data);
            break;

        case "create":
            create($data);
            break;
        default:
            echo "invalid operation";
    }
}

function create($data)
{
    try {
        require "config.php";
        $conn = new PDO($conn_string, $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully \n";
        $sql = "INSERT INTO users (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$data["name"]]);

        echo "success, inserted";
    } catch (PDOException $e) {
        echo "An error occured: " . $e->getMessage() . "\n";
    }

    $conn = null;
}


function read($data)
{
    try {
        require "config.php";
        $conn = new PDO($conn_string, $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully \n";
        $sql = "SELECT * FROM users";
        $data = $conn->query($sql)->fetchAll();
        echo json_encode($data);
    } catch (PDOException $e) {
        echo "An error occured: " . $e->getMessage() . "\n";
    }

    $conn = null;
}
