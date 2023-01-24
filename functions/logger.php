<?php  
    $user_id = 0;
    $remote_ip = 0;
    $action =  '';

    //takes the date of the system
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d  h:i:sa");

    //checks if the user is logged in first
    if (isset( $_SESSION['login_id'] )) {
        $user_id = $_SESSION['login_id'];
    }

    //takes the link visited
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        $remote_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if ( strpos( $remote_ip, "," ) > 0 ) {
            $remote_ip_for = explode( ",", $remote_ip );
            $remote_ip = $remote_ip_for[0];
        }
    } else {
        if (isset( $_SERVER['REMOTE_ADDR'] )) {
            $remote_ip = $_SERVER['REMOTE_ADDR'];
        }
    }

    if (isset( $_SERVER['REQUEST_URI'] )) {
        $location = $_SERVER['REQUEST_URI'];
        $location = preg_replace('/^.+[\\\\\\/]/', '', $location);
    }

    //inserts value into the database
    $sql  = "INSERT INTO audit_log (a_id, u_id, remote_ip, location, action, date)";
    $sql .= " VALUES ('{default}', '{$user_id}', '{$remote_ip}', '{$location}', 'Viewed Page', '{$date}')";

    $result = mysqli_query($conn, $sql);
?>