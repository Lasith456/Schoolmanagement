<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->view('user');
	}
	function user_add()
	{
		$this->load->view('user_add');
	}
	function user_profile()
	{
		$userid=$this->session->userdata['logedData']['userId'];

		$useraddress='';
		$useremail='';
		$userStartdate='';
		$mobileenum='';
		$result = $this->Usermodel->getuserdetails($userid);
		foreach($result as $row):
			$userFullname=$row->FullName;
			$useraddress=$row->Address;
			$useremail=$row->email;
			$mobileenum=$row->phoneNumber;
			$userStartdate=$row->startDate;
		endforeach;
		$data = array(
            'userFullname' => $userFullname,
            'useraddress' => $useraddress,
            'useremail' => $useremail,
			'mobileenum' => $mobileenum,
            'userStartdate' => $userStartdate
        );
		$this->load->view('user_profile',$data);
	}
	function updateuser(){
		$userid=$this->session->userdata['logedData']['userId'];
		$studentAddress=$this->input->post('studentAddress');
		$mobilenum=$this->input->post('mobilenum');

		$this->db->trans_start();

		$updatedata=array(
			'phoneNumber'=>$mobilenum,
			'Address'=>$studentAddress
		);
		$this->db->where('user_id',$userid);
		$this->db->update('users',$updatedata);

		
		if($this->db->trans_status() == false){
			$result=array("status" => "error","message" => "profile details doesn't updated " );
		}else{
			$result=array("status" => "success","message" => "profile details updated successfuly" );

		}


		$this->db->trans_complete();
		
		echo json_encode($result);
	}


	function changepasswo() {
		$userid = $this->session->userdata['logedData']['userId'];
		$oldpass = $this->input->post('oldpass');
		$new2pass = $this->input->post('new2pass');
		$result2 = $this->Usermodel->getuserdetails($userid);

		foreach ($result2 as $row) {
			$passwordOld = $row->userPassword;
		}
		
		if (password_verify($oldpass, $passwordOld)) {
			$encryptedpass = password_hash(trim($new2pass),PASSWORD_DEFAULT);
			$updatedata = array(
				'userPassword' => $encryptedpass,
			);
			
			$this->db->where('user_id', $userid);
			$this->db->update('users', $updatedata);
			
			$result = array("status" => "success", "message" => "password updated");
		} else {
			$result = array("status" => "error", "message" => "old password does not match");
		}
		
		echo json_encode($result);
	}
	function aduser() {
		$fullname = $this->input->post('fullname');
		$phoneNumber = $this->input->post('phoneNumber');
		$emailT = $this->input->post('emailT');
		$username = $this->input->post('username');
		$startDate = $this->input->post('startDate');
		$studentAddress = $this->input->post('studentAddress');
		$inputPassword = $this->input->post('inputPassword');
		$encryptedpass = password_hash(trim($inputPassword),PASSWORD_DEFAULT);
		$this->db->trans_start();

		$insertUser=array(
			'userName'=>$username,
			'phoneNumber'=>$phoneNumber,
			'userPassword'=>$encryptedpass,
			'email'=>$emailT,
			'Address'=>$studentAddress,
			'startDate'=>$startDate,
			'FullName'=>$fullname
		);
		$this->db->insert('users',$insertUser);

		$this->db->trans_complete();
		if($this->db->trans_status() == false){
			$result=array("status" => "error","message" => "details doesn't inserted " );
		}else{
			$result=array("status" => "success","message" => "details inserted successfuly" );

		}


		
		echo json_encode($result);
	}
	function getuserdata(){
		$search=$this->input->post('search');
		$limit=$this->input->post('limit');
		$offset=$this->input->post('offset');
		$result=$this->Usermodel->getuserdata($search,$limit,$offset);
		echo json_encode($result);
	}
}
