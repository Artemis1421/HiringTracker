<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Payreto | Hiring Tracker</title>
    <?php
    session_start();
    
    include '../functions/conn.php';
    include '../functions/functions.php';
    include '../layouts/header.php';
    ?>
</head>

<body>
    <?php   
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d H:i:s');
        if (isset($_SESSION['status_login'])) {
        ?>
            <script>
                Swal.fire({
                    icon: '<?php echo $_SESSION['status_code']; ?>',
                    title: '<?php echo $_SESSION['status_login']; ?>',
                    text: '<?php echo $_SESSION['status_text']; ?>',
                    confirmButtonColor: "#010538"
                })
            </script>
        <?php
            unset($_SESSION['status_login']);
        }
    ?>
    <div class="overflow-hidden">
        <form method="POST" action="login_validation.php">
            <div class="row">
                <div class="col-12 col-md-5 d-flex flex-column align-items-center align-content-center justify-content-center mt-5 pt-5 mt-sm-0">
                    <div class="w-50 mb-5">
                        <img class="img-fluid" width="50%" src="/HiringTracker/assets/images/Payreto_logo.png" alt="" srcset="">
                    </div>
                    <div class="w-50 w-sm-100">
                        <h3>Login</h3>
                    </div>
                    <div class="mb-3 w-50 w-sm-100">
                        <p class="text-muted">Payreto Hiring Tracker</p>
                    </div>
                    <div class="form-floating mb-3 w-50 w-sm-100">
                        <input type="text" required name="username" class="form-control" id="floatingUsername">
                        <label for="floatingUsername">Username</label>
                    </div>
                    <div class="form-floating mb-3 w-50 w-sm-100">
                        <input type="password" required name="password" class="form-control" id="floatingPassword">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="d-none">
                        <input type="text" name="date" class="form-control" id="floatingPassword" value="<?php echo $date ?>">
                        <label for="floatingPassword">Date</label>
                    </div>
                    <div class="form-check mb-3 w-50 w-sm-100">
                        <input class="form-check-input text-payreto-darkblue-900" type="checkbox" onclick="showPassword()">Show Password
                    </div>
                    <div class="my-2">
                        <span>Forgot password? <a href="/HiringTracker/login/forgot_password.php">Click Here</a></span>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <button class="btn btn-payreto-darkblue-900" type="submit" name="loginButton" value="Login">Login</button>
                    </div>
                </div>
                <div class="col-md-7 d-none d-md-block">
                    <div id="particles-js">
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="/HiringTracker/assets/js/particles-app.js"></script>
<script src="/HiringTracker/assets/js/app-particles.js"></script>

</html>