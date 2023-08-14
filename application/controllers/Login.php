<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('Usermodel');

	}
	public function index()
	{
		$this->load->view('login');
	}
	function forgot_password()
	{
		$this->load->view('forgot_password');
	}
	function submit_code()
	{
		$this->load->view('submit_code');
	}
	function user_login1()
	{
		$username1=$this->input->post('username1');
		$password1=$this->input->post('password1');
		$user='';
		$pass=''; 
		$userid='';
		$users = $this->Usermodel->getUser($username1);
		foreach($users as $row):
			$user=$row->userName;
			$pass=$row->userPassword;
			$userid=$row->user_id;
		endforeach;

		if( $username1 == $user && password_verify($password1, $pass)){
			$logindata=array(
				'userId'=>$userid,
				'userName'=>$user
			);
			$this->session->set_userdata('logedData',$logindata);
			if (isset($_SESSION['logedData'])) {
				// Access the "logedData" array key or perform any necessary operations
				$someVariable = $_SESSION['logedData'];
			} else {
				// Handle the case when the session or "logedData" key is not available
				// You can choose to set a default value or perform any other required actions
			}
			$message=array("status" => "success","message" => "http://localhost:8888/code/dashboard" );
		}else{
			$message=array("status" => "error","message" => "user name or password is invalid" );
		}


		
		echo json_encode($message);
	}
	function user_logout(){
		if($this->session->userdata['logedData']!=NULL || $this->session->userdata['logedData']!=''){
			$logindata=array(
				'userId'=>'',
				'userName'=>''
			);
			$this->session->unset_userdata($logindata);
			$this->session->sess_destroy();
			redirect(base_url('Login'));
		}
	}

}