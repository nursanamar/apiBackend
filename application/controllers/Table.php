<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends MY_Controller {

  public function __construct()
 {
   parent::__construct();
   $this->checkAuth();
   $this->load->model("tabel");
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
   $fields = array(
   );
   foreach ($data['data'] as $field) {
     $fields[$field['name']] =  array(
       'type' => $field['type'],
       "constraint" => $field['constraint']
    );

     //array_push($fields,$temp);
   }
   print_r($fields);
   echo $data['name'];
 }
}
?>
