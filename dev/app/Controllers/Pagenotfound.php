<?php

use App\Http\BaseController;

class Pagenotfound extends BaseController
{
  public function index()
  {

    return $this->view("not-found", [""]);

  }

}