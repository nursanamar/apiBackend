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
}

 ?>
