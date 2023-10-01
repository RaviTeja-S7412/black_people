<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

	public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('user_id')){
			redirect('home/login');
		}
    } 

	public function index()
	{
		$this->load->view('index');
	}

	public function employees()
	{
		$this->load->view('employees');
	}

	public function schedules()
	{
		$this->load->view('schedules');
	}
	
	public function createSchedule()
	{
		$this->load->view('createSchedule');
	}
	
	public function deleteEmployee($eid)
	{

		$d = $this->db->delete("tbl_users", ["id"=>$eid]);

		if($d){
			echo json_encode(["status"=>true, "msg"=>"Successfully Deleted"]);
			exit;
		}else{
			echo json_encode(["status"=>false, "msg"=>"Error Occured"]);
			exit;
		}

	}

	public function updateStation()
	{
		$station = $this->input->post('station');
		$employee_id = $this->input->post('eid');

		if($station == ""){
			echo json_encode(["status"=>false, "msg"=>"Station Is Required"]);
			exit;
		}
		if($employee_id == ""){
			echo json_encode(["status"=>false, "msg"=>"Employee ID Is Required"]);
			exit;
		}

		$d = $this->db->where("id",$employee_id)->update("tbl_users",["station"=>$station]);

		if($d){
			echo json_encode(["status"=>true, "msg"=>"Successfully Updated"]);
			exit;
		}else{
			echo json_encode(["status"=>false, "msg"=>"Error Occured"]);
			exit;
		}
	}
	
	public function insertSchedule()
	{
		$user_id = $this->session->userdata('user_id');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');
		$station = $this->input->post('station');
		$employee_id = $this->input->post('employee_id');

		$chkSchedule = $this->db->get_where("tbl_schedules", ["employee_id"=>$employee_id, "start_time"=>$start_time, "end_time"=>$end_time])->num_rows();

		if($chkSchedule > 0){
			echo json_encode(["status"=>false, "msg"=>"Schedule Already Created"]);
			exit;
		}

		$d = $this->db->insert("tbl_schedules", ["created_by"=>$user_id,"station"=>$station,"start_time"=>$start_time,"end_time"=>$end_time,"employee_id"=>$employee_id]);

		if($d){
			echo json_encode(["status"=>true, "msg"=>"Successfully Created"]);
			exit;
		}else{
			echo json_encode(["status"=>false, "msg"=>"Error Occured"]);
			exit;
		}

	}
	
}
