<?php $this->include("auth/layouts/header") ?>
<form method="post" action="<?= $this->url("auth/reset_password_request/".$user->forgot_token) ?>" class="login100-form validate-form">
  <span class="login100-form-title"> Reset Password </span>

  <?php $this->include("alerts/alert_section/error") ?>
  
  <div class="wrap-input100 validate-input"data-validate="Password is required">
    <input class="input100" type="password" name="password" placeholder="Password"/>
    <span class="focus-input100"></span>
    <span class="symbol-input100">
      <i class="fa fa-lock" aria-hidden="true"></i>
    </span>
  </div>

  <div class="container-login100-form-btn">
    <button type="submit" class="login100-form-btn">Send</button>
  </div>

  <div class="text-center p-t-12">
    <span class="txt1"> Forgot </span>
    <a class="txt2" href="<?= $this->url("auth/forgot") ?>"> Username / Password? </a>
  </div>

  <div class="text-center p-t-136">
    <a class="txt2" href="<?= $this->url("auth/login") ?>">
      Login your Account
      <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
    </a>
  </div>
</form>
<?php $this->include("auth/layouts/footer") ?>
