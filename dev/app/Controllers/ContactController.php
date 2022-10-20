<?php


use App\Models\DB;
use App\Http\Request;
use App\Http\ImageService;
use App\Http\BaseController;

class ContactController extends BaseController
{

  public function __construct()
  {
    if (!isset($_SESSION['id'])) {
      $this->redirect('auth/login');
    }
  }

  public function index()
  {
    $userId=$_SESSION["id"];
    $contacts=json_decode(DB::table('contacts')->innerJoin("users","user_id","id")->where("users.id","=",$userId)->orderBy("created_at")->get());
    return $this->view("contact/index", compact('contacts'));
  }

  public function contactManagement()
  {
    $userId=$_SESSION["id"];
    $contacts=json_decode(DB::table('contacts')->innerJoin("users","user_id","id")->where("users.id","=",$userId)->orderBy("created_at")->get());
    return $this->view("contact/contact-management/index", compact('contacts'));
  }

  public function createContact()
  {
    return $this->view("contact/contact-management/create");
  }

  public function storeContact()
  {
    $request=Request::getParams();
    //image insert
    $contact=json_decode(DB::table("contacts")->where("mobile_number","=",$request["mobile_number"])->first());

    if (empty($contact)) {

      if (!empty($request["image"]["name"])) {
        $contactImage=$request["image"];
        $imageService=new ImageService;
        $result=$imageService->saveImage($contactImage,"contact_photo");
        if ($result) {
          $request["image"]=$result;
        }else{
          $this->flash("swal_error", "آپلود عکس با خطا مواجه شد");
          $this->redirect('user/edit');
        }
      }else{
        unset($request["image"]);
      }
    
      $request["user_id"]=$_SESSION["id"];
      $result=DB::table("contacts")->add(array_keys($request),array_values($request));
  
      $this->flash("swal_success", "مخاطب شما به لیست مخاطبین اضافه گردید");
    }else{
      $this->flash("swal_error", "شماره موبایل وارده در  لیست مخاطبین وجود دارد ");
    }


    $this->redirect("contact/contactManagement");

  }

  public function destroyContact($id)
  {

    $contact=json_decode(DB::table("contacts")->where("id","=",$id)->first());

    if (!empty($contact)) {
      
      if ($contact->image) {
        $imageService=new ImageService;
        $imageService->removeImage($contact->image);
      }

      $result=DB::table("contacts")->delete([$id]);
      $this->flash("swal_success", "مخاطب شما حذف گردید");

    }else{

      $this->flash("swal_error", "عملیات انجام نشد");
    }

    $this->redirect("contact/contactManagement");
  }

  public function editContact($id)
  {
    $contact=json_decode(DB::table("contacts")->where("id","=",$id)->first());
    return $this->view("contact/contact-management/edit",compact("contact"));
  }

  public function updateContact($id)
  {
    $request=Request::getParams();
    $contact=json_decode(DB::table("contacts")->where("id","=",$id)->first());
    //image update
    if (!empty($request["image"]["name"])) {
      $contactImage=$request["image"];
      $imageService=new ImageService;
      if ($contact->image) {
        $imageService->removeImage($contact->image);
      }
      $result=$imageService->saveImage($contactImage,"contact_photo");
      if ($result) {
        $request["image"]=$result;
      }else{
        $this->flash("swal_error", "آپلود عکس با خطا مواجه شد");
        $this->redirect('user/edit');
      }
    }else{
      unset($request["image"]);
    }


    $result=DB::table("contacts")->update($id,array_keys($request),array_values($request));
    $this->flash("swal_success", "مخاطب شما ویرایش گردید");
    $this->redirect("contact/contactManagement");
  }

  public function showContact($id)
  {
    $contact=json_decode(DB::table("contacts")->where("id","=",$id)->first());
    return $this->view("contact/contact-management/show",compact("contact"));
  }
}