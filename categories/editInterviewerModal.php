<div class="modal fade" id="editInterviewer" tabindex="-1" aria-labelledby="editInterviewerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="editInterviewerLabel">Edit Interviewer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="interviewer_validation.php">
                        <div class="row">
                            <div class="d-none">
                                <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">ID:</label>
                                <input type="text" required class="form-control" id="edit_interviewer_id" name="i_id">
                            </div>
                            <div class="mb-3 col col-md-12">
                                <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Interviewer Name:</label>
                                <input type="text" required class="form-control" id="edit_interviewer_name" name="i_name">
                            </div>
                            <div class="mb-3 col col-md-12">
                                <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Interviewer Email:</label>
                                <input type="text" required class="form-control" id="edit_interviewer_email" name="i_email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center my-2">
                        <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="editInterviewerButton">Save</button>
                    </div>
                </form>
            </div>
        </div>
</div>