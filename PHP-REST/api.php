<?php

if (isset($_POST)) {
    foreach (getallheaders() as $name => $value) {
        echo "$name: $value <br>";
    }

    read($_POST);
}

function create()
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
    return json_encode($data);
}
