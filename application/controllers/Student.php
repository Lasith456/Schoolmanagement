<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

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
		$this->load->view('student');
	}
	function student_add()
	{
		$this->load->view('studentadd');
	}
	function addneew() {
		$fullname = $this->input->post('fullname');
		$emailT = $this->input->post('emailT');
		$mobilenumb = $this->input->post('mobilenumb');
		$tAddress = $this->input->post('tAddress');
		$this->db->trans_start();

		$insertStudent=array(
			'fullName'=>$fullname,
			'Email'=>$emailT,
			'mobileNumber'=>$mobilenumb,
			'Address'=>$tAddress
		);
		$this->db->insert('student',$insertStudent);

		
		$this->db->trans_complete();
		if($this->db->trans_status() == false){
			$result=array("status" => "error","message" => "details doesn't inserted " );
		}else{
			$result=array("status" => "success","message" => "details inserted successfuly" );

		}


		
		echo json_encode($result);
	}
	function get_student(){
		$columns=array(
			0=>'fullName',
			1=>'Email',
			2=>'mobileNumber',
			3=>'Address',
		);
		$limit=$this->input->post('length');
		$start=$this->input->post('start');
		$order = '';
		if (!empty($columns) && !empty($this->input->post('order'))) {
    		$orderColumn = $this->input->post('order')[0]['column'];
    		if (isset($columns[$orderColumn])) {
        		$order = $columns[$orderColumn];
    		}
		}

		$dir = '';
		if (!empty($this->input->post('order')) && !empty($this->input->post('order')[0]['dir'])) {
    		$dir = $this->input->post('order')[0]['dir'];
		}


		$totalData=$this->Usermodel->all_student_count();
		$totalFiltered=$totalData;
		if(empty($this->input->post('search')['value'])){
			$students=$this->Usermodel->all_student($limit,$start,$order,$dir);
		}else{
			$search=$this->input->post('search')['value'];
			$students=$this->Usermodel->search_student($search,$limit,$start,$order,$dir);
			$totalFiltered=$this->Usermodel->student_filtered_count($search);
		}
		$data=array();
		if(!empty($students)){
			$data=$students;
		}
		$student_data=array(
			"draw"=>intval($this->input->post('draw')),
			"recordsTotal"=>intval($totalData),
			"recordsFiltered"=>intval($totalFiltered),
			"data"=>$data,
		);
		echo json_encode($student_data);
	}
}