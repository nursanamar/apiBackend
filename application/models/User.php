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

  public function addUser($data)
  {
    $this->db->insert('users',$data);
    return $this->lastData();
  }

  public function getById($id)
  {
    $this->db->select("*");
    $this->db->where("id",$id);
    $data = $this->db->get('users')->result_array();

    return $data[0];
  }

  public function lastData()
  {
    $this->db->select_max('id');
    $data = $this->db->get('users')->result_array();
    return $this->getById($data[0]['id']);
  }
}

 ?>
