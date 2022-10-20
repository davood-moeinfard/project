<?php

use App\Models\DB;
use App\Http\Request;
use App\Http\ImageService;
use App\Http\BaseController;

class UserController extends BaseController
{
  public function __construct()
  {
    if (!isset($_SESSION['id'])) {
      $this->redirect('auth/login');
    }
  }
  public function edit()
  {
    $userId=$_SESSION['id'];
    $user=json_decode(DB::table("users")->where("id","=",$userId)->first());
    return $this->view("contact/user/edit", compact("user"));
  }

  public function update($id)
  {
    $request=Request::getParams();

    $user=json_decode(DB::table("users")->where("id","=",$id)->first());
    if (!empty($request["user_photo"]["name"])) {
      $user_photo=$request["user_photo"];
      $imageService=new ImageService;
      if ($user->user_photo) {
        $imageService->removeImage($user->user_photo);
      }
      $result=$imageService->saveImage($user_photo,"user_photo");
      if ($result) {
        $request["user_photo"]=$result;
      }else{
        $this->flash("swal_error", "آپلود عکس با خطا مواجه شد");
        $this->redirect('user/edit');
      }
    }else{
      unset($request["user_photo"]);
    }

    $this->flash("swal_success", "اطلاعات کاربری شما ویرایش گردید");
    $result=DB::table("users")->update($id,array_keys($request),array_values($request));

    return $this->redirect("user/edit");
  }
  
}