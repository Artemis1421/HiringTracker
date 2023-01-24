<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Report | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    if ($_SESSION['login_status'] == 1) {
        include '../functions/conn.php';
        include '../functions/functions.php';
        include '../layouts/header.php';
        include '../functions/logger.php';
    ?>
</head>

<!-- MODALS -->

<!-- MODALS END -->

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
                <!-- Statistics Section -->
                <section class="container-fluid px-4 mt-4">
                    <h1 class="my-3 text-payreto-darkblue fw-bold">Statistics</h1>
                    <div class="row">
                        <div class="card shadow h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <!-- <div>
                                        <h3 class="my-3 text-payreto-darkblue fw-bold">All/Position</h3>
                                    </div> -->
                                    <div class="d-flex align-items-center">
                                        <!-- Form for dropdown pos -->
                                        <form class="row row-cols-lg-auto mb-3" method="post"
                                            action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <table class="text-nowrap">
                                            <tr>
                                                    <td>
                                            <div class="me-1">
                                                
                                                <select class="form-select DeptName" aria-label="Default select example"
                                                    name="DeptName" id="DeptName">
                                                    <option selected value="0">-- Select Department --</option>
                                                    <?php
                                                    $listDept = weekly_list_dept();
                                                    foreach($listDept as $keys) :
                                                ?>
                                                    <option value="<?php echo $keys['d_id']; ?>">
                                                        <?php echo $keys['d_name'].' - '.$keys['d_team']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                    
                                            </div>
                                            </td>
                                            <td>
                                            <div class="me-1">
                                                
                                                <select class="form-select PosName" aria-label="Default select example"
                                                    name="PosName" id="PosName">
                                                    <option selected value="0">-- Select Position --</option>
                                                    <?php 
                                                    $listPos = weekly_list_pos();
                                                    foreach($listPos as $keyss) :
                                                ?>
                                                    <option data-parent="<?php echo $keyss['d_id']; ?>"
                                                        value="<?php echo $keyss['p_id']; ?>">
                                                        <?php echo $keyss['p_cid'].' - '.$keyss['p_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                    
                                            </div>
                                            </td>
                                            <td>
                                            <div class="me-1">
                                                
                                                <select class="form-select" name="filter_date">
                                                    <option value="0" selected>-- Select Year --</option>
                                                    <?php foreach(find_year() as $year):?>
                                                    <option value="<?php echo $year["year"] ?>">
                                                        <?php echo $year["year"] ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                                    
                                            </div>
                                            </td>
                                            <td>
                                            <div class="me-3">
                                                
                                                <button type="submit" class="btn btn-payreto-darkblue-900 text-white"
                                                    name="FilterButtons">Search</button>
                                                    
                                            </div>
                                            </td>
                                                    </tr>
                                            </table>
                                        </form>
                                        <script>
                                        $(document).on('change', '.DeptName', function() {
                                            var parent = $(this).val();
                                            $(this).closest('tr').find('.PosName').children().each(function() {
                                                if ($(this).data('parent') != parent) {
                                                    $(this).hide();
                                                } else
                                                    $(this).show();
                                            });
                                        });
                                        </script>
                                    </div>
                                </div>
                                <?php 
                                // Add filter for pos
                                $x = 0;
                                $y = 0;
                                $filterDate = 0;
                                if(isset($_POST["FilterButtons"])){
                                    if(!empty($_POST['DeptName']) && !empty($_POST['PosName']) && !empty($_POST['filter_date'])){
                                        $x = $_POST['DeptName'];
                                        $y = $_POST['PosName'];
                                        $filterDate = $_POST['filter_date'];
                                    }
                                    // else if(!empty($_POST['DeptName']) && empty($_POST['PostName'])){
                                    //     $x = $_POST['DeptName'];
                                    // }
                                    // else if(empty($_POST['DeptName']) && !empty($_POST['PostName'])){
                                    //     $y = $_POST['PosName'];
                                    // }
                                    else {
                                        $x = $_POST['DeptName'];
                                        $y = $_POST['PosName'];
                                        $filterDate = $_POST['filter_date'];
                                    }
                                }
                                ?>
                                <div class="row">
                                    <!-- Number of Applicants -->
                                    <div class="col-md-6 py-2">
                                        <div class="card bg-payreto-darkblue text-white mb-4 rounded h-100">
                                            <div
                                                class="row d-flex justify-content-center align-items-center align-content-center">
                                                <div class="col">
                                                    <div class="card-body d-flex justify-content-center">
                                                        Number of Applicants
                                                    </div>
                                                    <div
                                                        class="display-1 fst-italic fw-bold d-flex justify-content-center weekly_4_table">
                                                        <!-- 99 -->
                                                        <?php echo numApp($x, $y, $filterDate); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Number of Applicants End -->
                                    <!-- Average Behavioral Profile -->
                                    <div class="col-md-6 py-2">
                                        <div class="card bg-payreto-darkblue text-white mb-4 rounded h-100">
                                            <div
                                                class="row d-flex justify-content-center align-items-center align-content-center">
                                                <div class="col">
                                                    <div class="card-body d-flex justify-content-center">
                                                        Average Behavioral Profile
                                                    </div>
                                                    <div
                                                        class="display-1 fst-italic fw-bold d-flex justify-content-center weekly_4_table">
                                                        <!-- 99 -->
                                                        <?php print_r(avg_beh_prof($x,$y,$filterDate)); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Average Behavioral Profile End -->
                                    <!-- Average Cognitive Score -->
                                    <div class="col-md-6 py-2">
                                        <div class="card bg-payreto-darkblue text-white mb-4 rounded h-100">
                                            <div
                                                class="row d-flex justify-content-center align-items-center align-content-center">
                                                <div class="col">
                                                    <div class="card-body d-flex justify-content-center">
                                                        Average Cognitive Score
                                                    </div>
                                                    <div
                                                        class="display-1 fst-italic fw-bold d-flex justify-content-center weekly_4_table">
                                                        <!-- 99 -->
                                                        <?php echo avg_cog($x,$y, $filterDate); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Average Cognitive Score End -->
                                    <!-- Average Behavioral Category -->
                                    <div class="col-md-6 py-2">
                                        <div class="card bg-payreto-darkblue text-white mb-4 rounded h-100">
                                            <div
                                                class="row d-flex justify-content-center align-items-center align-content-center">
                                                <div class="col">
                                                    <div class="card-body d-flex justify-content-center">
                                                        Average Behavioral Category
                                                    </div>
                                                    <div
                                                        class="display-2 fst-italic fw-bold d-flex justify-content-center weekly_4_table">
                                                        <!-- 99 -->
                                                        <?php print_r(avg_beh_cat($x, $y,$filterDate)); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Average Behavioral Category End -->
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4 card-body">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Popularity per
                                            Platform
                                            <?php $weeklyPlatform = weeklyChart($x,$y,$filterDate);
                                                // $arr_listname = array();
                                                // $arr_listcoun = array();
                                                // foreach($test_1 as $test_2):
                                                //     array_push($arr_listname, $test_2['platname']);
                                                //     array_push($arr_listcoun, $test_2['plat2']);
                                                // endforeach;
                                                
                                            ?>
                                        </h6>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                    <div class="col-12 col-md-4 card-body">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Application Stage
                                            <?php
                                                $appStages = appStage($x,$y,$filterDate);
                                                $arr_listname1 = array();
                                                $arr_listcoun1 = array();
                                                foreach($appStages as $test_2):
                                                    if($test_2['name1'] == 1)
                                                        array_push($arr_listname1, 'Initial');
                                                    if($test_2['name1'] == 2)
                                                        array_push($arr_listname1, 'Operation - Team Lead');
                                                    if($test_2['name1'] == 3)
                                                        array_push($arr_listname1, 'Operation - Manager');
                                                    if($test_2['name1'] == 4)
                                                        array_push($arr_listname1, 'Department Head');
                                                    if($test_2['name1'] == 5)
                                                        array_push($arr_listname1, 'Client');
                                                    if($test_2['name1'] == 6)
                                                        array_push($arr_listname1, 'Management');
                                                    array_push($arr_listcoun1, $test_2['count_status']);
                                                endforeach;
                                                
                                                
                                            ?>
                                        </h6>
                                        <canvas id="myChart2"></canvas>
                                    </div>
                                    <div class="col-12 col-md-4 card-body">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Application Status
                                            <?php 
                                            $appStats = appStatus($x,$y,$filterDate);
                                            ?>
                                        </h6>
                                        <canvas id="myChart3"></canvas>
                                    </div>
                                    <div class="col-12 col-md-4 card-body">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Dominant Personality
                                            Profile
                                            <?php
                                            $domChart = domChart($x,$y,$filterDate);
                                            ?>
                                        </h6>
                                        <canvas id="myChart4"></canvas>
                                    </div>
                                    <div class="col-12 col-md-4 card-body">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Average Total Score
                                            <?php
                                            $top_five = find_top5_chart($x,$y,$filterDate);
                                            ?>
                                        </h6>
                                        <canvas id="myChart5"></canvas>
                                    </div>
                                    <div class="col-12 col-md-4 card-body">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Ratio of Decisions
                                            <?php
                                                $finalChart = finalChart($x,$y,$filterDate);
                                               
                                            ?>
                                        </h6>

                                        <canvas id="myChart6"></canvas>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Weekly Report Section-->
                <section class="container-fluid px-4 mt-4">
                    <h1 class="my-3 text-payreto-darkblue fw-bold">Weekly Report</h1>
                    <div class="card shadow h-100" id="weeklyReport">
                        <div class="card-body">
                            <!-- For dropdown list (Week and Department & Team selection) -->
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="d-flex justify-content-end flex-wrap">
                                    <div class="d-flex align-items-center">
                                        <?php 
                                                date_default_timezone_set("Asia/Manila");
                                                $date = date('Y-m-d H:i:s');
                                               

                                                $date = new DateTime($date);
                                                $week = $date->format("W")+0;
                                                // echo $week;
                                            ?>

                                        <!-- Dropdown list for week and year selection -->
                                        <div class="me-3">
                                            <select class="form-select" aria-label="Default select example" id="y_no" name='y_no'
                                                required>
                                                <option selected value="0">-- Select Year --</option>
                                                <?php foreach(find_year() as $year):?>
                                                <option value="<?php echo $year["year"] ?>">Year Active
                                                    <?php echo $year["year"] ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="me-3">
                                            <select class="form-select" aria-label="Default select example" id="w_no" name='w_no'
                                                required>
                                                <option selected value="0">-- Select Week # --</option>
                                                <?php 
                                                        // for($i = 1; $i <= $week; $i++) :
                                                            for($i = $week; $i >= 1; $i--) :
                                                    ?>
                                                <option value="<?php echo $i; ?>"><?php echo "Week Active # ".$i; ?>
                                                </option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <!-- Dropdown list for week selection END -->

                                        <!-- Dropdown list for department & team selection -->
                                        <div class="me-3">
                                            <select class="form-select" aria-label="Default select example" name='d_id'
                                                required>
                                                <option selected value="0">-- Select Department & Team --</option>
                                                <?php 
                                                        $department_db = find_department_position();
                                                        foreach ($department_db as $department_search):
                                                    ?>
                                                <option value="<?php echo $department_search['d_id']?>"
                                                    name="departSearch" id="departSearch">
                                                    <?php echo $department_search['d_name'].' - '.$department_search['d_team'] ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- Dropdown list for department & team selection END -->

                                        <!-- Dropdown list search button -->
                                        <div>
                                            <a href="#weeklyReport">
                                                <button type="submit"
                                                    class="btn btn-payreto-darkblue-900 text-white my-3"
                                                    name="buttonSearch">Search</button>
                                            </a>
                                        </div>
                                        <!-- Dropdown list search button END-->

                                    </div>
                                </div>
                            </form>
                            <!-- For dropdown list (Week and Department & Team selection) END -->

                            <!-- Weekly Reports Table -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <!-- Weekly Reports Table Headers -->
                                        <tr class="table-light text-center">
                                            <th></th>
                                            <th></th>
                                            <th>Initial</th>
                                            <th>Ops - TL</th>
                                            <th>Ops - Man</th>
                                            <th>Dept. Head</th>
                                            <th>Client</th>
                                            <th>Mngmt</th>
                                        </tr>
                                        <!-- Weekly Reports Table Headers END -->

                                    </thead>
                                    <!-- ======================================================================================= -->
                                    <?php if(isset($_POST["buttonSearch"])):
                                            if(!empty($_POST["d_id"]) || $_POST["d_id"] != 0){
                                                $rowValue = $_POST["d_id"];
                                            }
                                            ?>
                                    <?php endif;?>
                                    <!-- FOR START AND END OF WEEK -->
                                    <?php
                                            if(isset($_POST["buttonSearch"])){
                                                if(!empty($_POST["w_no"]) || $_POST["w_no"] != 0){
                                                    $week= $_POST["w_no"];
                                                }
                                                if(!empty($_POST["y_no"]) || $_POST["y_no"] != 0){
                                                    $year = $_POST["y_no"];
                                                    $yearint = (int)$year;
                                                }else{
                                                    $datestr = strtotime("sunday this week");
                                                    $year = date("Y", $datestr);
                                                    $yearint = (int)$year;
                                                }
                                            }
                                                $fweek = fetch_week($week, @$yearint);
                                                // debugging purposes
                                                // var_dump($fweek);
                                            ?>
                                    <!-- FOR START AND END OF WEEK END-->
                                    <tbody>
                                        <!-- Parent Foreach -->
                                        <?php
                                                $position_db = find_position();
                                                foreach ($position_db as $position):
                                            ?>
                                        <tr class="<?php if(isset($_POST["buttonSearch"])){if($rowValue!=0){if(empty($rowValue) || $rowValue != $position["d_id"]){echo "d-none";}}}?>"
                                            data-value="<?php echo $position["d_id"];?>">
                                            <th class="align-middle text-center" rowspan="6">
                                                <?php echo $position['p_name']."<br><br>"."ID: ".$position["d_cid"]?>
                                            </th>
                                        </tr>



                                        <!-- FOR PASSED====================================================================================== -->
                                        <tr id="rpa"
                                            class="<?php if(isset($_POST["buttonSearch"])){if($rowValue != 0){if($rowValue != $position["d_id"]){echo "d-none";}}}?>">
                                            <td style="font-size: 0.8rem;">Passed</td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["passed"] != NULL && $phase["MAX(i.phase)"] == 1)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach;
                                                        echo $req; 
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["passed"] != NULL && $phase["MAX(i.phase)"] == 2)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["passed"] != NULL && $phase["MAX(i.phase)"] == 3)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["passed"] != NULL && $phase["MAX(i.phase)"] == 4)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["passed"] != NULL && $phase["MAX(i.phase)"] == 5)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["passed"] != NULL && $phase["MAX(i.phase)"] == 6)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                        </tr>
                                        <!-- FOR WITHDRAWN====================================================================================== -->
                                        <tr id="rw"
                                            class="<?php if(isset($_POST["buttonSearch"])){if($rowValue != 0){if($rowValue != $position["d_id"]){echo "d-none";}}}?>">
                                            <td style="font-size: 0.8rem;">Withdrawn</td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["withdrawn"] != NULL && $phase["MAX(i.phase)"] == 1)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["withdrawn"] != NULL && $phase["MAX(i.phase)"] == 2)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["withdrawn"] != NULL && $phase["MAX(i.phase)"] == 3)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["withdrawn"] != NULL && $phase["MAX(i.phase)"] == 4)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["withdrawn"] != NULL && $phase["MAX(i.phase)"] == 5)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["withdrawn"] != NULL && $phase["MAX(i.phase)"] == 6)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                        </tr>
                                        <!-- FOR FAIL====================================================================================== -->
                                        <tr id="rf"
                                            class="<?php if(isset($_POST["buttonSearch"])){if($rowValue != 0){if($rowValue != $position["d_id"]){echo "d-none";}}}?>">
                                            <td style="font-size: 0.8rem;">Failed</td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["fail"] != NULL && $phase["MAX(i.phase)"] == 1)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["fail"] != NULL && $phase["MAX(i.phase)"] == 2)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["fail"] != NULL && $phase["MAX(i.phase)"] == 3)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["fail"] != NULL && $phase["MAX(i.phase)"] == 4)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["fail"] != NULL && $phase["MAX(i.phase)"] == 5)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["fail"] != NULL && $phase["MAX(i.phase)"] == 6)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;     
                                                    ?></td>
                                        </tr>
                                        <!-- FOR POOLING====================================================================================== -->
                                        <tr id="rpo"
                                            class="<?php if(isset($_POST["buttonSearch"])){if($rowValue != 0){if($rowValue != $position["d_id"]){echo "d-none";}}}?>">
                                            <td style="font-size: 0.8rem;">Pooling</td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["pooling"] != NULL && $phase["MAX(i.phase)"] == 1)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["pooling"] != NULL && $phase["MAX(i.phase)"] == 2)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["pooling"] != NULL && $phase["MAX(i.phase)"] == 3)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["pooling"] != NULL && $phase["MAX(i.phase)"] == 4)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["pooling"] != NULL && $phase["MAX(i.phase)"] == 5)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["pooling"] != NULL && $phase["MAX(i.phase)"] == 6)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                        </tr>
                                        <!-- FOR UNRESPONSIVE====================================================================================== -->
                                        <tr style="border-bottom: solid 1.5px black;" id="ru"
                                            class="<?php if(isset($_POST["buttonSearch"])){if($rowValue != 0){if($rowValue != $position["d_id"]){echo "d-none";}}}?>">
                                            <td style="font-size: 0.8rem;">Unresponsive</td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["unresponsive"] != NULL && $phase["MAX(i.phase)"] == 1)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["unresponsive"] != NULL && $phase["MAX(i.phase)"] == 2)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["unresponsive"] != NULL && $phase["MAX(i.phase)"] == 3)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["unresponsive"] != NULL && $phase["MAX(i.phase)"] == 4)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["unresponsive"] != NULL && $phase["MAX(i.phase)"] == 5)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                            <td class="text-center" style="font-size: 0.8rem;">
                                                <?php 
                                                        $phase_db = find_requistion_phase($position['p_id'], $fweek["week_start"], $fweek["week_end"]);
                                                        $req=0;
                                                        foreach ($phase_db as $phase) :
                                                            if($phase["unresponsive"] != NULL && $phase["MAX(i.phase)"] == 6)
                                                            {
                                                                $req++;
                                                            }
                                                        endforeach; 
                                                        echo $req;  
                                                    ?></td>
                                        </tr>
                                        <!-- Parent Foreach END -->
                                        <?php endforeach; ?>
                                    </tbody>

                                    <tfoot>
                                        <tr class="table-light text-center">
                                            <th></th>
                                            <th></th>
                                            <th>Initial</th>
                                            <th>Ops - TL</th>
                                            <th>Ops - Man</th>
                                            <th>Dept. Head</th>
                                            <th>Client</th>
                                            <th>Mngmt</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </section>
                <!-- End of Weekly Report -->

                <!-- Statistics Section End -->
            </main>
            <div><?php include '../layouts/footer.php'; ?></div>
</body>

</html>

<!-- Chart 1  -->
<script src="/HiringTracker/assets/js/weeklyChart.js"></script>
<script>
const weeklyPlatform = <?php echo json_encode($weeklyPlatform) ?>;
console.log(weeklyPlatform);
if (jQuery.isEmptyObject(weeklyPlatform)) {
    var new_elem_chart1 = document.createElement('h6');
    new_elem_chart1.className = 'text-center myChart';
    var noData_chart1 = document.querySelector('#myChart').replaceWith(new_elem_chart1);
    document.querySelector('.myChart').innerHTML = '<b>NO DATA</b>';
} else {
    const weeklyPlatform_name = dataChart(weeklyPlatform, 2)
    const weeklyPlatform_count = dataChart(weeklyPlatform, 1);
    const data = {
        labels: weeklyPlatform_name,
        datasets: [{
            label: 'Sources',
            backgroundColor: colorCoding,
            borderColor: colorCoding,
            data: weeklyPlatform_count,
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {}
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
}
</script>

<script>
// const myChart = new Chart(
//     document.getElementById('myChart'),
//     config
// );
</script>

<!-- Chart 1  End -->

<!-- Chart 2  -->
<script>
const appStage = <?php echo json_encode($arr_listname1); ?>;
const appStage1 = <?php echo json_encode($arr_listcoun1); ?>;
if (jQuery.isEmptyObject(appStage1) && jQuery.isEmptyObject(appStage)) {
    var new_elem = document.createElement('h6');
    new_elem.className = 'text-center myChart2';
    var noData = document.querySelector('#myChart2').replaceWith(new_elem);
    document.querySelector('.myChart2').innerHTML = '<b>NO DATA</b>';
} else {
    const data2 = {
        labels: appStage,
        datasets: [{
            label: 'My Second dataset',
            backgroundColor: colorCoding,
            borderColor: colorCoding,
            data: appStage1,
        }]
    };

    const config2 = {
        type: 'bar',
        data: data2,
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );
}
</script>

<script>
// const myChart2 = new Chart(
//     document.getElementById('myChart2'),
//     config2
// );
</script>

<!-- Chart 2  End -->

<!-- Chart 3  -->

<script>
const appStats = <?php echo json_encode($appStats); ?>;
if (jQuery.isEmptyObject(appStats)) {
    var new_elem = document.createElement('h6');
    new_elem.className = 'text-center myChart3';
    var noData = document.querySelector('#myChart3').replaceWith(new_elem);
    document.querySelector('.myChart3').innerHTML = '<b>NO DATA</b>';
} else {
    const appStats_name = dataChart(appStats, 2)
    const appStats_count = dataChart(appStats, 1);

    const data3 = {
        labels: appStats_name,
        datasets: [{
            label: 'My Third dataset',
            backgroundColor: colorCoding,
            borderColor: colorCoding,
            data: appStats_count,
        }]
    };

    const config3 = {
        type: 'bar',
        data: data3,
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };
    const myChart3 = new Chart(
        document.getElementById('myChart3'),
        config3
    );
}
</script>

<script>
// const myChart3 = new Chart(
//     document.getElementById('myChart3'),
//     config3
// );
</script>

<!-- Chart 3  End -->

<!-- Chart 4  -->
<script>
const domChart = <?php echo json_encode($domChart); ?>;

if (jQuery.isEmptyObject(domChart)) {
    var new_elem = document.createElement('h6');
    new_elem.className = 'text-center myChart4';
    var noData = document.querySelector('#myChart4').replaceWith(new_elem);
    document.querySelector('.myChart4').innerHTML = '<b>NO DATA</b>';
} else {
    const domChart_name = dataChart(domChart, 2)
    const domChart_count = dataChart(domChart, 1);


    const data4 = {
        labels: domChart_name,
        datasets: [{
            label: 'My Fourth dataset',
            backgroundColor: colorCoding,
            borderColor: colorCoding,
            data: domChart_count,
        }]
    };

    const config4 = {
        type: 'doughnut',
        data: data4,
        options: {}
    };
    const myChart4 = new Chart(
        document.getElementById('myChart4'),
        config4
    );
}
</script>

<script>
// const myChart4 = new Chart(
//     document.getElementById('myChart4'),
//     config4
// );
</script>

<!-- Chart 4  End -->

<!-- Chart 5  -->
<script>
const top_five_cand = <?php echo json_encode($top_five); ?>;
if (jQuery.isEmptyObject(top_five_cand)) {
    var new_elem = document.createElement('h6');
    new_elem.className = 'text-center myChart5';
    var noData = document.querySelector('#myChart5').replaceWith(new_elem);
    document.querySelector('.myChart5').innerHTML = '<b>NO DATA</b>';
} else {
    const top_five_name = dataChart(top_five_cand, 2);
    const top_five_count = dataChart(top_five_cand, 1);


    const data5 = {
        labels: top_five_name,
        datasets: [{
            label: 'Scores',
            backgroundColor: colorCoding,
            borderColor: colorCoding,
            data: top_five_count,
        }]
    };

    const config5 = {
        type: 'bar',
        data: data5,
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    };
    const myChart5 = new Chart(
        document.getElementById('myChart5'),
        config5
    );
}
</script>

<script>
// const myChart5 = new Chart(
//     document.getElementById('myChart5'),
//     config5
// );
</script>

<!-- Chart 5  End -->

<!-- Chart 6  -->
<script>
const finalChart1 = <?php echo json_encode($finalChart); ?>;
if (jQuery.isEmptyObject(finalChart1)) {
    var new_elem = document.createElement('h6');
    new_elem.className = 'text-center myChart6';
    var noData = document.querySelector('#myChart6').replaceWith(new_elem);
    document.querySelector('.myChart6').innerHTML = '<b>NO DATA</b>';
} else {
    const finalChart_name = dataChart(finalChart1, 2)
    const finalChart_count = dataChart(finalChart1, 1);
    const data6 = {
        labels: finalChart_name,
        datasets: [{
            label: 'My Sixth dataset',
            backgroundColor: colorCoding,
            borderColor: colorCoding,
            data: finalChart_count,
        }]
    };

    const config6 = {
        type: 'doughnut',
        data: data6,
        options: {

        }
    };
    const myChart6 = new Chart(
        document.getElementById('myChart6'),
        config6
    );
}
</script>

<script>
// const myChart6 = new Chart(
//     document.getElementById('myChart6'),
//     config6
// );
</script>

<!-- 
    Yearly Weeks
-->

<script>

    
    const year_no = document.querySelector('#y_no');
    // const weekly_no = document.querySelector('#w_no');
    currentDate = new Date();
    currentYear = currentDate.getFullYear();
    // console.log(currentDate.getFullYear())
    const weekly_no = $('#w_no');
    year_no.addEventListener('change', function(){
        //currentDate = new Date().getFullYear();
        
        if(year_no.value == currentYear || year_no.value == 0) {
            currentDate = new Date();
            var year = new Date(currentDate.getFullYear(), 0, 1);
            var days = Math.floor((currentDate - year) / (24 * 60 * 60 * 1000));
            var week = Math.ceil(( currentDate.getDay() + 1 + days) / 7);
            weekly_no.empty();
            for(let i = week; i >= 1; i--){
                weekly_no.append($('<option>', {
            value: i,
            text: 'Week Active # '+ i
            }));
    }
        }
        else {
            console.log(currentYear);
            weekly_no.empty();
            
            let prevYear = year_no.value;
            let d = new Date("December 31, "+prevYear);
            // console.log(d);
            var year = new Date(prevYear,0,1);
            // console.log(year);
            var days = Math.floor((d-year)/ (24*60*60*1000));
            // console.log(days);
            var week = Math.ceil((d.getDay()+1+days) / 7);
            // console.log(week);

            for(let i = 1; i <= week; i++){
                weekly_no.append($('<option>', {
                value: i,
                text: 'Week Active # '+ i
                }));
            }
        
        }
    });
    // $('#weeklyyear').empty();
    // for(let i = week; i >= 1; i--){
    //     $('#weeklyyear').append($('<option>', {
    //     value: i,
    //     text: 'My option'
    //     }));
    // }

</script>


<!-- Chart 6  End -->
<?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
?>