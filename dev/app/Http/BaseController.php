<?php


namespace App\Http;

use App\Http\Helper;

class BaseController
{
  use Helper;

  private $message = "";

  protected function view($view, $data=null)
  {
    if ($data) {
      extract($data);
    }
    return require_once Config::RESOURCES_PATH . $view . ".php";
  }

  protected function flash($name, $value = null)
  {
    global $flashMessage;
    if (isset($_SESSION["flash_massage"])) {
      $flashMessage = $_SESSION["flash_massage"];
      unset($_SESSION["flash_massage"]);
    }
    if ($value === null) {
      $message = isset($flashMessage[$name]) ? $flashMessage[$name] : '';
      return $message;
    } else {
      $_SESSION["flash_massage"][$name] = $value;
    }
  }

}
