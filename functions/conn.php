<?php 
    $db_sname = "localhost";
    $db_uname = "root";
    $db_password = "";
    $db_name = "hiring_tracker";

    $conn = mysqli_connect($db_sname, $db_uname, $db_password, $db_name);

    if(!$conn){
        echo "Connection failed!";
    }
?>