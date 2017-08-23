<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Home extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->checkAuth();
    $this->load->model('stat');
  }

  public function statData()
  {
    $data = $this->stat->statData();

    $this->sendResponse($data);
  }
}

 ?>
