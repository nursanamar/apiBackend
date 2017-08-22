<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends MY_Controller {

  public function __construct()
 {
   parent::__construct();
   $this->checkAuth();
   $this->load->model("tabel");
   $this->load->dbforge();
 }

 public function getTable()
 {
   $data = $this->tabel->tableList();
   $respons = array('status' => "ok" , "data" => $data );
   $this->sendResponse($respons);
 }

 public function addTable()
 {
   $data = $this->getBody();
   $tables = array('table' => $data['name'] ,'columns' => $data['columns'] );
   $fields = array(

   );
   foreach ($data['data'] as $field) {
     $fields[$field['name']] =  array(
       'type' => $field['type'],
       "constraint" => $field['constraint']
    );
   }
    $this->dbforge->add_field('id');
   $this->dbforge->add_field($fields);

   $this->dbforge->create_table($data['name']);
   $res = $this->tabel->addTable($tables);

   $this->sendResponse($res);

 }
}
?>
