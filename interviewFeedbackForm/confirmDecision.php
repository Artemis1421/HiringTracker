<div class="modal fade" id="confirm-passed" tabindex="-1" aria-labelledby="confirm-passed" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="iff_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-passed">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>PASSED</b> as your decision?</p>
                    <div class="d-flex justify-content-center align-items-center py-2">
                        <i class="fa-solid fa-2xl fa-triangle-exclamation"></i>
                    </div>
                    <p class="mt-3 text-center">Clicking yes would automatically close this tab.</p>
                </div>
                <div class="d-none">
                    <input type="text" id="pass_sme" name="sme">
                    <input type="text" id="pass_com" name="com">
                    <input type="text" id="pass_pro" name="pro">
                    <input type="text" id="pass_cog" name="cog">
                    <input type="text" id="pass_sol" name="sol">
                    <input type="text" id="pass_int" name="int">
                    <input type="text" id="pass_own" name="own">
                    <input type="text" id="pass_lead" name="lead">
                    <input type="text" id="pass_des" name="dl">
                    <input type="text" id="pass_c_id" name="c_id">
                    <input type="text" id="pass_i_id" name="i_id">
                    <input type="text" id="pass_phase" name="phase">
                    <input type="text" id="pass_poscom" name="poscom">
                    <input type="text" id="pass_negcom" name="negcom">
                    <input type="text" id="pass_overcom" name="overcom">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="passButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-pooling" tabindex="-1" aria-labelledby="confirm-pooling" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="iff_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-pooling">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>FOR POOLING</b> as your decision?</p>
                    <div class="d-flex justify-content-center align-items-center py-2">
                        <i class="fa-solid fa-2xl fa-triangle-exclamation"></i>
                    </div>
                    <p class="mt-3 text-center">Clicking yes would automatically close this tab.</p>
                </div>
                <div class="d-none">
                    <input type="text" id="pool_sme" name="sme">
                    <input type="text" id="pool_com" name="com">
                    <input type="text" id="pool_pro" name="pro">
                    <input type="text" id="pool_cog" name="cog">
                    <input type="text" id="pool_sol" name="sol">
                    <input type="text" id="pool_int" name="int">    
                    <input type="text" id="pool_own" name="own">
                    <input type="text" id="pool_lead" name="lead">
                    <input type="text" id="pool_des" name="dl">
                    <input type="text" id="pool_c_id" name="c_id">
                    <input type="text" id="pool_i_id" name="i_id">
                    <input type="text" id="pool_phase" name="phase">
                    <input type="text" id="pool_poscom" name="poscom">
                    <input type="text" id="pool_negcom" name="negcom">
                    <input type="text" id="pool_overcom" name="overcom">
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
            <form method="post" action="iff_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-failed">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>FAILED</b> as your decision?</p>
                    <div class="d-flex justify-content-center align-items-center py-2">
                        <i class="fa-solid fa-2xl fa-triangle-exclamation"></i>
                    </div>
                    <p class="mt-3 text-center">Clicking yes would automatically close this tab.</p>
                </div>
                <div class="d-none">
                    <input type="text" id="fail_sme" name="sme">
                    <input type="text" id="fail_com" name="com">
                    <input type="text" id="fail_pro" name="pro">
                    <input type="text" id="fail_cog" name="cog">
                    <input type="text" id="fail_sol" name="sol">
                    <input type="text" id="fail_int" name="int">
                    <input type="text" id="fail_own" name="own">
                    <input type="text" id="fail_lead" name="lead">
                    <input type="text" id="fail_des" name="dl">
                    <input type="text" id="fail_c_id" name="c_id">
                    <input type="text" id="fail_i_id" name="i_id">
                    <input type="text" id="fail_phase" name="phase">
                    <input type="text" id="fail_poscom" name="poscom">
                    <input type="text" id="fail_negcom" name="negcom">
                    <input type="text" id="fail_overcom" name="overcom">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="failButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-discussion" tabindex="-1" aria-labelledby="confirm-discussion" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="iff_validation.php">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-discussion">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you have chosen <b>FOR DISCUSSION</b> as your decision?</p>
                    <div class="d-flex justify-content-center align-items-center py-2">
                        <i class="fa-solid fa-2xl fa-triangle-exclamation"></i>
                    </div>
                    <p class="mt-3 text-center">Clicking yes would automatically close this tab.</p>
                </div>
                <div class="d-none">
                    <input type="text" id="disc_sme" name="sme">
                    <input type="text" id="disc_com" name="com">
                    <input type="text" id="disc_pro" name="pro">
                    <input type="text" id="disc_cog" name="cog">
                    <input type="text" id="disc_sol" name="sol">
                    <input type="text" id="disc_int" name="int">
                    <input type="text" id="disc_own" name="own">
                    <input type="text" id="disc_lead" name="lead">
                    <input type="text" id="disc_des" name="dl">
                    <input type="text" id="disc_c_id" name="c_id">
                    <input type="text" id="disc_i_id" name="i_id">
                    <input type="text" id="disc_phase" name="phase">
                    <input type="text" id="disc_poscom" name="poscom">
                    <input type="text" id="disc_negcom" name="negcom">
                    <input type="text" id="disc_overcom" name="overcom">
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="discButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-reset" tabindex="-1" aria-labelledby="confirm-reset" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="confirm-reset">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <b>RESET</b> the entire form?</p>
                    <div class="d-flex justify-content-center align-items-center py-2">
                        <i class="fa-solid fa-2xl fa-triangle-exclamation"></i>
                    </div>
                    <p class="mt-3 text-center">Clicking yes would automatically close this tab.</p>
                </div>
                <div class="modal-footer d-flex justify-content-center my-2">
                    <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="resetFormButton">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>