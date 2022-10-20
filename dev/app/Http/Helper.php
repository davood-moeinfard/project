<?php
namespace App\Http;

trait Helper{

  protected function include($dir,$vars=null)
  {
    if ($vars) {
      extract($vars);
    }
    $path=realpath(Config::RESOURCES_PATH.$dir.".php");
    if (file_exists($path)) {
      return require_once($path);
    }else{
      echo "View [".$dir."] not found";
    }
  }

  protected function asset($src)
  {
      $domain = trim(Config::BASE_URL , '/ ');
      $src = $domain.'/'.'public' . '/' . trim($src, '/ ');
      return $src;
  }

  protected function url($src)
  {
      $domain = trim(Config::BASE_URL , '/ ');
      $src = $domain. '/' . trim($src, '/ ');
      return $src;
  }

  protected function redirect($action)
  {
      return header("location:".Config::BASE_URL.trim($action));
  }
  protected function redirectBack()
  {
    return header("location:".$_SERVER["HTTP_REFERER"]);
  }


  protected function dd($var)
  {
    echo "<pre>";
    var_dump($var);
    exit;
  }

  protected function hash($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }
  protected function random()
  {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }
}