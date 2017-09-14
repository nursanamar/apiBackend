<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Install extends MY_Controller
{

  function __construct()
  {
    $this->load->model('user');
    $this->load->dbforge();
  }

  public function installTable()
  {
    $fields = array(
			"id" => array(
				"type" => "INT",
				"constraint" => "11",
				"auto_increment"  => TRUE
			),
			"table" => array(
				"type" => "VARCHAR",
				"constraint" => "100"
			),
			"columns" => array(
				"type" => "INT",
				"constraint" => "11"
			),
      "hits" => array(
				"type" => "INT",
				"constraint" => "11",
        'null'=> true
			),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key("id",TRUE);
    if($this->dbforge->create_table("tables")){
			echo "sukses";
			var_dump($fields);
		}else{
			echo "gagal";
		}
  }
  public function installuser()
  {
    $fields = array(
      "id" => array(
        "type" => "INT",
        "constraint" => "11",
        "auto_increment"  => TRUE
      ),
      "user" => array(
        "type" => "VARCHAR",
        "constraint" => "12"
      ),
      "pass" => array(
        "type" => "VARCHAR",
        "constraint" => "12"
      ),
      "name" => array(
        "type" => "VARCHAR",
        "constraint" => "12"
      ),
      "isBlock" => array(
        "type" => "INT",
        "constraint" => "11",
        'default'=> '0'
      ),
      "type" => array(
        "type" => "VARCHAR",
        "constraint" => "11",
        'default'=> 'user'
      ),
    );

    $this->dbforge->add_field($fields);
    $this->dbforge->add_key("id",TRUE);
    if($this->dbforge->create_table("user")){
      $user = array(
        "user" => "Nursan",
        "pass" => "amar",
        "name" => "Nursan amar",
        "type" => "Admin"
      );
      $this->user->addUser($user);
      echo "sukses";
      var_dump($fields);
    }else{
      echo "gagal";
    }
  }
  public function install()
  {
    $this->installTable();
    $this->installuser();
  }
}


?>
