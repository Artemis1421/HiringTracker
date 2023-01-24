<div class="modal fade" id="editPosition" tabindex="-1" aria-labelledby="editPositionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-payreto-darkblue-900" id="editPositionLabel">Edit Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="position_validation.php">
                        <div class="row">
                            <div class="d-none">
                                <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">ID:</label>
                                <input type="text" required class="form-control" id="edit_position_id" name="p_id">
                            </div>
                            <div class="mb-3 col col-md-12">
                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Department:</label>
                                <select class="form-select" aria-label="Default select example" id="edit_position_department" name='p_department'>
                                    <option selected>-- Select Department --</option>
                                    <?php 
                                        $department_db = find_department_search();
                                        foreach ($department_db as $department_search) :
                                    ?>
                                        <option value="<?php echo $department_search['d_id'] ?>"><?php echo $department_search['d_name'].' - '.$department_search['d_team'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 col col-md-12">
                                <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Position Name:</label>
                                <input type="text" required class="form-control" id="edit_position_name" name="p_name">
                            </div>
                            <div class="mb-3 col col-md-12">
                                <label class="col-form-label text-payreto-darkblue-900 fw-bold">Requisition Type:</label>
                                <select class="form-select" aria-label="Default select example" name='p_req' id="edit_position_type" disabled>
                                    <option value="0">-- Select Requisition Type --</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Intern">Intern</option>
                                </select>
                            </div>
                            <div class="mb-3 col col-md-12">
                                <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Requisition Count:</label>
                                <input type="number" required class="form-control" id="edit_position_count" name="p_count" placeholder="2" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center my-2">
                        <button type="button" class="btn btn-outline-secondary mx-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-payreto-darkblue-900 mx-2" name="editPositionButton">Save</button>
                    </div>
                </form>
            </div>
        </div>
</div>