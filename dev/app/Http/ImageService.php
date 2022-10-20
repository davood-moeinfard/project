<?php
namespace App\Http;

class ImageService {

  public function saveImage($image,$imagePathName,$imageName=null)
  {
    $uploadOk=1;
    $extension=explode("/",$image["type"])[1];
    $allowMime=["jpg","jpeg","png","gif","webp"];
    $imageCheck=getimagesize($image['tmp_name']);
    if($imageCheck==false){
      $uploadOk=0;
      // $this->flash("imageError"," لطفا فقط عکس آپلود گردد/  ");
    }
    if (!in_array($extension,$allowMime)){
      $uploadOk=0;
      // flash("typeError","  عکس فقط می تواند از نوع jpg , jpeg , png , gif  باشد ");
    }
    if ($image['size']>(2*1024*1024)) {
      $uploadOk=0;
      // flash("sizeError"," حجم عکس کمتر از 2 مگابایت باشد ");
    }
    if ($uploadOk==1) {
      if ($imageName) {
        $imageName=$imageName.".".$extension;
      }
      else {
      $imageName=date("Y-m-d-H-i-s").".".$extension;
      }
      $imageTemp=$image["tmp_name"];
      $imagePath="public/".$imagePathName."/";
      if (is_uploaded_file($imageTemp)) {
        if (move_uploaded_file($imageTemp,$imagePath.$imageName)) {
          return $imagePathName."/".$imageName;
        }else{
          // $this->flash("loadError","عکس بارگذاری نگردید");
          return false;
        }
      }else{
        // $this->flash("loadError","عکس بارگذاری نگردید");
        return false;
      }
    }
    else{
      return false;
    }
  }
  public function removeImage($path)
  {
    $path=trim(Config::BASE_PATH,"/ ").DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR.trim($path,"/ ");
    if (file_exists($path)) {
      unlink($path);
    }else {
      return false;
    }
  }
}