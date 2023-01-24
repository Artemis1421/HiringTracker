<?php
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    if(isset($_POST["saveCandidateButton"])){
        $c_name = $_POST["c_name"];
        $c_eaddr = $_POST["c_eaddr"];
        $s_id = $_POST["s_id"];
        @$c_actpas = $_POST["c_actpas"];
        $c_appli = $_POST["c_appli"];
        $c_school = $_POST["c_school"];
        $c_course = $_POST["c_course"];
        $c_folder = $_POST["c_folder"];
        
        $d_id = $_POST["d_id"];
        $p_id = $_POST['p_id'];
        
        $temp_date = "0000-00-00 00:00:00";
        
        $sql = insert_candidate($c_name, $c_eaddr, $s_id, $c_actpas, $c_appli, $c_school, $c_course, $d_id, $p_id, $c_folder, $temp_date);
        $result = mysqli_query($conn, $sql);
        $id = $conn -> insert_id;
        
        //operation for proper formatting of ID for each candidate
        $year = date("Y");
        $id_db = mysqli_insert_id($conn);
        $id_pad = str_pad($id_db, 7, '0', STR_PAD_LEFT);
        $c_id = $year."C".$id_pad;
        
        $query2 = update_candid($c_id, $id_db);
        mysqli_query($conn, $query2);
        
        $cog_1 = $_POST["cog_1"];
        $cog_2 = $_POST["cog_2"];
        $raw_1 = $_POST["raw_1"];
        $raw_2 = $_POST["raw_2"];
        $verb_1 = $_POST["verb_1"];
        $verb_2 = $_POST["verb_2"];
        $num_1 = $_POST["num_1"];
        $num_2 = $_POST["num_2"];
        $abs_1 = $_POST["abs_1"];
        $abs_2 = $_POST["abs_2"];
        
        $beh_pro = $_POST["beh_pro"];
        $beh_cat = $_POST["beh_cat"];
        $beh_a = $_POST["beh_a"];
        $beh_b = $_POST["beh_b"];
        $beh_c = $_POST["beh_c"];
        $beh_d = $_POST["beh_d"];
        $beh_ab = $_POST["beh_ab"];
        $beh_ac = $_POST["beh_ac"];
        $beh_ad = $_POST["beh_ad"];
        $beh_bc = $_POST["beh_bc"];
        $beh_bd = $_POST["beh_bd"];
        $beh_cd = $_POST["beh_cd"];
        
        $dom_bird = $_POST["dom_bird"];
        $dove = $_POST["dove"];
        $owl = $_POST["owl"];
        $peacock = $_POST["peacock"];
        $eagle = $_POST["eagle"];
        
        $sql2 = insert_cognitive($id, $cog_1, $cog_2, $raw_1, $raw_2, $verb_1, $verb_2, $num_1, $num_2, $abs_1, $abs_2, $beh_pro, $beh_cat, $beh_a, $beh_b, $beh_c, $beh_d, $beh_ab, $beh_ac, $beh_ad, $beh_bc, $beh_bd, $beh_cd, $dom_bird, $dove, $owl, $peacock, $eagle);
        $result2 = mysqli_query($conn, $sql2);

        

        if ($result && $result2) {
            $_SESSION['status_listOfCandidates'] = "Data added successsfully!";
            $_SESSION['status_code'] = "success";
            header("Location: listOfCandidates.php");
        } else{
            $_SESSION['status_listOfCandidates'] = "Error! Something went wrong";
            $_SESSION['status_code'] = "warning";
            header("Location: listOfCandidates.php");
        }
    }
?>