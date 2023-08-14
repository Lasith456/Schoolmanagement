<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

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
		$data['teacher']=$this->Usermodel->getallteachers();
		
		$this->load->view('teacher',$data);
	}
	function teacher_add()
	{
		$this->load->view('teacher_add');
	}
	function addneew() {
		$fullname = $this->input->post('fullname');
		$emailT = $this->input->post('emailT');
		$mobilenumb = $this->input->post('mobilenumb');
		$tAddress = $this->input->post('tAddress');
		$this->db->trans_start();

		$insertTeacher=array(
			'name'=>$fullname,
			'email'=>$emailT,
			'phone'=>$mobilenumb,
			'address'=>$tAddress
		);
		$this->db->insert('Teacher',$insertTeacher);

		
		$this->db->trans_complete();
		if($this->db->trans_status() == false){
			$result=array("status" => "error","message" => "details doesn't inserted " );
		}else{
			$result=array("status" => "success","message" => "details inserted successfuly" );

		}


		
		echo json_encode($result);
	}
	
}