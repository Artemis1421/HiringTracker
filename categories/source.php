<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sources | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {
        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
    ?>
</head>

<!-- MODALS -->

<!-- Add Source -->
<div><?php include 'addSourceModal.php'; ?></div>
<!-- End Add Source -->

<!-- Edit Source -->
<div><?php include 'editSourceModal.php'; ?></div>
<!-- End Edit Source -->

<!-- Delete Source -->
<div><?php include 'deleteSourceModal.php'; ?></div>
<!-- End Delete Source -->
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
                if (isset($_SESSION['status_source'])) {
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
                            title: '<?php echo $_SESSION['status_source']; ?>',
                        })
                    </script>
                <?php
                    unset($_SESSION['status_source']);
                }
                ?>
                    <h1 class="my-3 text-payreto-darkblue fw-bold">List of Sources</h1>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-payreto-darkblue-900 my-4" data-bs-toggle="modal" data-bs-target="#addSource">Add Source</button>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body table-responsive">
                            <table id="tableTemplate" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Source</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $source_db = find_source();
                                    foreach ($source_db as $source) :
                                ?>
                                    <tr>
                                        <td><?php echo $source['s_cid']; ?></td>
                                        <td><?php echo $source['s_name']; ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-success btn-sm rounded-3 mx-1 editSourceButton" type="button" data-bs-toggle="modal" data-bs-target="#editSource" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm rounded-3 mx-1 deleteSourceButton" type="button" data-bs-toggle="modal" data-bs-target="#deleteSource" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
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
    $(document).on("click", ".editSourceButton", function() {
        $('#editSource').modal('show');

        $tr = $(this).closest('tr');

        var editSource = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(editSource);

        $('#edit_source_id').val(editSource[0]);
        $('#edit_source_name').val(editSource[1]);
    });

    $(document).on("click", ".deleteSourceButton", function() {
        $('#deleteSource').modal('show');

        $tr = $(this).closest('tr');

        var deleteSource = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(deleteSource);

        $('#delete_source_id').val(deleteSource[0]);
    });
</script>

<?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
?>