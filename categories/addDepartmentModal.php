<div class="modal fade" id="addDepartment" tabindex="-1" aria-labelledby="addDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="addDepartmentLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="department_validation.php">
                    <div class="row">
                        <div class="mb-3 col col-md-12">
                            <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Department:</label>
                            <input type="text" required class="form-control" name="d_name">
                        </div>
                        <div class="mb-3 col col-md-12">
                            <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Team:</label>
                            <input type="text" required class="form-control" name="d_team">
                        </div>
                    </div>
            </div>
            <div class="modal-footer d-flex justify-content-center my-2">
                <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="addDepartmentButton">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
