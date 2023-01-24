<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Feedback Approval | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {
        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
    ?>
</head>

<!-- MODALS -->
<!-- Edit Approval -->
<div><?php include 'successApprovalModal.php'; ?></div>
<!-- End Edit Approval -->

<!-- Delete Approval -->
<div><?php include 'deleteApprovalModal.php'; ?></div>
<!-- End Delete Approval -->
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
                if (isset($_SESSION['status_approval'])) {
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
                            title: '<?php echo $_SESSION['status_approval']; ?>',
                        })
                    </script>
                <?php
                    unset($_SESSION['status_approval']);
                }
                ?>
                    <h1 class="my-3 text-payreto-darkblue fw-bold">Interview Feedback Approval</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body table-responsive">
                            <table id="tableTemplate" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Candidate Name</th>
                                        <th>Interviewer Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Phase</th>
                                        <th>Total Score</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>                          
                                <tbody>
                                <?php 
                                    $find_approval_db = find_approval();
                                    foreach ($find_approval_db as $approval) :
                                ?>      
                                    <tr>
                                        <td><?php echo $approval['iff_int_id']; ?></td>
                                        <td><?php echo $approval['c_name']; ?></td>
                                        <td><?php echo $approval['i_name']; ?></td>
                                        <td><?php echo $approval['iff_date']; ?></td>
                                        <?php
                                            if($approval['iff_status'] == "Passed"){
                                        ?>
                                            <td class="status-payreto-green fw-bold"><?php echo $approval['iff_status']; ?></td>
                                        <?php   
                                            } elseif($approval['iff_status'] == "Failed") {
                                        ?>  
                                            <td class="status-payreto-red fw-bold"><?php echo $approval['iff_status']; ?></td>
                                        <?php       
                                            } elseif($approval['iff_status'] == "For Pooling") {
                                        ?>  
                                            <td class="status-payreto-bluegreen fw-bold"><?php echo $approval['iff_status']; ?></td>
                                        <?php  
                                            } elseif($approval['iff_status'] == "For Discussion") {
                                        ?>  
                                                <td class="status-payreto-yellow fw-bold"><?php echo $approval['iff_status']; ?></td>
                                        <?php  
                                            }
                                        ?>                                        
                                        <td>
                                            <?php 
                                                if($approval['iff_phase'] == "1") {
                                                    echo "Initial";
                                                } elseif ($approval['iff_phase'] == "2"){
                                                    echo "Operation Team Lead";
                                                } elseif ($approval['iff_phase'] == "3"){
                                                    echo "Exam";
                                                } elseif ($approval['iff_phase'] == "4"){
                                                    echo "Operation Manager";
                                                } elseif ($approval['iff_phase'] == "5"){
                                                    echo "Department Head";
                                                } elseif ($approval['iff_phase'] == "6"){
                                                    echo "Client";
                                                } elseif ($approval['iff_phase'] == "7"){
                                                    echo "Management";
                                                } 
                                            ?>
                                        </td>
                                        <td><?php echo $approval['iff_total']; ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-success btn-sm rounded-3 mx-1 approveIFFButton" type="button" data-bs-toggle="modal" data-bs-target="#successApproval" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-check"></i></button>
                                                <button class="btn btn-danger btn-sm rounded-3 mx-1 declineIFFButton" type="button" data-bs-toggle="modal" data-bs-target="#deleteApproval" data-toggle="tooltip" data-placement="top" title="Decline"><i class="fa fa-close"></i></button>
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

<?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
?>

<script>
    $(document).on("click", ".approveIFFButton", function() {
        $tr = $(this).closest('tr');

        var approveIFF = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(approveIFF);

        $('#approve_iff_id').val(approveIFF[0]);
    });

    $(document).on("click", ".declineIFFButton", function() {
        $tr = $(this).closest('tr');

        var declineIFF = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(declineIFF);

        $('#decline_iff_id').val(declineIFF[0]);
    });
</script>