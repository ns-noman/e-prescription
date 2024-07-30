<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  
  public function __construct()
    {
        parent::__construct();
    
    $this->load->model('prescription_model');
    $userType = $this->session->userdata('user_type');
        if($userType == "Patient"){
            redirect("patient");
        }elseif($userType == "Super Admin"){
            redirect("admin");
        }elseif($userType == "Admin"){
            redirect("admin");
        }elseif($userType == "Client"){
            redirect("client");
        }elseif($userType == "Employee"){
            redirect("admin");
        }elseif($userType == "Doctor"){
            redirect("doctor");
        }
    }
  
  
  //User Page
  public function index()
  {
      $data = array();
        $data['main'] = true;
        $data['main_content'] = $this->load->view('home/front_end_content', $data,true);
        $this->load->view('home/front_end', $data);
  }

  //patient login
   public function patient_access()
    {
        $reg_no = trim($this->input->post('reg_no'));
        $mobile_no = ($this->input->post('mobile_no'));
        
        if($reg_no && $mobile_no){

            $result = $this->prescription_model->check_patient_exist($reg_no, $mobile_no);
            if($result){
                    if($result->patient_status == 1){
                      $otp = rand(1000, 9999);
                      $otp_info = array(
                            'patient_otp_id' => "ITI-".uniqid(),
                            'patient_id' => $result->patient_id,
                            'patient_otp' => $otp,
                            'otp_mobile' => $mobile_no,
                            'otp_entry_date' => date('Y-m-d'),
                            'otp_created_at' => date('Y-m-d h:i:s'),
                            'otp_status' => 1
                        );
                      $this->prescription_model->save_otp_info($otp_info);

                      
                    }else{
                        $sdata = array();
                        $sdata['error_message'] = "<div class='alert alert-danger fade in''>Your account isn't Valid. Call help line.</div>";
                        $this->session->set_userdata($sdata);
                        redirect("home");
                    }

            }else{
                $sdata = array();
                $sdata['error_message'] = "<div class='alert alert-danger fade in''>Sorry! Registration Number or Mobile Number Not Matched . Call help line.</div>";
                $this->session->set_userdata($sdata);
                redirect("home");
            }
        }else{
            $sdata = array();
            $sdata['error_message'] = "<div class='alert alert-danger fade in''>Please insert all information correctly!</div>";
            $this->session->set_userdata($sdata);
            redirect("home");
        }


    }

  //otp page
  public function patient_otp_entry($patient_id)
  {
      $data = array();
        $data['main'] = true;
        $data['patient'] = $patient_id;
        $data['main_content'] = $this->load->view('home/otp_entry_form', $data,true);
        $this->load->view('home/front_end', $data);
  }

  //patient login
   public function patient_otp_signin($patient_id)
    {
        $otp_no = trim($this->input->post('otp_no'));
        
        if($otp_no){

            $result = $this->prescription_model->check_patient_otp($otp_no, $patient_id);
            if($result){
                    if($result->otp_status == 1){
                      $otp_info = array(
                            'otp_status' => 0
                        );
                      $this->prescription_model->update_otp_info($otp_info, $result->patient_otp_id);

                      $patient_info = $this->prescription_model->get_patient_by_id($patient_id);

                        $sdata = array();
                        $sdata['user_name'] = $patient_info->patient_first_name." ".$patient_info->patient_last_name;
                        $sdata['patient'] = $patient_info->patient_id;
                        $sdata['reg_no'] = $patient_info->patient_reg_no;
                        $sdata['status'] = $patient_info->patient_status;
                        $sdata['user_type'] = "Patient";
                        $this->session->set_userdata($sdata);
                      redirect("patient");

                    }else{
                        $sdata = array();
                        $sdata['error_message'] = "<div class='alert alert-danger fade in''>Your OTP isn't Valid.</div>";
                        $this->session->set_userdata($sdata);
                        redirect("patient-otp/".$patient_id);
                    }

            }else{
                $sdata = array();
                $sdata['error_message'] = "<div class='alert alert-danger fade in''>Sorry! OTP Not Matched.</div>";
                $this->session->set_userdata($sdata);
                redirect("patient-otp/".$patient_id);
            }
        }else{
            $sdata = array();
            $sdata['error_message'] = "<div class='alert alert-danger fade in''>Please insert OTP correctly!</div>";
            $this->session->set_userdata($sdata);
            redirect("patient-otp/".$patient_id);
        }


    }
  
  
  


    
}
