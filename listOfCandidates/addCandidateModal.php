<div class="modal fade" id="addCandidate" tabindex="-1" aria-labelledby="addCandidateLabel" aria-hidden="true">
    <form action="addCandidate_db.php" method="post">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="addCandidateLabel">Add Candidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body container">
                    <!-- Candidate Profile Card -->
                    <section class="d-flex justify-content-center m-auto">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="fw-bold text-payreto-darkblue-900">Candidate Profile</h3>
                                <div class="row">
                                    <!-- 1st Row -->
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Candidate Name:</label>
                                        <input type="text" required name="c_name" class="form-control" id="c_name">
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <?php 
                                            $date = date('Y-m-d H:i:s');
                                        ?>
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Date & Time:</label>
                                        <input type="text" required name="c_appli" class="form-control" value="<?php echo $date ?>" id="c_appli">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Applying For:</label>
                                        <select class="form-select" name="p_id" aria-label="Default select example" required>
                                            <option value="">-- Select Position --</option>
                                            <?php 
                                                $position_db = find_position_search();
                                                foreach ($position_db as $position_search) :
                                            ?>
                                                <option value="<?php echo $position_search['p_id'] ?>"><?php echo $position_search['p_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">School:</label>
                                        <input type="text" required name="c_school" class="form-control" id="c_school">
                                    </div>
                                    <!-- End 1st Row -->

                                    <!-- 2nd Row -->
                                    <div class="col-12 col-md-4">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Source:</label>
                                        <select class="form-select" aria-label="Default select example" name='s_id' required>
                                            <option value="" selected>-- Sources --</option>
                                            <?php 
                                                $source_db = find_source_search();
                                                foreach ($source_db as $source_search) :
                                            ?>
                                                <option value="<?php echo $source_search['s_id'] ?>"><?php echo $source_search['s_name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div style="margin-bottom:2.5rem;"></div>
                                        <div class="d-flex justify-content-around mx-2">
                                            <div>
                                                <input class="form-check-label" type="radio" name="c_actpas" id="" value="Active" requied> 
                                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Active</label>
                                            </div>
                                            <div>
                                                <input class="form-check-label" type="radio" name="c_actpas" id="" value="Passive" required> 
                                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Passive</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Email Address:</label>
                                        <input type="text" required name="c_eaddr" class="form-control" id="c_eaddr">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Course:</label>
                                        <input type="text" required name="c_course" class="form-control" id="c_course">
                                    </div>
                                    <!-- End 2nd Row -->

                                    <!-- 3rd Row -->
                                    <div class="col-12 col-md-6">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Department - Team:</label>
                                        <select class="form-select" aria-label="Default select example" name='d_id' required>
                                            <option selected value="">-- Select Department & Team --</option>
                                            <?php 
                                                $department_db = find_department_search();
                                                foreach ($department_db as $department_search) :
                                            ?>
                                                <option value="<?php echo $department_search['d_id'] ?>"><?php echo $department_search['d_name'].' - '.$department_search['d_team'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Application Folder:</label>
                                        <input type="text" required name="c_folder" class="form-control" id="c_folder">
                                    </div>
                                    <!-- End 3rd Row -->
                                </div>
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
                                        <!-- COGNITIVE ASSESSMENT -->
                                        <section>
                                            <h4 class="fw-bold text-center text-payreto-darkblue-900 my-4">Cognitive Assessment</h4>
                                            <div class="row d-block d-md-flex justify-content-center">
                                                <!-- Cognitive Score -->
                                                <div class="col-12 col-md-5 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Cognitive Score</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" required type="number" name="cog_1">
                                                        <input class="form-control text-center mx-1" placeholder="Total" required type="number" name="cog_2">
                                                    </div>
                                                </div>
                                                <!-- Cognitive Score End -->

                                                <!-- Raw Score -->
                                                <div class="col-12 col-md-5 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Raw Score</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" required type="number" name="raw_1">
                                                        <input class="form-control text-center mx-1" placeholder="Total" required type="number" name="raw_2">
                                                    </div>
                                                </div>
                                                <!-- Raw Score End -->

                                                <!-- Verbal Score -->
                                                <div class="col-12 col-md-3 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Verbal</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" required type="number" name="verb_1">
                                                        <input class="form-control text-center mx-1" placeholder="Total" required type="number" name="verb_2">
                                                    </div>
                                                </div>
                                                <!-- Verbal Score End -->

                                                <!-- Numeric Score -->
                                                <div class="col-12 col-md-3 text-center">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Numeric</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" required type="number" name="num_1">
                                                        <input class="form-control text-center mx-1" placeholder="Total" required type="number" name="num_2">
                                                    </div>
                                                </div>
                                                <!-- Numeric Score End -->

                                                <!-- Abstract Score -->
                                                <div class="col-12 col-md-3 text-center">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Abstract Reasoning</label>
                                                    <div class="d-flex">
                                                        <input class="form-control text-center mx-1" placeholder="Raw" required type="number" name="abs_1">
                                                        <input class="form-control text-center mx-1" placeholder="Total" required type="number" name="abs_2">
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
                                                            <option selected></option>
                                                            <option value="Adapter">Adapter</option>
                                                            <option value="Altruist">Altruist</option>
                                                            <option value="Analyzer">Analyzer</option>
                                                            <option value="Captain">Captain</option>
                                                            <option value="Collaborator">Collaborator</option>
                                                            <option value="Controller">Controller</option>
                                                            <option value="Craftsman">Craftsman</option>
                                                            <option value="Guardian">Guardian</option>
                                                            <option value="Individualist">Individualist</option>
                                                            <option value="Maverick">Maverick</option>
                                                            <option value="Operator">Operator</option>
                                                            <option value="Persuader">Persuader</option>
                                                            <option value="Promoter">Promoter</option>
                                                            <option value="Scholar">Scholar</option>
                                                            <option value="Scpecialist">Scpecialist</option>
                                                            <option value="Strategist">Strategist</option>
                                                            <option value="Venturer">Venturer</option>
                                                        </select>
                                                    </div>
                                                    <!-- Behavioral Profile End -->

                                                    <!-- Dominance A -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dominance A</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_a" required>
                                                            <option selected></option>
                                                            <option value="Collaborative">Collaborative</option>
                                                            <option value="Independent">Independent</option>
                                                            <option value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Dominance A End -->

                                                    <!-- Extraversion B -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Extraversion B</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_b" required>
                                                            <option selected></option>
                                                            <option value="Reserved">Reserved</option>
                                                            <option value="Sociable">Sociable</option>
                                                            <option value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Extraversion B End -->

                                                    <!-- Patience C -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Patience C</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_c" required>
                                                            <option selected></option>
                                                            <option value="Driving">Driving</option>
                                                            <option value="Steady">Steady</option>
                                                            <option value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Patience C End -->

                                                    <!-- Formality D -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Formality D</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_d" required>
                                                            <option selected></option>
                                                            <option value="Flexbile">Flexbile</option>
                                                            <option value="Precise">Precise</option>
                                                            <option value="Situational">Situational</option>
                                                        </select>
                                                    </div>
                                                    <!-- Formality D End -->

                                                    <!-- Orientation A&B -->
                                                    <div class="col-12 col-md-2 text-center mx-1">
                                                        <label class="col-form-label text-payreto-darkblue-900 fw-bold">Orientation A&B</label>
                                                        <select class="form-select" aria-label="Default select example" name="beh_ab" required>
                                                            <option selected></option>
                                                            <option value="People">People</option>
                                                            <option value="Task">Task</option>
                                                            <option value="Situational">Situational</option>
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
                                                        <option selected></option>
                                                        <option value="Analytical">Analytical</option>
                                                        <option value="Collaborative">Collaborative</option>
                                                        <option value="Persistent">Persistent</option>                                                        
                                                        <option value="Social">Social</option>
                                                        <option value="Stabilizing">Stabilizing</option>
                                                    </select>
                                                </div>
                                                <!-- Behavioral Category End -->

                                                <!-- Action A&C -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Action A&C</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_ac" required>
                                                        <option selected></option>
                                                        <option value="Proactive">Proactive</option>
                                                        <option value="Responsive">Responsive</option>
                                                        <option value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Action A&C End -->

                                                <!-- Risk A&D -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Risk A&D</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_ad" required>
                                                        <option selected></option>
                                                        <option value="Cautious">Cautious</option>
                                                        <option value="Comfortable">Comfortable</option>
                                                        <option value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Risk A&D End -->

                                                <!-- Connection B&C -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Connection B&C</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_bc" required>
                                                        <option selected></option>
                                                        <option value="Takes Time">Takes Time</option>
                                                        <option value="Quick">Quick</option>
                                                        <option value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Connection B&C End -->

                                                <!-- Interaction B&D -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Interaction B&D</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_bd" required>
                                                        <option selected></option>
                                                        <option value="Formal">Formal</option>
                                                        <option value="Informal">Informal</option>
                                                        <option value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Interaction B&D End -->

                                                <!-- Rules C&D -->
                                                <div class="col-12 col-md-2 text-center mx-1">
                                                    <label class="col-form-label text-payreto-darkblue-900 fw-bold">Rules C&D</label>
                                                    <select class="form-select" aria-label="Default select example" name="beh_cd" required>
                                                        <option selected></option>
                                                        <option value="Careful">Careful</option>
                                                        <option value="Casual">Casual</option>
                                                        <option value="Situational">Situational</option>
                                                    </select>
                                                </div>
                                                <!-- Rules C&D End -->
                                            </div>
                                        </section>
                                        <!-- BEHAVIORAL ASSESSMENT 2ND ROW END -->
                                    <!-- PERSONALITY PROFILE -->
                                    <section>
                                        <h4 class="fw-bold text-center text-payreto-darkblue-900 my-4">Personality Profile</h3>
                                            <div class="d-flex justify-content-center">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Dominant Profile -->
                                                        <div class="col-12 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dominant Profile</label>
                                                            <div class="d-flex">
                                                                <select class="form-select text-center" aria-label="Default select example" name="dom_bird" required>
                                                                    <option selected value="">-- Select Dominant Profile --</option>
                                                                    <option value="Dove">Dove</option>
                                                                    <option value="Owl">Owl</option>
                                                                    <option value="Peacock">Peacock</option>
                                                                    <option value="Eagle">Eagle</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Dominant Profile End -->
                                                    </div>
                                                    <div class="col-6">
                                                        <!-- Dove -->
                                                        <div class="col-12 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Dove</label>
                                                            <div class="d-flex">
                                                                <input class="form-control text-center mx-1" type="number" name="dove" required>
                                                            </div>
                                                        </div>
                                                        <!-- Dove End -->
                                                    </div>
                                                    <div class="col-6">
                                                        <!-- Owl -->
                                                        <div class="col-12 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Owl</label>
                                                            <div class="d-flex">
                                                                <input class="form-control text-center mx-1" type="number" name="owl" required>
                                                            </div>
                                                        </div>
                                                        <!-- Owl End -->
                                                    </div>
                                                    <div class="col-6">
                                                        <!-- Peacock -->
                                                        <div class="col-12 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Peacock</label>
                                                            <div class="d-flex">
                                                                <input class="form-control text-center mx-1" type="number" name="peacock" required>
                                                            </div>
                                                        </div>
                                                        <!-- Peacock End -->
                                                    </div>
                                                    <div class="col-6">
                                                        <!-- Eagle -->
                                                        <div class="col-12 text-center mx-1">
                                                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Eagle</label>
                                                            <div class="d-flex">
                                                                <input class="form-control text-center mx-1" type="number" name="eagle" required>
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
                    <!-- Predictive Index Card End-->
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                        <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="saveCandidateButton" >Save</button>
                </div>
                <?php

                ?>
            </div>
        </div>
    </form>
</div>