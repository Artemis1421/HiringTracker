<?php 
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    if(isset($_POST['addDepartmentButton'])){
        $d_name = $_POST['d_name'];
        $d_team = $_POST['d_team'];
        
        $query = insert_department($d_name, $d_team);
        $result = mysqli_query($conn, $query);
        
        $year = date("Y");
        $id_db = mysqli_insert_id($conn);
        $id = str_pad($id_db, 5, '0', STR_PAD_LEFT);
        $d_id = $year."D".$id;

        $query2 = update_depid($d_id, $id_db);
        mysqli_query($conn, $query2);

        if ($result) {
            $_SESSION['status_department'] = "Data added successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: department.php");
        } else{
            $_SESSION['status_department'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: department.php");
        }
    }

    if(isset($_POST['editDepartmentButton'])){
        $d_id = $_POST['d_id'];
        $d_name = $_POST['d_name'];
        $d_team = $_POST['d_team'];

        $query = update_department($d_id, $d_name, $d_team);
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status_department'] = "Data edited successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: department.php");
        } else{
            $_SESSION['status_department'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: department.php");
        }
    }

    if(isset($_POST['deleteDepartmentButton'])){
        $d_id = $_POST['d_id'];

        $query = delete_department($d_id);
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status_department'] = "Data deleted successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: department.php");
        } else{
            $_SESSION['status_department'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: department.php");
        }
    }
?>