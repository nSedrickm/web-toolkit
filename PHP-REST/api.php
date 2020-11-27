<?php

if (isset($_POST)) {

    switch ($_POST["operation"]) {
        case "read":
            read($_POST);
            break;

        case "create":
            create($_POST);
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
