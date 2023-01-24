<section class="container-fluid px-4">
    <div class="d-flex flex-row justify-content-between">
        <div>
            <h1 class="my-3 text-payreto-darkblue fw-bold">Interview Feedback Form</h1>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <label class="col-form-label text-payreto-darkblue-900 fw-bold mx-2">Interview Phase:</label>
            <div class="d-flex align-items-center justify-content-center">
                <?php if($getid != 1): ?>
                <input class="form-control text-center fw-bold" type="text" readonly value="<?php
                        if($interview_phase == "1") {
                            echo "Initial";
                        } elseif ($interview_phase == "2"){
                            echo "Operation Team Lead";
                        } elseif ($interview_phase == "3"){
                            echo "Exam";
                        }elseif ($interview_phase == "4"){
                            echo "Operation Manager";
                        } elseif ($interview_phase == "5"){
                            echo "Department Head";
                        } elseif ($interview_phase == "6"){
                            echo "Client";
                        } elseif ($interview_phase == "7"){
                            echo "Management";
                        }
                    ?>">
            <!-- </div> -->
            <!-- Add dropdown // 11/29/2022 -->
            <?php else:
                        ?>
            <div class="d-flex align-items-center justify-content-center">
                <form target="_blank" method="get">
                    <input type="hidden" value="<?php echo $id; ?>" name="id">
                    <input type="hidden" value="2" name="score_candidate">
                    <select class="form-select" name="phase" id="cand_phase">
                        <option value="<?php echo $_GET['phase']; ?>" selected disabled>--
                            <?php echo phase_name($_GET['phase']); ?> --</option>
                        <?php  
                                $find_iff_phase = find_iff_phase($id);
                                foreach($find_iff_phase as $keyss): ?>
                        <?php if($keyss['phase'] != $_GET['phase']): ?>
                        <?php 
                                        $interviewer_id = $keyss['i_id']; 
                                        $phase_status = $keyss['status'];
                                    ?>
                        <option value="<?php echo $keyss['phase']; ?>"><?php echo phase_name($keyss['phase']); ?>
                        </option>

                        <?php endif; endforeach; ?>
                    </select>
                    <input type="hidden" value="<?php echo $interviewer_id; ?>" name="interviewer_id">

            </div>
            <button type="submit" id="" name=""
                class="mx-2 btn btn-payreto-darkblue-900 text-white my-2 my-sm-0">Search</button>
            <?php endif; ?>
            </form>
        </div>


    </div>

    </div>
    <?php 
    $https = 'https://'
    ?>
    <!-- Candidate Profile Card -->
    <section class="d-flex justify-content-center m-auto shadow">
        <div class="card px-4">
            <div class="card-body">
                <h3 class="fw-bold text-payreto-darkblue-900">Candidate Profile</h3>
                <div class="row">
                    <div class="d-none">
                        <input type="text" readonly id="c_id" class="form-control" value="<?php echo $id ?>">
                        <input type="text" readonly id="i_id" class="form-control"
                            value="<?php echo $interviewer_id ?>">
                        <input type="text" readonly id="phase" class="form-control"
                            value="<?php echo $interview_phase ?>">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Candidate Name:</label>
                        <input type="text" readonly class="form-control" value="<?php echo $iff['c_name'] ?>">
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Date & Time:</label>
                        <input type="text" readonly class="form-control" value="<?php echo $iff['c_appli'] ?>">
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Applying For:</label>
                        <input type="text" readonly class="form-control" value="<?php echo $iff['p_name'] ?>">
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">School:</label>
                        <input type="text" readonly class="form-control" value="<?php echo $iff['c_school'] ?>">
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Interviewer:</label>
                        <input type="text" readonly class="form-control"
                            value="<?php if(!empty($interviewer_name)){echo $interviewer_name;}else{echo "---";}?>">
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Source:</label>
                        <input type="text" readonly class="form-control" value="<?php echo $iff['s_name']?>">
                    </div>
                    <div class="col-12 col-md-3">
                        <div style="margin-bottom:2.5rem;"></div>
                        <div class="d-flex justify-content-around mx-2">
                            <div>
                                <input class="form-check-label" type="radio" name="c_actpas"
                                    <?php if ($iff['c_actpas'] == "Active") echo 'checked'; else '' ?> value="Active"
                                    disabled>
                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Active</label>
                            </div>
                            <div>
                                <input class="form-check-label" type="radio" name="c_actpas"
                                    <?php if ($iff['c_actpas'] == "Passive") echo 'checked'; else '' ?> value="Passive"
                                    disabled>
                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Passive</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Email Address:</label>
                        <input type="text" readonly class="form-control" value="<?php echo $iff['c_eaddr'] ?>">
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Course:</label>
                        <input type="text" readonly class="form-control" value="<?php echo $iff['c_course'] ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Department - Team:</label>
                        <input type="text" readonly class="form-control"
                            value="<?php echo $iff['d_name'].' - '.$iff['d_team'] ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Application Folder:</label>
                        <a readonly
                            onclick="window.open('<?php echo $https.$iff['c_folder'] ?>','newwindow','width=1920,height=1080'); return false;"
                            class="pointer-event form-control text-left pe-auto"><?php echo $iff['c_folder'] ?></a>
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
                                <!-- Added Row class and change col to 5 5 3 3 3 -->
                                <!-- Cognitive Score -->
                                <div class="col-12 col-md-5 text-center mx-1">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Cognitive
                                        Score</label>
                                    <div class="d-flex">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['cog_1'] ?>">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['cog_2'] ?>">
                                    </div>
                                </div>
                                <!-- Cognitive Score End -->

                                <!-- Raw Score -->
                                <div class="col-12 col-md-5 text-center mx-1">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Raw Score</label>
                                    <div class="d-flex">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['raw_1'] ?>">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['raw_2'] ?>">
                                    </div>
                                </div>
                                <!-- Raw Score End -->

                                <!-- Verbal Score -->
                                <div class="col-12 col-md-3 text-center mx-1">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Verbal Score</label>
                                    <div class="d-flex">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['verb_1'] ?>">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['verb_2'] ?>">
                                    </div>
                                </div>
                                <!-- Verbal Score End -->

                                <!-- Numeric Score -->
                                <div class="col-12 col-md-3 text-center">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Numeric
                                        Score</label>
                                    <div class="d-flex">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['num_1'] ?>">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['num_2'] ?>">
                                    </div>
                                </div>
                                <!-- Numeric Score End -->

                                <!-- Abstract Score -->
                                <div class="col-12 col-md-3 text-center">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Abstract Reasoning
                                        Score</label>
                                    <div class="d-flex">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['abs_1'] ?>">
                                        <input class="form-control text-center mx-1" type="text" readonly
                                            value="<?php echo $iff['abs_2'] ?>">
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
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Behavioral
                                            Profile</label>
                                        <input type="text" readonly class="form-control"
                                            value="<?php echo $iff['beh_pro'] ?>">
                                    </div>
                                    <!-- Behavioral Profile End -->

                                    <!-- Dominance A -->
                                    <div class="col-12 col-md-2 text-center mx-1">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dominance
                                            A</label>
                                        <input type="text" readonly class="form-control"
                                            value="<?php echo $iff['beh_a'] ?>">
                                    </div>
                                    <!-- Dominance A End -->

                                    <!-- Extraversion B -->
                                    <div class="col-12 col-md-2 text-center mx-1">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Extraversion
                                            B</label>
                                        <input type="text" readonly class="form-control"
                                            value="<?php echo $iff['beh_b'] ?>">
                                    </div>
                                    <!-- Extraversion B End -->

                                    <!-- Patience C -->
                                    <div class="col-12 col-md-2 text-center mx-1">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Patience
                                            C</label>
                                        <input type="text" readonly class="form-control"
                                            value="<?php echo $iff['beh_c'] ?>">
                                    </div>
                                    <!-- Patience C End -->

                                    <!-- Formality D -->
                                    <div class="col-12 col-md-2 text-center mx-1">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Formality
                                            D</label>
                                        <input type="text" readonly class="form-control"
                                            value="<?php echo $iff['beh_d'] ?>">
                                    </div>
                                    <!-- Formality D End -->

                                    <!-- Orientation A&B -->
                                    <div class="col-12 col-md-2 text-center mx-1">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Orientation
                                            A&B</label>
                                        <input type="text" readonly class="form-control"
                                            value="<?php echo $iff['beh_ab'] ?>">
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
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Behavioral
                                        Category</label>
                                    <input type="text" readonly class="form-control"
                                        value="<?php echo $iff['beh_cat'] ?>">
                                </div>
                                <!-- Behavioral Category End -->

                                <!-- Action A&C -->
                                <div class="col-12 col-md-2 text-center mx-1">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Action A&C</label>
                                    <input type="text" readonly class="form-control"
                                        value="<?php echo $iff['beh_ac'] ?>">
                                </div>
                                <!-- Action A&C End -->

                                <!-- Risk A&D -->
                                <div class="col-12 col-md-2 text-center mx-1">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Risk A&D</label>
                                    <input type="text" readonly class="form-control"
                                        value="<?php echo $iff['beh_ad'] ?>">
                                </div>
                                <!-- Risk A&D End -->

                                <!-- Connection B&C -->
                                <div class="col-12 col-md-2 text-center mx-1">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Connection
                                        B&C</label>
                                    <input type="text" readonly class="form-control"
                                        value="<?php echo $iff['beh_bc'] ?>">
                                </div>
                                <!-- Connection B&C End -->

                                <!-- Interaction B&D -->
                                <div class="col-12 col-md-2 text-center mx-1">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Interaction
                                        B&D</label>
                                    <input type="text" readonly class="form-control"
                                        value="<?php echo $iff['beh_bd'] ?>">
                                </div>
                                <!-- Interaction B&D End -->

                                <!-- Rules C&D -->
                                <div class="col-12 col-md-2 text-center mx-1">
                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Rules C&D</label>
                                    <input type="text" readonly class="form-control"
                                        value="<?php echo $iff['beh_cd'] ?>">
                                </div>
                                <!-- Rules C&D End -->
                            </div>
                        </section>
                        <!-- BEHAVIORAL ASSESSMENT 2ND ROW END -->
                    </div>
                    <!-- PERSONALITY PROFILE -->
                    <section>
                        <h4 class="fw-bold text-center text-payreto-darkblue-900 my-4">Personality Profile</h3>
                            <div class="d-flex justify-content-center">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Dominant Profile -->
                                        <div class="col-12 text-center mx-1">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dominant
                                                Profile</label>
                                            <div class="d-flex">
                                                <input class="form-control text-center mx-1 fw-bold" type="text"
                                                    readonly value="<?php echo $iff['dom_bird'] ?>">
                                            </div>
                                        </div>
                                        <!-- Dominant Profile End -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Dove -->
                                        <div class="col-12 text-center mx-1">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dove</label>
                                            <div class="d-flex">
                                                <input class="form-control text-center mx-1" type="text" readonly
                                                    value="<?php echo $iff['dove'] ?>%">
                                            </div>
                                        </div>
                                        <!-- Dove End -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Owl -->
                                        <div class="col-12 text-center mx-1">
                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Owl</label>
                                            <div class="d-flex">
                                                <input class="form-control text-center mx-1" type="text" readonly
                                                    value="<?php echo $iff['owl'] ?>%">
                                            </div>
                                        </div>
                                        <!-- Owl End -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Peacock -->
                                        <div class="col-12 text-center mx-1">
                                            <label
                                                class="col-form-label text-payreto-darkblue-900 fw-bold">Peacock</label>
                                            <div class="d-flex">
                                                <input class="form-control text-center mx-1" type="text" readonly
                                                    value="<?php echo $iff['peacock'] ?>%">
                                            </div>
                                        </div>
                                        <!-- Peacock End -->
                                    </div>
                                    <div class="col-6">
                                        <!-- Eagle -->
                                        <div class="col-12 text-center mx-1">
                                            <label
                                                class="col-form-label text-payreto-darkblue-900 fw-bold">Eagle</label>
                                            <div class="d-flex">
                                                <input class="form-control text-center mx-1" type="text" readonly
                                                    value="<?php echo $iff['eagle'] ?>%">
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
                        <button type="button" class="btn btn-primary btn-payreto-darkblue-900" data-bs-toggle="modal"
                            data-bs-target="#viewGuidelines">
                            VIEW GUIDELINES
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
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
                        <form name="smeForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="sme" value="1" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sme'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="sme" value="2" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sme'],2)) : '';?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="sme" value="3" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sme'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="sme" value="4" aria-label="..." <?php 
                                    // if($iff['sme'] == 4){ echo 'checked'; } else echo 'onclick="return false;"'
                                    ($getid != 1 ) ?  print_r(iff_validate_score($iff['sme'],4)) : '';
                                    ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="sme" value="5" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sme'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th scope="row" class="w-50">COMMUNICATION</th>
                        <form name="comForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="communication" value="1"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['com'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="communication" value="2"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['com'],2)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="communication" value="3"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['com'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="communication" value="4"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['com'],4)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="communication" value="5"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['com'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th scope="row" class="w-50">PROACTIVITY</th>
                        <form name="proForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="proactivity" value="1"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['pro'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="proactivity" value="2"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['pro'],2)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="proactivity" value="3"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['pro'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="proactivity" value="4"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['pro'],4)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="proactivity" value="5"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['pro'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th scope="row" class="w-50">COGNITIVE ABILITY</th>
                        <form name="cogForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="cognitive" value="1"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['cog'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="cognitive" value="2"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['cog'],2)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="cognitive" value="3"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['cog'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="cognitive" value="4"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['cog'],4)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="cognitive" value="5"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['cog'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th scope="row" class="w-50">SOLUTION DRIVEN</th>
                        <form name="solForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="sol_dri" value="1"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sol'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="sol_dri" value="2"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sol'],2)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="sol_dri" value="3"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sol'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="sol_dri" value="4"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sol'],4)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="sol_dri" value="5"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['sol'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th scope="row" class="w-50">INTEGRITY</th>
                        <form name="intForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="integrity" value="1"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['int_int'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="integrity" value="2"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['int_int'],2)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="integrity" value="3"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['int_int'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="integrity" value="4"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['int_int'],4)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="integrity" value="5"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['int_int'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th scope="row" class="w-50">OWNERSHIP</th>
                        <form name="ownForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="ownership" value="1"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['own'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="ownership" value="2"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['own'],2)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="ownership" value="3"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['own'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="ownership" value="4"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['own'],4)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="ownership" value="5"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['own'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th scope="row" class="w-50">LEADERSHIP POTENTIAL</th>
                        <form name="leadForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="leadership" value="1"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['lead'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="leadership" value="2"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['lead'],2)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="leadership" value="3"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['lead'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="leadership" value="4"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['lead'],4)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="leadership" value="5"
                                        aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['lead'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th scope="row" class="w-50">DESIRE FOR DEEPER LEARNING</th>
                        <form name="desForm">
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input " type="radio" name="dl" id="deeper-learning"
                                        value="1" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['ddl'],1)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="dl" id="deeper-learning"
                                        value="2" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['ddl'],2)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="dl" id="deeper-learning"
                                        value="3" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['ddl'],3)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="dl" id="deeper-learning"
                                        value="4" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['ddl'],4)) : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" type="radio" name="dl" id="deeper-learning"
                                        value="5" aria-label="..."
                                        <?php ($getid != 1 ) ?  print_r(iff_validate_score($iff['ddl'],5)) : ''; ?>>
                                </div>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
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
                        <td><textarea id="poscom" class="form-control" style="resize:none; height:350px;"
                                <?php (empty($_GET['score_candidate']) || $getid == 2) ? print_r('readonly') : ''; ?>><?php echo $iff['poscom']; ?></textarea>
                        </td>
                        <td><textarea id="negcom" class="form-control" style="resize:none; height:350px;"
                                <?php (empty($_GET['score_candidate']) || $getid == 2) ? print_r('readonly') : ''; ?>><?php echo $iff['negcom']; ?></textarea>
                        </td>
                        <td><textarea id="overcom" class="form-control" style="resize:none; height:350px;"
                                <?php (empty($_GET['score_candidate']) || $getid == 2) ? print_r('readonly') : ''; ?>><?php echo $iff['allcom']; ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <!-- ACTION -->
    <section class="mt-4">
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
                                <input class="form-control text-center mx-1 fw-bold" type="text" readonly value="<?php 
                                    if($interview_phase == "1") {
                                        echo "Initial";
                                    } elseif ($interview_phase == "2"){
                                        echo "Operation Team Lead";
                                    } elseif ($interview_phase == "3"){
                                        echo "Operation Manager";
                                    } elseif ($interview_phase == "4"){
                                        echo "Department Head";
                                    } elseif ($interview_phase == "5"){
                                        echo "Client";
                                    } elseif ($interview_phase == "6"){
                                        echo "Management";
                                    }
                                ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-6 align-items-center justify-content-center">
                        <div class="row align-items-center justify-content-center">
                            <?php if($getid == 1): ?>
                            <div class="col-12 d-flex flex-row align-items-center justify-content-center">
                                <button type="button" class="btn btn-primary btn-payreto-green-900 w-75 m-1"
                                    onclick="textArea()" data-bs-toggle="modal" data-bs-target="#confirm-passed">
                                    <p class="fw-bold m-0">PASSED</p>
                                </button>
                                <button type="button" class="btn btn-primary btn-payreto-bluegreen-900 w-75 m-1"
                                    onclick="textArea()" data-bs-toggle="modal" data-bs-target="#confirm-pooling">
                                    <p class="fw-bold m-0">FOR POOLING</p>
                                </button>
                            </div>
                            <div class="col-12 d-flex flex-row align-items-center justify-content-center">
                                <button type="button" class="btn btn-primary btn-payreto-red-900 w-75 m-1"
                                    onclick="textArea()" data-bs-toggle="modal" data-bs-target="#confirm-failed">
                                    <p class="fw-bold m-0">FAILED</p>
                                </button>
                                <button type="button" class="btn btn-primary btn-payreto-yellow-900 w-75 m-1"
                                    onclick="textArea()" data-bs-toggle="modal" data-bs-target="#confirm-discussion">
                                    <p class="fw-bold m-0">FOR DISCUSSION</p>
                                </button>
                            </div>
                            <div class="col-12 d-flex flex-row align-items-center justify-content-center">
                                <button type="button" class="btn btn-primary btn-payreto-gray-900 w-100 m-1"
                                    data-bs-toggle="modal" data-bs-target="#confirm-reset">
                                    <p class="fw-bold m-0">RESET</p>
                                </button>
                            </div>
                            <?php else: ?>
                            <div class="col-3 d-flex align-items-center justify-content-center">
                                <h5 class="fw-bold text-payreto-darkblue-900 ">Decision</h5>
                            </div>
                            <div class="col-9">
                                <input type="text" class="form-control" placeholder="<?php echo find_decision(); ?>"
                                    disabled>
                            </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="padding-bottom: 5rem;">

    </section>
</section>
<script>
$(document).on('change', '#cand_phase', function() {
    var parent = $(this).val();
    $(this).closest('tr').find('#cand_list_int').children().each(function() {
        if ($(this).data('parent') != parent) {
            $(this).hide();
            console.log(parent);
        } else
            $(this).show();
    });
});
</script>
<!-- fetches the value of the radiobutton selected -->
<script>
var c_id = document.getElementById('c_id').value;
c_id = c_id.trim();
var i_id = document.getElementById('i_id').value;
var phase = document.getElementById('phase').value;

function textArea() {
    var poscom = document.getElementById('poscom').value;
    var negcom = document.getElementById('negcom').value;
    var overcom = document.getElementById('overcom').value;

    document.getElementById("pass_poscom").value = poscom;
    document.getElementById("pool_poscom").value = poscom;
    document.getElementById("fail_poscom").value = poscom;
    document.getElementById("disc_poscom").value = poscom;

    document.getElementById("pass_negcom").value = negcom;
    document.getElementById("pool_negcom").value = negcom;
    document.getElementById("fail_negcom").value = negcom;
    document.getElementById("disc_negcom").value = negcom;

    document.getElementById("pass_overcom").value = overcom;
    document.getElementById("pool_overcom").value = overcom;
    document.getElementById("fail_overcom").value = overcom;
    document.getElementById("disc_overcom").value = overcom;
}

document.getElementById("pass_c_id").value = c_id;
document.getElementById("pool_c_id").value = c_id;
document.getElementById("fail_c_id").value = c_id;
document.getElementById("disc_c_id").value = c_id;
document.getElementById("pass_i_id").value = i_id;
document.getElementById("pool_i_id").value = i_id;
document.getElementById("fail_i_id").value = i_id;
document.getElementById("disc_i_id").value = i_id;

document.getElementById("pass_phase").value = phase;
document.getElementById("pool_phase").value = phase;
document.getElementById("fail_phase").value = phase;
document.getElementById("disc_phase").value = phase;

var sme = document.smeForm.sme;
var sme_prev = null;
for (var i = 0; i < sme.length; i++) {
    sme[i].addEventListener('change', function() {
        (sme_prev) ? console.log(sme_prev.value): null;
        if (this !== sme_prev) {
            sme_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_sme").value = this.value;
        document.getElementById("pool_sme").value = this.value;
        document.getElementById("fail_sme").value = this.value;
        document.getElementById("disc_sme").value = this.value;
    });
}

var com = document.comForm.communication;
var com_prev = null;
for (var i = 0; i < com.length; i++) {
    com[i].addEventListener('change', function() {
        (com_prev) ? console.log(com_prev.value): null;
        if (this !== com_prev) {
            com_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_com").value = this.value;
        document.getElementById("pool_com").value = this.value;
        document.getElementById("fail_com").value = this.value;
        document.getElementById("disc_com").value = this.value;
    });
}

var pro = document.proForm.proactivity;
var pro_prev = null;
for (var i = 0; i < pro.length; i++) {
    pro[i].addEventListener('change', function() {
        (pro_prev) ? console.log(pro_prev.value): null;
        if (this !== pro_prev) {
            pro_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_pro").value = this.value;
        document.getElementById("pool_pro").value = this.value;
        document.getElementById("fail_pro").value = this.value;
        document.getElementById("disc_pro").value = this.value;
    });
}

var cog = document.cogForm.cognitive;
var cog_prev = null;
for (var i = 0; i < cog.length; i++) {
    cog[i].addEventListener('change', function() {
        (cog_prev) ? console.log(cog_prev.value): null;
        if (this !== cog_prev) {
            cog_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_cog").value = this.value;
        document.getElementById("pool_cog").value = this.value;
        document.getElementById("fail_cog").value = this.value;
        document.getElementById("disc_cog").value = this.value;
    });
}

var sol = document.solForm.sol_dri;
var sol_prev = null;
for (var i = 0; i < sol.length; i++) {
    sol[i].addEventListener('change', function() {
        (sol_prev) ? console.log(sol_prev.value): null;
        if (this !== sol_prev) {
            sol_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_sol").value = this.value;
        document.getElementById("pool_sol").value = this.value;
        document.getElementById("fail_sol").value = this.value;
        document.getElementById("disc_sol").value = this.value;
    });
}

var int = document.intForm.integrity;
var int_prev = null;
for (var i = 0; i < int.length; i++) {
    int[i].addEventListener('change', function() {
        (int_prev) ? console.log(int_prev.value): null;
        if (this !== int_prev) {
            int_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_int").value = this.value;
        document.getElementById("pool_int").value = this.value;
        document.getElementById("fail_int").value = this.value;
        document.getElementById("disc_int").value = this.value;
    });
}

var own = document.ownForm.ownership;
var own_prev = null;
for (var i = 0; i < own.length; i++) {
    own[i].addEventListener('change', function() {
        (own_prev) ? console.log(own_prev.value): null;
        if (this !== own_prev) {
            own_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_own").value = this.value;
        document.getElementById("pool_own").value = this.value;
        document.getElementById("fail_own").value = this.value;
        document.getElementById("disc_own").value = this.value;
    });
}

var lead = document.leadForm.leadership;
var lead_prev = null;
for (var i = 0; i < lead.length; i++) {
    lead[i].addEventListener('change', function() {
        (lead_prev) ? console.log(lead_prev.value): null;
        if (this !== lead_prev) {
            lead_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_lead").value = this.value;
        document.getElementById("pool_lead").value = this.value;
        document.getElementById("fail_lead").value = this.value;
        document.getElementById("disc_lead").value = this.value;
    });
}

var des = document.desForm.dl;
var des_prev = null;
for (var i = 0; i < des.length; i++) {
    des[i].addEventListener('change', function() {
        (des_prev) ? console.log(des_prev.value): null;
        if (this !== des_prev) {
            des_prev = this;
        }
        console.log(this.value)
        document.getElementById("pass_des").value = this.value;
        document.getElementById("pool_des").value = this.value;
        document.getElementById("fail_des").value = this.value;
        document.getElementById("disc_des").value = this.value;
    });
}
</script>