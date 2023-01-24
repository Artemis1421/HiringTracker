<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="profile_validation.php">
                    Are you sure you want to delete this field?
                    <div class="d-none">
                        <input type="text" class="form-control" id="id_delete" name="id" style="width: 100%;">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-payreto-darkblue-900" name="deleteUserButton">Yes</button>
                </form>
        </div>
    </div>
</div>