 <?php 
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    if(isset($_POST['addSourceButton'])){
        $p_name = sanitize($_POST['s_name']);
        
        $query = insert_source($p_name);
        $result = mysqli_query($conn, $query);

        $year = date("Y");
        $id_db = mysqli_insert_id($conn);
        $id = str_pad($id_db, 5, '0', STR_PAD_LEFT);
        $s_id = $year."S".$id;

        $query2 = update_srcid($s_id, $id_db);
        mysqli_query($conn, $query2);
        
        if ($result) {
            $_SESSION['status_source'] = "Data added successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: source.php");
        } else{
            $_SESSION['status_source'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: source.php");
        }
    }

    if(isset($_POST['editSourceButton'])){
        $s_cid = sanitize($_POST['s_id']);
        $s_name = sanitize($_POST['s_name']);

        $query = update_source($s_cid, $s_name);
                $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status_source'] = "Data edited successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: source.php");
        } else{
            $_SESSION['status_source'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: source.php");
        }
    }

    if(isset($_POST['deleteSourceButton'])){
        $s_id = sanitize($_POST['s_id']);

        $query = delete_source($s_id);
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['status_source'] = "Data deleted successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: source.php");
        } else{
            $_SESSION['status_source'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: source.php");
        }
    }
?>