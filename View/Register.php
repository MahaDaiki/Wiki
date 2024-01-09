<?php
$title = "Login Register";
ob_start();
?>
<div class="row">
    <div class="col-md-6 mx-auto p-0">
        <div class="">
            <div class="login-box">
                <div class="login-snip">
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
                    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                    <div class="login-space">

                        <!-- Register Form -->
                      <form method="post" action="index.php?action=Register" class="sign-up-form" onsubmit="return validateForm();">
              <div class="group">
                <label for="signup-user" class="label">Username</label>
                <input id="signup-user" name="signup-user" type="text" class="input" placeholder="Username" required>
              </div>
              <div class="group">
                <label for="signup-email" class="label">Email Address</label>
                <input id="signup-email" name="signup-email" type="email" class="input" placeholder="Email address" required>
              </div>
              <div class="group">
                <label for="signup-pass" class="label">Password <span class="password-toggle" onclick="togglePassword('signup-pass', 'eye-signup-pass')">👁️</span></label>
                <input id="signup-pass" name="signup-pass" type="password" class="input" data-type="password" placeholder="password" required>
                
              </div>
              <div class="group">
                <label for="signup-pass-repeat" class="label">Password Verification <span class="password-toggle" onclick="togglePassword('signup-pass-repeat', 'eye-signup-pass-repeat')">👁️</span></label>
                <input  id="signup-pass-repeat" name="signup-pass-repeat" type="password" class="input" data-type="password Verification" placeholder="Repeat your password" required >
                
              </div>
              <hr>
              <div class="group">
                <input type="submit" class="button" value="Sign Up">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>








<?php $content = ob_get_clean(); ?>
<?php include_once 'View\layout.php'; ?>
	