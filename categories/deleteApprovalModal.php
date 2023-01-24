<div class="modal fade" id="deleteApproval" tabindex="-1" aria-labelledby="deleteApprovalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteApprovalLabel">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="approval_validation.php">
                    Are you sure you want to delete this field1? This action cannot be undone.
                    <div class="d-none">
                        <input type="text" required class="form-control" id="decline_iff_id" name="iff_id">
                    </div>
                    <div>
                        <p>Do you want to send the decision to candidate?</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sendEmail" id="inlineRadio1"
                                value="Yes">
                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sendEmail" id="inlineRadio2"
                                value="No">
                            <label class="form-check-label" for="inlineRadio2">No</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-center my-2">
                <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="deleteIFFButton">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>