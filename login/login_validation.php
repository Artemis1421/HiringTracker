<?php 
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    if(isset($_POST['loginButton'])){
        $username = sanitize($_POST['username']);
        $password = sanitize($_POST['password']);
        $date = $_POST['date'];

        $login_credentials = find_login($username);

        foreach($login_credentials as $login){
            //login validation
            if($login['uname'] == $username && password_verify($password, $login['passw']) == 1){
                //if login sucessful

                $query = update_login($username, $date);
                $result = mysqli_query($conn, $query);

                //pass all login credentials to session
                $_SESSION['login_status'] = 1;
                $_SESSION['login_id'] = $login['u_id'];
                $_SESSION['login_uname'] = $login['uname'];
                $_SESSION['login_password'] = $login['passw'];
                $_SESSION['login_name'] = $login['name'];
                $_SESSION['login_email'] = $login['eaddr'];
                $_SESSION['login_level'] = $login['level'];
                
                header("location: ../dashboard/index.php");
                exit();
            }
        }
        //incorrect credentials
        $_SESSION['status_login'] = "Incorrect Credentials!";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_text'] = "You have entered incorrect username or password.";   
        
        header("location: login.php");
        exit();
    }
?>