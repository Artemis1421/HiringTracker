<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {
        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
    ?>
</head>

<!-- MODALS -->

<!-- Add Department -->
<div><?php include 'addDepartmentModal.php'; ?></div>
<!-- End Add Department -->

<!-- Edit Department -->
<div><?php include 'editDepartmentModal.php'; ?></div>
<!-- End Edit Department -->

<!-- Delete Department -->
<div><?php include 'deleteDepartmentModal.php'; ?></div>
<!-- End Delete Department -->
<!-- END MODALS -->

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
                <!-- Data Verification -->
                <?php
                if (isset($_SESSION['status_department'])) {
                ?>
                    <script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: '<?php echo $_SESSION['status_code']; ?>',
                            title: '<?php echo $_SESSION['status_department']; ?>',
                        })
                    </script>
                <?php
                    unset($_SESSION['status_department']);
                }
                ?>
                <!-- End Data Verification -->
                    <h1 class="my-3 text-payreto-darkblue fw-bold">List of Departments</h1>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-payreto-darkblue-900 my-4" data-bs-toggle="modal" data-bs-target="#addDepartment">Add Department</button>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body table-responsive">
                            <table id="tableDashboard" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Department</th>
                                        <th>Team</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $department_db = find_department();
                                    foreach ($department_db as $department) :
                                ?>
                                    <tr>
                                        <td><?php echo $department['d_cid'] ?></td>
                                        <td><?php echo $department['d_name'] ?></td>
                                        <td><?php echo $department['d_team'] ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-success btn-sm rounded-3 mx-1 editDepartmentButton" type="button" data-bs-toggle="modal" data-bs-target="#editDepartment" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm rounded-3 mx-1 deleteDepartmentButton" type="button" data-bs-toggle="modal" data-bs-target="#deleteDepartment" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </main>
            <div><?php include '../layouts/footer.php'; ?></div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).on("click", ".editDepartmentButton", function() {
        $('#editDepartment').modal('show');

        $tr = $(this).closest('tr');

        var editDepartment = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(editDepartment);

        $('#edit_department_id').val(editDepartment[0]);
        $('#edit_department_name').val(editDepartment[1]);
        $('#edit_department_team').val(editDepartment[2]);
    });

    $(document).on("click", ".deleteDepartmentButton", function() {
        $('#deleteDepartment').modal('show');

        $tr = $(this).closest('tr');

        var deleteDepartment = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(deleteDepartment);

        $('#delete_department_id').val(deleteDepartment[0]);
    });
</script>

<?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
?>