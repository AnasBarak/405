<?php

    $servername = "localhost";
    $username = "anas1";
    $password = "";
    $database = "tech_news";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    echo $conn->connect_error;
    // check the connection
    if ($conn->connect_error) {
        // exit and kill this process
        echo "Failed to connect to database!";
        die("Connection failed: ");
    }

?>