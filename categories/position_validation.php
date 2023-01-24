<?php 
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    if(isset($_POST['addPositionButton'])){
        $p_department = sanitize($_POST['p_department']);
        $p_name = sanitize($_POST['p_name']);
        $p_req = sanitize($_POST['p_req']);
        $p_count = sanitize($_POST['p_count']);

        date_default_timezone_set('Asia/Manila');
        $p_date = date('Y-m-d H:i:s');
        
        $query = insert_position($p_department, $p_name, $p_date, $p_req, $p_count);
        $result = mysqli_query($conn, $query);

        $year = date("Y");
        $id_db = mysqli_insert_id($conn);
        $id = str_pad($id_db, 5, '0', STR_PAD_LEFT);
        $p_id = $year."P".$id;

        $query2 = update_posid($p_id, $id_db);
        mysqli_query($conn, $query2);
        
        if ($result) {
            $_SESSION['status_position'] = "Data added successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: position.php");
        } else{
            $_SESSION['status_position'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: position.php");
        }
    }

    if(isset($_POST['editPositionButton'])){
        $p_id = sanitize($_POST['p_id']);
        $p_department = sanitize($_POST['p_department']);
        $p_name = sanitize($_POST['p_name']);
        $p_req = sanitize($_POST['p_req']);
        $p_count = sanitize($_POST['p_count']);

        $query = update_position($p_id, $p_department, $p_name, $p_req, $p_count);
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status_position'] = "Data edited successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: position.php");
        } else{
            $_SESSION['status_position'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: position.php");
        }
    }

    if(isset($_POST['deletePositionButton'])){
        $p_id = sanitize($_POST['p_id']);

        $query = delete_position($p_id);
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status_position'] = "Data deleted successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: position.php");
        } else{
            $_SESSION['status_position'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: position.php");
        }
    }
?>