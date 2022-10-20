<?php $this->include("auth/layouts/header") ?>
<form method="post" action="<?= $this->url('auth/forgot_request') ?>" class="login100-form validate-form">
    <span class="login100-form-title">
        Forgot Password
    </span>

    <?php $this->include("alerts/alert_section/error") ?>
    
    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
        <input class="input100" type="text" name="email" placeholder="Email">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
    </div>

    <div class="container-login100-form-btn">
        <button type="submit" class="login100-form-btn">
            Send
        </button>
    </div>

    <div class="text-center p-t-136">
        <a class="txt2" href="register">
            Create your Account
            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
        </a>
    </div>
</form>
<?php $this->include("auth/layouts/footer") ?>