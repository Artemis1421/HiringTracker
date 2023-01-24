<?php 
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    if(isset($_POST['approvalIFFButton'])){
        $iff_id = sanitize($_POST['iff_id']);

        $query = insert_int_scores($iff_id);
        $result = mysqli_query($conn, $query);

        $query2 = delete_int_scores($iff_id);
        $result2 = mysqli_query($conn, $query2);
        $sendYes = $_POST['sendEmail'];
        if(($result || $result2) && $sendYes == 'Yes'){
            $_SESSION['status_approval'] = "Candidate approved and email has been sent successfully!";
            $_SESSION['status_code'] = "success";
            header("location:iffApproval.php");
        } else if($result || $result2){
            $_SESSION['status_approval'] = "Candidate approved successfully!";
            $_SESSION['status_code'] = "success";
            header("location:iffApproval.php");
        } else {
            $_SESSION['status_approval'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location:iffApproval.php");
        }
    }

    if(isset($_POST['deleteIFFButton'])){
        $iff_id = sanitize($_POST['iff_id']);

        $query = delete_int_scores($iff_id);
        $result = mysqli_query($conn, $query);
        $sendYes = $_POST['sendEmail'];
        $email = "psinternjyotoko.payreto@gmail.com";
        if(($result || $result2) && $sendYes == 'Yes'){
            include 'emailCand_Descision.php';
            $_SESSION['status_approval'] = "Candidate declined and email has been sent successfully!";
            $_SESSION['status_code'] = "success";
            header("location:iffApproval.php");
        }else if($result){
            $_SESSION['status_approval'] = "Candidate declined successfully!";
            $_SESSION['status_code'] = "success";
            header("location:iffApproval.php");
        } else {
            $_SESSION['status_approval'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location:iffApproval.php");
        }
    }
?>