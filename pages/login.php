<?php include '../includes/header.php'; ?>

<div class="login-form">
    <h2>Login</h2>
    <form action="../php_actions/process_login.php" method="POST" onsubmit="return validateLoginForm()">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" >
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" >
        </div>
        <div class="form-group">
            <input type="submit" value="Login">
        </div>
        <div class="signup-link">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </form>
</div>
<script src="../js/validation.js"></script>
<?php include '../includes/footer.php'; ?>