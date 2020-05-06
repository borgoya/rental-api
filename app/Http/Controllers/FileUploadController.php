<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of FileUploadController
 *
 * @author Nagarjun
 */
use App\Http\Requests;
use Illuminate\Http\Request;

class FileUploadController extends Controller {
    //put your code here
    public function __construct() {
        $this->middleware(array('auth'));
    }
    
    public static function fileUpload($file,$destinationPath) {
        $extenstion = $file->getClientOriginalExtension();
        $fileName = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,10).'.'.$extenstion;
        $file->move($destinationPath, $fileName);
        return $fileName;
    }
}
