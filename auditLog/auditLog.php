<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Log | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {
        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
    ?>
    
</head>

<body class="sb-nav-fixed">

    <?php
        if ($_SESSION['login_level'] == 0) {
            include '../layouts/navigation-bar_admin.php';
        } elseif ($_SESSION['login_level'] == 1) {
            include '../layouts/navigation-bar.php';
        }
    ?>
    <div id="layoutSidenav">
        <?php
        if ($_SESSION['login_level'] == 0) {
            include '../layouts/sidebar-admin.php';
        } elseif ($_SESSION['login_level'] == 1) {
            include '../layouts/sidebar.php';
        }
        ?>
        <div id="layoutSidenav_content">
            <main>
                <section class="container-fluid px-4">
                    <h1 class="my-3 text-payreto-darkblue fw-bold">Audit Log</h1>
                </section>
                 <section class="container-fluid px-4 mt-4">
                    <div class="row">
                        <div class="card shadow mb-4">
                            <div class="card-body table-responsive">
                                <table id="tableTemplate" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                            <th>Remote IP</th>
                                            <th>Date Accessed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $logs_db = find_logs();
                                        foreach ($logs_db as $logs):
                                    ?>
                                        <tr>
                                            <td><?php echo $logs['uname'] ?></td>
                                            <td><?php echo $logs['name'] ?></td>
                                            <td><?php echo $logs['location'] ?></td>
                                            <td><?php echo $logs['action'] ?></td>
                                            <td><?php echo $logs['remote_ip'] ?></td>
                                            <td><?php echo $logs['date'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <div><?php include '../layouts/footer.php'; ?></div>
            
        </div>
    </div>
</body>
</html>

<?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
?>