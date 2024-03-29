<?php
$title = "Login Register";
ob_start();
?>


<div class="row">
  <div class="col-md-6 mx-auto p-0">
    <div class="">
      <div class="login-box ">
        <div class="login-snip">
          <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
          <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
          <div class="login-space">
            <!-- Login Form -->
            <form id="loginForm" method="post" action="index.php?action=Authentification">
              <div class="login">
                <div class="group">
                  <label for="login-user" class="label">Email</label>
                  <input id="login-user" name="login-user" type="Email" class="input" placeholder="Enter your Email">
                </div>
                <div class="group">
                  <label for="login-pass" class="label">Password</label>
                  <input id="login-pass" name="login-pass" type="password" class="input" data-type="password"
                    placeholder="Enter your password">
                </div>
                <hr>
                <div class="group">
                  <input type="submit" class="button" value="Sign In">
                </div>
              </div>
            </form>

            <!-- Register Form -->
            <form id="registerForm" method="post" action="index.php?action=Register" class="sign-up-form">
              <div class="group">
                <label for="signup-user" class="label">Username</label>
                <input id="signup-user" name="signup-user" type="text" class="input" placeholder="Username" required>
                <span id="signup-userError" style="color: red;"></span>
              </div>
              <div class="group">
                <label for="signup-email" class="label">Email Address</label>
                <input id="signup-email" name="signup-email" type="email" class="input" placeholder="Email address"
                  required>
                <span id="signup-emailError" style="color: red;"></span>
              </div>
              <div class="group">
                <label for="signup-pass" class="label">Password<span class="password-toggle"
                    onclick="togglePassword('signup-pass', 'eye-signup-pass')">👁️</span> </label>
                <input id="signup-pass" name="signup-pass" type="password" class="input" data-type="password"
                  placeholder="password" required>
                <span id="signup-passError" style="color: red;"></span>
              </div>
              <div class="group">
                <label for="signup-pass-repeat" class="label">Password Verification <span class="password-toggle"
                    onclick="togglePassword('signup-pass-repeat', 'eye-signup-pass-repeat')">👁️</span></label>
                <input id="signup-pass-repeat" name="signup-pass-repeat" type="password" class="input"
                  data-type="password Verification" placeholder="Repeat your password" required>
                <span id="signup-pass-repeatError" style="color: red;"></span>
              </div>
   <hr>
          <div class="group">
            <input type="submit" class="button" value="Sign Up">
          </div>
          </div>
       

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



<script>
  // Function to show error messages
  function showError(element, message) {
    var errorElement = document.getElementById(element + "Error");
    errorElement.textContent = message;
  }

  // Function to clear error messages
  function clearError(element) {
    var errorElement = document.getElementById(element + "Error");
    errorElement.textContent = "";
  }

  document.addEventListener('DOMContentLoaded', function () {
    var usernameInput = document.getElementById('signup-user');
    var emailInput = document.getElementById('signup-email');
    var passwordInput = document.getElementById('signup-pass');
    var confirmPasswordInput = document.getElementById('signup-pass-repeat');

    usernameInput.addEventListener('input', function () {
      clearError('signup-user');
      if (!/^[a-zA-Z0-9_]{2,20}$/.test(usernameInput.value)) {
        showError('signup-user', 'Invalid username format.');
      }
    });

    emailInput.addEventListener('input', function () {
      clearError('signup-email');
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailPattern.test(emailInput.value)) {
        showError('signup-email', 'Invalid email format.');
      }
    });

    passwordInput.addEventListener('input', function () {
      clearError('signup-pass');
      if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/.test(passwordInput.value)) {
        showError('signup-pass', 'at least one uppercase, one lowercase letter, one digit, and be at least 6 characters long.');
      }
    });

    confirmPasswordInput.addEventListener('input', function () {
      clearError('signup-pass-repeat');
      if (confirmPasswordInput.value !== passwordInput.value) {
        showError('signup-pass-repeat', 'Error: Passwords do not match.');
      }
    });
  });
</script>





<?php $content = ob_get_clean(); ?>
<?php include_once 'View\layout.php'; ?>