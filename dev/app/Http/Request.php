<?php

namespace App\Http;

class Request
{
    use Helper;
    public static function getParam($request)
    {
        return $_GET[$request] ?? $_POST[$request];
    }
    public static function getParams()
    {		
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            $request=$_POST;
            if (isset($_FILES)) {
                $request=array_merge($request,$_FILES);
            }
            return $request;
        } else {
            return $_GET;
        }
        
    }
}