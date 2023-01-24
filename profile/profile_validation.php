<?php
    include '../functions/conn.php';
    include '../functions/functions.php';
    session_start();

    if(isset($_POST['changeUserButton'])){
        $username = sanitize($_POST['username']);
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        $privilege = sanitize($_POST['privilege']);
        $curr_pass = sanitize($_POST['current_password']);
        $new_pass = sanitize($_POST['new_password']);
        $confirm_pass = sanitize($_POST['confirm_password']);

        //checks if all password fields are empty, if so change username
        if(empty($curr_pass) && empty($new_pass) && empty($confirm_pass)){
            if(!empty($username)){
                $query = update_credentials($username, $email);
                $result = mysqli_query($conn, $query);
                $_SESSION['status_profile'] = "Success!";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_text'] = "Data has been saved successfully!";

                $_SESSION['login_name'] = $name;

                if($result){
                    $_SESSION['status_profile'] = "Success!";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['status_text'] = "Data has been saved successfully!";
                    header("location: profile.php");
                } else {
                    $_SESSION['status_profile'] = "Error!";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_text'] = "Something went wrong!";
                    header("location: profile.php");
                }
            } else {
                $_SESSION['status_profile'] = "Error!";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_text'] = "Incomplete Data Credentials!";
                header("location: profile.php");
            }
        }
        //checks if all password fields are not empty
        elseif(!empty($curr_pass) && !empty($new_pass) && !empty($confirm_pass)){

            //checks if current password fields is same with the login password
            if(password_verify($curr_pass, $_SESSION['login_password']) == 1){
                //checks if new password and confirm password fields are the same
                
                if($new_pass == $confirm_pass){
                    $new_pass = passSaltHash($new_pass);

                    $query2 = update_credentials($username, $email);
                    $result2 = mysqli_query($conn, $query2);
                    
                    $query3 = update_password($email, $new_pass);
                    $result3 = mysqli_query($conn, $query3);
                    
                    $_SESSION['status_profile'] = "Error!";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_text'] = "Something went wrong!";
                    header("location: profile.php");
                    if($result3){
                        $_SESSION['status_profile'] = "Success!";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_text'] = "Password changed successfully!";
                        header("location: ../functions/logout.php");
                    } else {
                        $_SESSION['status_profile'] = "Error!";
                        $_SESSION['status_code'] = "error";
                        $_SESSION['status_text'] = "Something went wrong!";
                        header("location: profile.php");
                    }
                } else {
                    $_SESSION['status_profile'] = "Error!";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_text'] = "New Password and Confirm Password does not match!";
                    header("location: profile.php");
                }
            } else {
                $_SESSION['status_profile'] = "Error!";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_text'] = "Incorrect Password!";
                header("location: profile.php");
            }
        } else {
            $_SESSION['status_profile'] = "Error!";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_text'] = "Incomplete Data for Password!";
            header("location: profile.php");
        }
    }

    if(isset($_POST['addUserButton'])){
        $username = sanitize($_POST['username']);
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        $privilege = sanitize($_POST['privilege']);
        $password = sanitize($_POST['password']);
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d H:i:s');

        include 'profile_email.php';

        $query = insert_employee($username, $name, $email, $privilege, $password, $date);
        $result = mysqli_query($conn, $query);
        
        $_SESSION['status_profile'] = "Success!";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_text'] = "Account created successfully! Check user's inbox or spam for credentials";
        header("location: profile.php");
    }

    if(isset($_POST['restoreUserButton'])){
        $email = sanitize($_POST['email']);
        $default_pass = 'Payreto@123456';

        $default_pass = passSaltHash($default_pass);

        $query = update_password($email, $default_pass);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_profile'] = "Success!";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_text'] = "Account's password has been set to default!";
            header("location: profile.php");
        }
    }

    if(isset($_POST['deleteUserButton'])){
        $id = sanitize($_POST['id']);

        $query = delete_employee($id);
        $result = mysqli_query($conn, $query);

        if($result){
            $_SESSION['status_profile'] = "Success!";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_text'] = "Account has been successfully deleted!";
            header("location: profile.php");
        } else {
            echo "fail";
        }
    }
?>