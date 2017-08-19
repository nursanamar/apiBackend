<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends MY_Controller {

  public function __construct()
 {
   parent::__construct();
   $this->checkAuth();
 }

 public function getTable()
 {
   $data = array(
     array(
       "id" => "1",
       "table" => "data",
       "column" => "2",
       "hits" => "123",
     ),
     array(
       "id" => "2",
       "table" => "data",
       "column" => "2",
       "hits" => "123",
     )
   );
   $respons = array('status' => "ok" , "data" => $data );
   $this->sendResponse($respons);
 }
}
?>
