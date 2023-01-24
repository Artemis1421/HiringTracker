<?php 
session_start();

include "../functions/functions.php";
include "../functions/conn.php";

date_default_timezone_set("Asia/Manila");
$date = date('Y-m-d H:i:s');

if(isset($_POST["tthSaveButton"])){
    $tthVal = $_POST["tthValue"];

    $result = insert_tth_value($tthVal, $date);
    mysqli_query($conn, $result);

    header("location: index.php");
}
?>