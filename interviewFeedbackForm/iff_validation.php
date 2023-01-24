<?php 
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    date_default_timezone_set("Asia/Manila");
    $date = date('Y-m-d H:i:s');

    if(isset($_POST['searchButton'])){
        $search_phase = sanitize($_POST['search_phase']);
        $search_name = sanitize($_POST['search_name']);

        $find_candidate_iff_db = find_candidate_iff($search_name, $search_phase);
        foreach ($find_candidate_iff_db as $candidate) {
            $c_id = $candidate['c_id'];
            $i_id = $candidate['i_id'];
        }

        header("location:iff.php?id=$c_id&interviewer_id=$i_id&phase=$search_phase");
    }

    if(isset($_POST['passButton'])){
        $sme = sanitize($_POST['sme']);
        $com = sanitize($_POST['com']);
        $pro = sanitize($_POST['pro']);
        $cog = sanitize($_POST['cog']);
        $sol = sanitize($_POST['sol']);
        $int = sanitize($_POST['int']);
        $own = sanitize($_POST['own']);
        $lead = sanitize($_POST['lead']);
        $dl = sanitize($_POST['dl']);

        $c_id = sanitize($_POST['c_id']);
        $i_id = sanitize($_POST['i_id']);
        $phase = sanitize($_POST['phase']);

        $poscom = sanitize($_POST['poscom']);
        $negcom = sanitize($_POST['negcom']);
        $overcom = sanitize($_POST['overcom']);

        $status = "Passed";

        $total = $sme + $com + $pro + $cog + $sol + $int + $own + $lead + $dl;

        $query = insert_iff($c_id, $i_id, $sme, $com, $pro, $cog, $sol, $int, $own, $lead, $dl, $total, $poscom, $negcom, $overcom, $date, $status, $phase);
        $result = mysqli_query($conn, $query);

        if($result){
            echo "<script>window.close();</script>";
        } else {
            echo "Error! Something went wrong.";
        }
    }

    if(isset($_POST['poolButton'])){
        $sme = sanitize($_POST['sme']);
        $com = sanitize($_POST['com']);
        $pro = sanitize($_POST['pro']);
        $cog = sanitize($_POST['cog']);
        $sol = sanitize($_POST['sol']);
        $int = sanitize($_POST['int']);
        $own = sanitize($_POST['own']);
        $lead = sanitize($_POST['lead']);
        $dl = sanitize($_POST['dl']);

        $c_id = sanitize($_POST['c_id']);
        $i_id = sanitize($_POST['i_id']);
        $phase = sanitize($_POST['phase']);

        $poscom = sanitize($_POST['poscom']);
        $negcom = sanitize($_POST['negcom']);
        $overcom = sanitize($_POST['overcom']);

        $status = "For Pooling";

        $total = $sme + $com + $pro + $cog + $sol + $int + $own + $lead + $dl;
        //echo $sme.'-'.$com.'-'.$pro.'-'.$cog.'-'.$sol.'-'.$int.'-'.$own.'-'.$lead.'-'.$dl;

        $query = insert_iff($c_id, $i_id, $sme, $com, $pro, $cog, $sol, $int, $own, $lead, $dl, $total, $poscom, $negcom, $overcom, $date, $status, $phase);
        $result = mysqli_query($conn, $query);

        if($result){
            echo "<script>window.close();</script>";
        } else {
            echo "Error! Something went wrong.";
        }
    }

    if(isset($_POST['failButton'])){
        $sme = sanitize($_POST['sme']);
        $com = sanitize($_POST['com']);
        $pro = sanitize($_POST['pro']);
        $cog = sanitize($_POST['cog']);
        $sol = sanitize($_POST['sol']);
        $int = sanitize($_POST['int']);
        $own = sanitize($_POST['own']);
        $lead = sanitize($_POST['lead']);
        $dl = sanitize($_POST['dl']);

        $c_id = sanitize($_POST['c_id']);
        $i_id = sanitize($_POST['i_id']);
        $phase = sanitize($_POST['phase']);

        $poscom = sanitize($_POST['poscom']);
        $negcom = sanitize($_POST['negcom']);
        $overcom = sanitize($_POST['overcom']);

        $status = "Failed";

        $total = $sme + $com + $pro + $cog + $sol + $int + $own + $lead + $dl;

        $query = insert_iff($c_id, $i_id, $sme, $com, $pro, $cog, $sol, $int, $own, $lead, $dl, $total, $poscom, $negcom, $overcom, $date, $status, $phase);
        $result = mysqli_query($conn, $query);

        if($result){
            echo "<script>window.close();</script>";
        } else {
            echo "Error! Something went wrong.";
        }
    }

    if(isset($_POST['discButton'])){
        $sme = sanitize($_POST['sme']);
        $com = sanitize($_POST['com']);
        $pro = sanitize($_POST['pro']);
        $cog = sanitize($_POST['cog']);
        $sol = sanitize($_POST['sol']);
        $int = sanitize($_POST['int']);
        $own = sanitize($_POST['own']);
        $lead = sanitize($_POST['lead']);
        $dl = sanitize($_POST['dl']);

        $c_id = sanitize($_POST['c_id']);
        $i_id = sanitize($_POST['i_id']);
        $phase = sanitize($_POST['phase']);

        $poscom = sanitize($_POST['poscom']);
        $negcom = sanitize($_POST['negcom']);
        $overcom = sanitize($_POST['overcom']);

        $status = "For Discussion";

        $total = $sme + $com + $pro + $cog + $sol + $int + $own + $lead + $dl;

        $query = insert_iff($c_id, $i_id, $sme, $com, $pro, $cog, $sol, $int, $own, $lead, $dl, $total, $poscom, $negcom, $overcom, $date, $status, $phase);
        $result = mysqli_query($conn, $query);

        if($result){
            echo "<script>window.close();</script>";
        } else {
            echo "Error! Something went wrong.";
        }
    }
?>