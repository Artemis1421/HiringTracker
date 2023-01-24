<div class="modal fade" id="deleteInterviewer" tabindex="-1" aria-labelledby="deleteInterviewerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <form method="post" action="interviewer_validation.php">
                    Are you sure do you want to permanently delete this field?
                    <div class="d-none">
                        <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">ID:</label>
                        <input type="text" required class="form-control" id="delete_interviewer_id" name="i_id">
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-center my-2">
                <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="deleteInterviewerButton">Confirm</button>
            </div>
        </div>
    </div>
</div>