<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class User extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  }

  public function getAll()
  {
    return $this->db->where('type','user')->get('users')->result_array();
  }
}

 ?>
