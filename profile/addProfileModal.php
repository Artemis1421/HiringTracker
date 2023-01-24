<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-payreto-darkblue fw-bold" id="addUserLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="profile_validation.php">
                    <div class="row">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Username:</label>
                            <input type="text" required class="form-control" name="username">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Name:</label>
                            <input type="text" required class="form-control" name="name">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Email:</label>
                            <input type="text" required class="form-control" name="email">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Privilege:</label>
                            <select class="form-select" name="privilege" required>
                                <option selected>-- Select Position --</option>
                                <option value="1">Super Admin</option>
                                <option value="0">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="message-text" class="col-form-label text-payreto-darkblue-900 fw-bold">Password:</label>
                            <input type="password" minlength="8" required class="form-control" name="password" id="PassEntry" value="Payreto@123456">
                            <span id="StrengthDisp" class="badge displayBadge">Weak</span>
                        </div>
                        <div class="mb-3 col-12">
                            <div class="form-check mb-3 w-50 w-sm-100">
                                <input class="form-check-input text-payreto-darkblue-900" type="checkbox" onclick="showPassword1()">Show Password
                            </div>
                        </div>
                    </div>
            <div class="modal-footer text-center d-flex justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-payreto-darkblue-900" name="addUserButton">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="../assets/js/passStrengthChecker.js"></script>
<script>
    const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#PassEntry');
        
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
</script>
