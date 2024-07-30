<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		
		$this->load->model('prescription_model');
        $userType = $this->session->userdata('user_type');
        if($userType != "Patient"){
            redirect("/");
        }
    }

	public function index()
	{
        $date = date('Y-m-d');
        $data = array();
        $data['main'] = true;
        $patient_id = ($this->session->userdata('patient'));
        $data['main_content'] = $this->load->view('home/patient_home_content', $data,true);
        $this->load->view('home/patient_home', $data);
	}

	// patient Log Out
	public function patient_log_out() {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('patient');
        $this->session->unset_userdata('reg_no');
        $this->session->unset_userdata('status');
		$this->session->sess_destroy();
        redirect("/", "refresh");
    }
	
}
