<?php

    $servername = "localhost:3306";
    $dbusername = "Admin";
    $dbpassword = "password";
    $dbname     = "demodb";
    
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    if(!$conn) {
        echo "Connection failed, check db_conn.php";
    }

