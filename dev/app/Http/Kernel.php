<?php


namespace App\Http;

use App\Http\Config;
use App\Http\Helper;

class Kernel
{
    use Helper;
    public $controller = null;
    public $action = null;
    public $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        if (!isset($url[0])) {
            return $this->redirect('contact/index');
        }else{
            $formatUrl = ucfirst($url[0]) . "Controller";
        }
        if (file_exists(Config::CONTROLLERS_PATH . $formatUrl . ".php")) {
            $this->controller = $formatUrl;
            unset($url[0]);
        }else{
            $this->controller = "Pagenotfound";
            unset($url[0]);
        }

        require_once Config::CONTROLLERS_PATH . $this->controller . ".php";
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->action = $url[1];
                unset($url[1]);
            }else{
                return $this->redirect('Pagenotfound/index');
                unset($url[1]);
            }
        }else{
            return $this->redirect('Pagenotfound/index');
        }

        $this->params = $url ? array_values($url) : [""];

        call_user_func_array([$this->controller, $this->action], $this->params);

    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode("/", rtrim($_GET['url'], "/"));
        }
    }
}