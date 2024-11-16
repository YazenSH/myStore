<?php include '../includes/header.php'; ?>

<div class="container">
    <div class="signup-form box">
        <h2>Sign Up</h2>
        <form action="../php_actions/process_signup.php" method="post" onsubmit="return validateSignupForm()">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name"/>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email"/>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"/>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password"/>
            </div>
            <div class="form-group">
                <input type="submit" value="Sign Up" class="btn"/>
            </div>
            <div class="form-group login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </form>
</div>
</div>

<script src="../js/validation.js" type="text/css"></script>
<?php include '../includes/footer.php'; ?>