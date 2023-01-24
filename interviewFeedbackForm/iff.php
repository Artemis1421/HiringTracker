<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Feedback Form | Payreto | Hiring Tracker</title>
    <?php
    session_start();

    include '../functions/conn.php';
    include '../functions/functions.php';
    include '../layouts/header.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $interviewer_id = $_GET['interviewer_id'];
        $phase_status;
    }
    ?>
</head>

<!-- MODALS -->
<div><?php include 'confirmDecision.php'; ?></div>
<div><?php include 'viewGuidelinesModal.php'; ?></div>

<!-- MODALS END -->


<body class="sb-nav-fixed">
    <?php
    // 11/28/2022
        $getid = '';
        if(isset($_GET['score_candidate']) == 1){
            echo "";
            $getid =  $_GET['score_candidate'];
        } elseif ($_SESSION['login_level'] == 0) {
            include '../layouts/navigation-bar_admin.php';
        } elseif ($_SESSION['login_level'] == 1) {
            include '../layouts/navigation-bar.php';
        }
    ?>
    <div id="layoutSidenav">
        <?php
        //removes navbar and sidebar if it is sent to an interviewer via email
        if(isset($_GET['score_candidate']) == 1){
            echo "";
        } elseif ($_SESSION['login_level'] == 0) {
            include '../layouts/sidebar-admin.php';
        } elseif ($_SESSION['login_level'] == 1) {
            include '../layouts/sidebar.php';
        }
        ?>
        <?php 
             if(isset($_GET['score_candidate']) == 1){
                echo "";
            } else {
        ?>
        <div id="layoutSidenav_content">
        <?php } ?>
            <!-- CONTENT HERE -->
            <main>
                <?php
                if (isset($_GET['id']) && isset($_GET['interviewer_id'])) {
                    $find_interviewer_db = find_iff_interviewer($interviewer_id);
                    foreach ($find_interviewer_db as $iff_interviewer) {
                        $interviewer_name = $iff_interviewer['i_name'];
                        $interviewer_id = $iff_interviewer['i_id'];
                    }

                    //display the data of the candidate searched and its interviewer
                    // $find_iff_db = find_iff($id); // Old
                    $interview_phase = $_GET['phase'];
                    $find_iff_db = find_iff($id,$interview_phase,$interviewer_id);
                    
                    foreach ($find_iff_db as $iff) {
                        include 'iff_data.php';
                    }
                } else {
                ?>
                    <section class="container-fluid px-4">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h1 class="my-3 text-payreto-darkblue fw-bold">Interview Feedback Form</h1>
                            </div>
                            <!-- CANDIDATE SEARCH DROPDOWNS -->
                            <form method="post" action="iff_validation.php" class="d-flex align-items-center align-content-center justify-content-between"> 
                                <table class="text-nowrap" id="search_table">
                                    <tr>
                                        <td>
                                            <select class="form-select mx-2 search_phase" name="search_phase" id="search_phase" required>
                                                <option value="" selected>-- Select Phase --</option>
                                                <option value="1">Initial</option>
                                                <option value="2">Operation - Team Lead</option>
                                                <option value="3">Exam</option>
                                                <option value="4">Operation - Manager</option>
                                                <option value="5">Department Head</option>
                                                <option value="6">Client</option>
                                                <option value="7">Management</option>
                                            </select>
                                         </td>   
                                         <td class="px-2">
                                             <select class="form-select mx-2 search_name" name="search_name" id="search_name" required>
                                                 <option value="" selected>-- Select Name --</option>
                                                 <?php 
                                                $find_phase_db = find_phase_all();
                                                foreach($find_phase_db as $phase):
                                                ?>                                
                                                <option data-parent="<?php echo $phase['phase']?>" value="<?php echo $phase["c_id"]?>"><?php echo $phase['c_name'].' - '.$phase['status']?></option>       
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                    </tr>
                                    <script>
                                        $(document).on('change', '.search_phase', function () {
                                            var parent = $(this).val();  $(this).closest('tr').find('.search_name').children().each(function () {
                                                if ($(this).data('parent') != parent) {
                                                    $(this).hide();
                                                } else
                                                $(this).show();
                                            });
                                        });
                                    </script>
                                    </table>
                                    <button type="submit" id="" name="searchButton" class="mx-2 btn btn-payreto-darkblue-900 text-white my-2 my-sm-0">Search</button>
                            </form>
                            <!-- CANDIDATE SEARCH DROPDOWN END -->
                        </div>
                        <?php //var_dump($find_candidate_db) ?> 
                        <!-- Candidate Profile Card -->
                        <section class="d-flex justify-content-center m-auto shadow">
                            <div class="card px-4">
                                <div class="card-body">
                                    <h3 class="fw-bold text-payreto-darkblue-900">Candidate Profile</h3>
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Candidate Name:</label>
                                            <input type="text" readonly class="form-control" value="<?php echo @$candidate_name ?>">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Date & Time:</label>
                                            <input type="text" readonly class="form-control" value="">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Applying For:</label>
                                            <input type="text" readonly class="form-control" value="">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">School:</label>
                                            <input type="text" readonly class="form-control" value="">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Interviewer:</label>
                                            <input type="text" readonly class="form-control" value="">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Source:</label>
                                            <input type="text" readonly class="form-control" value="">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div style="margin-bottom:2.5rem;"></div>
                                            <div class="d-flex justify-content-around mx-2">
                                                <div>
                                                    <input class="form-check-label" type="radio" name="c_actpas" id="" value="Active" disabled> 
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Active</label>
                                                </div>
                                                <div>
                                                    <input class="form-check-label" type="radio" name="c_actpas" id="" value="Passive" disabled> 
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Passive</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Email Address:</label>
                                            <input type="text" readonly class="form-control" value="">
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Course:</label>
                                            <input type="text" readonly class="form-control" value="">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Department - Team:</label>
                                            <input type="text" readonly class="form-control" value="">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Application Folder:</label>
                                            <input type="text   " readonly class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Candidate Profile Card End -->

                        <!-- Predictive Index Card -->
                        <section class="mt-4">
                            <div class="shadow card px-4">
                                <div class="card-body px-4">
                                    <h3 class="fw-bold text-payreto-darkblue-900">Predictive Index</h3>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col">
                                            <!-- COGNITIVE ASSESSMENT -->
                                            <section>
                                                <h4 class="fw-bold text-center text-payreto-darkblue-900 my-4">Cognitive Assessment</h4>
                                                <div class="d-block d-md-flex justify-content-center mx-auto row">
                                                    <!-- Cognitive Score -->
                                                    <div class="col-12 col-md-5 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Cognitive Score</label>
                                                        <div class="d-flex">
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                        </div>
                                                    </div>
                                                    <!-- Cognitive Score End -->

                                                    <!-- Raw Score -->
                                                    <div class="col-12 col-md-5 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Raw Score</label>
                                                        <div class="d-flex">
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                        </div>
                                                    </div>
                                                    <!-- Raw Score End -->

                                                    <!-- Verbal Score -->
                                                    <div class="col-12 col-md-3 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Verbal Score</label>
                                                        <div class="d-flex">
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                        </div>
                                                    </div>
                                                    <!-- Verbal Score End -->

                                                    <!-- Numeric Score -->
                                                    <div class="col-12 col-md-3 text-center">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Numeric Score</label>
                                                        <div class="d-flex">
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                        </div>
                                                    </div>
                                                    <!-- Numeric Score End -->

                                                    <!-- Abstract Score -->
                                                    <div class="col-12 col-md-3 text-center">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Abstract Reasoning Score</label>
                                                        <div class="d-flex">
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
                                                            <input class="form-control text-center mx-1" type="text" readonly ?>
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
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Behavioral Profile</label>
                                                            <input type="text" readonly class="form-control">
                                                        </div>
                                                        <!-- Behavioral Profile End -->

                                                        <!-- Dominance A -->
                                                        <div class=" col-12 col-md-2 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Dominance A</label>
                                                            <input type="text" readonly class="form-control">
                                                        </div>
                                                        <!-- Dominance A End -->

                                                        <!-- Extraversion B -->
                                                        <div class=" col-12 col-md-2 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Extraversion B</label>
                                                            <input type="text" readonly class="form-control">
                                                        </div>
                                                        <!-- Extraversion B End -->

                                                        <!-- Patience C -->
                                                        <div class=" col-12 col-md-2 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Patience C</label>
                                                            <input type="text" readonly class="form-control">
                                                        </div>
                                                        <!-- Patience C End -->

                                                        <!-- Formality D -->
                                                        <div class=" col-12 col-md-2 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Formality D</label>
                                                            <input type="text" readonly class="form-control">
                                                        </div>
                                                        <!-- Formality D End -->

                                                        <!-- Orientation A&B -->
                                                        <div class=" col-12 col-md-2 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Orientation A&B</label>
                                                            <input type="text" readonly class="form-control">
                                                        </div>
                                                        <!-- Orientation A&B End -->
                                                    </div>
                                            </section>
                                            <!-- BEHAVIORAL ASSESSMENT END -->

                                            <!-- BEHAVIORAL ASSESSMENT 2ND ROW -->
                                            <section class=" mt-2">
                                                    <div class="d-block d-md-flex justify-content-center">
                                                    <!-- Behavioral Category -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Behavioral Category</label>
                                                        <input type="text" readonly class="form-control">
                                                    </div>
                                                    <!-- Behavioral Category End -->

                                                    <!-- Action A&C -->
                                                    <div class=" col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Action A&C</label>
                                                        <input type="text" readonly class="form-control">
                                                    </div>
                                                    <!-- Action A&C End -->

                                                    <!-- Risk A&D -->
                                                    <div class=" col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Risk A&D</label>
                                                        <input type="text" readonly class="form-control">
                                                    </div>
                                                    <!-- Risk A&D End -->

                                                    <!-- Connection B&C -->
                                                    <div class=" col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Connection B&C</label>
                                                        <input type="text" readonly class="form-control">
                                                    </div>
                                                    <!-- Connection B&C End -->

                                                    <!-- Interaction B&D -->
                                                    <div class=" col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Interaction B&D</label>
                                                        <input type="text" readonly class="form-control">
                                                    </div>
                                                    <!-- Interaction B&D End -->

                                                    <!-- Rules C&D -->
                                                    <div class=" col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold label-medium">Rules C&D</label>
                                                        <input type="text" readonly class="form-control">
                                                    </div>
                                                    <!-- Rules C&D End -->
                                                </div>
                                            </section>
                                            <!-- BEHAVIORAL ASSESSMENT 2ND ROW END -->
                                        </div>
                                        <!-- PERSONALITY PROFILE -->
                                        <section>
                                            <h4 class=" fw-bold text-center text-payreto-darkblue-900 my-4">Personality Profile</h3>
                                                <div class="d-flex justify-content-center">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <!-- Dominant Profile -->
                                                            <div class="col-12 text-center mx-1">
                                                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dominant Profile</label>
                                                                <div class="d-flex">
                                                                    <input class="form-control text-center mx-1 fw-bold" type="text" readonly ?>
                                                                </div>
                                                            </div>
                                                            <!-- Dominant Profile End -->
                                                        </div>
                                                        <div class="col-6">
                                                            <!-- Dove -->
                                                            <div class="col-12 text-center mx-1">
                                                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dove</label>
                                                                <div class="d-flex">
                                                                    <input class="form-control text-center mx-1" type="text" readonly ?>
                                                                </div>
                                                            </div>
                                                            <!-- Dove End -->
                                                        </div>
                                                        <div class="col-6">
                                                            <!-- Owl -->
                                                            <div class="col-12 text-center mx-1">
                                                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Owl</label>
                                                                <div class="d-flex">
                                                                    <input class="form-control text-center mx-1" type="text" readonly ?>
                                                                </div>
                                                            </div>
                                                            <!-- Owl End -->
                                                        </div>
                                                        <div class="col-6">
                                                            <!-- Peacock -->
                                                            <div class="col-12 text-center mx-1">
                                                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Peacock</label>
                                                                <div class="d-flex">
                                                                    <input class="form-control text-center mx-1" type="text" readonly ?>
                                                                </div>
                                                            </div>
                                                            <!-- Peacock End -->
                                                        </div>
                                                        <div class="col-6">
                                                            <!-- Eagle -->
                                                            <div class="col-12 text-center mx-1">
                                                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Eagle</label>
                                                                <div class="d-flex">
                                                                    <input class="form-control text-center mx-1" type="text" readonly ?>
                                                                </div>
                                                            </div>
                                                            <!-- Eagle End -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <!-- PERSONALITY PROFILE END-->
                                        </div>
                                    </div>
                                </div>
                        </section>
                        <!-- Candidate Feedback Scoring -->
                        <section class="mt-4">
                            <div class="shadow card px-4">
                                <div class="card-body px-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <h3 class="fw-bold text-payreto-darkblue-900">Candidate Feedback Scoring</h3>
                                        </div>
                                        <div class="col-6 d-flex flex-row-reverse">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary btn-payreto-darkblue-900" data-bs-toggle="modal" data-bs-target="#viewGuidelines">
                                                VIEW GUIDELINES
                                            </button>
                                        </div>
                                    </div>
                                    <table class="table table-bordered my-4">
                                        <thead class="text-center">
                                            <tr>
                                                <th scope="col" class="head-payreto-darkblue-900"></th>
                                                <th scope="col" class="head-payreto-darkblue-900">1</th>
                                                <th scope="col" class="head-payreto-darkblue-900">2</th>
                                                <th scope="col" class="head-payreto-darkblue-900">3</th>
                                                <th scope="col" class="head-payreto-darkblue-900">4</th>
                                                <th scope="col" class="head-payreto-darkblue-900">5</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <th scope="row" class="w-50">SUBJECT MATTER EXPERTISE FIT</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="subject-matter" id="subject-matter" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="subject-matter" id="subject-matter" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="subject-matter" id="subject-matter" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="subject-matter" id="subject-matter" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="subject-matter" id="subject-matter" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-50">COMMUNICATION</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="communication" id="communication" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="communication" id="communication" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="communication" id="communication" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="communication" id="communication" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="communication" id="communication" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-50">PROACTIVITY</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="proactivity" id="proactivity" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="proactivity" id="proactivity" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="proactivity" id="proactivity" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="proactivity" id="proactivity" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="proactivity" id="proactivity" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-50">COGNITIVE ABILITY</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="cognitive" id="cognitive" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="cognitive" id="cognitive" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="cognitive" id="cognitive" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="cognitive" id="cognitive" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="cognitive" id="cognitive" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-50">SOLUTION DRIVEN</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="solution-driven" id="solution-driven" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="solution-driven" id="solution-driven" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="solution-driven" id="solution-driven" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="solution-driven" id="solution-driven" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="solution-driven" id="solution-driven" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-50">INTEGRITY</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="integrity" id="integrity" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="integrity" id="integrity" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="integrity" id="integrity" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="integrity" id="integrity" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="integrity" id="integrity" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-50">OWNERSHIP</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="ownership" id="ownership" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="ownership" id="ownership" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="ownership" id="ownership" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="ownership" id="ownership" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="ownership" id="ownership" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-50">LEADERSHIP POTENTIAL</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="leadership" id="leadership" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="leadership" id="leadership" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="leadership" id="leadership" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="leadership" id="leadership" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="leadership" id="leadership" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-50">DESIRE FOR DEEPER LEARNING</th>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input " type="radio" name="deeper-learning" id="deeper-learning" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="deeper-learning" id="deeper-learning" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="deeper-learning" id="deeper-learning" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="deeper-learning" id="deeper-learning" varia-label="...">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input" type="radio" name="deeper-learning" id="deeper-learning" varia-label="...">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <!-- Comments -->
                        <section class="mt-4">
                            <div class="shadow card px-4">
                                <div class="card-body px-4">
                                    <h3 class="fw-bold text-payreto-darkblue-900">Comments</h3>
                                </div>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="head-payreto-darkblue-900">POSITIVE</th>
                                            <th class="head-payreto-darkblue-900">NEGATIVE</th>
                                            <th class="head-payreto-darkblue-900">OVERALL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><textarea name="" id="" class="form-control" style="resize:none; height:350px;"></textarea></td>
                                            <td><textarea name="" id="" class="form-control" style="resize:none; height:350px;"></textarea></td>
                                            <td><textarea name="" id="" class="form-control" style="resize:none; height:350px;"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <!-- ACTION -->
                        <!-- <section class="mt-4">
                            <div class="shadow card px-4">
                                <div class="card-body px-4">
                                    <h3 class="fw-bold text-payreto-darkblue-900">Decision</h3>
                                    <div class="row d-flex flex-row align-items-center justify-content-center">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3 d-flex flex-row align-items-center justify-content-center">
                                                    <h5 class="fw-bold text-payreto-darkblue-900 text-center ">INTERVIEW PHASE</h5>
                                                </div>
                                                <div class="col-9 d-flex flex-row align-items-center justify-content-center">
                                                    <select class="form-select" aria-label="Default select example" id="" name="">
                                                        <option selected>-- Select Phase --</option>
                                                        <option value="Initial">Initial</option>
                                                        <option value="Operation-Team Lead">Operation-Team Lead</option>
                                                        <option value="Operation-Manager">Operation-Manager</option>
                                                        <option value="Department Head">Department Head</option>
                                                        <option value="Client">Client</option>
                                                        <option value="Management">Management</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-6 align-items-center justify-content-center">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-12 d-flex flex-row align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-primary btn-payreto-green-900 w-75 m-1" data-bs-toggle="modal" data-bs-target="#confirm-passed">
                                                        <p class="fw-bold m-0">PASSED</p> 
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-payreto-bluegreen-900 w-75 m-1" data-bs-toggle="modal" data-bs-target="#confirm-pooling">
                                                        <p class="fw-bold m-0">FOR POOLING</p>
                                                    </button>
                                                </div>
                                                <div class="col-12 d-flex flex-row align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-primary btn-payreto-red-900 w-75 m-1" data-bs-toggle="modal" data-bs-target="#confirm-failed">
                                                    <p class="fw-bold m-0">FAILED</p>
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-payreto-yellow-900 w-75 m-1" data-bs-toggle="modal" data-bs-target="#confirm-discussion">
                                                    <p class="fw-bold m-0">FOR DISCUSSION</p>
                                                    </button>
                                                </div>
                                                <div class="col-12 d-flex flex-row align-items-center justify-content-center">
                                                    <button type="button" class="btn btn-primary btn-payreto-gray-900 w-100 m-1" data-bs-toggle="modal" data-bs-target="#confirm-reset">
                                                        <p class="fw-bold m-0">RESET</p> 
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> -->
                        <!-- END OF ACTION -->
                        <section style="padding-bottom: 5rem;">

                        </section>
                    </section>
                <?php
                };
                ?>
            </main>
            <?php 
            if(isset($_GET['score_candidate']) == 1){
                echo "";
            } else {
        ?>
            <div><?php include '../layouts/footer.php'; ?></div>
        <?php } ?>
        </div>
    </div>
</body>
</html>

<script>



// $js_arr = json_encode($find_phase_db);
// echo "var nameArr = ". $js_arr . ";\n";

// var searchPhase = "";
// var value = "";

// function getNames() {
    //     searchPhase = document.getElementById("search_phase");
    //     value = searchPhase.value;
    
    //     removeOptions(document.getElementById("search_name"));
    //     nameArr.forEach(nameIterate, value);
    // };
    
    
    // function removeOptions(selectElement){
        //     var i, L = selectElement.options.length - 1;
        //     for(i = L; i >= 0; i--) {
            //         selectElement.remove(i);
            //     }
            // };
            
            // function nameIterate(item, index, array){
                // if(item["phase"] == value){
                    //         var searchName = document.getElementById("search_name");
                    //         console.log("pasok");
                    
                    
                    //     }
                    //     // console.log(item);
                    // };
</script>