<?php 
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();
    
    date_default_timezone_set("Asia/Manila");
    $date = date('Y-m-d H:i:s');

    if(isset($_POST['passButton'])){
        $c_id = sanitize($_POST['c_id']);

        $query = pass_candidate($c_id, $date);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_viewCandidates'] = "Success! Candidate passed successfully.";
            $_SESSION['status_code'] = "success";
            header("location:viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }
    
    if(isset($_POST['jobButton'])){
        $c_id = sanitize($_POST['c_id']);

        $query = job_candidate($c_id, $date);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_viewCandidates'] = "Success! Candidate offered job successfully.";
            $_SESSION['status_code'] = "success";
            header("location:viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }

    if(isset($_POST['unresponsiveButton'])){
        $c_id = sanitize($_POST['c_id']);

        $query = unresponsive_candidate($c_id, $date);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_viewCandidates'] = "Success! Candidate changed to unresponsive successfully.";
            $_SESSION['status_code'] = "success";
            header("location:viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }

    if(isset($_POST['poolButton'])){
        $c_id = sanitize($_POST['c_id']);

        $query = pool_candidate($c_id, $date);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_viewCandidates'] = "Success! Candidate is now for pooling successfully.";
            $_SESSION['status_code'] = "success";
            header("location:viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }

    if(isset($_POST['failButton'])){
        $c_id = sanitize($_POST['c_id']);

        $query = fail_candidate($c_id, $date);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_viewCandidates'] = "Success! Candidate status failed successfully.";
            $_SESSION['status_code'] = "success";
            header("location:viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }

    if(isset($_POST['withdrawnButton'])){
        $c_id = sanitize($_POST['c_id']);

        $query = withdrawn_candidate($c_id, $date);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_viewCandidates'] = "Success! Candidate withdrawn successfully.";
            $_SESSION['status_code'] = "success";
            header("location:viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }

    if(isset($_POST['jobAcceptButton'])){
        $c_id = sanitize($_POST['c_id']);

        $query = job_accept_candidate($c_id, $date);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_viewCandidates'] = "Success! Candidate job offer accepted successfully.";
            $_SESSION['status_code'] = "success";
            header("location:viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }

    if(isset($_POST['jobDeclineButton'])){
        $c_id = sanitize($_POST['c_id']);

        $query = job_decline_candidate($c_id, $date);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_viewCandidates'] = "Success! Candidate job offer declined successfully.";
            $_SESSION['status_code'] = "success";
            header("location:viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }
?>