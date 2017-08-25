<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Users extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->checkAuth();
    $this->load->model('user');
  }

  public function getUSers()
  {
    $data['status'] = 'ok';
    $data['data'] = $this->user->getAll();

    $this->sendResponse($data);
  }

  public function addUser()
  {
    $req = $this->getBody();
    $data = array("type" => "user");
    foreach ($req as $key => $value) {
      $data[$key] = $value;
    }
    $res['status'] = 'ok';
    $res['data'] = $this->user->addUser($data);


    $this->sendResponse($res);
  }

  public function deleteUser($id)
  {
    $this->user->deleteUser($id);
    $this->output->set_status_header(204);
  }

  public function blockUser($id)
  {
    $data = $this->getBody();
    $res['status'] = "ok";
    $res['data'] = $this->user->blockUser($id,$data);
    $this->sendResponse($res);
  }
}

 ?>
