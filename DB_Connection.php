<?php

    $servername = "eu-cdbr-west-01.cleardb.com";
    $username = "b5cb0c7c276522";
    $password = "4dd83117";
    $database = "heroku_919492313e633ae";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    echo $conn->connect_error;
    // check the connection
    if ($conn->connect_error) {
        // exit and kill this process
        echo "Failed to connect to database!";
        die("Connection failed: ");
    }

?>