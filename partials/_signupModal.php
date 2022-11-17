<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup for codeDiscuss account</h5>
            </div>
            <div class="modal-body">
                <form action="/productivity/codeDiscuss/partials/_signupFunctional.php" method="post">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" class="form-control border-dark" id="userName" name="userName" maxlength="15" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control border-dark" id="signup_email" name="signup_email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="signup_password" class="form-label">Password</label>
                        <input type="password" class="form-control border-dark" id="signup_password" name="signup_password" aria-describedby="passwordHelp" maxlength="16" required>
                        <div id="passwordHelp" class="form-text">Password must be 6-16 character long</div>
                    </div>
                    <div class="mb-3">
                        <label for="signup_cPassword" class="form-label">Confirm password</label>
                        <input type="password" class="form-control border-dark" id="signup_cPassword" name="signup_cPassword" aria-describedby="passwordHelp" maxlength="16" required>
                       
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>