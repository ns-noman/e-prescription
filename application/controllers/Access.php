<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('prescription_model');

        $userType = $this->session->userdata('user_type');
        if($userType == "Super Admin"){
            redirect("admin");
        }elseif($userType == "Admin"){
            redirect("admin");
        }elseif($userType == "Client"){
            redirect("client");
        }elseif($userType == "Operator"){
            redirect("admin");
        }elseif($userType == "Doctor"){
            redirect("doctor");
        }

    }

    public function index()
    {
        $data = array();
        $data['main'] = true;
        $exp_date = "2023-12-31";
        $today = date('Y-m-d');
        //if ($today < $exp_date) {
        $data['main_content'] = $this->load->view('home/login_content', $data,true);
        $this->load->view('home/landing_page', $data);
        // }else{echo '<center><h1><p style="color:red; margin-top:250px;">Please Contact Support</p></h1></center>';}
    }

    public function user_access()
    {
        $email = trim($this->input->post('email'));
        $password = md5($this->input->post('password'));
        $numresult = $this->input->post('numresult');
        $cap = $this->input->post('cap');

        if($email && $password && $cap){

            $result = $this->prescription_model->check_user_exist($email);
            if($result){
                $user = $this->prescription_model->check_user_login($email, $password);
                if($user){
                    if($user->user_status == 1){
                        if($numresult == $cap){
                        $sdata = array();
                        $sdata['user_name'] = $user->user_name;
                        $sdata['user_id'] = $user->user_id;
                        $sdata['designation'] = $user->user_designation;
                        $sdata['user_email'] = $user->user_email;
                        $sdata['user_type'] = $user->user_type;
                        $sdata['active_status'] = $user->user_status;
                        $this->session->set_userdata($sdata);

                        $userType = $this->session->userdata('user_type');
                        if($userType == "Super Admin"){
                            redirect("admin");
                        }elseif($userType == "Admin"){
                            redirect("admin");
                        }elseif($userType == "Client"){
                            redirect("client");
                        }elseif($userType == "Operator"){
                            redirect("admin");
                        }elseif($userType == "Doctor"){
                            redirect("doctor");
                        }

                    }else{
                    $sdata = array();
                    $sdata['error_message'] = "<div class='alert alert-danger fade in''>Answer is not Correct! Try again.</div>";
                    $this->session->set_userdata($sdata);
                    redirect("login");
                }
                    }else{
                        $sdata = array();
                        $sdata['error_message'] = "<div class='alert alert-danger fade in''>Your account isn't Valid. Call help line.</div>";
                        $this->session->set_userdata($sdata);
                        redirect("login");
                    }
                }
                else{
                    $sdata = array();
                    $sdata['error_message'] = "<div class='alert alert-danger fade in''>Your Username or Password not matched! Try again.</div>";
                    $this->session->set_userdata($sdata);
                    redirect("login");
                }

            }
            else{
                $sdata = array();
                $sdata['error_message'] = "<div class='alert alert-danger fade in''>Sorry! You are not Registered or not approve yet. Call help line.</div>";
                $this->session->set_userdata($sdata);
                redirect("login");
            }
        }
        else{
            $sdata = array();
            $sdata['error_message'] = "<div class='alert alert-danger fade in''>Please insert all information correctly!</div>";
            $this->session->set_userdata($sdata);
            redirect("login");
        }


    }


   

} 