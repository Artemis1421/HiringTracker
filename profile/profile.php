<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1 && $_SESSION['login_level'] == 1) {
        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
    ?>
</head>

<!-- MODALS -->
<!-- Add Modal -->
<div>
    <?php include 'addProfileModal.php'; ?>
</div>
<!-- Add Modal End -->
<!-- Restore Modal -->
<div>
    <?php include 'restoreProfileModal.php'; ?>
</div>
<!-- Restore Modal End -->
<!-- Delete Modal -->
<div>
    <?php include 'deleteProfileModal.php'; ?>
</div>
<!-- Delete Modal End -->

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
                <!-- User Profile -->
                <section class="container-fluid px-4">
                    <h1 class="my-3 text-payreto-darkblue fw-bold">User Profile</h1>
                    <?php
                    if (isset($_SESSION['status_profile'])) {
                    ?>
                        <script>
                            Swal.fire({
                                icon: "<?php echo $_SESSION['status_code']; ?>",
                                title: "<?php echo $_SESSION['status_profile']; ?>",
                                text: "<?php echo $_SESSION['status_text']; ?>",
                                confirmButtonColor: "#010538"
                            })
                        </script>
                    <?php
                        unset($_SESSION['status_profile']);
                    }
                    ?>
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <?php
                            $find_employee_db = find_employee_list_login($_SESSION['login_email']);
                            foreach ($find_employee_db as $employee) :
                            ?>
                                <form method="POST" action="profile_validation.php">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold" for="username">Username</label>
                                            <input class="form-control" type="text" name="username" id="" value="<?php echo $employee['uname'] ?>">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold" for="firstName">Name</label>
                                            <input class="form-control" readonly type="text" name="name" id="" value="<?php echo $employee['name'] ?>">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold" for="lastName">Email</label>
                                            <input class="form-control" readonly type="text" name="email" id="" value="<?php echo $employee['eaddr'] ?>">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold" for="lastName">Privilege</label>
                                            <input class="form-control" readonly type="text" name="privilege" id="" value="<?php if ($employee['level'] == 1) echo "Super Admin";
                                                                                                                            else echo "Admin" ?>">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold" for="currentPassword">Current Password</label>
                                            <input class="form-control" type="password" name="current_password" id="">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold" for="newPassword">New Password</label>
                                            <input class="form-control" minlength="8" type="password" name="new_password" id="PassEntry2">
                                            <span name="StrengthDisp2" id="StrengthDisp2" class="badge displayBadge w-2">Weak</span>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold" for="ConfirmNewPassword">Confirm New Password</label>
                                            <input class="form-control" minlength="8" type="password" name="confirm_password" id="">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-payreto-darkblue-900 w-auto" type="submit" name="changeUserButton" id="changeUserButton">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <!-- User List -->
                <section class="container-fluid px-4 mt-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="my-3 text-payreto-darkblue fw-bold">User List</h1>
                        </div>
                        <div>
                            <button class="d-inline-block btn btn-payreto-darkblue-900 w-auto" data-bs-toggle="modal" data-bs-target="#addUser">+ Add</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card shadow-lg mb-4">
                            <div class="card-body table-responsive">
                                <table id="tableDashboard" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Last Login</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-break">
                                            <?php
                                            $employees_db = find_employee_list();
                                            foreach ($employees_db as $employee) :
                                            ?>
                                                <td class="fw-bold"><?php echo $employee['u_id'] ?></td>
                                                <td><?php echo $employee['uname'] ?></td>
                                                <td><?php echo $employee['eaddr'] ?></td>
                                                <td><?php $date = date('m/d/Y h:i:s:a', strtotime($employee['date']));
                                                    echo $date ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <button class="btn btn-success btn-sm rounded mx-1 restoreUserButton" type="button" data-bs-toggle="modal" data-bs-target="#restoreUser" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fas fa-undo"></i></button>
                                                        <button class="btn btn-danger btn-sm rounded mx-1 deleteUserButton" type="button" data-bs-toggle="modal" data-bs-target="#deleteUser" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <?php
            include '../layouts/footer.php';
            ?>
        </div>
    </div>
</body>

<script>
    $(document).on("click", ".restoreUserButton", function() {
        $('#restoreUser').modal('show');

        $tr = $(this).closest('tr');

        var restoreUser = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(restoreUser);

        $('#email_restore').val(restoreUser[2]);
    });

    $(document).on("click", ".deleteUserButton", function() {
        $('#deleteUser').modal('show');

        $tr = $(this).closest('tr');

        var deleteUser = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(deleteUser);

        $('#id_delete').val(deleteUser[0]);
    });

    // $(function() {
    //     var searchText = "Weak";
    //     var searchText2 = "Strong";
    //     var searchText3 = "Medium";
        

    //     $('#changeUserButton').prop('disabled', function() {
    //         return $('span').filter(function(_, el) {
    //             return $.trim($(el).text()) === searchText;
    //         }).length > 0;
    //     });

    // });
</script>

<?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
?>


<script type="text/javascript" src="../assets/js/passStrengthChecker2.js"></script>