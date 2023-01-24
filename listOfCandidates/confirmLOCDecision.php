<div class="modal fade" id="confirm-passed" tabindex="-1" aria-labelledby="confirm-passed" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="finalDecision_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-passed">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>PASSED</b> as your decision?</p>
                </div>
                <div class="d-none">
                    <input type="text" name="c_id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="passButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-job-offer" tabindex="-1" aria-labelledby="confirm-job-offer" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="finalDecision_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-job-offer">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>JOB OFFER</b> as your decision?</p>
                </div>
                <div class="d-none">
                    <input type="text" name="c_id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="jobButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-unresponsive" tabindex="-1" aria-labelledby="confirm-unresponsive" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="finalDecision_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-unresponsive">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>UNRESPONSIVE</b> as your decision?</p>
                </div>
                <div class="d-none">
                    <input type="text" name="c_id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="unresponsiveButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="confirm-for-pooling" tabindex="-1" aria-labelledby="confirm-for-pooling" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="finalDecision_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-for-pooling">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>FOR FOOLING</b> as your decision?</p>
                </div>
                <div class="d-none">
                    <input type="text" name="c_id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="poolButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-failed" tabindex="-1" aria-labelledby="confirm-failed" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="finalDecision_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-failed">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>FAILED</b> as your decision?</p>
                </div>
                <div class="d-none">
                    <input type="text" name="c_id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="failButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-withdrawn" tabindex="-1" aria-labelledby="confirm-withdrawn" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="finalDecision_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-withdrawn">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>WITHDRAWN</b> as your decision?</p>
                </div>
                <div class="d-none">
                    <input type="text" name="c_id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="withdrawnButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-job-accept" tabindex="-1" aria-labelledby="confirm-job-accept" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="finalDecision_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-job-accept">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>ACCEPTED</b> for job offer as your decision?</p>
                </div>
                <div class="d-none">
                    <input type="text" name="c_id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="jobAcceptButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-job-decline" tabindex="-1" aria-labelledby="confirm-job-decline" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="finalDecision_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-job-decline">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>DECLINED</b> for job offer as your decision?</p>
                </div>
                <div class="d-none">
                    <input type="text" name="c_id" value="<?php echo $_GET['id'] ?>">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="jobDeclineButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>