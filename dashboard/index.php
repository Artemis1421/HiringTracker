<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {

        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
        include '../functions/logger.php';

        date_default_timezone_set('Asia/Manila');
        $date = date('m/d/Y', strtotime($date));
        $year = date('Y', strtotime($date));
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
                <?php

                $target_hires = 0;
                $intern_req = 0;
                $employee_req = 0;
                $candidate_num = 0;

                $position_db = find_position();
                $position_num = count($position_db);
                foreach ($position_db as $position){
                    $target_hires += $position['p_count'];
                    if($position['p_req'] == "Intern"){
                        $intern_req += 1;
                    }else if($position['p_req'] == "Employee"){
                        $employee_req += 1;
                    }
                }

                $candidate_year = find_candidates_year();
                // var_dump($candidate_year);
                foreach ($candidate_year as $candidate){
                    // var_dump($candidate);
                    // var_dump($year);

                    if($candidate["YEAR(c_appli)"] == $year){
                        $candidate_num += 1;
                    }
                }

            ?>
                <section class="container-fluid px-4">
                    <h1 class="my-3 text-payreto-darkblue fw-bold">Dashboard</h1>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="card shadow bg-payreto-darkblue">
                                <div class="card-body m-0 p-0">
                                    <h3 class="my-3 text-center text-white fw-bold">As of <?php echo $date; ?></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 py-2 text-center">
                                    <div class="card bg-payreto-yellow primary mb-3 h-100">
                                        <div class="card-header fw-bold text-white bg-payreto-darkblue">Open
                                            Requisitions</div>
                                        <div class="card-body">
                                            <h2 class="card-title text-dark fw-bold"><?php echo $position_num?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 py-2 text-center">
                                    <div class="card bg-payreto-yellow primary mb-3 h-100">
                                        <div class="card-header fw-bold text-white bg-payreto-darkblue">Target Hires
                                        </div>
                                        <div class="card-body">
                                            <h2 class="card-title text-dark fw-bold"><?php echo $target_hires?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 py-2 text-center">
                                    <div class="card bg-payreto-yellow primary mb-3 h-100">
                                        <div class="card-header fw-bold text-white bg-payreto-darkblue">Active Employee
                                            Requisition</div>
                                        <div class="card-body">
                                            <h2 class="card-title text-dark fw-bold"><?php echo $employee_req?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 py-2 text-center">
                                    <div class="card bg-payreto-yellow primary mb-3 h-100">
                                        <div class="card-header fw-bold text-white bg-payreto-darkblue">Active Intern
                                            Requisition</div>
                                        <div class="card-body">
                                            <h2 class="card-title text-dark fw-bold"><?php echo $intern_req?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card shadow bg-payreto-darkblue mt-5 mt-md-0">
                                <div class="card-body m-0 p-0">
                                    <h3 class="my-3 text-center text-white fw-bold">As of <?php echo $year; ?></h3>
                                </div>
                            </div>
                            <div class="row">
                                <?php 
                                    
                                    $tth_val = find_tth_value();
                                    // var_dump($tth_val);
                                    
                                    foreach($tth_val as $tth):
                                    if($_SESSION["login_level"] == 0): ?>
                                <div class="col-12 col-md-6 py-2 text-center">
                                    <div class="card bg-payreto-yellow primary mb-3 h-100">
                                        <div class="card-header fw-bold text-white bg-payreto-darkblue">Total Target
                                            Hires</div>
                                        <div class="card-body">
                                            <h2 class="card-title text-dark fw-bold"><?php echo $tth["dash_value"]?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <?php else:?>
                                <form action="dashboard_validation.php" method="post">
                                    <div class="row">
                                        <div class="col-12 col-md-6 py-2 text-center">
                                            <div class="card bg-payreto-yellow primary mb-3 h-100">
                                                <div class="card-header fw-bold text-white bg-payreto-darkblue">Total
                                                    Target Hires</div>
                                                <div class="card-body p-0">
                                                    <input type="number"
                                                        class="form-control bg-payreto-yellow border-0 p-0 m-0 card-title text-dark fw-bold text-center fs-3"
                                                        name="tthValue" placeholder="<?php echo $tth["dash_value"]?>">
                                                    </h2>
                                                </div>
                                                <button class="btn-payreto-darkblue-900 m-0 p-0"
                                                    name="tthSaveButton">Save</button>
                                            </div>
                                        </div>
                                        <?php endif; endforeach;?>
                                        <div class="col-12 col-md-6 py-2 text-center">
                                            <div class="card bg-payreto-yellow primary mb-3 h-100">
                                                <div class="card-header fw-bold text-white bg-payreto-darkblue">Total
                                                    Candidates</div>
                                                <div class="card-body">
                                                    <h2 class="card-title text-dark fw-bold">
                                                        <?php echo $candidate_num ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                            $position_value = find_pos_value($year);
                                            // var_dump($position_value);
                                            foreach ($position_value as $position):
                                            ?>
                                        <div class="col-12 col-md-6 py-2 text-center">
                                            <div class="card bg-payreto-yellow primary mb-3 h-100">
                                                <div class="card-header fw-bold text-white bg-payreto-darkblue">Total
                                                    Hired</div>
                                                <div class="card-body">
                                                    <h2 class="card-title text-dark fw-bold">
                                                        <?php echo $position["SUM(p_hired)"]?></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 py-2 text-center">
                                            <div class="card bg-payreto-yellow primary mb-3 h-100">
                                                <div class="card-header fw-bold text-white bg-payreto-darkblue">Total
                                                    Closed Requisitions</div>
                                                <div class="card-body">
                                                    <h2 class="card-title text-dark fw-bold">
                                                        <?php echo $position["SUM(p_closed)"]?></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>

                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>
                </section>

                <!-- Active Requisition Section -->
                <section class="container-fluid px-4 mt-4">
                    <h1 class="my-3 text-payreto-darkblue fw-bold">Active Requisition</h1>
                    <div class="d-flex justify-content-end my-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <?php 
                        $find_dept = find_dash_dept();
                        $find_pos = find_dash_pos();
                        ?>
                            <select class="form-select mx-2" name="" id="dash_dept">
                                <option value="" selected>-- Filter Department --</option>
                                <?php for($i = 0; $i < count($find_dept); $i++): ?>
                                <option value="<?php echo $find_dept[$i][0]; ?>"><?php echo $find_dept[$i][1]; ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                            <select class="form-select mx-2" name="" id="dash_pos">
                            <option selected value="">-- Filter Team --</option>
                                <?php for($i =0; $i < count($find_pos); $i++): ?>
                                    <option value="<?php echo $find_pos[$i][1]; ?>"><?php echo $find_pos[$i][1]; ?></option>
                                <?php endfor; ?>
                            </select>
                            <select class="form-select mx-2" name="" id="dash_type">
                            <option selected value="">-- Filter Type --</option>
                                <option value="Employee">Employee</option>
                                <option value="Intern">Intern</option>
                            </select>
                        </div>
                        <!-- <button type="submit" id="" name=""
                            class="mx-2 btn btn-payreto-darkblue-900 text-white my-2 my-sm-0">Search</button> -->
                    </div>
                    <div class="row">
                        <div class="card shadow mb-4">
                            <div class="card-body table-responsive">
                                <table id="tableDashboard" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="display: none;">Department</th>
                                            <th>Active Requisition</th>
                                            <th>Requisition Start Date</th>
                                            <th>Requisition Type</th>
                                            <th class="text-center">Target Hires</th>
                                            <th class="text-center">Applicant Processed</th>
                                            <th class="text-center">Hired (Count)</th>
                                            <th class="text-center">Remaining Positions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $position_db = find_position_cand();
                                        foreach( $position_db as $position):
                                        
                                        ?>
                                        <tr>
                                            <td style="display: none;"><?php echo $position['d_id']; ?></td>
                                            <td><?php echo $position['p_name']?></td>
                                            <td><?php echo date('m/d/y',strtotime($position['date']))?></td>
                                            <td><?php echo $position['p_req']; ?></td>
                                            <td class="text-center"><?php echo $position['p_count']?></td>
                                            <td class="text-center">
                                                <?php echo $position['id']; //var_dump($position); ?></td>
                                            <td class="text-center"><?php echo $position['p_hired']?></td>
                                            <td class="text-center">
                                                <?php echo $position['p_count'] - $position['p_hired']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Active Requisition Section End -->
            </main>
            <div><?php include '../layouts/footer.php'; ?></div>
        </div>
    </div>
</body>

</html>

<?php
    } else {
        include '../functions/logout.php';

        header('location: ../functions/logout.php');
    }


?>