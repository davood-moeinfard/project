<?php


use App\Models\DB;
use App\Http\Request;
use App\Http\BaseController;
use App\Http\Mail;

class AuthController extends BaseController
{
  use Mail;

  public function __construct()
  {
    if (isset($_SESSION['id'])) {
      $this->redirect('contact/index');
    }
  }
  
  public function login()
  {
    return $this->view("auth/login", [""]);
  }

  public function checkLogin()
  {
    $email = Request::getParam('email');
    $password = Request::getParam('password');

    if ($email == null || $password == null) {
      $this->flash("alert_section_error", "لطفا تمامی اطلاعات درخواستی را تکمیل نمائید");
      $this->redirectBack();
    } else {
      $user = json_decode(DB::table("users")->where('email', '=', $email)->first());
      if (!empty($user)) {
        if (password_verify($password, $user->password)) {
          if ($user->is_active == 1) {
            $_SESSION["username"] = $user->username;
            $_SESSION["id"] = $user->id;
            $_SESSION["user_photo"] = $user->user_photo;
            $this->redirect("contact/index");
          }else {
            $this->flash("alert_section_error", "حساب کاربری فعال نشده است");
            $this->redirectBack();
          }
        } else {
          $this->flash("alert_section_error", "رمز عبور صحیح نمی باشد");
          $this->redirectBack();
        }
      } else {
        $this->flash("alert_section_error", "کاربری با این مشخصات یافت نشد");
        $this->redirectBack();
      }
    }
  }

  public function register()
  {
    return $this->view("auth/register", [""]);
  }

  public function registerStore()
  {

    $email = Request::getParam('email');
    $password = Request::getParam('password');
    $username = Request::getParam('username');

    if ($email == null || $password == null || $username == null) {
      $this->flash("alert_section_error", "لطفا تمامی اطلاعات درخواستی را تکمیل نمائید");
      $this->redirectBack();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->flash("alert_section_error", "ایمیل وارده نامعتبر است");
      $this->redirectBack();
    } else if (strlen($password) < 8) {
      $this->flash("alert_section_error", "رمز عبور می بایست بیش تر از 8 کاراکتر باشد");
      $this->redirectBack();
    } else {
      $user = DB::table('users')->where('email', '=', $email)->first();
      $user = json_decode($user);
      if (!empty($user)) {
        $this->flash("alert_section_error", "ایمیل وارده قبلا ثبت شده است");
        $this->redirectBack();
      } else {
        //create token for email verification
        $verify_token = $this->random();
        //create activation message
        $activationMassage = $this->activationMassage($username, $verify_token);
        //send activation email
        $sendMail = $this->sendMail($email, "فعال سازی حساب کاربری", $activationMassage);

        if ($sendMail) {
          $password = $this->hash($password);
          DB::table('users')->add(["username", "password", "email", "verify_token"], [$username, $password, $email, $verify_token]);
          $this->flash("swal_success", "حساب کاربری شما با موفقیت ثبت گردید و ایمیل فعالسازی حساب کاربری ارسال گردید");
          echo "<script>window.location.assign('login')</script>";
        } else {
          $this->flash("alert_section_error", "ارسال ایمیل با خطا مواجه شد");
          $this->redirectBack();
        }
      }
    }
  }

  public function activation($verify_token)
  {
    //active user
    $user = DB::table('users')->where('verify_token', '=', $verify_token)->and('is_active', '=', 0)->first();
    $user = json_decode($user);
    if ($user) {
      DB::table('users')->update($user->id, ["is_active"], ['1']);

      $this->flash("swal_success", "حساب کاربری شما با موفقیت فعال گردید");

      $this->redirect("auth/login");
    } else {
      $this->flash("swal_error", "حساب کاربری شما فعال نگردید");
      $this->redirect("auth/login");
    }
  }

  public function logout()
  {
    if (isset($_SESSION["id"])) {
      unset($_SESSION["username"]);
      unset($_SESSION["id"]);
      session_destroy();
    }
    $this->redirect("auth/login");
  }


  public function forgot()
  {
    return $this->view("auth/forgot-password", [""]);
  }

  public function forgot_request()
  {
    date_default_timezone_set("Iran");
    $email = Request::getParam('email');
    if ($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $user = json_decode(DB::table('users')->where('email','=',$email)->first());
      if (!empty($user)) {
        $forgot_token = $this->random();
        $forgotMassage = $this->forgotMassage($user->username, $forgot_token);
        $sendMail = $this->sendMail($email, "بازنشانی رمز عبور", $forgotMassage);
        if ($sendMail) {

          DB::table('users')->update($user->id,["forgot_token", "forgot_token_expire"], [$forgot_token, date("Y-m-d H:i:s", strtotime("+15 minutes"))]);
          $this->flash("swal_success", "کاربر گرامی لینک بازیابی رمز عبور به ایمیل شما ارسال گردید");

          echo "<script>window.location.assign('login')</script>";
        } else {
          $this->flash("alert_section_error", "ارسال ایمیل با خطا مواجه شد");
          $this->redirectBack();
        }
      } else {
        $this->flash("alert_section_error", "ایمیل وارده ثبت نام نکرده است");
        $this->redirectBack();
      }
    } else {
      $this->flash("alert_section_error", "ایمیل وارده معتبر نمی باشد");
      $this->redirectBack();
    }
  }


  public function reset_password($forgot_token)
  {
    date_default_timezone_set("Iran");
    $user =json_decode(DB::table('users')->where('forgot_token','=',$forgot_token)->first());
    if (empty($user)) {
      
      $this->flash("swal_error", "کاربر گرامی لینک بازیابی رمز عبور شما صحیح نمی باشد");     
      $this->redirect("auth/login");

    } else if ($user->forgot_token_expire < date("Y-m-d H:i:s")) {

      $this->flash("swal_error", "کاربر گرامی لینک بازیابی رمز عبور شما منقضی شده است");     
      $this->redirect("auth/login");

    } else {
      return $this->view("auth/reset-password", compact('user'));
    }
  }

  public function reset_password_request($forgot_token)
  {
    $password = Request::getParam('password');
    date_default_timezone_set("Iran");
    $user=json_decode(DB::table('users')->where('forgot_token','=',$forgot_token)->first());
    if (strlen($password) < 8) {

      $this->flash("alert_section_error","رمز عبور می بایست بیشتر از 8 کاراکتر باشد");
      $this->redirectBack();

    }else if(empty($user)) {

      $this->flash("alert_section_error","کاربر گرامی لینک بازیابی رمز عبور شما منقضی شده است");
      $this->redirectBack();

    }else if($user->forgot_token_expire < date("Y-m-d H:i:s")) {

      $this->flash("alert_section_error","کاربر گرامی لینک بازیابی رمز عبور شما منقضی شده است");
      $this->redirectBack();

    }else {

      $password=$this->hash($password);
      DB::table('users')->update($user->id,["password"],[$password]);

      $this->flash("swal_success", "رمز عبور شما با موفقیت تغییر یافت");

      $this->redirect("auth/login");
    }
  }
}
