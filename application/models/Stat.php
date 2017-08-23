<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Stat extends CI_Model
{

  function __construct()
  {
    parent::__construct();

  }

  public function statData()
  {
    $data['tabels'] = $this->db->count_all_results('tables');
    $data['user'] = 0;
    $data['blacklist'] = 0;
    $hits = $this->db->select_sum('hits')->get('tables')->result_array();
    $data['hits'] = $hits[0]['hits'];

    return $data;
  }
}

 ?>
