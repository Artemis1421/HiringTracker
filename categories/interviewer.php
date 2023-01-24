<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interviewer | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {
        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
    ?>
</head>

<!-- MODALS -->

<!-- Add Interviewer -->
<div><?php include 'addInterviewerModal.php'; ?></div>
<!-- End Add Interviewer -->

<!-- Edit Interviewer -->
<div><?php include 'editInterviewerModal.php'; ?></div>
<!-- End Edit Interviewer -->

<!-- Delete Interviewer -->
<div><?php include 'deleteInterviewerModal.php'; ?></div>
<!-- End Delete Interviewer -->
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
                if (isset($_SESSION['status_interviewer'])) {
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
                            title: '<?php echo $_SESSION['status_interviewer']; ?>',
                        })
                    </script>
                <?php
                    unset($_SESSION['status_interviewer']);
                }
                ?>
                    <h1 class="my-3 text-payreto-darkblue fw-bold">List of Interviewers</h1>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-payreto-darkblue-900 my-4" data-bs-toggle="modal" data-bs-target="#addInterviewer">Add Interviewer</button>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body table-responsive">
                            <table id="tableTemplate" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Interviewer</th>
                                        <th>Email</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $interviewer_db = find_interviewer();
                                    foreach ($interviewer_db as $interviewer) :
                                ?>
                                    <tr>
                                        <td><?php echo $interviewer['i_cid']; ?></td>
                                        <td><?php echo $interviewer['i_name']; ?></td>
                                        <td><?php echo $interviewer['i_eaddr']; ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-success btn-sm rounded-3 mx-1 editInterviewerButton" type="button" data-bs-toggle="modal" data-bs-target="#editInterviewer" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm rounded-3 mx-1 deleteInterviewerButton" type="button" data-bs-toggle="modal" data-bs-target="#deleteInterviewer" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
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
    $(document).on("click", ".editInterviewerButton", function() {
        $('#editInterviewer').modal('show');

        $tr = $(this).closest('tr');

        var editInterviewer = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(editInterviewer);

        $('#edit_interviewer_id').val(editInterviewer[0]);
        $('#edit_interviewer_name').val(editInterviewer[1]);
        $('#edit_interviewer_email').val(editInterviewer[2]);
    });

    $(document).on("click", ".deleteInterviewerButton", function() {
        $('#deleteInterviewer').modal('show');

        $tr = $(this).closest('tr');

        var deleteInterviewer = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(deleteInterviewer);

        $('#delete_interviewer_id').val(deleteInterviewer[0]);
    });
</script>

<?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
?>