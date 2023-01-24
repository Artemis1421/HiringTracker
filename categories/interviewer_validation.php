<?php
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    if(isset($_POST['addInterviewerButton'])){
        $i_name = $_POST['i_name'];
        $i_email = $_POST['i_email'];

        $query = insert_interviewer($i_name, $i_email);
        $result = mysqli_query($conn, $query);

        $year = date("Y");
        $id_db = mysqli_insert_id($conn);
        $id = str_pad($id_db, 5, '0', STR_PAD_LEFT);
        $i_id = $year."I".$id;

        $query2 = update_intid($i_id, $id_db);
        mysqli_query($conn, $query2);

        if ($result) {
            $_SESSION['status_interviewer'] = "Data added successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: interviewer.php");
        } else{
            $_SESSION['status_interviewer'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: interviewer.php");
        }
    }

    if(isset($_POST['editInterviewerButton'])){
        $i_id = $_POST['i_id'];
        $i_name = $_POST['i_name'];
        $i_email = $_POST['i_email'];

        $query = update_interviewer($i_id, $i_name, $i_email);
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status_interviewer'] = "Data edited successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: interviewer.php");
        } else{
            $_SESSION['status_interviewer'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: interviewer.php");
        }
    }

    if(isset($_POST['deleteInterviewerButton'])){
        $i_id = $_POST['i_id'];

        $query = delete_interviewer($i_id);
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status_interviewer'] = "Data deleted successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: interviewer.php");
        } else{
            $_SESSION['status_interviewer'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: interviewer.php");
        }
    }
?>