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
        echo "Connected successfully \n";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "\n";
    }

    $conn = null;
}


function read($data)
{
    echo $data["name"];
}
