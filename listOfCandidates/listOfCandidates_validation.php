<?php 
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    //edit candidate in the database
    if(isset($_POST['edtiViewButton'])){
        $c_id = sanitize($_POST['c_id']);
        $c_name = sanitize($_POST["c_name"]);
        $c_eaddr = sanitize($_POST["c_eaddr"]);
        $c_actpas = sanitize($_POST["c_actpas"]);
        $c_appli = sanitize($_POST["c_appli"]);
        $c_school = sanitize($_POST["c_school"]);
        $c_course = sanitize($_POST["c_course"]);
        $c_folder = sanitize($_POST["c_folder"]);

        $d_id = sanitize($_POST["d_id"]);
        $p_id = sanitize($_POST['p_id']);
        $s_id = sanitize($_POST['s_id']);

        $cog_1 = sanitize($_POST["cog_1"]);
        $cog_2 = sanitize($_POST["cog_2"]);
        $raw_1 = sanitize($_POST["raw_1"]);
        $raw_2 = sanitize($_POST["raw_2"]);
        $verb_1 = sanitize($_POST["verb_1"]);
        $verb_2 = sanitize($_POST["verb_2"]);
        $num_1 = sanitize($_POST["num_1"]);
        $num_2 = sanitize($_POST["num_2"]);
        $abs_1 = sanitize($_POST["abs_1"]);
        $abs_2 = sanitize($_POST["abs_2"]);

        $beh_pro = sanitize($_POST["beh_pro"]);
        $beh_cat = sanitize($_POST["beh_cat"]);
        $beh_a = sanitize($_POST["beh_a"]);
        $beh_b = sanitize($_POST["beh_b"]);
        $beh_c = sanitize($_POST["beh_c"]);
        $beh_d = sanitize($_POST["beh_d"]);
        $beh_ab = sanitize($_POST["beh_ab"]);
        $beh_ac = sanitize($_POST["beh_ac"]);
        $beh_ad = sanitize($_POST["beh_ad"]);
        $beh_bc = sanitize($_POST["beh_bc"]);
        $beh_bd = sanitize($_POST["beh_bd"]);
        $beh_cd = sanitize($_POST["beh_cd"]);

        // Hide prev data if position is changed
        $repro = if_samePos($c_id,$p_id);
        if($repro == false){
            $sql_reprof = update_reprofile($c_id);
            $result = mysqli_query($conn, $sql_reprof);
            $sql = insert_candidate($c_name, $c_eaddr, $s_id, $c_actpas, $c_appli, $c_school, $c_course, $d_id, $p_id, $c_folder, $temp_date);
            $result = mysqli_query($conn, $sql);
            $id = $conn -> insert_id;
            
            //operation for proper formatting of ID for each candidate
            $year = date("Y");
            $id_db = mysqli_insert_id($conn);
            $id_pad = str_pad($id_db, 7, '0', STR_PAD_LEFT);
            $cc_id = $year."C".$id_pad;
            
            $query2 = update_candid($cc_id, $id_db);
            mysqli_query($conn, $query2);

            $query3 = insert_reprof_cog($c_id, $id);
            mysqli_query($conn, $query3);
            
        }
        else{
            $sql = update_candidate($c_id, $c_name, $c_eaddr, $s_id, $c_actpas, $c_appli, $c_school, $c_course, $d_id, $p_id, $c_folder);
            $result = mysqli_query($conn, $sql);

            $sql2 = update_cognitive($c_id, $cog_1, $cog_2, $raw_1, $raw_2, $verb_1, $verb_2, $num_1, $num_2, $abs_1, $abs_2, $beh_pro, $beh_cat, $beh_a, $beh_b, $beh_c, $beh_d, $beh_ab, $beh_ac, $beh_ad, $beh_bc, $beh_bd, $beh_cd);
            $result2 = mysqli_query($conn, $sql2);
        }

        // $sql = update_candidate($c_id, $c_name, $c_eaddr, $s_id, $c_actpas, $c_appli, $c_school, $c_course, $d_id, $p_id, $c_folder);
        // $result = mysqli_query($conn, $sql);

        // $sql2 = update_cognitive($c_id, $cog_1, $cog_2, $raw_1, $raw_2, $verb_1, $verb_2, $num_1, $num_2, $abs_1, $abs_2, $beh_pro, $beh_cat, $beh_a, $beh_b, $beh_c, $beh_d, $beh_ab, $beh_ac, $beh_ad, $beh_bc, $beh_bd, $beh_cd);
        // $result2 = mysqli_query($conn, $sql2);

        if($sql){
            $_SESSION['status_viewCandidates'] = "Success! Candidate edited successfully.";
            $_SESSION['status_code'] = "success";
            header("location: viewCandidates.php?id=".$c_id);
        } else {
            $_SESSION['status_viewCandidates'] = "Error! Something went wrong.";
            $_SESSION['status_code'] = "error";
            header("location: viewCandidates.php?id=".$c_id);
        }
    }

    //scoring of candidate
    if(isset($_POST['scoreCandidateButton'])){
        $i_id = sanitize($_POST['i_id']);
        $i_phase = sanitize($_POST['i_phase']);
        $c_id = sanitize($_POST['c_id']);

        $find_email_interviewer_db = find_email_interviewer($i_id);
        foreach ($find_email_interviewer_db as $interviewer) {
            $name = $interviewer['i_name'];
            $email = $interviewer['i_eaddr'];
        }

        include 'score_email.php';

        $_SESSION['status_listOfCandidates'] = "Success! Interviewer has been emailed.";
        $_SESSION['status_code'] = "success";
        header("location: listOfCandidates.php");
    }
?>