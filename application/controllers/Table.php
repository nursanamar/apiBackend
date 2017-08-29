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
   $response = array();
   $tables = array('table' => $data['name'] ,'columns' => $data['columns'] );
   $fields = array();

   if ($this->tabel->checkTable($tables['table'])) {
     $response = array('status' => 'failed' ,'desc' => 'Tabel sudah ada' );
   } else {
     foreach ($data['data'] as $field) {
       $fields[$field['name']] =  array(
         'type' => $field['type'],
         "constraint" => $field['constraint']
      );
     }

     $this->dbforge->add_field('id');
     $this->dbforge->add_field($fields);

     $this->dbforge->create_table($data['name']);

     $response['data'] = $this->tabel->addTable($tables);
     $response['status'] = 'ok';
     $response['desc'] = 'table created';
   }
   $this->output->set_status_header(201);
   $this->sendResponse($response);

 }

 public function deleteTable($id)
 {
   $table = $this->tabel->getById($id);
   $this->dbforge->drop_table($table['table']);
   $this->tabel->deleteTable($id);

   $this->output->set_status_header(204);
 }
}
?>
