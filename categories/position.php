<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Positions | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {
        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
    ?>
</head>

<!-- MODALS -->

<!-- Add Position -->
<div><?php include 'addPositionModal.php'; ?></div>
<!-- End Add Position -->

<!-- Edit Position -->
<div><?php include 'editPositionModal.php'; ?></div>
<!-- End Edit Position -->

<!-- Delete Position -->
<div><?php include 'deletePositionModal.php'; ?></div>
<!-- End Delete Position -->
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
                if (isset($_SESSION['status_position'])) {
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
                            title: '<?php echo $_SESSION['status_position']; ?>',
                        })
                    </script>
                <?php
                    unset($_SESSION['status_position']);
                }
                ?>
                    <h1 class="my-3 text-payreto-darkblue fw-bold">List of Positions</h1>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-payreto-darkblue-900 my-4" data-bs-toggle="modal" data-bs-target="#addPosition">Add Position</button>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body table-responsive">
                            <table id="tableTemplate" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Department</th>
                                        <th>Team</th>
                                        <th>Position</th>
                                        <th>Requisition Type</th>
                                        <th>Requisition Count</th>
                                        <th style="display:none">Dep ID</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $position_db = find_position();
                                    foreach ($position_db as $position) :
                                ?>
                                    <tr>
                                        <td><?php echo $position['p_cid']; ?></td>
                                        <td><?php echo $position['d_name']; ?></td>
                                        <td><?php echo $position['d_team']; ?></td>
                                        <td><?php echo $position['p_name'];?></td>
                                        <td><?php echo $position['p_req'];?></td>
                                        <td><?php echo $position['p_count'];?></td>
                                        <td style="display:none"><?php echo $position['d_id'] ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-success btn-sm rounded-3 mx-1 editPositionButton" type="button" data-bs-toggle="modal" data-bs-target="#editPosition" data-toggle="tooltip" data-placement="top" title="Edit"<?php if($position["p_closed"] == 1){echo "disabled";}?>><i class="fa fa-edit" ></i></button>
                                                <button class="btn btn-danger btn-sm rounded-3 mx-1 deletePositionButton" type="button" data-bs-toggle="modal" data-bs-target="#deletePosition" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
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
    $(document).on("click", ".editPositionButton", function() {
        $('#editPosition').modal('show');

        $tr = $(this).closest('tr');

        var editPosition = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(editPosition);

        $('#edit_position_id').val(editPosition[0]);
        $('#edit_position_name').val(editPosition[3]);
        $('#edit_position_type').val(editPosition[4]);
        $('#edit_position_count').val(editPosition[5]);
        $('#edit_position_department').val(editPosition[6]);
    });

    $(document).on("click", ".deletePositionButton", function() {
        $('#deletePosition').modal('show');

        $tr = $(this).closest('tr');

        var deletePosition = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(deletePosition);

        $('#delete_position_id').val(deletePosition[0]);
    });
</script>

<?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
?>