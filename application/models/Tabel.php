<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tabel extends	CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function tableList()
  {
    return $this->db->get("tables")->result_array();
  }
}
?>
