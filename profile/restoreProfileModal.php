<div class="modal fade" id="restoreUser" tabindex="-1" aria-labelledby="restoreUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreUserLabel">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="profile_validation.php">
                    Are you sure you want to restore this account's password to default?
                    <div class="d-none">
                        <input type="text" class="form-control" id="email_restore" name="email" style="width: 100%;">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-payreto-darkblue-900" name="restoreUserButton">Yes</button>
                </form>
        </div>
    </div>
</div>