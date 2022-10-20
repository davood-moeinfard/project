<?php 
namespace App\Http;

use App\Http\Config;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

trait Mail {

  protected function activationMassage($username, $verify_token)
  {
    $massage = "<h1>فعال سازی حساب کاربری</h1>
    <p>" . $username . "عزیز جهت فعال سازی حساب کاربری خود لطفا روی لینک زیر کلیک نمائید</p>
    <div><a href='" . $this->url('auth/activation/' . $verify_token) . "'>فعال سازی حساب</a></div>";
    return $massage;
  }

  protected function forgotMassage($username, $forgot_token)
  {
    $massage = "<h1>بازنشانی رمز عبور حساب کاربری</h1>
    <p>" . $username . "عزیز جهت بازنشانی رمز عبور حساب کاربری خود لطفا روی لینک زیر کلیک نمائید</p>
    <div><a href='" . $this->url('auth/reset_password/' . $forgot_token) . "'>بازنشانی رمز عبور</a></div>";
    return $massage;
  }
  
  protected function sendMail($emailAddress, $subject, $body)
  {
    $mail = new PHPMailer();
    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->CharSet = "UTF-8";
      $mail->isSMTP();
      $mail->Host       = Config::MAIL_HOST;
      $mail->SMTPAuth   = Config::SMTP_AUTH;
      $mail->Username   = Config::MAIL_USERNAME;
      $mail->Password   = Config::MAIL_PASSWORD;
      $mail->SMTPSecure = "tls";
      $mail->Port       = Config::MAIL_PORT;

      //Recipients
      $mail->setFrom(Config::SENDER_MAIL, Config::SENDER_NAME);
      $mail->addAddress($emailAddress);     
      $mail->addReplyTo(Config::SENDER_MAIL, Config::SENDER_NAME);

      //Content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $body;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();
      return true;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      return false;
    }
  }
}