<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Candidates | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {

        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
        include '../functions/logger.php';
        ?>
</head>

<body class="sb-nav-fixed">
    <?php if ($_SESSION['login_level'] == 0) {
        include '../layouts/navigation-bar_admin.php';
    } elseif ($_SESSION['login_level'] == 1) {
        include '../layouts/navigation-bar.php';
    } ?>
    <div id="layoutSidenav">
        <?php if ($_SESSION['login_level'] == 0) {
            include '../layouts/sidebar-admin.php';
        } elseif ($_SESSION['login_level'] == 1) {
            include '../layouts/sidebar.php';
        } ?>
        <div id="layoutSidenav_content">
            <!-- CONTENT HERE -->
            <main>
                <section class="container-fluid px-4">
                    <!-- Data Verification -->
                    <?php if (isset($_SESSION['status_listOfCandidates'])) {
                        if(isset($_SESSION['status_code']) == 'success'){
                            include '../functions/logger.php';
                            $sql_add  = "INSERT INTO audit_log (a_id, u_id, remote_ip, location, action, date)";
                            $sql_add .= " VALUES ('{default}', '{$user_id}', '{$remote_ip}', '{$location}', 'Add Candidate', '{$date}')";
                
                            $result_add = mysqli_query($conn, $sql_add);
                        }
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
                                title: '<?php echo $_SESSION['status_listOfCandidates']; ?>',
                            })
                        </script>
                    <?php unset($_SESSION['status_listOfCandidates']);} ?>
                    <h1 class="my-3 text-payreto-darkblue fw-bold">List of Candidates</h1>
                    <div class="d-flex justify-content-end">
                        <div class="my-3 me-3 col-sm-3">
                            <select class="form-select input-sm" id="phase_pos" aria-label="Default select example">
                                <option selected value="">-- Phase Filter --</option>
                                <option value="Preliminary">Preliminary</option>
                                <option value="Initial">Initial</option>
                                <option value="Operation Team Lead">Operation - Team Lead</option>
                                <option value="Exam">Exam</option>
                                <option value="Operation Manager">Operation - Manager</option>
                                <option value="Department Head">Department Head</option>
                                <option value="Client">Client</option>
                                <option value="Management">Management</option>
                            </select>
                        </div>
                        <button id="btn" type="button" class="btn btn-payreto-darkblue-900 text-white my-3" data-bs-toggle="modal" data-bs-target="#addCandidate">Add Candidate</button>
                    </div>

                        <div class="card shadow mb-4">
                            <div class="card-body table-responsive">
                                <table id="tableTemplate1" class="table">
                                    
                                    <thead>
                                        <!-- Test Filter dropdown -->
                                    <!-- <div class="pb-3 col-3">
                                        <select class="form-select input-sm" id="phase_pos" aria-label="Default select example">
                                            <option selected value="">-- Phase Filter --</option>
                                            <option value="Preliminary">Preliminary</option>
                                            <option value="Initial">Initial</option>
                                            <option value="Operation Team Lead">Operation - Team Lead</option>
                                            <option value="Operation Manager">Operation - Manager</option>
                                            <option value="Department Head">Department Head</option>
                                            <option value="Client">Client</option>
                                            <option value="Management">Management</option>
                                        </select>
                                    </div> -->
                                    <!-- Test Filter dropdown End -->
                                        <tr class="text-center">
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Score Candidate</th>
                                            <th class="text-center">Active/Passive</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Position</th>
                                            <th class="text-center">Phase</th>
                                            <th style="width: 0; height: 0; visibility: hidden; opacity: 0;">
                                                <span class="d-none">
                                                    ID
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                        $candidate_db = find_candidates();
                                        foreach ($candidate_db as $candidate): 
                                            if($candidate['reprofile'] == 1): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $candidate['c_cid']; ?>
                                                </td>
                                                <td>
                                                    <p class="text-center m-0">
                                                    <?php 
                                                    $id = $candidate['c_id'];
                                                    $status_db = find_status($id); 
                                                    foreach($status_db as $status) :
                                                        if($status['c_job'] == 0){
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-reprofiled\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>Job Offered</span>";
                                                            break;
                                                        }
                                                        else if($status['c_job'] == 1){
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-passed\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>Job Offer Accepted</span>";
                                                            break;
                                                        }
                                                        else if($status['c_job'] == 2){
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-failed\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>Job Offer Declined</span>";
                                                            break;
                                                        }
                                                        else if($status['greatest'] == $status['c_padate']){
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-passed\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>Passed</span>";
                                                            break;
                                                        }else if($status['greatest'] == $status['c_fdate']){
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-failed\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>Failed</span>";
                                                            break;
                                                        }else if($status['greatest'] == $status['c_podate']){
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-for-pooling\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>For Pooling</span>";
                                                            break;
                                                        }else if($status['greatest'] == $status['c_udate']){
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-withdrawn\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>Unresponsive</span>";
                                                            break;
                                                        }else if($status['greatest'] == $status['c_wdate']){
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-withdrawn\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>Withdrawn</span>";
                                                            break;
                                                        }else{
                                                            echo "<span class=\"d-flex flex-column\"><a class=\"text-payreto-withdrawn\" href=\"viewCandidates.php?id=".$candidate['c_id']."\">";
                                                            echo "<i class=\"fa-solid fa-square fa-3x\"></i>";
                                                            echo "</a>Pending</span>";
                                                            break;
                                                        } // add Color for Pending, code Reprofile
                                                    endforeach; ?>
                                                </td>
                                                <td>
                                                    <a class="fw-bold text-payreto-darkblue-900 viewCandidateButton" href='viewCandidates.php?id=<?php echo $candidate['c_id']; ?>'><?php echo $candidate['c_name']; ?></a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-payreto-darkblue-900 text-white text-center scoreCandidateButton" data-bs-toggle="modal" data-bs-target="#scoreCandidate">Score Candidate</button>
                                                </td>
                                                <td>
                                                    <?php echo $candidate['c_actpas'] == 'Active'? 'Active': 'Passive'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $candidate['d_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $candidate['p_name']; ?>
                                                </td>
                                                <td>
                                                <?php 
                                                    $id = $candidate['c_id'];
                                                    $phase_db = find_phase($id);
                                                    foreach($phase_db as $phase){
                                                        if($candidate['c_id'] == $phase['c_id']){
                                                            // var_dump($phase);
                                                            if($phase['phase'] == '7'){
                                                                echo "Management";
                                                                break;
                                                            }else if($phase['phase'] == '6'){
                                                                echo "Client";
                                                                break;
                                                            }else if($phase['phase'] == '5'){
                                                                echo "Department Head";
                                                                break;
                                                            }else if($phase['phase'] == '4'){
                                                                echo "Operation Manager";
                                                                break;
                                                            }else if($phase['phase'] == '3'){
                                                                echo "Exam";
                                                                break;
                                                            }else if($phase['phase'] == '2'){
                                                                echo "Operation Team Lead";
                                                                break;
                                                            }else if($phase['phase'] == '1'){
                                                                echo "Initial";
                                                                break;
                                                            }
                                                        } else {
                                                            echo "Preliminary";
                                                        }
                                                    }?>
                                                </td>
                                                <td class="d-none m-0 p-0">
                                                    <span class="d-none">
                                                        <?php echo $candidate['c_id']; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php endif; endforeach;?>
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

<!-- MODALS -->
<!-- Add Candidate Modal -->
<div>
    <?php include 'addCandidateModal.php'; ?>
</div>
<!-- Add Candidate Modal End -->
<!-- Score Candidate Modal -->
<div>
    <?php include 'scoreCandidateModal.php'; ?>
</div>
<!-- Score Candidate Modal End -->
<!-- MODALS END -->

<script>
    $(document).on("click", ".scoreCandidateButton", function() {
        $('#scoreCandidate').modal('show');

        $tr = $(this).closest('tr');

        var scoreCandidate = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(scoreCandidate);

        $('#id_score').val(scoreCandidate[8].trim());
    });
</script>

<?php
    } else {
        include '../functions/logout.php';

        header('location: ../functions/logout.php');
    }
?>
