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

  public function addTable($data)
  {
    $this->db->insert('tables',$data);
    return $this->lastData();
  }

  public function getById($id)
  {
    $this->db->select("*");
    $this->db->where("id",$id);
    $data = $this->db->get('tables')->result_array();

    return $data[0];
  }

  public function deleteTable($id)
  {
    $this->db->where('id',$id);
    $this->db->delete('tables');
  }

  public function checkTable($table)
  {
    return $this->db->table_exists($table);
  }

  public function lastData()
  {
    $this->db->select_max('id');
    $data = $this->db->get('tables')->result_array();
    return $this->getById($data[0]['id']);
  }
}
?>
