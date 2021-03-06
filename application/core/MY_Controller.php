<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	private $jwtToken;
	public $payload;
	public $user;

	 public function __construct()
	{
		parent::__construct();
		$this->load->library('jwt');
		$this->load->model('login');
	}

	 public function sendResponse($data,$headers = array())
	{
		foreach($headers as $key => $value){
			$this->output->set_header($key." : ".$value);
		}
		 $this->output->set_content_type("application/json");
		//  $this->output->set_header("Access-Control-Allow-Origin : *");
		//  $this->output->set_header("X-Message : ApiBuilder/1.0");
		//  $this->output->set_header("Server : ApiBuilder",true);
		$this->output->set_output(json_encode($data));
	}

	public function getBody()
	{
		 $data = json_decode($this->input->raw_input_stream,true);
		 return $data;
	}

	public function checkToken()
	{
		$status = "auth";
		$headers = $this->input->get_request_header("Authorization");
		list($token) = sscanf($headers,"Bearer %s");

		if($token === null){
		 $this->output->set_status_header(401);
		 die();
		}

		$this->jwtToken = $token;
	}

	public function checkAuth()
	{
		$this->checkToken();

		 try{

			$valid = $this->jwt->decode($this->jwtToken,$this->input->get_request_header("User-agent",true)."nursan");

			} catch( \UnexpectedValueException $ec) {
			 $this->output->set_status_header(401);
		die();
		}

		$this->payload = $valid;
	}

	public function generateToken()
	{
		$input = $this->getBody();
		$iss = $this->input->get_request_header('User-agent',true);
		$user = $this->login->chekUser($input['user'],$input['pass']);
		$payload = array('id' => $user['id'] ,'name' => $user['name'] ,'iss' => $iss );
		$token = $this->jwt->encode($payload,$iss."nursan");

		return $token;
	}

	public function validateLogin()
	{
		$input = $this->getBody();
		$result = $this->login->chekUser($input['user'],$input['pass']);
		$this->user = array(
			'id' => $result['id'],
			'name' => $result['name']
		);
		return ($result === array()) ? false : true;
	}

}

 ?>
