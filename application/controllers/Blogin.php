<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogin extends MY_Controller {

  public function __construct()
 {
   parent::__construct();

 }

 public function options()
 {
   $this->sendResponse();
 }


  public function login()
  {
    $check = $this->validateLogin();
    if($check){
      $token = $this->generateToken();
      $response = array(
        'status' => 'ok',
        'desc' => "Login succes",
        'data' => array(
          'token' => $token,
          'user' => $this->user,
        ),
      );

    }else {
      $response = array(
        'status' => 'failed',
        'desc' => "chek your pass",
      );
    }
    $this->sendResponse($response);
  }
}
?>
