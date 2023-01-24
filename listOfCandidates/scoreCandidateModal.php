<script>
    function scoreCandidate(){
        var iff_id = document.getElementById('id_score').value;
        console.log(iff_id);
    }
</script>

<div class="modal fade" id="scoreCandidate" tabindex="-1" aria-labelledby="scoreCandidateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="scoreCandidateLabel">Score Candidate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="listOfCandidates_validation.php">
                    <div class="row">
                        <div class="mb-3 col col-md-12">
                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Interviewer Name:</label>
                            <select required class="form-select" name="i_id" aria-label="Default select example" id="select_interviewer" required>
                                <option value="">-- Select Interviewer --</option>
                                <?php 
                                    $checkers = phase_passed_checker();
                                    $interviewer_db = find_interviewer_search();
                                    foreach ($interviewer_db as $interviewer_search) :
                                ?>
                                <option value="<?php echo $interviewer_search['i_id'] ?>"><?php echo $interviewer_search['i_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label class="col-form-label text-payreto-darkblue-900 fw-bold">Interview Phase:</label>
                            <select required class="form-select" name="i_phase" aria-label="Default select example" id="select_phase" onclick="ClickMe()" required>
                                <option value="">-- Select Phase --</option>
                                <option value="1">Initial </option>
                                <option value="2">Operation - Team Lead</option>
                                <option value="3">Operation - Manager</option>
                                <option value="4">Exam</option>
                                <option value="5">Department Head</option>
                                <option value="6">Client</option>
                                <option value="7">Management</option>
                            </select>
                        </div>
                        <div class="mb-3 col col-md-12" style="display:none">
                            <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Candidate ID:</label>
                            <input type="text" required class="form-control" name="c_id" id="id_score">
                        </div>
                        <div class="text-center fs-6 fst-italic">
                            
                            <!-- <a class="card-link text-muted" style="cursor: pointer;" onclick="window.open('../interviewFeedbackForm/iff.php?id=' + document.getElementById('id_score').value + '&interviewer_id=' + interviewer + '&phase=' + phase)" class="scoreCandidate">Click Here</a><span class="text-muted"> to view the Interview Feedback Form   of the candidate.</span> -->
                            
                        </div>
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-center my-2">
                <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="scoreCandidateButton">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div>
<?php include 'passedPhaseModal.php'; ?>
</div>
<!-- Disable link if there's no va -->

<!-- Disable the passed phase of candidate -->
<script>
    var passed_P = [];
    $('#select_phase').change(function(){
        console.log(this.value);
        for(let i = 0; i < passed_P.length; i++){
            if(this.value == passed_P[i]){
            $('#select_phase').prop('selectedIndex',0);
            $('#passedPhase').modal('show');
        }
        }
        passed_P = [];
    });
    function ClickMe(){
        var phase_arr = [];
        const cand_Id = document.getElementById('id_score').value;
        const checker = <?php echo json_encode($checkers); ?>;
        //console.log(checker);
        //console.log(cand_Id);
        for(let i = 0; i < checker.length; i++){
            if(cand_Id == checker[i]['c_id'] && checker[i]['status'] == 'Passed')
            {
                document.querySelectorAll("#select_phase option").forEach(opt => {
                    if (opt.value == checker[i]['phase']) {
                        //opt.disabled = true;
                        //$('#scoreCandidate').modal('show');
                        //opt.style.color = "red";
                        passed_P.push(opt.value);
                    }
                });
            }
        }
    }
</script>

<script>
    var interviewer = "";
    var phase = "";

    $('#select_interviewer').change(function(){
        interviewer = $(this).val();

        console.log(interviewer);
    });

    $('#select_phase').change(function(){
        phase = $(this).val();

        console.log(phase);
    });
</script>