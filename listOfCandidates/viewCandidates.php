<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Candidates | Payreto | Hiring Tracker</title>
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
<!-- Forfeited Modal -->
<div><?php include 'forteitedModal.php'; ?></div>
<!-- End Forfeited Modal -->
<!-- Decision -->
<div><?php include 'confirmLOCDecision.php'; ?></div>
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
            <!-- Data Verification -->
            <?php
            if (isset($_SESSION['status_viewCandidates'])) {
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
                        title: '<?php echo $_SESSION['status_viewCandidates']; ?>',
                    })
                </script>
            <?php
                unset($_SESSION['status_viewCandidates']);
            }
            ?>
            <!-- CONTENT HERE -->
            <?php
            if (isset($_GET['id'])) {
                $c_id = $_GET['id'];
            }
            ?>
            <main>
                <section class="container-fluid px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="my-3 text-payreto-darkblue fw-bold">View Candidate</h1>
                        </div>
                        <div class="d-flex align-items-center">
                        <p class="fw-bold text-payreto-darkblue-900 text-center m-0">Interview Phase</p>
                            <div class="mx-2">
                                <select class="form-select" aria-label="Default select example" id="traitd" name="">
                                    <option selected>-- Select Phase --</option>
                                    <option value="1">Initial</option>
                                    <option value="2">Operation-Team Lead</option>
                                    <option value="3">Exam</option>
                                    <option value="4">Operation-Manager</option>
                                    <option value="5">Department Head</option>
                                    <option value="6">Client</option>
                                    <option value="7">Management</option>
                                </select>
                            </div>
                            <button id="btn" type="btn" class="btn btn-payreto-darkblue-900 text-white my-3 me-2">Search</button>
                            <button id="btn" type="btn" class="btn btn-payreto-darkblue-900 text-white my-3" data-bs-toggle="modal" data-bs-target="#saveChanges">Save Changes</button>
                        </div>
                    </div>
                    <!-- Candidate Profile Card -->
                    <section class="d-flex justify-content-center m-auto">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="fw-bold text-payreto-darkblue-900">Candidate Profile</h3>
                                <?php
                                $candidate_view_db = find_candidates_view($c_id);
                                foreach ($candidate_view_db as $candidate_view) :
                                ?>
                                    <!-- Save Changes -->
                                    <div><?php include 'saveChangesModal.php'; ?></div>
                                    <!-- End Save Changes -->
                                    <div class="row">
                                        <!-- 1st Row -->
                                        <div class="d-none">
                                            <input type="text" value="<?php echo $c_id ?>" name="c_id" required>
                                            <input type="text" id="position_id" value="<?php echo $candidate_view['p_id'] ?>" required>
                                            <input type="text" id="department_id" value="<?php echo $candidate_view['d_id'] ?>" required>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Candidate Name:</label>
                                            <input type="text" name="c_name" class="form-control" value="<?php echo $candidate_view['c_name'] ?>" id="c_name" required>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <?php
                                            $date = date('Y-m-d H:i:s');
                                            ?>
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Date & Time:</label>
                                            <input type="text" name="c_appli" class="form-control" value="<?php echo $candidate_view['c_appli'] ?>" id="c_appli" required>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Applying For:</label>
                                            <select class="form-select" name="p_id" id="view_position_candidate" aria-label="Default select example" required>
                                                <option selected>-- Select Position --</option>
                                                <?php
                                                $position_db = find_position_search();
                                                foreach ($position_db as $position_search) :
                                                ?>
                                                    <option value="<?php echo $position_search['p_id']; ?>" <?php if ($candidate_view['p_id'] == $position_search['p_id']) echo 'selected';
                                                                                                            else echo ''  ?>><?php echo $position_search['p_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">School:</label>
                                            <input type="text" name="c_school" class="form-control" value="<?php echo $candidate_view['c_school'] ?>" id="c_school" required>
                                        </div>
                                        <!-- End 1st Row -->

                                        <!-- 2nd Row -->
                                        <?php
                                        $cogpre_view_db = find_ini_int($c_id); //change to if statement after dropdown phase, fornow just initial
                                        foreach ($cogpre_view_db as $cogpre_view) :
                                            $int_name_db = find_int_name($cogpre_view['i_id']);
                                            foreach ($int_name_db as $int_name) :
                                        ?>
                                                <div class="col-12 col-md-3">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Interviewer:</label>
                                                    <select class="form-select" aria-label="Default select example" name='i_id' required>
                                                        <?php
                                                        $int_db = find_interviewer_search();
                                                        foreach ($int_db as $int_search) :
                                                        ?>
                                                            <option value="<?php echo $int_search['i_id'] ?>" <?php if ($cogpre_view['i_id'] == $int_search['i_id']) echo 'selected';
                                                                                                                else echo ''  ?>><?php echo $int_search['i_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <!-- <input type="text" name="" class="form-control" value="<?php //echo $int_name['i_name'] 
                                                                                                                ?>"> -->
                                                </div>
                                        <?php
                                            endforeach;
                                        endforeach; ?>
                                        <div class="col-12 col-md-2">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Source:</label>
                                            <select class="form-select" aria-label="Default select example" name='s_id' required>
                                                <option selected>-- Sources --</option>
                                                <?php
                                                $source_db = find_source_search();
                                                foreach ($source_db as $source_search) :
                                                ?>
                                                    <option value="<?php echo $source_search['s_id'] ?>" <?php if ($candidate_view['s_id'] == $source_search['s_id']) echo 'selected';
                                                                                                            else echo ''  ?>><?php echo $source_search['s_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <!-- <label class="col-form-label text-payreto-darkblue-900 fw-bold">Type:</label>-->
                                            <div style="margin-bottom:2.5rem;"></div>
                                            <div class="d-flex justify-content-around">
                                                <div>
                                                    <input class="form-check-label" type="radio" name="c_actpas" <?php if ($candidate_view['c_actpas'] == "Active") echo 'checked';
                                                                                                                    else '' ?> value="Active" required>
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Active</label>
                                                </div>
                                                <div>
                                                    <input class="form-check-label" type="radio" name="c_actpas" <?php if ($candidate_view['c_actpas'] == "Passive") echo 'checked';
                                                                                                                    else '' ?> value="Passive" required>
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Passive</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Email Address:</label>
                                            <input type="text" name="c_eaddr" class="form-control" value="<?php echo $candidate_view['c_eaddr'] ?>" id="c_eaddr" required>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Course:</label>
                                            <input type="text" name="c_course" class="form-control" value="<?php echo $candidate_view['c_course'] ?>" id="c_course" required>
                                        </div>
                                        <!-- End 2nd Row -->

                                        <!-- 3rd Row -->
                                        <div class="col-12 col-md-6">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Department - Team:</label>
                                            <select class="form-select" aria-label="Default select example" id="view_department_candidate" name='d_id'>
                                                <option selected>-- Select Department & Team --</option>
                                                <?php
                                                $department_db = find_department_search();
                                                foreach ($department_db as $department_search) :
                                                ?>
                                                    <option value="<?php echo $department_search['d_id'] ?>" <?php if ($candidate_view['d_id'] == $department_search['d_id']) echo 'selected';
                                                                                                                else echo ''  ?>><?php echo $department_search['d_name'] . ' - ' . $department_search['d_team'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php 
                                        $https = 'https://'
                                        ?>
                                        <div class="col-12 col-md-6">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Application Folder:</label>
                                            <a readonly onclick="window.open('<?php echo $https.$candidate_view['c_folder'] ?>','newwindow','width=1920,height=1080'); return false;" class="pointer-event form-control text-left pe-auto"><?php echo $candidate_view['c_folder'] ?></a>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <button id="btn" type="button" class="btn btn-payreto-darkblue-900 text-white my-3" data-bs-toggle="modal" data-bs-target="#forfeited">Forfeited</button>
                                        </div>
                                        <!-- End 3rd Row -->
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>
                    <!-- Candidate Profile Card End -->

                    <!-- Predictive Index Card -->
                    <section class="mt-4">
                        <div class="card">
                            <div class="card-body px-4">
                                <h3 class="fw-bold text-payreto-darkblue-900">Predictive Index</h3>
                                <div class="row d-flex justify-content-center">
                                    <?php
                                    $candidate_cogpre_db = find_cogpre_view($c_id);
                                    foreach ($candidate_cogpre_db as $candidate_cogpre) :
                                    ?>
                                        <!-- COGNITIVE ASSESSMENT -->
                                        <section>
                                            <h4 class="fw-bold text-center text-payreto-darkblue-900 my-4">Cognitive Assessment</h4>
                                            <div class="row d-block d-md-flex justify-content-center">
                                                <!-- Cognitive Score -->
                                                <div class="col-12 col-md-5 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Cognitive Score</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" type="number" value="<?php echo $candidate_cogpre['cog_1'] ?>" name="cog_1" required>
                                                        <input class="form-control text-center mx-1" placeholder="Total" type="number" value="<?php echo $candidate_cogpre['cog_2'] ?>" name="cog_2" required>
                                                    </div>
                                                </div>
                                                <!-- Cognitive Score End -->

                                                <!-- Raw Score -->
                                                <div class="col-12 col-md-5 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Raw Score</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" type="number" value="<?php echo $candidate_cogpre['raw_1'] ?>" name="raw_1" required>
                                                        <input class="form-control text-center mx-1" placeholder="Total" type="number" value="<?php echo $candidate_cogpre['raw_2'] ?>" name="raw_2" required>
                                                    </div>
                                                </div>
                                                <!-- Raw Score End -->

                                                <!-- Verbal Score -->
                                                <div class="col-12 col-md-3 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Verbal</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" type="number" value="<?php echo $candidate_cogpre['verb_1'] ?>" name="verb_1" required>
                                                        <input class="form-control text-center mx-1" placeholder="Total" type="number" value="<?php echo $candidate_cogpre['verb_2'] ?>" name="verb_2" required>
                                                    </div>
                                                </div>
                                                <!-- Verbal Score End -->

                                                <!-- Numeric Score -->
                                                <div class="col-12 col-md-3 text-center">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Numeric</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" type="number" value="<?php echo $candidate_cogpre['num_1'] ?>" name="num_1" required>
                                                        <input class="form-control text-center mx-1" placeholder="Total" type="number" value="<?php echo $candidate_cogpre['num_2'] ?>" name="num_2" required>
                                                    </div>
                                                </div>
                                                <!-- Numeric Score End -->

                                                <!-- Abstract Score -->
                                                <div class="col-12 col-md-3 text-center">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Abstract Reasoning</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" type="number" value="<?php echo $candidate_cogpre['abs_1'] ?>" name="abs_1" required>
                                                        <input class="form-control text-center mx-1" placeholder="Total" type="number" value="<?php echo $candidate_cogpre['abs_2'] ?>" name="abs_2" required>
                                                    </div>
                                                </div>
                                                <!-- Abstract Score End -->
                                            </div>
                                        </section>
                                        <!-- COGNITIVE ASSESSMENT END -->

                                        <!-- BEHAVIORAL ASSESSMENT -->
                                        <section>
                                            <h4 class="fw-bold text-center text-payreto-darkblue-900 my-4">Behavioral Assessment</h3>
                                                <div class="d-block d-md-flex justify-content-center">
                                                    <!-- Behavioral Profile -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Behavioral Profile</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_pro" required>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Adapter") echo 'selected' ?> value="Adapter">Adapter</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Altruist") echo 'selected' ?> value="Altruist">Altruist</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Analyzer") echo 'selected' ?> value="Analyzer">Analyzer</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Captain") echo 'selected' ?> value="Captain">Captain</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Collaborator") echo 'selected' ?> value="Collaborator">Collaborator</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Controller") echo 'selected' ?> value="Controller">Controller</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Craftsman") echo 'selected' ?> value="Craftsman">Craftsman</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Guardian") echo 'selected' ?> value="Guardian">Guardian</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Individualist") echo 'selected' ?> value="Individualist">Individualist</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Maverick") echo 'selected' ?> value="Maverick">Maverick</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Operator") echo 'selected' ?> value="Operator">Operator</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Persuader") echo 'selected' ?> value="Persuader">Persuader</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Promoter") echo 'selected' ?> value="Promoter">Promoter</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Scholar") echo 'selected' ?> value="Scholar">Scholar</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Scpecialist") echo 'selected' ?> value="Scpecialist">Scpecialist</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Strategist") echo 'selected' ?> value="Strategist">Strategist</option>
                                                            <option <?php if ($candidate_cogpre['beh_pro'] == "Venturer") echo 'selected' ?> value="Venturer">Venturer</option>
                                                        </select>
                                                    </div>
                                                    <!-- Behavioral Profile End -->

                                                    <!-- Dominance A -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dominance A</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_a" required>
                                                            <option <?php if ($candidate_cogpre['beh_a'] == "Collaborative") echo 'selected' ?> value="Collaborative">Collaborative</option>
                                                            <option <?php if ($candidate_cogpre['beh_a'] == "Independent") echo 'selected' ?> value="Independent">Independent</option>
                                                            <option <?php if ($candidate_cogpre['beh_a'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Dominance A End -->

                                                    <!-- Extraversion B -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Extraversion B</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_b" required>
                                                            <option <?php if ($candidate_cogpre['beh_b'] == "Reserved") echo 'selected' ?> value="Reserved">Reserved</option>
                                                            <option <?php if ($candidate_cogpre['beh_b'] == "Sociable") echo 'selected' ?> value="Sociable">Sociable</option>
                                                            <option <?php if ($candidate_cogpre['beh_b'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Extraversion B End -->

                                                    <!-- Patience C -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Patience C</label>
                                                        <select class="form-select" aria-label="Default select example" value="<?php echo $candidate_cogpre['beh_c'] ?>" name="beh_c" required>
                                                            <option <?php if ($candidate_cogpre['beh_c'] == "Driving") echo 'selected' ?> value="Driving">Driving</option>
                                                            <option <?php if ($candidate_cogpre['beh_c'] == "Steady") echo 'selected' ?> value="Steady">Steady</option>
                                                            <option <?php if ($candidate_cogpre['beh_c'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Patience C End -->

                                                    <!-- Formality D -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Formality D</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_d" required>
                                                            <option <?php if ($candidate_cogpre['beh_d'] == "Flexbile") echo 'selected' ?> value="Flexbile">Flexbile</option>
                                                            <option <?php if ($candidate_cogpre['beh_d'] == "Precise") echo 'selected' ?> value="Precise">Precise</option>
                                                            <option <?php if ($candidate_cogpre['beh_d'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Formality D End -->

                                                    <!-- Orientation A&B -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Orientation A&B</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_ab" required>
                                                            <option <?php if ($candidate_cogpre['beh_ab'] == "People") echo 'selected' ?> value="People">People</option>
                                                            <option <?php if ($candidate_cogpre['beh_ab'] == "Task") echo 'selected' ?> value="Task">Task</option>
                                                            <option <?php if ($candidate_cogpre['beh_ab'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Orientation A&B End -->
                                                </div>
                                        </section>
                                        <!-- BEHAVIORAL ASSESSMENT END -->

                                        <!-- BEHAVIORAL ASSESSMENT 2ND ROW -->
                                        <section class="mt-2">
                                            <div class="d-block d-md-flex justify-content-center">
                                                <!-- Behavioral Category -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Behavioral Category</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_cat" required>
                                                        <option <?php if ($candidate_cogpre['beh_cat'] == "Analytical") echo 'selected' ?> value="Analytical">Analytical</option>
                                                        <option <?php if ($candidate_cogpre['beh_cat'] == "Collaborative") echo 'selected' ?> value="Collaborative">Collaborative</option>
                                                        <option <?php if ($candidate_cogpre['beh_cat'] == "Persistent") echo 'selected' ?> value="Persistent">Persistent</option>
                                                        <option <?php if ($candidate_cogpre['beh_cat'] == "Social") echo 'selected' ?> value="Social">Social</option>
                                                        <option <?php if ($candidate_cogpre['beh_cat'] == "Stabilizing") echo 'selected' ?> value="Stabilizing">Stabilizing</option>
                                                    </select>
                                                </div>
                                                <!-- Behavioral Category End -->

                                                <!-- Action A&C -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Action A&C</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_ac" required>
                                                        <option <?php if ($candidate_cogpre['beh_ac'] == "Proactive") echo 'selected' ?> value="Proactive">Proactive</option>
                                                        <option <?php if ($candidate_cogpre['beh_ac'] == "Responsive") echo 'selected' ?> value="Responsive">Responsive</option>
                                                        <option <?php if ($candidate_cogpre['beh_ac'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Action A&C End -->

                                                <!-- Risk A&D -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Risk A&D</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_ad" required>
                                                        <option <?php if ($candidate_cogpre['beh_ad'] == "Cautious") echo 'selected' ?> value="Cautious">Cautious</option>
                                                        <option <?php if ($candidate_cogpre['beh_ad'] == "Comfortable") echo 'selected' ?> value="Comfortable">Comfortable</option>
                                                        <option <?php if ($candidate_cogpre['beh_ad'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Risk A&D End -->

                                                <!-- Connection B&C -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Connection B&C</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_bc" required>
                                                        <option <?php if ($candidate_cogpre['beh_bc'] == "Takes Time") echo 'selected' ?> value="Takes Time">Takes Time</option>
                                                        <option <?php if ($candidate_cogpre['beh_bc'] == "Quick") echo 'selected' ?> value="Quick">Quick</option>
                                                        <option <?php if ($candidate_cogpre['beh_bc'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Connection B&C End -->

                                                <!-- Interaction B&D -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Interaction B&D</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_bd" required>
                                                        <option <?php if ($candidate_cogpre['beh_bd'] == "Formal") echo 'selected' ?> value="Formal">Formal</option>
                                                        <option <?php if ($candidate_cogpre['beh_bd'] == "Informal") echo 'selected' ?> value="Informal">Informal</option>
                                                        <option <?php if ($candidate_cogpre['beh_bd'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Interaction B&D End -->

                                                <!-- Rules C&D -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Rules C&D</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_cd" required>
                                                        <option <?php if ($candidate_cogpre['beh_cd'] == "Careful") echo 'selected' ?> value="Careful">Careful</option>
                                                        <option <?php if ($candidate_cogpre['beh_cd'] == "Casual") echo 'selected' ?> value="Casual">Casual</option>
                                                        <option <?php if ($candidate_cogpre['beh_cd'] == "Situational") echo 'selected' ?> value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Rules C&D End -->
                                            </div>
                                            </form>
                                        </section>
                                        <!-- BEHAVIORAL ASSESSMENT 2ND ROW END -->
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Predictive Index Card End-->
                    <!-- Actual vs Average Card -->
                    <section class="mt-4">
                        <div class="card">
                            <div class="card-body px-4">
                                <h3 class="fw-bold text-payreto-darkblue-900">Actual vs Average</h3>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Candidate Score<?php $findtrait = find_trait();
                                        ?></h6>
                                        <canvas id="candidateScore"></canvas>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Cognitive Predictive Index</h6>
                                        <?php 
                                        $cogAsses = cog_asses();
                                        $actual_cogAsses = actual_asses();
                                        // print_r($cogAsses);
                                        $avg_cog1 = 0;
                                        $avg_cog2 = 0;
                                        
                                        for($i = 0; $i < count($actual_cogAsses); $i++){
                                            if($actual_cogAsses[$i]['c_id'] == $_GET['id']){
                                                $actual_cog = $actual_cogAsses[$i]['cog_1'] / $actual_cogAsses[$i]['cog_2'];
                                                $actual_raw = $actual_cogAsses[$i]['raw_1'] / $actual_cogAsses[$i]['raw_2'];
                                                $actual_verb = $actual_cogAsses[$i]['verb_1'] / $actual_cogAsses[$i]['verb_2'];
                                                $actual_num = $actual_cogAsses[$i]['num_1'] / $actual_cogAsses[$i]['num_2'];
                                                $actual_abs = $actual_cogAsses[$i]['abs_1'] / $actual_cogAsses[$i]['abs_2'];
                                                $actual_array = array($actual_cog, $actual_raw, $actual_verb, $actual_num, $actual_abs);
                                                
                                            }
                                            else{
                                                $avg_cog1 = ($actual_cogAsses[$i]['cog_1']/$actual_cogAsses[$i]['cog_1']) + $avg_cog1;
                                            }
                                        }
                                        $cogAvg_array = array($cogAsses[0][0],$cogAsses[0][1],$cogAsses[0][2],$cogAsses[0][3],$cogAsses[0][4]);
                                        
                                        
                                        ?>
                                        <canvas id="predictiveScore"></canvas>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Behavioral Predictive Index</h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <?php 
                                                $aabehPro = aa_behProf($_GET['id']);
                                                $avgbehPro = avg_behProf($_GET['id']);
                                                $aabehCat = aa_behCat($_GET['id']);
                                                $avgbehCat = avg_behCat($_GET['id']);
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Actual</th>
                                                        <th scope="col">Average</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Profile</th>
                                                        <td><?php echo  $aabehPro[0][0]; ?></td>
                                                        <td><?php echo  $avgbehPro[0][0]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Category</th>
                                                        <td><?php echo $aabehCat[0][0]; ?></td>
                                                        <td><?php echo $avgbehCat[0][0]; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <h6 class="my-3 text-payreto-darkblue fw-bold text-center">Personality Profile</h6>
                                    <?php 
                                    $aa_domBird = aa_dominantProf($_GET['id']);
                                    $avgdomBird = avg_domBird($_GET['id']);
                                    
                                    ?>
                                    <div class="col-6 mx-auto">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold text-center">Actual Dominant Profile</label>
                                        <input class="form-control text-center mx-1" type="text" name="" value="<?php echo $aa_domBird[0]['dom_bird']; ?>" disabled>
                                    </div>
                                    <div class="col-6 mx-auto">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold text-center">Average Dominant Profile</label>
                                        <input class="form-control text-center mx-1" type="text" name="" value="<?php echo $avgdomBird[0][1]; ?>" disabled>
                                    </div>
                                </div>
                    </section>
                    <section class="mt-4">
                        <div class="shadow card px-4">
                            <div class="card-body px-4">
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-primary">Add Comment/Remarks</button>
                            </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Actual vs Average Card -->
                    <!-- ACTION -->
                    <section class="mt-4">
                        <div class="shadow card px-4">
                            <div class="card-body px-4">
                                <h3 class="fw-bold text-payreto-darkblue-900">Final Decision</h3>
                                <div class="row d-flex flex-row align-items-center justify-content-center">
                                    <div class="col-9 d-flex flex-row align-items-center justify-content-center pt-5">
                                        <button type="button" class="btn btn-primary btn-payreto-green-900 w-50 m-1" data-bs-toggle="modal" data-bs-target="#confirm-passed">
                                            <p class="fw-bold m-0">PASSED</p>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-payreto-yellow-900 w-50 m-1" data-bs-toggle="modal" data-bs-target="#confirm-job-offer">
                                            <p class="fw-bold m-0">JOB OFFER</p>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-payreto-gray-900 w-50 m-1" data-bs-toggle="modal" data-bs-target="#confirm-unresponsive">
                                            <p class="fw-bold m-0">UNRESPONSIVE</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="row d-flex flex-row align-items-center justify-content-center pb-5">
                                    <div class="col-9 d-flex flex-row align-items-center justify-content-center">
                                        <button type="button" class="btn btn-primary btn-payreto-bluegreen-900 w-50 m-1" data-bs-toggle="modal" data-bs-target="#confirm-for-pooling">
                                            <p class="fw-bold m-0">FOR POOLING</p>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-payreto-red-900 w-50 m-1" data-bs-toggle="modal" data-bs-target="#confirm-failed">
                                            <p class="fw-bold m-0">FAILED</p>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-payreto-gray-900 w-50 m-1" data-bs-toggle="modal" data-bs-target="#confirm-withdrawn">
                                            <p class="fw-bold m-0">WITHDRAWN</p>
                                        </button>
                                    </div>
                                </div>
                                <?php 
                                    $display = "";
                                    $id = $_GET['id'];
                                    $status_db = find_status($id); 
                                    foreach($status_db as $status) {
                                        if($status['c_job'] == '0' || $status['c_job'] == '1' || $status['c_job'] == '2'){
                                            $display = 1;
                                        }
                                    }

                                    if($display == 1) {
                                ?>
                                <h3 class="fw-bold text-payreto-darkblue-900 text-center">Job Offer Status</h3>
                                <div class="row d-flex flex-row align-items-center justify-content-center pb-5">
                                    <div class="col-9 d-flex flex-row align-items-center justify-content-center">
                                        <button type="button" class="btn btn-primary btn-payreto-green-900 w-50 m-1" data-bs-toggle="modal" data-bs-target="#confirm-job-accept">
                                            <p class="fw-bold m-0">ACCEPTED</p>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-payreto-red-900 w-50 m-1" data-bs-toggle="modal" data-bs-target="#confirm-job-decline">
                                            <p class="fw-bold m-0">DECLINED</p>
                                        </button>
                                    </div>
                                </div>
                                <?php } else { ""; } ?>
                            </div>
                        </div>
                    </section>
                    <!-- END OF ACTION -->
                </section>
            </main>
            <div><?php include '../layouts/footer.php'; ?></div>
        </div>
    </div>
</body>

<!-- Candidate Score Chart  -->
<!-- <script>
    const candidateLabels = [
        // 'Trait 1',
        // 'Trait 2',
        // 'Trait 3',
        // 'Trait 4',
        // 'Trait 5',
        // 'Trait 6',
    ];

    const candidateData = {
        labels: candidateLabels,
        datasets: [{
            label: 'Candidate Score',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    };

    const candidateChart = {
        type: 'line',
        data: candidateData,
        options: {}
    };
</script>

<script>
    const CandidateScore = new Chart(
        document.getElementById('candidateScore'),
        candidateChart
    );
</script> -->
<script>
    const candidateLabels = [
        
    ];
    

    const candidateData = {
        labels: candidateLabels,
        datasets: [{
            label: 'Candidate Score',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    };

    const candidateChart = {
        type: 'line',
        data: candidateData,
        options: {}
    };

    const CandidateScore = new Chart(
        document.getElementById('candidateScore'),
        candidateChart
    );
    let test1 = 10;
    const selTrait = document.querySelector('#traitd');
    let jsondaw = <?php echo json_encode($findtrait); ?>;
    console.log(jsondaw[0]);
    selTrait.addEventListener('change', function handleChange(event){

        // if(event.target.value == 1)
        //     CandidateScore.data.datasets[0].data = jsondaw[0];
        //let qwe = event.target.value;
        // let ww = 1;
        if(event.target.value == 1)
            CandidateScore.data.datasets[0].data = jsondaw[0];
        if(event.target.value == 2)
            CandidateScore.data.datasets[0].data = jsondaw[1];
        if(event.target.value == 3)
            CandidateScore.data.datasets[0].data = jsondaw[2];
        if(event.target.value == 4)
            CandidateScore.data.datasets[0].data = jsondaw[3];
        if(event.target.value == 5)
            CandidateScore.data.datasets[0].data = jsondaw[4];
        if(event.target.value == 6)
            CandidateScore.data.datasets[0].data = jsondaw[5];
        if(event.target.value == 7)
            CandidateScore.data.datasets[0].data = jsondaw[6];


        
        CandidateScore.update();

        
    })
</script>
<!-- Candidate Score Chart  End -->

<!-- Predictive Index Chart  -->
<script src="/HiringTracker/assets/js/weeklyChart.js"></script>
<script>
const predictiveChart = document.getElementById('predictiveScore').getContext('2d');
const PIAvg = <?php echo json_encode($cogAvg_array); ?>;
const PIAct = <?php echo json_encode($actual_array); ?>;
// const PIAvg_count = dataChart(PIAvg, 1);
console.log(PIAvg);

const predictiveScore = new Chart(predictiveChart, {
    type: 'bar',
    data: {
        labels: ['Cognitive', 'Raw', 'Verbal', 'Numeric', 'Abstract Reasoning'],
        datasets: [{
            label: 'Actual Predictive Index',
            data: PIAct,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        },{
            label: 'Average Predictive Index',
            data: PIAvg,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<!-- Predictive Index Chart  End -->


</html>

<script>
    var position = document.getElementById('position_id').value;
    var department = document.getElementById('department_id').value;

    console.log(position);

    $('#view_position_candidate').val(position);
    $('#view_department_candidate').val(department); 

    <?php
    } else {
        include '../functions/logout.php';

        header("location: ../functions/logout.php");
    }
    ?>