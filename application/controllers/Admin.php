<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		
		$this->load->model('prescription_model');
        $userType = $this->session->userdata('user_type');
        if($userType != "Super Admin" && $userType != "Admin" && $userType != "Operator" && $userType != "Doctor"){
            redirect("/");
        }
    }
	
	// Admin Log Out
	public function admin_log_out() {
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('active_status');
		$this->session->sess_destroy();
        redirect("/", "refresh");
    }

	//Admin Dashboard
	public function index()
	{

    		$date = date('Y-m-d');
            $data = array();
            $data['main'] = true;
            $data['appointments'] = $this->prescription_model->get_datewise_appointment($date);
            $data['doc_app'] = $this->prescription_model->get_datewise_doctor_appointment($date);
            $prescriptions = $this->prescription_model->get_all_prescriptions();

            $visit = array();
            for($i = 30; $i > 0; $i--)
                {
                  $days = date("Y-m-d", strtotime("-$i days")).", ";
                  $visit['visit_label'][] = date("d/m", strtotime($days));
                  $yes_sub = $this->prescription_model->get_male_prescription($days);
                  $no_sub = $this->prescription_model->get_female_prescription($days);
                  $yes_count = count($yes_sub);
                  $no_count = count($no_sub);
                  $visit['male_count'][] = (int) $yes_count;
                  $visit['female_count'][] = (int) $no_count;

                }
            $data['visit_data'] = json_encode($visit);

              $vtype = array();
              $emergency_data = $this->prescription_model->get_emergency_prescription();
              $emergency_count = count($emergency_data);
              $followup_data = $this->prescription_model->get_followup_prescription();
              $followup_count = count($followup_data);
              $general_data = $this->prescription_model->get_general_prescription();
              $general_count = count($general_data);
              $consultation_data = $this->prescription_model->get_consultation_prescription();
              $consultation_count = count($consultation_data);
              $vtype['emergency'] = (int) $emergency_count;
              $vtype['followup'] = (int) $followup_count;
              $vtype['general'] = (int) $general_count;
              $vtype['consultation'] = (int) $consultation_count;
              $data['type_data'] = json_encode($vtype);

            //exit();

            // $sub = array();
            //   foreach($prescriptions as $ques) {
            //         $sub['sub_label'][] = date("d/m", strtotime($d));
            //         $yes_sub = $this->prescription_model->get_male_prescription($ques->visit_date);
            //         $no_sub = $this->prescription_model->get_female_prescription($ques->visit_date);
            //         $yes_count = count($yes_sub);
            //         $no_count = count($no_sub);
            //         $sub['yes_count'][] = (int) $yes_count;
            //         $sub['no_count'][] = (int) $no_count;
            //   }
            //$data['sub_data'] = json_encode($sub);
            
            
            $data['main_content'] = $this->load->view('home/admin_home_content', $data,true);
            $this->load->view('home/admin_home', $data);
	}

/////Start User Module/////
    
// Start of user entry
    public function new_user()
    {
       $data = array();
            $data['main'] = true;
            $data['menu'] = $this->prescription_model->get_menu();
            $data['main_content'] = $this->load->view('home/new_user_form', $data,true);
            $this->load->view('home/admin_home', $data);
    }
    
    public function add_user()
    {
        $user_id = "ADU-".uniqid();
        $name = ($this->input->post('name'));
        $user_designation = ($this->input->post('user_designation'));
        $email = ($this->input->post('email'));
        $password = md5($this->input->post('password'));
        $repassword = md5($this->input->post('repassword'));
        $type = ($this->input->post('type'));
        $entry_by = ($this->session->userdata('user_id'));
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $active_status = 1;

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|max_length[30]|xss_clean');
        //$this->form_validation->set_rules('user_designation', 'Designation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.user_email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|callback_password_check');
        $this->form_validation->set_rules('repassword', 'Password Match', 'trim|required|matches[password]|min_length[6]');
        $this->form_validation->set_rules('type', 'User Type', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['menu'] = $this->prescription_model->get_menu();
            $data['main_content'] = $this->load->view('home/new_user_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            $data = array(
                'user_id' => $user_id,
                'user_name' => $name,
                'user_designation' => $user_designation,
                'user_email' => $email,
                'user_password' => $password,
                'user_type' => $type,
                'user_entry_by' => $entry_by,
                'user_entry_date' => $entry_date,
                'user_created_at' => $created_at,
                'user_status' =>$active_status    
        );
        
             $this->prescription_model->insert_user($data);

        $menu_id = $this->input->post('menue_prev');
        if ($menu_id) {
        $qty = count($menu_id);
        for($m=0; $m<$qty; $m++)
                {
                    $privilege = array(
                        'privilege_id' => "PRI-".uniqid(),
                        'menu_id' => $menu_id[$m],
                        'user_id' => $user_id,
                        'privilege_entry_by' => $entry_by,
                        'privilege_entry_date' => $entry_date,
                        'privilege_created_at' => $created_at,
                        'privilege_status' => $active_status
                      );
                $this->prescription_model->save_user_privilege($privilege);
                  
                }
            }
             
            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in'>Successfully User Created!</div>";
            $this->session->set_userdata($sdata);
            redirect("user-list");
            
        }
    }
    
    //password validation
    public function password_check($s)
    {

        $string = str_split($s);
        if (in_array('=', $string) ||in_array('(-)', $string) ||in_array('*', $string) ||in_array('&', $string) ||in_array('^', $string) ||in_array('!', $string) ||in_array('#', $string) || in_array('@', $string ) || in_array('_', $string ) || in_array('$', $string)) {
            return TRUE;
        }else{
            $this->form_validation->set_message('password_check', 'Special Characters (e.g : #, $, @, _) required for strong password!');
            return FALSE;
        }

    }
// End of user entry

//user list
    public function user_list()
    {
        $data = array();
        $data['main'] = true;
        $data['users'] = $this->prescription_model->get_user();
        $data['main_content'] = $this->load->view('home/user_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

// User re-set form
    public function re_set_user($user_id)
    {
        $data = array();
        $data['main'] = true;
        $data['menu'] = $this->prescription_model->get_menu();
        $data['privilege'] = $this->prescription_model->get_user_privilege($user_id);
        $data['update_user'] = $this->prescription_model->show_user_by_id($user_id);
        $data['main_content'] = $this->load->view('home/user_reset_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }
        
//Update User Information
    public function update_user_id($user_id)
    {       
        $name = ($this->input->post('name'));
        $user_designation = ($this->input->post('user_designation'));
        $type = ($this->input->post('type'));
        $updated_at = date('Y-m-d H:i:s');
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        //$this->form_validation->set_rules('user_designation', 'Designation', 'required');
        $this->form_validation->set_rules('type', 'User Type', 'required');
        
            if ($this->form_validation->run() == FALSE)
            {
                $data = array();
                $data['main'] = true;
                $data['menu'] = $this->prescription_model->get_menu();
                $data['privilege'] = $this->prescription_model->get_user_privilege($user_id);
                $data['update_user'] = $this->prescription_model->show_user_by_id($user_id);
                $data['main_content'] = $this->load->view('home/user_reset_form', $data,true);
                $this->load->view('home/admin_home', $data);
            
            }else{
                $user_data = array(
                'user_name' => $name,
                'user_designation' => $user_designation,
                'user_type' => $type,
                'user_updated_at' => $updated_at,
                'user_updated_by' => $this->session->userdata('user_id')
        );
    
                $this->prescription_model->update_user_id($user_data, $user_id);

         $this->prescription_model->remove_user_privilege($user_id);       
         $menu_id = $this->input->post('menue_prev');
            if ($menu_id) {
            $qty = count($menu_id);
            for($m=0; $m<$qty; $m++)
                    {
                        $privilege = array(
                            'privilege_id' => "PRI-".uniqid(),
                            'menu_id' => $menu_id[$m],
                            'user_id' => $user_id,
                            'privilege_entry_by' => $this->session->userdata('user_id'),
                            'privilege_entry_date' => date('Y-m-d'),
                            'privilege_created_at' => $updated_at,
                            'privilege_status' => 1
                          );
                    $this->prescription_model->save_user_privilege($privilege);
                      
                    }
                }
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>User Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("user-list");
        }
    
    }
    
// User password re-set form
    public function re_set_password($user_id)
        {
            if($this->session->userdata('active_status') == 1)
        {
            $data = array();
            $data['main'] = true;
            $data['update_user'] = $this->prescription_model->show_user_by_id($user_id);
            $data['main_content'] = $this->load->view('home/user_password_reset_form', $data,true);
            $this->load->view('home/admin_home', $data);
        
                }else
                {
                   redirect('/', 'refresh');
                }
        }
        
//Update User Password
    public function update_user_password($user_id)
        
        {
            if($this->session->userdata('active_status') == 1)
        {
        $password = md5($this->input->post('password'));
        $repassword = md5($this->input->post('repassword'));
        $updated_at = date('Y-m-d H:i:s');
        
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|callback_password_check');
        $this->form_validation->set_rules('repassword', 'Password Retype', 'trim|required|matches[password]|min_length[6]');
        
            if ($this->form_validation->run() == FALSE)
            {
                $data = array();
                $data['main'] = true;
                $data['update_user'] = $this->prescription_model->show_user_by_id($user_id);
                $data['main_content'] = $this->load->view('home/user_password_reset_form', $data,true);
                $this->load->view('home/admin_home', $data);
            
            }else{
                $user_data = array(
                'user_password' => $password,
                'user_updated_at' => $updated_at,
                'user_updated_by' => $this->session->userdata('user_id')
        );
    
                $this->prescription_model->update_user_id($user_data, $user_id);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>User Password Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("admin");
        }
        }else
                {
                   redirect('/', 'refresh');
                }
    }
    
//activate user status
    public function activate_user_id($user_id)
    {
        if($this->session->userdata('active_status') == 1)
        {
        $updated_at = date('Y-m-d H:i:s');
        $user_data['user_status'] = 1;
        $user_data['user_updated_by'] = $this->session->userdata('user_id');
        $user_data['user_updated_at'] = $updated_at;
        $this->prescription_model->update_user_id($user_data, $user_id);
        $sdata = array();
        $sdata['success'] = "<div class='alert alert-success fade in'>User Activated!</div>";
        $this->session->set_userdata($sdata);
        redirect("user-list");

        }else
                {
                   redirect('/', 'refresh');
                }
    }
    
//deactivate user status
    public function deactivate_user_id($user_id)
    {
        if($this->session->userdata('active_status') == 1)
        {
        $updated_at = date('Y-m-d H:i:s');
        $user_data['user_status'] = 0;
        $user_data['user_updated_by'] = $this->session->userdata('user_id');
        $user_data['user_updated_at'] = $updated_at;

        $this->prescription_model->update_user_id($user_data, $user_id);
        $sdata = array();
        $sdata['success'] = "<div class='alert alert-success fade in'>User Deactivated!</div>";
        $this->session->set_userdata($sdata);
        redirect("user-list");
    
            }else
                {
                   redirect('/', 'refresh');
                }
    }
/////Start menu/////
    //menu List
    public function menu_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['menu'] = $this->prescription_model->get_menu();
        $data['main_content'] = $this->load->view('home/menu_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save menu
    public function save_menu()
    {
        $menu = array(
            'menu_id' => "DEPT-".uniqid(),
            'menu_name' => $this->input->post('menu_name'),
            'menu_code' => $this->input->post('menu_code'),
            'menu_entry_by' => $this->session->userdata('user_id'),
            'menu_entry_date' => date('Y-m-d'),
            'menu_created_at' => date('Y-m-d H:i:s'),
            'menu_status' => 1
        );

        $this->form_validation->set_rules('menu_name', 'Name', 'required|is_unique[menus.menu_name]');
        $this->form_validation->set_rules('menu_code', 'ID', 'required|is_unique[menus.menu_code]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['menu'] = $this->prescription_model->get_menu();
            $data['main_content'] = $this->load->view('home/menu_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_menu($menu);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("menu-setup");
            }
    }

    //menu edit Form
    public function edit_menu($menu_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_menu_by_id($menu_id);
        $data['menu'] = $this->prescription_model->get_menu();
        $data['main_content'] = $this->load->view('home/menu_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update menu info
    public function update_menu($menu_id)
    {
        $menu = array(
            'menu_name' => $this->input->post('menu_name'),
            'menu_code' => $this->input->post('menu_code'),
            'menu_updated_by' => $this->session->userdata('user_id'),
            'menu_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('menu_name', 'Name', 'required');
        $this->form_validation->set_rules('menu_code', 'ID', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_menu_by_id($menu_id);
            $data['menu'] = $this->prescription_model->get_menu();
            $data['main_content'] = $this->load->view('home/menu_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_menu($menu, $menu_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("menu-setup");
            }
    }

///////////end menu //////////

/////End User Module/////

/////Start department/////
    //department List
    public function department_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['department'] = $this->prescription_model->get_department();
        $data['main_content'] = $this->load->view('home/department_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save department
    public function save_department()
    {
        $department = array(
            'department_id' => "DEPT-".uniqid(),
            'department_name' => $this->input->post('department_name'),
            'department_entry_by' => $this->session->userdata('user_id'),
            'department_entry_date' => date('Y-m-d'),
            'department_created_at' => date('Y-m-d H:i:s'),
            'department_status' => 1
        );

        $this->form_validation->set_rules('department_name', 'department', 'required|is_unique[departments.department_name]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['department'] = $this->prescription_model->get_department();
            $data['main_content'] = $this->load->view('home/department_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_department($department);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("department-setup");
            }
    }

    //department edit Form
    public function edit_department($department_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_department_by_id($department_id);
        $data['department'] = $this->prescription_model->get_department();
        $data['main_content'] = $this->load->view('home/department_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update department info
    public function update_department($department_id)
    {
        $department = array(
            'department_name' => $this->input->post('department_name'),
            'department_updated_by' => $this->session->userdata('user_id'),
            'department_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('department_name', 'department', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_department_by_id($department_id);
            $data['department'] = $this->prescription_model->get_department();
            $data['main_content'] = $this->load->view('home/department_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_department($department, $department_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("department-setup");
            }
    }

///////////end department //////////

/////Start chief complaint/////
    //chief complaint List
    public function chief_complaint_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['chief_complaint'] = $this->prescription_model->get_chief_complaint();
        $data['main_content'] = $this->load->view('home/chief_complaint_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save chief complaint
    public function save_chief_complaint()
    {
        $complaint = array(
            'chief_complaint_id' => "CCI-".uniqid(),
            'chief_complaint_eng' => $this->input->post('chief_complaint_eng'),
            'chief_complaint_ban' => $this->input->post('chief_complaint_ban'),
            'chief_complaint_entry_by' => $this->session->userdata('user_id'),
            'chief_complaint_entry_date' => date('Y-m-d'),
            'chief_complaint_created_at' => date('Y-m-d H:i:s'),
            'chief_complaint_status' => 1
        );

        $this->form_validation->set_rules('chief_complaint_eng', 'Complaint', 'required|is_unique[chief_complaints.chief_complaint_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['chief_complaint'] = $this->prescription_model->get_chief_complaint();
            $data['main_content'] = $this->load->view('home/chief_complaint_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_chief_complaint($complaint);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("chief-complaint-setup");
            }
    }

    //chief complaint edit Form
    public function edit_chief_complaint($chief_complaint_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_chief_complaint_by_id($chief_complaint_id);
        $data['chief_complaint'] = $this->prescription_model->get_chief_complaint();
        $data['main_content'] = $this->load->view('home/chief_complaint_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update chief complaint info
    public function update_chief_complaint($chief_complaint_id)
    {
        $complaint = array(
            'chief_complaint_eng' => $this->input->post('chief_complaint_eng'),
            'chief_complaint_ban' => $this->input->post('chief_complaint_ban'),
            'chief_complaint_updated_by' => $this->session->userdata('user_id'),
            'chief_complaint_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('chief_complaint_eng', 'Complaint', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_chief_complaint_by_id($chief_complaint_id);
            $data['chief_complaint'] = $this->prescription_model->get_chief_complaint();
            $data['main_content'] = $this->load->view('home/chief_complaint_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_chief_complaint($complaint, $chief_complaint_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("chief-complaint-setup");
            }
    }

///////////end chief complaint //////////

/////Start examination/////
    //examination List
    public function examination_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['examination'] = $this->prescription_model->get_examination();
        $data['main_content'] = $this->load->view('home/examination_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save examination
    public function save_examination()
    {
        $examination = array(
            'examination_id' => "EXI-".uniqid(),
            'examination_eng' => $this->input->post('examination_eng'),
            'examination_ban' => $this->input->post('examination_ban'),
            'examination_entry_by' => $this->session->userdata('user_id'),
            'examination_entry_date' => date('Y-m-d'),
            'examination_created_at' => date('Y-m-d H:i:s'),
            'examination_status' => 1
        );

        $this->form_validation->set_rules('examination_eng', 'Examination', 'required|is_unique[examinations.examination_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['examination'] = $this->prescription_model->get_examination();
            $data['main_content'] = $this->load->view('home/examination_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_examination($examination);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("examination-setup");
            }
    }

    //examination edit Form
    public function edit_examination($examination_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_examination_by_id($examination_id);
        $data['examination'] = $this->prescription_model->get_examination();
        $data['main_content'] = $this->load->view('home/examination_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update examination info
    public function update_examination($examination_id)
    {
        $examination = array(
            'examination_eng' => $this->input->post('examination_eng'),
            'examination_ban' => $this->input->post('examination_ban'),
            'examination_updated_by' => $this->session->userdata('user_id'),
            'examination_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('examination_eng', 'Examination', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_examination_by_id($examination_id);
            $data['examination'] = $this->prescription_model->get_examination();
            $data['main_content'] = $this->load->view('home/examination_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_examination($examination, $examination_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("examination-setup");
            }
    }

///////////end examination //////////

/////Start history/////
    //history List
    public function history_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['history'] = $this->prescription_model->get_history();
        $data['main_content'] = $this->load->view('home/history_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save history
    public function save_history()
    {
        $history = array(
            'history_id' => "HII-".uniqid(),
            'history_eng' => $this->input->post('history_eng'),
            'history_ban' => $this->input->post('history_ban'),
            'history_entry_by' => $this->session->userdata('user_id'),
            'history_entry_date' => date('Y-m-d'),
            'history_created_at' => date('Y-m-d H:i:s'),
            'history_status' => 1
        );

        $this->form_validation->set_rules('history_eng', 'History', 'required|is_unique[histories.history_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['history'] = $this->prescription_model->get_history();
            $data['main_content'] = $this->load->view('home/history_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_history($history);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("history-setup");
            }
    }

    //history edit Form
    public function edit_history($history_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_history_by_id($history_id);
        $data['history'] = $this->prescription_model->get_history();
        $data['main_content'] = $this->load->view('home/history_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update history info
    public function update_history($history_id)
    {
        $history = array(
            'history_eng' => $this->input->post('history_eng'),
            'history_ban' => $this->input->post('history_ban'),
            'history_updated_by' => $this->session->userdata('user_id'),
            'history_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('history_eng', 'History', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_history_by_id($history_id);
            $data['history'] = $this->prescription_model->get_history();
            $data['main_content'] = $this->load->view('home/history_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_history($history, $history_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("history-setup");
            }
    }

///////////end history //////////

/////Start diagnosis/////
    //diagnosis List
    public function diagnosis_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['diagnosis'] = $this->prescription_model->get_diagnosis();
        $data['main_content'] = $this->load->view('home/diagnosis_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save diagnosis
    public function save_diagnosis()
    {
        $diagnosis = array(
            'diagnosis_id' => "DII-".uniqid(),
            'diagnosis_eng' => $this->input->post('diagnosis_eng'),
            'diagnosis_ban' => $this->input->post('diagnosis_ban'),
            'diagnosis_icd10' => $this->input->post('diagnosis_icd10'),
            'diagnosis_entry_by' => $this->session->userdata('user_id'),
            'diagnosis_entry_date' => date('Y-m-d'),
            'diagnosis_created_at' => date('Y-m-d H:i:s'),
            'diagnosis_status' => 1
        );

        $this->form_validation->set_rules('diagnosis_eng', 'Diagnosis', 'required|is_unique[diagnoses.diagnosis_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['diagnosis'] = $this->prescription_model->get_diagnosis();
            $data['main_content'] = $this->load->view('home/diagnosis_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_diagnosis($diagnosis);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("diagnosis-setup");
            }
    }

    //diagnosis edit Form
    public function edit_diagnosis($diagnosis_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_diagnosis_by_id($diagnosis_id);
        $data['diagnosis'] = $this->prescription_model->get_diagnosis();
        $data['main_content'] = $this->load->view('home/diagnosis_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update diagnosis info
    public function update_diagnosis($diagnosis_id)
    {
        $diagnosis = array(
            'diagnosis_eng' => $this->input->post('diagnosis_eng'),
            'diagnosis_ban' => $this->input->post('diagnosis_ban'),
            'diagnosis_icd10' => $this->input->post('diagnosis_icd10'),
            'diagnosis_updated_by' => $this->session->userdata('user_id'),
            'diagnosis_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('diagnosis_eng', 'Diagnosis', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_diagnosis_by_id($diagnosis_id);
            $data['diagnosis'] = $this->prescription_model->get_diagnosis();
            $data['main_content'] = $this->load->view('home/diagnosis_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_diagnosis($diagnosis, $diagnosis_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("diagnosis-setup");
            }
    }

///////////end diagnosis //////////

/////Start investigation type/////
    //investigation type List
    public function investigation_type_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['investigation_type'] = $this->prescription_model->get_investigation_type();
        $data['main_content'] = $this->load->view('home/investigation_type_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save investigation type
    public function save_investigation_type()
    {
        $type = array(
            'investigation_type_id' => "ITI-".uniqid(),
            'investigation_type' => $this->input->post('investigation_type'),
            'investigation_type_entry_by' => $this->session->userdata('user_id'),
            'investigation_type_entry_date' => date('Y-m-d'),
            'investigation_type_created_at' => date('Y-m-d H:i:s'),
            'investigation_type_status' => 1
        );

        $this->form_validation->set_rules('investigation_type', 'Type', 'required|is_unique[investigation_types.investigation_type]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['investigation_type'] = $this->prescription_model->get_investigation_type();
            $data['main_content'] = $this->load->view('home/investigation_type_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_investigation_type($type);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("investigation-type-setup");
            }
    }

    //investigation type edit Form
    public function edit_investigation_type($investigation_type_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_investigation_type_by_id($investigation_type_id);
        $data['investigation_type'] = $this->prescription_model->get_investigation_type();
        $data['main_content'] = $this->load->view('home/investigation_type_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update investigation type info
    public function update_investigation_type($investigation_type_id)
    {
        $type = array(
            'investigation_type' => $this->input->post('investigation_type'),
            'investigation_type_updated_by' => $this->session->userdata('user_id'),
            'investigation_type_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('investigation_type', 'Type', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_investigation_type_by_id($investigation_type_id);
            $data['investigation_type'] = $this->prescription_model->get_investigation_type();
            $data['main_content'] = $this->load->view('home/investigation_type_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_investigation_type($type, $investigation_type_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("investigation-type-setup");
            }
    }

///////////end investigation type //////////

/////Start investigation/////
    //investigation List
    public function investigation_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['investigation_type'] = $this->prescription_model->get_investigation_type();
        $data['investigation'] = $this->prescription_model->get_investigation();
        $data['main_content'] = $this->load->view('home/investigation_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save investigation
    public function save_investigation()
    {
        $investigation = array(
            'investigation_id' => "INI-".uniqid(),
            'investigation_type_id' => $this->input->post('investigation_type_id'),
            'investigation' => $this->input->post('investigation'),
            'investigation_entry_by' => $this->session->userdata('user_id'),
            'investigation_entry_date' => date('Y-m-d'),
            'investigation_created_at' => date('Y-m-d H:i:s'),
            'investigation_status' => 1
        );

        $this->form_validation->set_rules('investigation', 'Investigation', 'required');
        $this->form_validation->set_rules('investigation_type_id', 'Type', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['investigation_type'] = $this->prescription_model->get_investigation_type();
            $data['investigation'] = $this->prescription_model->get_investigation();
            $data['main_content'] = $this->load->view('home/investigation_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_investigation($investigation);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("investigation-setup");
            }
    }

    //investigation edit Form
    public function edit_investigation($investigation_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_investigation_by_id($investigation_id);
        $data['investigation_type'] = $this->prescription_model->get_investigation_type();
        $data['investigation'] = $this->prescription_model->get_investigation();
        $data['main_content'] = $this->load->view('home/investigation_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update investigation info
    public function update_investigation($investigation_id)
    {
        $investigation = array(
            'investigation_type_id' => $this->input->post('investigation_type_id'),
            'investigation' => $this->input->post('investigation'),
            'investigation_updated_by' => $this->session->userdata('user_id'),
            'investigation_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('investigation', 'Investigation', 'required');
        $this->form_validation->set_rules('investigation_type_id', 'Type', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_investigation_by_id($investigation_id);
            $data['investigation_type'] = $this->prescription_model->get_investigation_type();
            $data['investigation'] = $this->prescription_model->get_investigation();
            $data['main_content'] = $this->load->view('home/investigation_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_investigation($investigation, $investigation_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("investigation-setup");
            }
    }

///////////end investigation //////////

/////Start health advice/////
    //health advice List
    public function health_advice_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['health_advice'] = $this->prescription_model->get_health_advice();
        $data['main_content'] = $this->load->view('home/health_advice_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save health advice
    public function save_health_advice()
    {
        $advice = array(
            'health_advice_id' => "HAI-".uniqid(),
            'health_advice_eng' => $this->input->post('health_advice_eng'),
            'health_advice_ban' => $this->input->post('health_advice_ban'),
            'health_advice_entry_by' => $this->session->userdata('user_id'),
            'health_advice_entry_date' => date('Y-m-d'),
            'health_advice_created_at' => date('Y-m-d H:i:s'),
            'health_advice_status' => 1
        );

        $this->form_validation->set_rules('health_advice_eng', 'Advice', 'required|is_unique[health_advices.health_advice_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['health_advice'] = $this->prescription_model->get_health_advice();
            $data['main_content'] = $this->load->view('home/health_advice_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_health_advice($advice);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("health-advice-setup");
            }
    }

    //health advice edit Form
    public function edit_health_advice($health_advice_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_health_advice_by_id($health_advice_id);
        $data['health_advice'] = $this->prescription_model->get_health_advice();
        $data['main_content'] = $this->load->view('home/health_advice_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update health advice info
    public function update_health_advice($health_advice_id)
    {
        $advice = array(
            'health_advice_eng' => $this->input->post('health_advice_eng'),
            'health_advice_ban' => $this->input->post('health_advice_ban'),
            'health_advice_updated_by' => $this->session->userdata('user_id'),
            'health_advice_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('health_advice_eng', 'Advice', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_health_advice_by_id($health_advice_id);
            $data['health_advice'] = $this->prescription_model->get_health_advice();
            $data['main_content'] = $this->load->view('home/health_advice_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_health_advice($advice, $health_advice_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("health-advice-setup");
            }
    }

///////////end health advice //////////

/////Start special note/////
    //special note List
    public function special_note_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['special_note'] = $this->prescription_model->get_special_note();
        $data['main_content'] = $this->load->view('home/special_note_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save special note
    public function save_special_note()
    {
        $note = array(
            'special_note_id' => "SNI-".uniqid(),
            'special_note_eng' => $this->input->post('special_note_eng'),
            'special_note_ban' => $this->input->post('special_note_ban'),
            'special_note_entry_by' => $this->session->userdata('user_id'),
            'special_note_entry_date' => date('Y-m-d'),
            'special_note_created_at' => date('Y-m-d H:i:s'),
            'special_note_status' => 1
        );

        $this->form_validation->set_rules('special_note_eng', 'Note', 'required|is_unique[special_notes.special_note_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['special_note'] = $this->prescription_model->get_special_note();
            $data['main_content'] = $this->load->view('home/special_note_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_special_note($note);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("special-note-setup");
            }
    }

    //special note edit Form
    public function edit_special_note($special_note_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_special_note_by_id($special_note_id);
        $data['special_note'] = $this->prescription_model->get_special_note();
        $data['main_content'] = $this->load->view('home/special_note_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update special note info
    public function update_special_note($special_note_id)
    {
        $note = array(
            'special_note_eng' => $this->input->post('special_note_eng'),
            'special_note_ban' => $this->input->post('special_note_ban'),
            'special_note_updated_by' => $this->session->userdata('user_id'),
            'special_note_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('special_note_eng', 'Note', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_special_note_by_id($special_note_id);
            $data['special_note'] = $this->prescription_model->get_special_note();
            $data['main_content'] = $this->load->view('home/special_note_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_special_note($note, $special_note_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("special-note-setup");
            }
    }

///////////end special note //////////

/////Start refer/////
    //refer List
    public function refer_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['refer'] = $this->prescription_model->get_refer();
        $data['main_content'] = $this->load->view('home/refer_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save refer
    public function save_refer()
    {
        $refer = array(
            'refer_id' => "ROI-".uniqid(),
            'refer_region' => $this->input->post('refer_region'),
            'refer_org' => $this->input->post('refer_org'),
            'refer_entry_by' => $this->session->userdata('user_id'),
            'refer_entry_date' => date('Y-m-d'),
            'refer_created_at' => date('Y-m-d H:i:s'),
            'refer_status' => 1
        );

        //$this->form_validation->set_rules('refer_region', 'Region', 'required');
        $this->form_validation->set_rules('refer_org', 'Hospital', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['refer'] = $this->prescription_model->get_refer();
            $data['main_content'] = $this->load->view('home/refer_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_refer($refer);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("refer-setup");
            }
    }

    //refer edit Form
    public function edit_refer($refer_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_refer_by_id($refer_id);
        $data['refer'] = $this->prescription_model->get_refer();
        $data['main_content'] = $this->load->view('home/refer_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update refer info
    public function update_refer($refer_id)
    {
        $refer = array(
            'refer_region' => $this->input->post('refer_region'),
            'refer_org' => $this->input->post('refer_org'),
            'refer_updated_by' => $this->session->userdata('user_id'),
            'refer_updated_at' => date('Y-m-d H:i:s'),
        );

        //$this->form_validation->set_rules('refer_region', 'Region', 'required');
        $this->form_validation->set_rules('refer_org', 'Hospital', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_refer_by_id($refer_id);
            $data['refer'] = $this->prescription_model->get_refer();
            $data['main_content'] = $this->load->view('home/refer_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_refer($refer, $refer_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("refer-setup");
            }
    }

///////////end refer //////////

/////Start doses administration/////
    //doses administration List
    public function doses_administration_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['doses_administration'] = $this->prescription_model->get_doses_administration();
        $data['main_content'] = $this->load->view('home/doses_administration_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save doses administration
    public function save_doses_administration()
    {
        $doses = array(
            'doses_administration_id' => "DAI-".uniqid(),
            'doses_administration_eng' => $this->input->post('doses_administration_eng'),
            'doses_administration_ban' => $this->input->post('doses_administration_ban'),
            'doses_administration_entry_by' => $this->session->userdata('user_id'),
            'doses_administration_entry_date' => date('Y-m-d'),
            'doses_administration_created_at' => date('Y-m-d H:i:s'),
            'doses_administration_status' => 1
        );

        $this->form_validation->set_rules('doses_administration_eng', 'doses', 'required|is_unique[doses_administrations.doses_administration_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['doses_administration'] = $this->prescription_model->get_doses_administration();
            $data['main_content'] = $this->load->view('home/doses_administration_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_doses_administration($doses);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("doses-administration-setup");
            }
    }

    //doses administration edit Form
    public function edit_doses_administration($doses_administration_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_doses_administration_by_id($doses_administration_id);
        $data['doses_administration'] = $this->prescription_model->get_doses_administration();
        $data['main_content'] = $this->load->view('home/doses_administration_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update doses administration info
    public function update_doses_administration($doses_administration_id)
    {
        $doses = array(
            'doses_administration_eng' => $this->input->post('doses_administration_eng'),
            'doses_administration_ban' => $this->input->post('doses_administration_ban'),
            'doses_administration_updated_by' => $this->session->userdata('user_id'),
            'doses_administration_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('doses_administration_eng', 'doses', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_doses_administration_by_id($doses_administration_id);
            $data['doses_administration'] = $this->prescription_model->get_doses_administration();
            $data['main_content'] = $this->load->view('home/doses_administration_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_doses_administration($doses, $doses_administration_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("doses-administration-setup");
            }
    }

///////////end doses administration //////////

/////Start doses duration/////
    //doses duration List
    public function doses_duration_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['doses_duration'] = $this->prescription_model->get_doses_duration();
        $data['main_content'] = $this->load->view('home/doses_duration_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save doses duration
    public function save_doses_duration()
    {
        $duration = array(
            'doses_duration_id' => "DDI-".uniqid(),
            'doses_duration_eng' => $this->input->post('doses_duration_eng'),
            'doses_duration_ban' => $this->input->post('doses_duration_ban'),
            'doses_duration_entry_by' => $this->session->userdata('user_id'),
            'doses_duration_entry_date' => date('Y-m-d'),
            'doses_duration_created_at' => date('Y-m-d H:i:s'),
            'doses_duration_status' => 1
        );

        $this->form_validation->set_rules('doses_duration_eng', 'Duration', 'required|is_unique[doses_durations.doses_duration_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['doses_duration'] = $this->prescription_model->get_doses_duration();
            $data['main_content'] = $this->load->view('home/doses_duration_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_doses_duration($duration);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("doses-duration-setup");
            }
    }

    //doses duration edit Form
    public function edit_doses_duration($doses_duration_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_doses_duration_by_id($doses_duration_id);
        $data['doses_duration'] = $this->prescription_model->get_doses_duration();
        $data['main_content'] = $this->load->view('home/doses_duration_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update doses duration info
    public function update_doses_duration($doses_duration_id)
    {
        $duration = array(
            'doses_duration_eng' => $this->input->post('doses_duration_eng'),
            'doses_duration_ban' => $this->input->post('doses_duration_ban'),
            'doses_duration_updated_by' => $this->session->userdata('user_id'),
            'doses_duration_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('doses_duration_eng', 'Duration', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_doses_duration_by_id($doses_duration_id);
            $data['doses_duration'] = $this->prescription_model->get_doses_duration();
            $data['main_content'] = $this->load->view('home/doses_duration_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_doses_duration($duration, $doses_duration_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("doses-duration-setup");
            }
    }

///////////end doses duration //////////

/////Start meal administration/////
    //meal administration List
    public function meal_administration_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['meal_administration'] = $this->prescription_model->get_meal_administration();
        $data['main_content'] = $this->load->view('home/meal_administration_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save meal administration
    public function save_meal_administration()
    {
        $meal = array(
            'meal_administration_id' => "MEI-".uniqid(),
            'meal_administration_eng' => $this->input->post('meal_administration_eng'),
            'meal_administration_ban' => $this->input->post('meal_administration_ban'),
            'meal_administration_entry_by' => $this->session->userdata('user_id'),
            'meal_administration_entry_date' => date('Y-m-d'),
            'meal_administration_created_at' => date('Y-m-d H:i:s'),
            'meal_administration_status' => 1
        );

        $this->form_validation->set_rules('meal_administration_eng', 'Meal', 'required|is_unique[meal_administrations.meal_administration_eng]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['meal_administration'] = $this->prescription_model->get_meal_administration();
            $data['main_content'] = $this->load->view('home/meal_administration_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_meal_administration($meal);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("meal-administration-setup");
            }
    }

    //meal administration edit Form
    public function edit_meal_administration($meal_administration_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_meal_administration_by_id($meal_administration_id);
        $data['meal_administration'] = $this->prescription_model->get_meal_administration();
        $data['main_content'] = $this->load->view('home/meal_administration_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update meal administration info
    public function update_meal_administration($meal_administration_id)
    {
        $meal = array(
            'meal_administration_eng' => $this->input->post('meal_administration_eng'),
            'meal_administration_ban' => $this->input->post('meal_administration_ban'),
            'meal_administration_updated_by' => $this->session->userdata('user_id'),
            'meal_administration_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('meal_administration_eng', 'Meal', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_meal_administration_by_id($meal_administration_id);
            $data['meal_administration'] = $this->prescription_model->get_meal_administration();
            $data['main_content'] = $this->load->view('home/meal_administration_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_meal_administration($meal, $meal_administration_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("meal-administration-setup");
            }
    }

///////////end meal administration //////////

///////////Start Manufacturer //////////
    //Manufacturer Entry Form
    public function manufacturer_entry_form()
    {
        $data = array();
        $data['main'] = true;
        $data['main_content'] = $this->load->view('home/manufacturer_entry_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save Manufacturar Entry
    public function save_manufacturer()
    {
        $manufacturer_info = array(
            'man_id' => "MAN-".uniqid(),
            'man_name' => $this->input->post('man_name'),
            'man_email' => $this->input->post('man_email'),
            'man_mobile' => $this->input->post('man_mobile'),
            'man_address' => $this->input->post('man_address'),
            'man_cr_amount' => $this->input->post('man_cr_amount'),
            'man_cr_amount_dt' => $this->input->post('man_cr_amount_dt'),
            'man_entry_by' => $this->session->userdata('user_id'),
            'man_entry_date' => date('Y-m-d'),
            'man_created_at' => date('Y-m-d H:i:s'),
            'man_status' => 1
        );

        $this->form_validation->set_rules('man_name', 'Name', 'required');
        $this->form_validation->set_rules('man_email', 'Email Address', 'valid_email|is_unique[manufacturer.man_email]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['main_content'] = $this->load->view('home/manufacturer_entry_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            $this->prescription_model->save_manufacturer($manufacturer_info);

            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in''>New Manufacturer Created Successfully!</div>";
            $this->session->set_userdata($sdata);
            redirect("manufacturer-list");
            }
    }

    //manufacturar List
    public function manufacturer_list()
    {
        $data = array();
        $data['main'] = true;
        $client_id = $this->session->userdata('user_id');
        $data['manufacturer_info'] = $this->prescription_model->get_manufacturer();
        $data['main_content'] = $this->load->view('home/manufacturer_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    //Client edit Form
    public function edit_manufacturer($man_id)
    {
        $data = array();
        $data['main'] = true;
        $data['manufacturer_info'] = $this->prescription_model->get_manufacturer_by_id($man_id);
        $data['main_content'] = $this->load->view('home/manufacturer_edit_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // update Manufacturar Entry
    public function update_manufacturer($man_id)
    {
        $manufacturer_info = array(
            'man_name' => $this->input->post('man_name'),
            'man_email' => $this->input->post('man_email'),
            'man_mobile' => $this->input->post('man_mobile'),
            'man_address' => $this->input->post('man_address'),
            'man_cr_amount' => $this->input->post('man_cr_amount'),
            'man_cr_amount_dt' => $this->input->post('man_cr_amount_dt'),
            'man_updated_by' => $this->session->userdata('user_id'),
            'man_updated_at' => date('Y-m-d H:i:s')
        );

        $this->form_validation->set_rules('man_name', 'Name', 'required');
        $this->form_validation->set_rules('man_email', 'Email Address', 'valid_email');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['manufacturer_info'] = $this->prescription_model->get_manufacturer_by_id($man_id);
            $data['main_content'] = $this->load->view('home/manufacturer_edit_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            $this->prescription_model->update_manufacturer($manufacturer_info, $man_id);

            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in''>New Manufacturer Created Successfully!</div>";
            $this->session->set_userdata($sdata);
            redirect("manufacturer-list");
            }
    }

///////////End manufacturar //////////

///////////start Medicine Type //////////
    // Medicine Type list
    public function medicine_type_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['medicine_type_info'] = $this->prescription_model->get_medicine_type();
        $data['main_content'] = $this->load->view('home/medicine_type_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save Medicine Type Entry
    public function save_medicine_type()
    {
        $type_info = array(
            'med_type_id' => "MTI-".uniqid(),
            'med_type_name' => $this->input->post('med_type_name'),
            'med_type_entry_by' => $this->session->userdata('user_id'),
            'med_type_entry_date' => date('Y-m-d'),
            'med_type_created_at' => date('Y-m-d H:i:s'),
            'med_type_status' => 1
        );

        $this->form_validation->set_rules('med_type_name', 'Type', 'required');
       
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['medicine_type_info'] = $this->prescription_model->get_medicine_type();
            $data['main_content'] = $this->load->view('home/medicine_type_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{

            $this->prescription_model->save_medicine_type($type_info);

                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in''>New Medicine Type Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("medicine-type");
            }
    }

    // Medicine Type edit form 
    public function edit_medicine_type($med_type_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_medicine_type_by_id($med_type_id);
        $data['medicine_type_info'] = $this->prescription_model->get_medicine_type();
        $data['main_content'] = $this->load->view('home/medicine_type_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // update Medicine Type Entry
    public function update_medicine_type($med_type_id)
    {
        $type_info = array(
            'med_type_name' => $this->input->post('med_type_name'),
            'med_type_updated_by' => $this->session->userdata('user_id'),
            'med_type_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('med_type_name', 'Type', 'required');
       
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_medicine_type_by_id($med_type_id);
            $data['medicine_type_info'] = $this->prescription_model->get_medicine_type();
            $data['main_content'] = $this->load->view('home/medicine_type_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{

            $this->prescription_model->update_medicine_type($type_info, $med_type_id);

                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in''>Medicine Type Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("medicine-type");
            }
    }
///////////End Medicine Type ////////// 

///////////start Medicine generic //////////
    // Medicine generic list
    public function medicine_generic_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['medicine_gen_info'] = $this->prescription_model->get_medicine_generic();
        $data['main_content'] = $this->load->view('home/medicine_generic_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save Medicine generic Entry
    public function save_medicine_generic()
    {
        $generic_info = array(
            'med_gen_id ' => "MGI-".uniqid(),
            'med_gen_name' => $this->input->post('med_gen_name'),
            'med_gen_entry_by' => $this->session->userdata('user_id'),
            'med_gen_entry_date' => date('Y-m-d'),
            'med_gen_created_at' => date('Y-m-d H:i:s'),
            'med_gen_status' => 1
        );

        $this->form_validation->set_rules('med_gen_name', 'Generic', 'required');
       
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['medicine_gen_info'] = $this->prescription_model->get_medicine_generic();
            $data['main_content'] = $this->load->view('home/medicine_generic_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{

            $this->prescription_model->save_medicine_generic($generic_info);

                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in''>New Medicine Generic Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("medicine-generic");
            }
    }

    // Medicine generic edit form 
    public function edit_medicine_generic($med_gen_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_medicine_generic_by_id($med_gen_id);
        $data['medicine_gen_info'] = $this->prescription_model->get_medicine_generic();
        $data['main_content'] = $this->load->view('home/medicine_generic_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // update generic Type Entry
    public function update_medicine_generic($med_gen_id)
    {
        $generic_info = array(
            'med_gen_name' => $this->input->post('med_gen_name'),
            'med_gen_updated_by' => $this->session->userdata('user_id'),
            'med_gen_updated_at' => date('Y-m-d H:i:s'),
        );

        $this->form_validation->set_rules('med_gen_name', 'Generic', 'required');
       
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_medicine_generic_by_id($med_gen_id);
            $data['medicine_gen_info'] = $this->prescription_model->get_medicine_generic();
            $data['main_content'] = $this->load->view('home/medicine_generic_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{

            $this->prescription_model->update_medicine_generic($generic_info, $med_gen_id);

                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in''>Medicine Generic Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("medicine-generic");
            }
    }
///////////End Medicine Generic //////////

/////Start medicine/////
    //medicine List
    public function medicine_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['manufacturer_info'] = $this->prescription_model->get_manufacturer();
        $data['medicine_type'] = $this->prescription_model->get_medicine_type();
        $data['medicine_generic'] = $this->prescription_model->get_medicine_generic();
        //$data['medicine'] = $this->prescription_model->get_medicine();
        $data['medicine'] = $this->prescription_model->get_medicine_limited();
        $data['main_content'] = $this->load->view('home/medicine_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save Medicine Entry
    public function save_medicine()
    {
        
        $product_id = "PPI-".uniqid();
        $product_info = array(
            'product_id' => $product_id,
            'product_name' => $this->input->post('product_name'),
            'product_type' => $this->input->post('product_type'),
            'product_generic' => $this->input->post('product_generic'),
            'product_manufacturer' => $this->input->post('product_manufacturer'),
            'product_pack_size' => $this->input->post('product_pack_size'),
            'product_entry_by' => $this->session->userdata('user_id'),
            'product_entry_date' => date('Y-m-d'),
            'product_created_at' => date('Y-m-d H:i:s'),
            'product_status ' => 1
        );

        

        $this->form_validation->set_rules('product_name', 'Product Name', 'required|is_unique[pharmacy_product.product_name]');
        $this->form_validation->set_rules('product_manufacturer', 'Manufacturer', 'required');
        $this->form_validation->set_rules('product_pack_size', 'Box Size', 'required');
       
        
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['manufacturer_info'] = $this->prescription_model->get_manufacturer();
            $data['medicine_type'] = $this->prescription_model->get_medicine_type();
            $data['medicine_generic'] = $this->prescription_model->get_medicine_generic();
            $data['medicine'] = $this->prescription_model->get_medicine_limited();
            $data['main_content'] = $this->load->view('home/medicine_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{

            $this->prescription_model->save_product($product_info);
            

            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in''>New Product Created Successfully!</div>";
            $this->session->set_userdata($sdata);
            redirect("medicine-setup");
            }
    }

    //medicine edit Form
    public function edit_medicine($product_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_product_by_id($product_id);
        $data['manufacturer_info'] = $this->prescription_model->get_manufacturer();
        $data['medicine_type'] = $this->prescription_model->get_medicine_type();
        $data['medicine_generic'] = $this->prescription_model->get_medicine_generic();
        $data['medicine'] = $this->prescription_model->get_medicine_limited();
        $data['main_content'] = $this->load->view('home/medicine_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update medicine info
    public function update_medicine($product_id)
    {
        $product_info = array(
            'product_id' => $product_id,
            'product_name' => $this->input->post('product_name'),
            'product_type' => $this->input->post('product_type'),
            'product_generic' => $this->input->post('product_generic'),
            'product_manufacturer' => $this->input->post('product_manufacturer'),
            'product_pack_size' => $this->input->post('product_pack_size'),
            'product_entry_by' => $this->session->userdata('user_id'),
            'product_entry_date' => date('Y-m-d'),
            'product_created_at' => date('Y-m-d H:i:s'),
            'product_status ' => 1
        );

        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('product_manufacturer', 'Manufacturer', 'required');
        $this->form_validation->set_rules('product_pack_size', 'Box Size', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_product_by_id($product_id);
            $data['manufacturer_info'] = $this->prescription_model->get_manufacturer();
            $data['medicine_type'] = $this->prescription_model->get_medicine_type();
            $data['medicine_generic'] = $this->prescription_model->get_medicine_generic();
            $data['medicine'] = $this->prescription_model->get_medicine_limited();
            $data['main_content'] = $this->load->view('home/medicine_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_product($product_info, $product_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("medicine-setup");
            }
    }


    // prouduct search
    public function product_search()
 {
  $output = '';
  $query = '';
  if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->prescription_model->fetch_product_data($query);
  $output .= '
  <table class="table table-bordered table-striped table-hover">
    <caption><center>All Medicine List</center></caption>
    <thead>
    <tr>
        <th style="width:12px;">SL.</th>
        <th>Company Name</th>
        <th>Product Name</th>
        <th>Dosage Name</th>
        <th>Generic Name</th>
        <th>Box Size</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
  ';
  if($data->num_rows() > 0)
  {
    $p=0;
   foreach($data->result() as $row)
   {
    $output .= '
      <tr>
       <td>'.$p++.'</td>
       <td>'.$row->product_manufacturer.'</td>
       <td>'.$row->product_name.'</td>
       <td>'.$row->product_type.'</td>
       <td>'.$row->product_generic.'</td>
       <td>'.$row->product_pack_size.'</td>
       <td><a class="btn btn-primary btn-xs" href="'.base_url().'edit-medicine/'. $row->product_id.'">
            <i class="glyphicon glyphicon-pencil"></i>Edit</a></td>
      </tr>
    ';
   }
  }
  else
  {
   $output .= '<tr>
       <td colspan="7">No Data Found</td>
      </tr>';
  }
  $output .= '</tbody></table>';
  echo $output;
 }

///////////end medicine //////////

///////////Start doctor//////////
    //doctor Entry Form
    public function new_doctor()
    {
        $data = array();
        $data['main'] = true;
        $data['department'] = $this->prescription_model->get_department();
        $data['main_content'] = $this->load->view('home/doctor_entry_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save doctor Entry
    public function save_doctor()
    {
        
        $config['upload_path'] = 'uploads/doctor_image';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['max_size'] = '2000';
        $this->load->library('upload', $config);
        
        if($_FILES['doctor_image']['name'] != ""){
            if (!$this->upload->do_upload('doctor_image')) {
                        $sdata = array();
                        $sdata['error'] = "<div class='alert alert-error fade in''>Please use a png, jpg or jpeg File. Max File size 2MB.</div>";
                        $this->session->set_userdata($sdata);
                        redirect('/');
                    }else{
            $data_upload_files_other = $this->upload->data();
            $pdata = array('upload_data' => $this->upload->data());
            $doctor_image = "uploads/doctor_image/" . $pdata['upload_data']['file_name'];
            } 
        }else{$doctor_image = "";}

        if($_FILES['doctor_sign']['name'] != ""){
            if (!$this->upload->do_upload('doctor_sign')) {
                        $sdata = array();
                        $sdata['error'] = "<div class='alert alert-error fade in''>Please use a png, jpg or jpeg File. Max File size 2MB.</div>";
                        $this->session->set_userdata($sdata);
                        redirect('/');
                    }else{
            $data_upload_files_other = $this->upload->data();
            $sdata = array('upload_data' => $this->upload->data());
            $doctor_sign = "uploads/doctor_image/" . $sdata['upload_data']['file_name'];
            } 
        }else{$doctor_sign = "";}


        $doctor_id = "DCI-".uniqid();
        $doctor_name = $this->input->post('doctor_name');
        $username = $this->input->post('doctor_username');
        $doctor_email = $this->input->post('doctor_email');
        $entry_by = $this->session->userdata('user_id');
        $status = 1;
        $password = md5(1234);
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');
        
        $doctor = array(
            'doctor_id' => $doctor_id,
            'doctor_name' => $doctor_name,
            'doctor_username' => $username,
            'doctor_designation' => $this->input->post('doctor_designation'),
            'department_id' => $this->input->post('doctor_department'),
            'doctor_email' => $doctor_email,
            'doctor_mobile' => $this->input->post('doctor_mobile'),
            'doctor_address' => $this->input->post('doctor_address'),
            'doctor_image' => $doctor_image,
            'doctor_sign' => $doctor_sign,
            'doctor_seal' => $this->input->post('doctor_seal'),
            'doctor_seal_bn' => $this->input->post('doctor_seal_bn'),
            'doctor_consultation_fee' => $this->input->post('consultation_fee'),
            'doctor_emergency_fee' => $this->input->post('emergency_fee'),
            'doctor_followup_fee' => $this->input->post('followup_fee'),
            'doctor_general_fee' => $this->input->post('general_fee'),
            'doctor_entry_by' => $entry_by,
            'doctor_entry_date' => $entry_date,
            'doctor_created_at' => $created_at,
            'doctor_status' => $status
        );

        $this->form_validation->set_rules('doctor_name', 'Doctor Name', 'required');
        $this->form_validation->set_rules('doctor_department', 'Department', 'required');
        $this->form_validation->set_rules('doctor_mobile', 'Mobile No.', 'required');
        $this->form_validation->set_rules('doctor_username', 'Username', 'required|is_unique[doctors.doctor_username]');
        $this->form_validation->set_rules('doctor_email', 'Email Address', 'valid_email|is_unique[doctors.doctor_email]');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['department'] = $this->prescription_model->get_department();
            $data['main_content'] = $this->load->view('home/doctor_entry_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
            $this->prescription_model->save_doctor($doctor);

            $data = array(
                'user_id' => $doctor_id,
                'user_name' => $doctor_name,
                'user_designation' => "Doctor",
                'user_email' => $username,
                'user_password' => $password,
                'user_type' => "Doctor",
                'user_entry_by' => $entry_by,
                'user_entry_date' => $entry_date,
                'user_created_at' => $created_at,
                'user_status' =>$status    
            );
             $this->prescription_model->insert_user($data);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in''>New doctor Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("edit-doctor/".$doctor_id);
            }
    }

    //doctor List
    public function doctor_list()
    {
        $data = array();
        $data['main'] = true;
        $data['doctors'] = $this->prescription_model->get_doctors();
        $data['main_content'] = $this->load->view('home/doctor_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    //doctor edit Form
    public function edit_doctor($doctor_id)
    {
        $data = array();
        $data['main'] = true;
        $data['doctors_info'] = $this->prescription_model->get_doctor_by_id($doctor_id);
        $data['department'] = $this->prescription_model->get_department();
        $data['main_content'] = $this->load->view('home/doctor_edit_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }
    
    // Update doctor Info
    public function update_doctor($doctor_id)
    {       
        $config['upload_path'] = 'uploads/doctor_image';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['max_size'] = '2000';
        $this->load->library('upload', $config);
        
        if($_FILES['doctor_image']['name'] != ""){
            if (!$this->upload->do_upload('doctor_image')) {
                        $sdata = array();
                        $sdata['error'] = "<div class='alert alert-error fade in''>Please use a png, jpg or jpeg File. Max File size 2MB.</div>";
                        $this->session->set_userdata($sdata);
                        redirect('/');
                    }else{
            $data_upload_files_other = $this->upload->data();
            $pdata = array('upload_data' => $this->upload->data());
            $doctor_image = "uploads/doctor_image/" . $pdata['upload_data']['file_name'];
            } 
        }else{$doctor_image = $this->input->post('old_doctor_image');}

        if($_FILES['doctor_sign']['name'] != ""){
            if (!$this->upload->do_upload('doctor_sign')) {
                        $sdata = array();
                        $sdata['error'] = "<div class='alert alert-error fade in''>Please use a png, jpg or jpeg File. Max File size 2MB.</div>";
                        $this->session->set_userdata($sdata);
                        redirect('/');
                    }else{
            $data_upload_files_other = $this->upload->data();
            $sdata = array('upload_data' => $this->upload->data());
            $doctor_sign = "uploads/doctor_image/" . $sdata['upload_data']['file_name'];
            } 
        }else{$doctor_sign = $this->input->post('old_doctor_sign');}

        $doctor_name = $this->input->post('doctor_name');
        $username = $this->input->post('doctor_username');
        $doctor_email = $this->input->post('doctor_email');
        
        $doctor = array(
            'doctor_name' => $doctor_name,
            'doctor_username' => $username,
            'doctor_designation' => $this->input->post('doctor_designation'),
            'department_id' => $this->input->post('doctor_department'),
            'doctor_email' => $doctor_email,
            'doctor_mobile' => $this->input->post('doctor_mobile'),
            'doctor_address' => $this->input->post('doctor_address'),
            'doctor_image' => $doctor_image,
            'doctor_sign' => $doctor_sign,
            'doctor_seal' => $this->input->post('doctor_seal'),
            'doctor_seal_bn' => $this->input->post('doctor_seal_bn'),
            'doctor_consultation_fee' => $this->input->post('consultation_fee'),
            'doctor_emergency_fee' => $this->input->post('emergency_fee'),
            'doctor_followup_fee' => $this->input->post('followup_fee'),
            'doctor_general_fee' => $this->input->post('general_fee'),
            'doctor_updated_by' => $this->session->userdata('user_id'),
            'doctor_updated_at' => date('Y-m-d H:i:s')
        );

        $this->form_validation->set_rules('doctor_name', 'Doctor Name', 'required');
        $this->form_validation->set_rules('doctor_department', 'Department', 'required');
        $this->form_validation->set_rules('doctor_mobile', 'Mobile No.', 'required');
        $this->form_validation->set_rules('doctor_email', 'Email Address', 'valid_email');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['doctors_info'] = $this->prescription_model->get_doctor_by_id($doctor_id);
            $data['department'] = $this->prescription_model->get_department();
            $data['main_content'] = $this->load->view('home/doctor_edit_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->update_doctor($doctor, $doctor_id);

                $user_data['user_name'] = $doctor_name;
                $user_data['user_email'] = $username;
                $this->prescription_model->update_user_id($user_data, $doctor_id);
               
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in''>doctor Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("edit-doctor/".$doctor_id);
            }
        
    }

    //deactivate doctor status
    public function deactivate_doctor_id($doctor_id)
    {
        $user_data['user_status'] = 0;
        $this->prescription_model->update_user_id($user_data, $doctor_id);
        $doctor['doctor_status'] = 0;
         $this->prescription_model->update_doctor($doctor, $doctor_id);
        $sdata = array();
        $sdata['success'] = "<div class='alert alert-success fade in''>doctor Deactivated!</div>";
        $this->session->set_userdata($sdata);
        redirect("doctor-list");
    }

    //activate doctor status
    public function activate_doctor_id($doctor_id)
    {
        $user_data['user_status'] = 1;
        $this->prescription_model->update_user_id($user_data, $doctor_id);
        $doctor['doctor_status'] = 1;
         $this->prescription_model->update_doctor($doctor, $doctor_id);
        $sdata = array();
        $sdata['success'] = "<div class='alert alert-success fade in''>doctor Activated!</div>";
        $this->session->set_userdata($sdata);
        redirect("doctor-list");
    }

    // doctor password re-set form
    public function reset_doctor_password($doctor_id)
        {
            $data = array();
            $data['main'] = true;
            $data['doctor_info'] = $this->prescription_model->get_doctor_by_id($doctor_id);
            $data['main_content'] = $this->load->view('home/doctor_password_reset_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }

    //Update doctor Password
    public function update_doctor_password()
        {
        $doctor_id = $this->input->post('doctor_id');
        $password = md5($this->input->post('password'));
        $repassword = md5($this->input->post('repassword'));
        $updated_at = date('Y-m-d H:i:s');
        $updated_by = ($this->session->userdata('user_id'));
        
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|callback_password_check');
        $this->form_validation->set_rules('repassword', 'Password Retype', 'trim|required|matches[password]|min_length[6]');
        
            if ($this->form_validation->run() == FALSE)
            {
                $data = array();
                $data['main'] = true;
                $data['doctor_info'] = $this->prescription_model->get_doctor_by_id($doctor_id);
                $data['main_content'] = $this->load->view('home/doctor_password_reset_form', $data,true);
                $this->load->view('home/admin_home', $data);
            
            }else{
                $user_data = array(
                'user_password' => $password,
                'user_updated_by' => $updated_by,
                'user_updated_at' => $updated_at
        );
    
                $this->prescription_model->update_user_id($user_data, $doctor_id);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in''>doctor Password Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("doctor-list");
        }
    }
///////////end doctor //////////

///////////Start patient registration//////////
    // patient registration form
    public function new_patient()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['patient_info'] = $this->prescription_model->get_patient_limited();
        $data['main_content'] = $this->load->view('home/patient_entry_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save patient registration
    public function save_patient()
    {
        
         $year = $this->input->post('year');
         $month = $this->input->post('month');
         $day = $this->input->post('day');
         $dob = date('Y-m-d', strtotime($year . ' years ago'. "-$month months". "-$day days"));
         $last_reg = $this->prescription_model->get_patient_reg_no();
         if ($last_reg) {
             $patient_reg_no = $last_reg->patient_reg_no+1;
         }else{
            $patient_reg_no = "100000";
         }

        $patient = array(
            'patient_id' => uniqid(),
            'patient_reg_no' => $patient_reg_no,
            'patient_first_name' => $this->input->post('first_name'),
            'patient_dob' => $dob,
            'patient_mobile' => $this->input->post('mobile'),
            'patient_email' => $this->input->post('email'),
            'patient_address' => $this->input->post('present_address'),
            'patient_gender' => $this->input->post('gender'),
            'patient_father_name' => $this->input->post('father_name'),
            'patient_mother_name' => $this->input->post('mother_name'),
            'patient_nid' => $this->input->post('national_id'),
            'patient_blood_group' => $this->input->post('blood_group'),
            'patient_religion' => $this->input->post('religion'),
            'patient_occupation' => $this->input->post('occupation'),
            'patient_entry_by' => $this->session->userdata('user_id'),
            'patient_entry_date' => date('Y-m-d'),
            'patient_created_at' => date('Y-m-d H:i:s'),
            'patient_status' => 1
            
        );

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['main_content'] = $this->load->view('home/patient_entry_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            $this->prescription_model->save_patient($patient);
            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in''>New Patient Created Successfully!</div>";
            $this->session->set_userdata($sdata);
            redirect("patient-registration");
        }
    }

    // patient search
    public function patient_search()
 {
  $output = '';
  $query = '';
  $age = '';
    if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->prescription_model->fetch_patient_data($query);
  $output .= '
  <table class="table table-bordered table-striped table-hover example2">
    <caption><center>Patient List</center></caption>
    <thead>
    <tr>
        <th style="width:12px;">SL.</th>
        <th>Registration #</th>
        <th>Patient Name</th>
        <th>Father Name</th>
        <th>Age</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Address</th>
        <th>Blood Group</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
  ';
  if($data->num_rows() > 0)
  {
    $p=0;
   foreach($data->result() as $row)
   {

    if($row->patient_dob != "0000-00-00")
            {
                $interval = date_diff(date_create(), date_create($row->patient_dob));
                $age = $interval->format("%Y Year, %M Months, %d Days");
            }
    $output .= '
      <tr>
       <td>'.$p++.'</td>
       <td>'.$row->patient_reg_no.'</td>
       <td>'.$row->patient_first_name.' '.$row->patient_last_name.'</td>
       <td>'.$row->patient_father_name.'</td>
       <td>'.$age.'</td>
       <td>'.$row->patient_mobile.'</td>
       <td>'.$row->patient_email.'</td>
       <td>'.$row->patient_address.'</td>
       <td>'.$row->patient_blood_group.'</td>
       <td><a class="btn btn-primary btn-xs" href="'.base_url().'edit-patient/'. $row->patient_id.'">
            </i>Edit</a></td>
      </tr>
    ';
   }
  }
  else
  {
   $output .= '<tr>
       <td colspan="7">No Data Found</td>
      </tr>';
  }
  $output .= '</tbody></table>';
  echo $output;
 }

 // patient registration edit
    public function edit_patient($patient_id)
    {
        $data = array();
        $data['main'] = true;
        $data['patient_info'] = $this->prescription_model->get_patient_limited();
        $data['edit_info'] = $this->prescription_model->get_patient_by_id($patient_id);
        $data['main_content'] = $this->load->view('home/patient_entry_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

// update patient registration
    public function update_patient($patient_id)
    {
         $year = $this->input->post('year');
         $month = $this->input->post('month');
         $day = $this->input->post('day');
         $dob = date('Y-m-d', strtotime($year . ' years ago'. "-$month months". "-$day days"));

        $patient = array(
            'patient_first_name' => $this->input->post('first_name'),
            'patient_dob' => $dob,
            'patient_mobile' => $this->input->post('mobile'),
            'patient_email' => $this->input->post('email'),
            'patient_address' => $this->input->post('present_address'),
            'patient_gender' => $this->input->post('gender'),
            'patient_father_name' => $this->input->post('father_name'),
            'patient_mother_name' => $this->input->post('mother_name'),
            'patient_nid' => $this->input->post('national_id'),
            'patient_blood_group' => $this->input->post('blood_group'),
            'patient_religion' => $this->input->post('religion'),
            'patient_occupation' => $this->input->post('occupation'),
            'patient_updated_at' => date('Y-m-d H:i:s')
        );

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['patient_info'] = $this->prescription_model->get_patient_limited();
            $data['edit_info'] = $this->prescription_model->get_patient_by_id($patient_id);
            $data['main_content'] = $this->load->view('home/patient_entry_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            $this->prescription_model->update_patient($patient, $patient_id);
            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in''>Patient Updated Successfully!</div>";
            $this->session->set_userdata($sdata);
            redirect("patient-registration");
        }
    }
///////////End patient registration//////////

///////////Start patient appointment//////////
    // patient appointment form
    public function new_appointment()
    {
        $data = array();
        $data['main'] = true;
        $date = date('Y-m-d');
        $data['doctors'] = $this->prescription_model->get_doctors();
        //$data['patients'] = $this->prescription_model->get_patient_reg();
        $data['appointments'] = $this->prescription_model->get_datewise_appointment($date);
        $data['doc_app'] = $this->prescription_model->get_datewise_doctor_appointment($date);
        $data['main_content'] = $this->load->view('home/patient_appointment_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    //patient auto complete
    public function get_patient_list()
    {
    $postData = $this->input->post();
    $data = $this->prescription_model->patient_search($postData);
    echo json_encode($data);
    }

    // patient appointment form
    public function appointment_entry_form($patient_id)
    {
        $data = array();
        $data['main'] = true;
        $date = date('Y-m-d');
        $data['doctors'] = $this->prescription_model->get_doctors();
        //$data['patients'] = $this->prescription_model->get_patient_reg();
        $patient = $this->prescription_model->get_patient_by_id($patient_id);
        $patient_appointment = $this->prescription_model->get_patient_appointment($patient_id);
         if ($patient_appointment) {
             $appointment_number = count($patient_appointment);
         }else{
            $appointment_number = 0;
         }
        $data['patient'] = $patient;
        $data['patient_appointment'] = $patient_appointment;
        $data['appointment_number'] = $appointment_number;
        $data['appointments'] = $this->prescription_model->get_datewise_appointment($date);
        $data['doc_app'] = $this->prescription_model->get_datewise_doctor_appointment($date);
        $data['main_content'] = $this->load->view('home/patient_appointment_entry_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    //get date wise appointment
    public function get_datewise_appointment()
    {
        $date = $this->input->post('app_date');
        if($date){
        $appointments = $this->prescription_model->get_datewise_doctor_appointment($date);
        
        $a = 1;
        if($appointments){
        
        echo '<table class="table table-bordered table-striped table-hover example2">
                    <caption><center>Appointment Count of '. date("d/m/Y", strtotime($date)).'</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Doctor</th>
                        <th>Appointment</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach($appointments as $patient){
          echo '<tr>
                    <td style="width:12px;">'.$a++.'.</td>
                    <td>'.$patient->doctor_name.'</td>
                    <td>'.
                    count( $this->prescription_model->get_datewise_doctor_appointment_count($date, $patient->doctor_id))
                    .'</td>
                </tr>';
                }          
           echo '</tbody></table>';
           }else echo "No Appointments";

        }
        
    }

    //get date wise appointment
    // public function get_datewise_appointment()
    // {
    //     $date = $this->input->post('app_date');
    //     if($date){
    //     $appointments = $this->prescription_model->get_datewise_appointment($date);
        
    //     $a = 1;
    //     if($appointments){
        
    //     echo '<table class="table table-bordered table-striped table-hover example2">
    //                 <caption><center>Appointment List of '. date("d/m/Y", strtotime($date)).'</center></caption>
    //                 <thead>
    //                 <tr>
    //                     <th style="width:12px;">SL.</th>
    //                     <th>Registration #</th>
    //                     <th>Patient Name</th>
    //                     <th>Father Name</th>
    //                     <th>Age</th>
    //                     <th>Mobile</th>
    //                     <th>Doctor</th>
    //                     <th>Type</th>
    //                 </tr>
    //                 </thead>
    //                 <tbody>';
    //             foreach($appointments as $patient){
    //       echo '<tr>
    //                 <td style="width:12px;">'.$a++.'.</td>
    //                 <td>'.$patient->patient_reg_no.'</td>
    //                 <td>'.$patient->patient_first_name.' '.$patient->patient_last_name.'</td>
    //                 <td>'.$patient->patient_father_name.'</td>
    //                 <td>';
    //                         if($patient->patient_dob != "0000-00-00")
    //                         {
    //                             $interval = date_diff(date_create(), date_create($patient->patient_dob));
    //                             echo $interval->format("%Y Year, %M Months, %d Days");
    //                         }
                    
    //           echo '</td>
    //                 <td>'.$patient->patient_mobile.'</td>
    //                 <td>'.$patient->doctor_name.'</td>
    //                 <td>'.$patient->appointment_type.'</td>
    //             </tr>';
    //             }          
    //        echo '</tbody></table>';
    //        }else echo "No Appointments";

    //     }
        
    // }

    //get patient info for appointment form
    public function get_patient_info()
    {
        $patient_id = $this->input->post('patient_reg');
        if($patient_id){
        $patient = $this->prescription_model->get_patient_by_id($patient_id);
        $patient_appointment = $this->prescription_model->get_patient_appointment($patient_id);
         if ($patient_appointment) {
             $appointment_number = count($patient_appointment);
         }else{
            $appointment_number = 0;
         }
        
        //echo $patient->patient_first_name;
         //if ($patient) {
             echo '<div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="'.base_url().'assets/img/user.png" alt="Patient Photo">
                </div>
                <h3 class="profile-username text-center">'.$patient->patient_first_name.' '.$patient->patient_last_name.'</h3>
                <p class="text-muted text-center">Reg.#:'.$patient->patient_reg_no.'</p>
                <div class="col-md-6"><ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Father Name: </b> <a class="float-right">'.$patient->patient_father_name.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Age: </b> <a class="float-right">';
                     if($patient->patient_dob != "0000-00-00")
                            {
                                $interval = date_diff(date_create(), date_create($patient->patient_dob));
                                echo $interval->format("%Y Year, %M Months, %d Days");
                            }
                echo '</a>
                  </li>
                  <li class="list-group-item">
                    <b>Mobile: </b> <a class="float-right">'.$patient->patient_mobile.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Address: </b> <a class="float-right">'.$patient->patient_address.'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Registration Date: </b> <a class="float-right">'.date("d/m/Y", strtotime($patient->patient_entry_date)).'</a>
                  </li>
                  <li class="list-group-item">
                    <b>Appointment Count: </b> <a class="float-right">'.$appointment_number.'</a>
                  </li>
                </ul></div>';
        // }
              

                $p = 1;
                if($patient_appointment){
                
                echo '<div class="col-md-6"><table class="table table-bordered table-striped">
                        <tr>
                            <th width="15">Sl</th>
                            <th>Old Appointment Date</th>
                        </tr>';
                        foreach($patient_appointment as $app){
                  echo '<tr>
                            <td>'.$p++.'</td>
                            <td>'.date("d/m/Y", strtotime($app->appointment_date)).'</td>
                        </tr>';
                        }          
                   echo '</table></div>';
                   }

        }
        
    }

    // Save patient appointment
    public function save_appointment()
    {
        $patient_id = $this->input->post('patient_id');
        $patient_appointment = $this->prescription_model->get_patient_appointment($patient_id);
         if ($patient_appointment) {
             $appointment_number = count($patient_appointment)+1;
         }else{
            $appointment_number = 1;
         }

        $appointment_id = "AID-".uniqid();
       
        $appointment = array(
            'appointment_id' => $appointment_id,
            'patient_id' => $patient_id,
            'doctor_id' => $this->input->post('doctor_name'),
            'appointment_type' => $this->input->post('type'),
            'appointment_date' => $this->input->post('app_date'),
            'appointment_number' => $appointment_number,
            'appointment_entry_by' => $this->session->userdata('user_id'),
            'appointment_entry_date' => date('Y-m-d'),
            'appointment_created_at' => date('Y-m-d H:i:s'),
            'appointment_status' => 1
            
        );

        $vital = array(
            'vital_id' => "PVI-".uniqid(),
            'appointment_id' => $appointment_id,
            'patient_id' => $patient_id,
            'vital_entry_by' => $this->session->userdata('user_id'),
            'vital_entry_date' => date('Y-m-d'),
            'vital_created_at' => date('Y-m-d H:i:s'),
            'vital_status' => 1
        );

        $this->form_validation->set_rules('patient_reg', 'Registration Number', 'required');
        $this->form_validation->set_rules('doctor_name', 'Doctor Name', 'required');
        $this->form_validation->set_rules('type', 'Appointment Type', 'required');
        $this->form_validation->set_rules('app_date', 'Appointment Date', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $date = date('Y-m-d');
            $data = array();
            $data['main'] = true;
            $data['doctors'] = $this->prescription_model->get_doctors();
            $data['patients'] = $this->prescription_model->get_patient_reg();
            $data['appointments'] = $this->prescription_model->get_datewise_appointment($date);
            $data['doc_app'] = $this->prescription_model->get_datewise_doctor_appointment($date);
            $data['main_content'] = $this->load->view('home/patient_appointment_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            $this->prescription_model->save_appointment($appointment);
            $this->prescription_model->save_patient_vital($vital);
            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in''>New Appointment Created Successfully!</div>";
            $this->session->set_userdata($sdata);
            redirect("patient-appointment");
        }
    }

    // patient appointment list
    public function appointment_list()
    {
        $data = array();
        $data['main'] = true;
        $date = date('Y-m-d');
        //$data['appointments'] = $this->prescription_model->get_datewise_appointment($date);
        $data['appointments'] = "";
        $data['shift'] = $this->prescription_model->get_shift();
        //$data['doctors'] = $this->prescription_model->get_doctors();
        $data['date'] = $date;
        $data['main_content'] = $this->load->view('home/patient_appointment_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    public function appointment_search()
    {
        $data = array();
        $data['main'] = true;
        $date = $this->input->post('app_date');
        $doctor_id = $this->input->post('doctor_name');
        $doctor_option = explode(":", $doctor_id);
        $doctor = $this->prescription_model->get_doctor_by_id($doctor_option[0]);
        $data['doctor_name'] = $doctor->doctor_name;
        //$data['doctors'] = $this->prescription_model->get_doctors();
        $data['shift'] = $this->prescription_model->get_shift();
        $schedule = $this->prescription_model->get_schedule_by_id($doctor_option[1]);
        $data['slot'] = $schedule->schedule_slots;
        $data['appointments'] = $this->prescription_model->get_datewise_doctor_appointment_count($date, $doctor_option[0], $doctor_option[1]);
        $data['date'] = $date;
        $data['main_content'] = $this->load->view('home/patient_appointment_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // patient appointment form
    public function direct_appointment_entry()
    {
        $data = array();
        $data['main'] = true;
        $date = date('Y-m-d');
        $data['shift'] = $this->prescription_model->get_shift();
        //$data['department'] = $this->prescription_model->get_department();
        $data['main_content'] = $this->load->view('home/direct_appointment_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    public function shift_doctor_list()
    {
        $date = $this->input->post('app_date');
        $shift = $this->input->post('shift');
        //$department = $this->input->post('doctor_department');
        $day = date('l', strtotime($date));
        if($shift && $date){
         //$doctor = $this->prescription_model->get_schedule_day_doctor($department, $shift, $day);
         $doctor = $this->prescription_model->get_schedule_day_doctor($shift, $day);
            
            if($doctor){
            
            echo '<div class="col-md-12"><table class="table table-bordered table-striped">
                    <tr>
                        <th>Available Doctors</th>
                    </tr>';
                    foreach($doctor as $doc){
              echo "<tr>
                        <td><label><input type ='radio' name='schedule_doctor' value='".$doc->doctor_id.":".$doc->schedule_id."' onclick=doctor_slot('".$doc->schedule_id."') required> ".$doc->doctor_name."</label>
                        </td>
                    </tr>";
                    }          
               echo '</table></div>';
               }

        }else{echo "Select Date & Shift first.";}
        
    }

    public function app_shift_doctor_list()
    {
        $date = $this->input->post('app_date');
        $shift = $this->input->post('shift');
        $day = date('l', strtotime($date));
        if($shift && $date){
         $doctor = $this->prescription_model->get_schedule_day_doctor($shift, $day);
            
            if($doctor){
                echo "<option value=''>Select Doctor</option>";
            foreach($doctor as $doc){
              echo "<option value='".$doc->doctor_id.":".$doc->schedule_id."'> ".$doc->doctor_name."</option>";
                    }          
               }

        }else{echo "<option value=''>Select Date & Shift first</option>";}
        
    }

    public function doctor_app_list()
    {
        $schedule_id = $this->input->post('schedule_id');
        $date = $this->input->post('app_date');

        $schedule = $this->prescription_model->get_schedule_by_id($schedule_id);
        $appointment = $this->prescription_model->get_datewise_doctor_appointment_count($date, $schedule->doctor_id, $schedule->schedule_id);
        $appqty = count($appointment);
        $slot = $schedule->schedule_slots;

        $to_time = strtotime($schedule->end_time);
        $from_time = strtotime($schedule->start_time);
        $duration = round(abs($to_time - $from_time) / 60,2);
        $slot_duration = round($duration/$slot);

        echo "From ".$schedule->start_time." to ". $schedule->end_time."<br>";
        if ($appointment) {
            
            $appcount = array_column($appointment, 'appointment_slot'); 
            
            for($i = 1; $i<=$slot; $i++ ){
                $time_slot  = date('h:i A',$from_time );
                $from_time = strtotime('+'.$slot_duration.' minutes',$from_time);
                if(in_array($i,$appcount)){
                     $patient = $this->prescription_model->get_schedule_patient($date, $schedule->doctor_id, $schedule->schedule_id, $i);
                    echo '<label class="text-red">'.$i.'.'.$patient->patient_first_name."-".$time_slot.'</label><br>';
                     } else {
                        echo "<label class='text-success'><input type ='radio' name='schedule_slot' value='".$i."' required> ".$i.".Empty (".$time_slot.")</label><br>";        
                     }
                 
                }


        }else{

            for($d=1; $d<=$slot; $d++)
            {
               $time_slot  = date('h:i A',$from_time );
               $from_time = strtotime('+'.$slot_duration.' minutes',$from_time);
                echo "<label class='text-success'><input type ='radio' name='schedule_slot' value='".$d."' required> ".$d.".Empty (".$time_slot.")</label><br>";
            }
        }
        
    }

    // Save patient appointment
    public function save_direct_appointment()
    {
        $patient_id = $this->input->post('patient_id');
        $patient_name = $this->input->post('patient_name');
        $patient_mobile = $this->input->post('patient_mobile');
        $date = $this->input->post('app_date');
        $doctor_id = $this->input->post('schedule_doctor');
        $doctor_option = explode(":", $doctor_id);
        $appointment_slot = $this->input->post('schedule_slot');

        $varify_slot = $this->prescription_model->match_appointment_slot($date, $doctor_option[0], $doctor_option[1], $appointment_slot);
        if($varify_slot  && $appointment_slot == $varify_slot->appointment_slot){
            $sdata = array();
            $sdata['error'] = "<div class='alert alert-danger fade in'>Appointment of ".$patient_name.", Mobile- ".$patient_mobile.", date- ".$date.", Doctor-".$varify_slot->doctor_name.", Serial Number ".$appointment_slot." not Available</div>";
            $this->session->set_userdata($sdata);
            redirect("direct-appointment");
        }else{

        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $day = $this->input->post('day');
        $dob = date('Y-m-d', strtotime($year . ' years ago'. "-$month months". "-$day days"));
        $last_reg = $this->prescription_model->get_patient_reg_no();
         if ($last_reg) {
             $patient_reg_no = $last_reg->patient_reg_no+1;
         }else{
            $patient_reg_no = "100000";
         }


        if ($patient_id) {
            $patient_info =  $this->prescription_model->get_patient_by_id($patient_id);
            if ($patient_mobile == $patient_info->patient_mobile) {
                $app_patient = $patient_id;
                $patient = array(
                'patient_dob' => $dob,
                'patient_updated_at' => date('Y-m-d H:i:s'),
                );
                $this->prescription_model->update_patient($patient, $patient_id);


            }else{
                
                $app_patient = uniqid();
                $patient = array(
                'patient_id' => $app_patient,
                'patient_reg_no' => $patient_reg_no,
                'patient_first_name' => $patient_name,
                'patient_dob' => $dob,
                'patient_mobile' => $patient_mobile,
                'patient_entry_by' => $this->session->userdata('user_id'),
                'patient_entry_date' => date('Y-m-d'),
                'patient_created_at' => date('Y-m-d H:i:s'),
                'patient_status' => 1
                );
                $this->prescription_model->save_patient($patient);
            }
            
        }else{
            $app_patient = uniqid();
            $patient = array(
            'patient_id' => $app_patient,
            'patient_reg_no' => $patient_reg_no,
            'patient_first_name' => $patient_name,
            'patient_dob' => $dob,
            'patient_mobile' => $patient_mobile,
            'patient_entry_by' => $this->session->userdata('user_id'),
            'patient_entry_date' => date('Y-m-d'),
            'patient_created_at' => date('Y-m-d H:i:s'),
            'patient_status' => 1
            );
            $this->prescription_model->save_patient($patient);

        }

        $patient_appointment = $this->prescription_model->get_patient_appointment($app_patient);
         if ($patient_appointment) {
             $appointment_number = count($patient_appointment)+1;
         }else{
            $appointment_number = 1;
         }

        $appointment_id = "AID-".uniqid();
       
        $appointment = array(
            'appointment_id' => $appointment_id,
            'patient_id' => $app_patient,
            'doctor_id' => $doctor_option[0],
            'schedule_id' => $doctor_option[1],
            'appointment_type' => $this->input->post('type'),
            'appointment_remark' => $this->input->post('remark'),
            'appointment_ref' => $this->input->post('patient_ref'),
            'appointment_date' => $date,
            'appointment_number' => $appointment_number,
            'appointment_slot' => $appointment_slot,
            'appointment_entry_by' => $this->session->userdata('user_id'),
            'appointment_entry_date' => date('Y-m-d'),
            'appointment_created_at' => date('Y-m-d H:i:s'),
            'appointment_status' => 1
        );

        $vital = array(
            'vital_id' => "PVI-".uniqid(),
            'appointment_id' => $appointment_id,
            'patient_id' => $app_patient,
            'vital_entry_by' => $this->session->userdata('user_id'),
            'vital_entry_date' => date('Y-m-d'),
            'vital_created_at' => date('Y-m-d H:i:s'),
            'vital_status' => 1
        );

        $this->form_validation->set_rules('app_date', 'Date', 'required');
        //$this->form_validation->set_rules('doctor_department', 'Department', 'required');
        $this->form_validation->set_rules('shift', 'Shift', 'required');
        $this->form_validation->set_rules('patient_name', 'Patient Number', 'required');
        $this->form_validation->set_rules('patient_mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('type', 'Appointment Type', 'required');
        $this->form_validation->set_rules('schedule_slot', 'Appointment Slot', 'required');
        
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $date = date('Y-m-d');
            $data['shift'] = $this->prescription_model->get_shift();
            //$data['department'] = $this->prescription_model->get_department();
            $data['main_content'] = $this->load->view('home/direct_appointment_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            // $this->prescription_model->save_appointment($appointment);
            // $this->prescription_model->save_patient_vital($vital);

            // //sms
            //  $appinfo = $this->prescription_model->match_appointment_slot($date, $doctor_option[0], $doctor_option[1], $appointment_slot);
            // $contact = $patient_mobile;
            // //$content = "প্রিয় ".$patient_name.", ".$appinfo->doctor_name." এর সাথে আপনার সাক্ষাতের তারিখ:".date("d/m/Y", strtotime($date)).", সিরিয়াল: ".$appointment_slot.", সময়সীমা ".$appinfo->start_time." টা থেকে ".$appinfo->end_time." টা পর্যন্ত নির্ধারিত আছে। লাইফ লাইন কনসালটেশন এন্ড ডায়াগনস্টিক লিঃ যোগাযোগঃ ০১৭০৬৩১৯১৪১-৪২"; 
            //  $content = "স্যার/ম্যাডাম ".$patient_name.", ".$appinfo->doctor_name." এর সাথে আপনার সাক্ষাতের তারিখ:".date("d/m/Y", strtotime($date)).", সিরিয়াল: ".$appointment_slot." নির্ধারিত আছে। লাইফ লাইন কনসালটেশন এন্ড ডায়াগনস্টিক লিঃ যোগাযোগঃ ০১৭০৬৩১৯১৪১-৪২"; 
            // if ($date >= date('Y-m-d')) {
            //    $this->smsgatway->send_sms($contact, $content);
            // }

            // $sdata = array();
            // $sdata['success'] = "<div class='alert alert-success fade in'>Appointment of ".$patient_name." Created Successfully. Serial Number ".$appointment_slot."</div>";
            // $this->session->set_userdata($sdata);
            // redirect("direct-appointment");
            if($this->prescription_model->save_appointment($appointment) && $this->prescription_model->save_patient_vital($vital))
                {
                    //sms
                    $appinfo = $this->prescription_model->match_appointment_slot($date, $doctor_option[0], $doctor_option[1], $appointment_slot);
                    $contact = $patient_mobile;
                    //$content = "প্রিয় ".$patient_name.", ".$appinfo->doctor_name." এর সাথে আপনার সাক্ষাতের তারিখ:".date("d/m/Y", strtotime($date)).", সিরিয়াল: ".$appointment_slot.", সময়সীমা ".$appinfo->start_time." টা থেকে ".$appinfo->end_time." টা পর্যন্ত নির্ধারিত আছে। লাইফ লাইন কনসালটেশন এন্ড ডায়াগনস্টিক লিঃ যোগাযোগঃ ০১৭০৬৩১৯১৪১-৪২"; 
                    $content = "স্যার/ম্যাডাম ".$patient_name.", ".$appinfo->doctor_name." এর সাথে আপনার সাক্ষাতের তারিখ:".date("d/m/Y", strtotime($date)).", সিরিয়াল: ".$appointment_slot." নির্ধারিত আছে। লাইফ লাইন কনসালটেশন এন্ড ডায়াগনস্টিক লিঃ যোগাযোগঃ ০১৭০৬৩১৯১৪১-৪২"; 
                    if ($date >= date('Y-m-d')) {
                        $this->smsgatway->send_sms($contact, $content);
                    }
                    $sdata = array();
                    $sdata['success'] = "<div class='alert alert-success fade in'>Appointment of ".$patient_name." Created Successfully. Serial Number ".$appointment_slot."</div>";
                    $this->session->set_userdata($sdata);
                    redirect("direct-appointment");
                }

        }

        }

        
    }

    // patient appointment edit
    public function edit_direct_appointment($appointment_id)
    {
        $data = array();
        $data['main'] = true;
        $data['shift'] = $this->prescription_model->get_shift();
        //$data['department'] = $this->prescription_model->get_department();
        $data['appointment_info'] = $this->prescription_model->get_appointment_by_id($appointment_id);
        $data['main_content'] = $this->load->view('home/direct_appointment_edit_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // update patient appointment
    public function update_direct_appointment($appointment_id)
    {
        $appointment_info = $this->prescription_model->get_appointment_by_id($appointment_id);
        $doctor_id = $this->input->post('schedule_doctor');
        $doctor_option = explode(":", $doctor_id);
        $patient_name = $this->input->post('patient_name');
        $appointment_slot = $this->input->post('schedule_slot');
        //$patient_id = $this->input->post('patient_id');

        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $day = $this->input->post('day');
        $dob = date('Y-m-d', strtotime($year . ' years ago'. "-$month months". "-$day days"));

        $patient = array(
            'patient_first_name' => $patient_name,
            'patient_dob' => $dob,
            'patient_mobile' => $this->input->post('patient_mobile'),
            'patient_updated_at' => date('Y-m-d H:i:s')
            );
        $this->prescription_model->update_patient($patient, $appointment_info->patient_id);
       
        $appointment = array(
            'doctor_id' => $doctor_option[0],
            'schedule_id' => $doctor_option[1],
            'appointment_type' => $this->input->post('type'),
            'appointment_remark' => $this->input->post('remark'),
            'appointment_ref' => $this->input->post('patient_ref'),
            'appointment_date' => $this->input->post('app_date'),
            'appointment_slot' => $appointment_slot,
            'appointment_entry_by' => $this->session->userdata('user_id'),
            'appointment_entry_date' => date('Y-m-d'),
            'appointment_created_at' => date('Y-m-d H:i:s'),
            'appointment_status' => 1
        );

        $this->form_validation->set_rules('app_date', 'Date', 'required');
        //$this->form_validation->set_rules('doctor_department', 'Department', 'required');
        $this->form_validation->set_rules('shift', 'Shift', 'required');
        $this->form_validation->set_rules('patient_name', 'Patient Number', 'required');
        $this->form_validation->set_rules('patient_mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('type', 'Appointment Type', 'required');
        $this->form_validation->set_rules('schedule_slot', 'Appointment Slot', 'required');
        
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['shift'] = $this->prescription_model->get_shift();
            //$data['department'] = $this->prescription_model->get_department();
            $data['appointment_info'] = $this->prescription_model->get_appointment_by_id($appointment_id);
            $data['main_content'] = $this->load->view('home/direct_appointment_edit_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            $this->prescription_model->update_appointment($appointment, $appointment_id);
            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in'>Appointment of ".$patient_name." Updated Successfully. Serial Number ".$appointment_slot."</div>";
            $this->session->set_userdata($sdata);
            redirect("edit-appointment/". $appointment_id);
        }
    }

    // patient appointment delete
    public function delete_direct_appointment($appointment_id)
    {
        $this->prescription_model->remove_appointment($appointment_id);
        $sdata = array();
        $sdata['success'] = "<div class='alert alert-danger fade in'>Appointment Deleted!</div>";
        $this->session->set_userdata($sdata);
        redirect("appointment-list");
    }


///////////End patient appointment//////////

///////////Start patient Vital//////////
    // patient vital  form
    public function patient_vital_entry_form($appointment_id)
    {
        $vital_info = $this->prescription_model->get_vital_by_id($appointment_id);
        if ($vital_info) {
            $data = array();
            $data['main'] = true;
            $data['app_info'] = $this->prescription_model->get_appointment_by_id($appointment_id);
            $data['vital_info'] = $vital_info;
            $data['main_content'] = $this->load->view('home/patient_vital_edit_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
            $data = array();
            $data['main'] = true;
            $data['app_info'] = $this->prescription_model->get_appointment_by_id($appointment_id);
            $data['main_content'] = $this->load->view('home/patient_vital_entry_form', $data,true);
            $this->load->view('home/admin_home', $data);
        }
        
    }

    // Save patient vital
    public function save_patient_vital($appointment_id)
    {
        $vital = array(
            'vital_id' => "PVI-".uniqid(),
            'appointment_id' => $appointment_id,
            'patient_id' => $this->input->post('patient_reg'),
            'vital_height_feet' => $this->input->post('height_feet'),
            'vital_height_inch' => $this->input->post('height_inch'),
            'vital_temperature_f' => $this->input->post('patient_temperature_f'),
            'vital_temperature_c' => $this->input->post('patient_temperature_c'),
            'vital_weight_kg' => $this->input->post('patient_weight_kg'),
            'vital_respiration' => $this->input->post('patient_respiration'),
            'vital_pulse' => $this->input->post('patient_pulse'),
            'vital_bp_sys' => $this->input->post('patient_bp_sys'),
            'vital_bp_dia' => $this->input->post('patient_bp_dia'),
            'vital_smoking_habit' => $this->input->post('patient_smoking_habit'),
            'vital_other' => $this->input->post('patient_other'),
            'vital_entry_by' => $this->session->userdata('user_id'),
            'vital_entry_date' => date('Y-m-d'),
            'vital_created_at' => date('Y-m-d H:i:s'),
            'vital_status' => 1
        );

        $this->prescription_model->save_patient_vital($vital);
        $sdata = array();
        $sdata['success'] = "<div class='alert alert-success fade in''>Patient Vital Save Successful!</div>";
        $this->session->set_userdata($sdata);
        redirect("patient-vital-entry/".$appointment_id);
    }

    // update  patient vital
    public function update_patient_vital($appointment_id)
    {
        $vital = array(
            'vital_height_feet' => $this->input->post('height_feet'),
            'vital_height_inch' => $this->input->post('height_inch'),
            'vital_temperature_f' => $this->input->post('patient_temperature_f'),
            'vital_temperature_c' => $this->input->post('patient_temperature_c'),
            'vital_weight_kg' => $this->input->post('patient_weight_kg'),
            'vital_respiration' => $this->input->post('patient_respiration'),
            'vital_pulse' => $this->input->post('patient_pulse'),
            'vital_bp_sys' => $this->input->post('patient_bp_sys'),
            'vital_bp_dia' => $this->input->post('patient_bp_dia'),
            'vital_smoking_habit' => $this->input->post('patient_smoking_habit'),
            'vital_other' => $this->input->post('patient_other'),
            'vital_updated_by' => $this->session->userdata('user_id'),
            'vital_updated_at' => date('Y-m-d H:i:s')
        );

        $this->prescription_model->update_patient_vital($vital, $appointment_id);
        $sdata = array();
        $sdata['success'] = "<div class='alert alert-success fade in''>Patient Vital Update Successful!</div>";
        $this->session->set_userdata($sdata);
        redirect("patient-vital-entry/".$appointment_id);
    }
    
///////////End patient Vital//////////


 //view prescription
  public function view_prescription($prescription_id)
  {
    $date = date('Y-m-d');
    $data = array();
    $data['main'] = true;
    $data['app_info'] = $this->prescription_model->get_prescription_by_id($prescription_id);
    $data['pre_history'] = $this->prescription_model->get_pre_history($prescription_id);
    $data['pre_complaint'] = $this->prescription_model->get_pre_complaint($prescription_id);
    $data['pre_exam'] = $this->prescription_model->get_pre_exam($prescription_id);
    $data['pre_diagnosis'] = $this->prescription_model->get_pre_diagnosis($prescription_id);
    $data['pre_investigation'] = $this->prescription_model->get_pre_investigation($prescription_id);
    $data['pre_medicine'] = $this->prescription_model->get_pre_medicine($prescription_id);
    $data['pre_advice'] = $this->prescription_model->get_pre_advice($prescription_id);
    $data['pre_note'] = $this->prescription_model->get_pre_note($prescription_id);
    $data['pre_file'] = $this->prescription_model->get_pre_file($prescription_id);
    $data['main_content'] = $this->load->view('home/patient_prescription_eng', $data,true);
    $this->load->view('home/admin_home', $data);
  }

  //view prescription
  public function print_prescription($prescription_id)
  {
    $date = date('Y-m-d');
    $data = array();
    $data['main'] = true;
    $data['app_info'] = $this->prescription_model->get_prescription_by_id($prescription_id);
    $data['app_info'] = $this->prescription_model->get_prescription_by_id($prescription_id);
    $data['pre_history'] = $this->prescription_model->get_pre_history($prescription_id);
    $data['pre_complaint'] = $this->prescription_model->get_pre_complaint($prescription_id);
    $data['pre_exam'] = $this->prescription_model->get_pre_exam($prescription_id);
    $data['pre_diagnosis'] = $this->prescription_model->get_pre_diagnosis($prescription_id);
    $data['pre_investigation'] = $this->prescription_model->get_pre_investigation($prescription_id);
    $data['pre_medicine'] = $this->prescription_model->get_pre_medicine($prescription_id);
    $data['pre_advice'] = $this->prescription_model->get_pre_advice($prescription_id);
    $data['pre_note'] = $this->prescription_model->get_pre_note($prescription_id);
    $data['pre_file'] = $this->prescription_model->get_pre_file($prescription_id);
    $this->load->view('home/patient_prescription_eng_print', $data);
  }

//view prescription list
  public function prescription_list()
  {
    $date = date('Y-m-d');
    $data = array();
    $data['main'] = true;
    $data['pre_info'] = $this->prescription_model->prescription_by_date($date);
    $data['main_content'] = $this->load->view('home/prescription_list', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  // prescription search
    public function prescription_search()
     {
      $output = '';
      $query = '';
        if($this->input->post('query'))
      {
       $query = $this->input->post('query');
      }
      $data = $this->prescription_model->fetch_prescription($query);
      $output .= '
      <table class="table table-bordered table-striped table-hover example2">
        <caption><center>Prescription List</center></caption>
        <thead>
        <tr>
            <th style="width:12px;">SL.</th>
            <th>Visit Date</th>
            <th>Registration #</th>
            <th>prescription #</th>
            <th>Patient Name</th>
            <th>Father Name</th>
            <th>Age</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Blood Group</th>
            <th>Doctor</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
      ';
      if($data->num_rows() > 0)
      {
        $p=0;
       foreach($data->result() as $row)
       {

        $output .= '
          <tr>
           <td>'.$p++.'</td>
           <td>'.date("d/m/Y", strtotime($row->visit_date)).'</td>
           <td>'.$row->patient_reg_no.'</td>
           <td>'.$row->prescription_no.'</td>
           <td>'.$row->patient_first_name.' '.$row->patient_last_name.'</td>
           <td>'.$row->patient_father_name.'</td>
           <td>'.$row->pre_age.'</td>
           <td>'.$row->patient_mobile.'</td>
           <td>'.$row->patient_address.'</td>
           <td>'.$row->patient_blood_group.'</td>
           <td>'.$row->doctor_name.'</td>
           <td><a class="btn btn-primary btn-xs" href="'.base_url().'view-prescription/'. $row->prescription_id.'">
                </i>View/Print</a>
                <a class="btn btn-success btn-xs" href="'.base_url().'prescription-files/'. $row->prescription_id.'">
                </i>Files</a>
                </td>
          </tr>
        ';
       }
      }
      else
      {
       $output .= '<tr>
           <td colspan="7">No Data Found</td>
          </tr>';
      }
      $output .= '</tbody></table>';
      echo $output;
     }

  //view prescription files
  public function prescription_files($prescription_id)
  {
    $date = date('Y-m-d');
    $data = array();
    $data['main'] = true;
    $data['file_info'] = $this->prescription_model->get_prescription_files($prescription_id);
    $data['pre_info'] = $this->prescription_model->get_prescription_by_id($prescription_id);
    $data['main_content'] = $this->load->view('home/prescription_files', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  // Save prescription file
    public function save_prescription_file($prescription_id)
    {
        $pre_info = $this->prescription_model->get_prescription_by_id($prescription_id);
        $config['upload_path'] = 'uploads/pre_file';
        $config['allowed_types'] = 'pdf|docx|doc|png|jpg|jpeg';
        $config['max_size'] = '2000';
        $this->load->library('upload', $config);
        
        if($_FILES['patient_file']['name'] != ""){
            if (!$this->upload->do_upload('patient_file')) {
                        $sdata = array();
                        $sdata['error'] = "<div class='alert alert-error fade in''>Please use a png, jpg, jpeg, pdf, docx or doc File. Max File size 2MB.</div>";
                        $this->session->set_userdata($sdata);
                        redirect('prescription-files/'.$prescription_id);
                    }else{
            $data_upload_files_other = $this->upload->data();
            $pdata = array('upload_data' => $this->upload->data());
            $patient_file = "uploads/pre_file/" . $pdata['upload_data']['file_name'];
            } 
        }

        $file = array(
            'prescription_id' => $prescription_id,
            'patient_id' => $pre_info->patient_id,
            'pre_file_id' => "PFI-".uniqid(),
            'pre_file_name' => $this->input->post('file_name'),
            'pre_file' => $patient_file,
            'pre_file_entry_by' => $this->session->userdata('user_id'),
            'pre_file_entry_date' => date('Y-m-d'),
            'pre_file_created_at' => date('Y-m-d H:i:s'),
            'pre_file_status' => 1
        );

        $this->form_validation->set_rules('file_name', 'File Name', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $date = date('Y-m-d');
            $data = array();
            $data['main'] = true;
            $data['file_info'] = $this->prescription_model->get_prescription_files($prescription_id);
            $data['pre_info'] = $pre_info;
            $data['main_content'] = $this->load->view('home/prescription_files', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
        $this->prescription_model->save_prescription_file($file);
        $sdata = array();
        $sdata['success'] = "<div class='alert alert-success fade in''>New File Entry Successful!</div>";
        $this->session->set_userdata($sdata);
        redirect("prescription-files/$prescription_id");
        }
    }

    //download file item
    public function download_prescription_file($pre_file_id)
    {
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->prescription_model->get_prescription_file($pre_file_id);
            
            //file path
            $file = $fileInfo->pre_file;
            
            //download file from directory
            force_download($file, NULL);
        
    }

///////////Start template//////////
    //template Entry Form
    public function new_template()
    {
        $data = array();
        $data['main'] = true;
        $data['doses_administration'] = $this->prescription_model->get_doses_administration();
        $data['doses_duration'] = $this->prescription_model->get_doses_duration();
        $data['meal_administration'] = $this->prescription_model->get_meal_administration();
        $data['investigation_type'] = $this->prescription_model->get_investigation_type();
        $data['health_advice'] = $this->prescription_model->get_health_advice();
        $data['main_content'] = $this->load->view('home/template_entry_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    //template entry
   public function save_template()
   {
        $template_id = "TMP-".uniqid();
        $entry_by = $this->session->userdata('user_id');
        $status = 1;
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');
        $department_id = $this->input->post('department_code');
        if ($department_id){
        $qty = count($department_id);

        $template = array(
            'template_id' => $template_id,
            'template_name' => $this->input->post('template_name'),
            'template_entry_by' => $entry_by,
            'template_entry_date' => $entry_date,
            'template_created_at' => $created_at,
            'template_access' => "All",
            'template_status' => $status
        );
        $this->prescription_model->save_template($template);

        for($d=0; $d<$qty; $d++)
        {
            $temp_department = array(
                'template_id' => $template_id,
                'temp_department_id' => "TDI-".uniqid(),
                'temp_department' => $department_id[$d],
                'temp_department_entry_by' => $entry_by,
                'temp_department_entry_date' => $entry_date,
                'temp_department_created_at' => $created_at,
                'temp_department_status' => $status
              );
              $this->prescription_model->save_temp_department($temp_department);
          
        }

       

        $patient_diagnosis = $this->input->post("patient_diagnosis");
        $diagnosis_array = explode("\r\n", $patient_diagnosis);
        foreach($diagnosis_array as $diagnosis){
          if($diagnosis){
            $pre_diagnosis = array(
            'prescription_id' => $template_id,
            'pre_diagnosis_id' => "PDI-".uniqid(),
            'pre_diagnosis' => $diagnosis,
            'pre_diagnosis_entry_by' => $entry_by,
            'pre_diagnosis_entry_date' => $entry_date,
            'pre_diagnosis_created_at' => $created_at,
            'pre_diagnosis_status' => $status
          );
          $this->prescription_model->save_pre_diagnosis($pre_diagnosis);
        }
        }

        $patient_medicine = $this->input->post("patient_medicine");
        $medicine_array = explode("\r\n", $patient_medicine);
        foreach($medicine_array as $medicine){
          if($medicine){
            $med_option = explode("|", $medicine);
            $pre_medicine = array(
            'prescription_id' => $template_id,
            'pre_medicine_id' => "PMI-".uniqid(),
            'pre_medicine_name' => $med_option[0],
            'pre_medicine_doses' => $med_option[1],
            'pre_medicine_duration' => $med_option[2],
            'pre_medicine_advice' => $med_option[3],
            'pre_medicine_entry_by' => $entry_by,
            'pre_medicine_entry_date' => $entry_date,
            'pre_medicine_created_at' => $created_at,
            'pre_medicine_status' => $status
          );
          $this->prescription_model->save_pre_medicine($pre_medicine);
        }
        }
        
        $patient_test = $this->input->post("patient_test");
        $test_array = explode("\r\n", $patient_test);
        foreach($test_array as $test){
          if($test){
            //$test_option = explode("|", $test);
            $pre_investigation = array(
            'prescription_id' => $template_id,
            'pre_investigation_id' => "PII-".uniqid(),
            //'pre_investigation_type' => $test_option[0],
            //'pre_investigation' => $test_option[1],
            'pre_investigation' => $test,
            'pre_investigation_entry_by' => $entry_by,
            'pre_investigation_entry_date' => $entry_date,
            'pre_investigation_created_at' => $created_at,
            'pre_investigation_status' => $status
          );
          $this->prescription_model->save_pre_investigation($pre_investigation);
        }
        }

        $patient_advice = $this->input->post("patient_advice");
        $advice_array = explode("\r\n", $patient_advice);
        foreach($advice_array as $advice){
          if($advice){
            $pre_advice = array(
            'prescription_id' => $template_id,
            'pre_health_advice_id' => "PAI-".uniqid(),
            'pre_health_advice' => $advice,
            'pre_health_advice_entry_by' => $entry_by,
            'pre_health_advice_entry_date' => $entry_date,
            'pre_health_advice_created_at' => $created_at,
            'pre_health_advice_status' => $status
          );
          $this->prescription_model->save_pre_advice($pre_advice);
        }
        }

        $patient_note = $this->input->post("patient_note");
        $note_array = explode("\r\n", $patient_note);
        foreach($note_array as $note){
          if($note){
            $pre_note = array(
            'prescription_id' => $template_id,
            'pre_special_note_id' => "PNI-".uniqid(),
            'pre_special_note' => $note,
            'pre_special_note_entry_by' => $entry_by,
            'pre_special_note_entry_date' => $entry_date,
            'pre_special_note_created_at' => $created_at,
            'pre_special_note_status' => $status
          );
          $this->prescription_model->save_pre_note($pre_note);
        }
        }
    
    redirect("template-detail/".$template_id);
    }else{
            $sdata = array();
            $sdata['error'] = "<div class='alert alert-danger fade in'>Please select at least one Department.</div>";
            $this->session->set_userdata($sdata);
            redirect("new-template");

        }
  }

  //edit template
  public function template_detail($template_id)
  {
    $data = array();
    $data['main'] = true;
    $data['doses_administration'] = $this->prescription_model->get_doses_administration();
    $data['doses_duration'] = $this->prescription_model->get_doses_duration();
    $data['meal_administration'] = $this->prescription_model->get_meal_administration();
    $data['investigation_type'] = $this->prescription_model->get_investigation_type();
    $data['health_advice'] = $this->prescription_model->get_health_advice();
    $app_info = $this->prescription_model->get_template_by_id($template_id);
    $data['app_info'] = $app_info;    
    $data['temp_dept'] = $this->prescription_model->get_temp_dept($template_id);
    $data['pre_diagnosis'] = $this->prescription_model->get_pre_diagnosis($template_id);
    $data['pre_investigation'] = $this->prescription_model->get_pre_investigation($template_id);
    $data['pre_medicine'] = $this->prescription_model->get_pre_medicine($template_id);
    $data['pre_advice'] = $this->prescription_model->get_pre_advice($template_id);
    $data['pre_note'] = $this->prescription_model->get_pre_note($template_id);
    $data['main_content'] = $this->load->view('home/template_detail', $data,true);
    $this->load->view('home/admin_home', $data);
  }

  //template update
   public function update_template($template_id)
   {
        $entry_by = $this->session->userdata('user_id');
        $status = 1;
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');

        $department_id = $this->input->post('department_code');
        if ($department_id){
        $qty = count($department_id);

        $template = array(
            'template_name' => $this->input->post('template_name'),
            'template_updated_by' => $entry_by,
            'template_updated_at' => $created_at
        );
        $this->prescription_model->update_template($template, $template_id);

        $this->prescription_model->delete_pre_department($template_id);
        $this->prescription_model->delete_pre_diagnosis($template_id);
        $this->prescription_model->delete_pre_medicine($template_id);
        $this->prescription_model->delete_pre_investigation($template_id);
        $this->prescription_model->delete_pre_advice($template_id);
        $this->prescription_model->delete_pre_note($template_id);

        for($d=0; $d<$qty; $d++)
        {
            $temp_department = array(
                'template_id' => $template_id,
                'temp_department_id' => "TDI-".uniqid(),
                'temp_department' => $department_id[$d],
                'temp_department_entry_by' => $entry_by,
                'temp_department_entry_date' => $entry_date,
                'temp_department_created_at' => $created_at,
                'temp_department_status' => $status
              );
              $this->prescription_model->save_temp_department($temp_department);
          
        }

        $patient_diagnosis = $this->input->post("patient_diagnosis");
        $diagnosis_array = explode("\r\n", $patient_diagnosis);
        foreach($diagnosis_array as $diagnosis){
          if($diagnosis){
            $pre_diagnosis = array(
            'prescription_id' => $template_id,
            'pre_diagnosis_id' => "PDI-".uniqid(),
            'pre_diagnosis' => $diagnosis,
            'pre_diagnosis_entry_by' => $entry_by,
            'pre_diagnosis_entry_date' => $entry_date,
            'pre_diagnosis_created_at' => $created_at,
            'pre_diagnosis_status' => $status
          );
          $this->prescription_model->save_pre_diagnosis($pre_diagnosis);
        }
        }

        $patient_medicine = $this->input->post("patient_medicine");
        $medicine_array = explode("\r\n", $patient_medicine);
        foreach($medicine_array as $medicine){
          if($medicine){
            $med_option = explode("|", $medicine);
            $pre_medicine = array(
            'prescription_id' => $template_id,
            'pre_medicine_id' => "PMI-".uniqid(),
            'pre_medicine_name' => $med_option[0],
            'pre_medicine_doses' => $med_option[1],
            'pre_medicine_duration' => $med_option[2],
            'pre_medicine_advice' => $med_option[3],
            'pre_medicine_entry_by' => $entry_by,
            'pre_medicine_entry_date' => $entry_date,
            'pre_medicine_created_at' => $created_at,
            'pre_medicine_status' => $status
          );
          $this->prescription_model->save_pre_medicine($pre_medicine);
        }
        }
        
        $patient_test = $this->input->post("patient_test");
        $test_array = explode("\r\n", $patient_test);
        foreach($test_array as $test){
          if($test){
            //$test_option = explode("|", $test);
            $pre_investigation = array(
            'prescription_id' => $template_id,
            'pre_investigation_id' => "PII-".uniqid(),
            //'pre_investigation_type' => $test_option[0],
            //'pre_investigation' => $test_option[1],
            'pre_investigation' => $test,
            'pre_investigation_entry_by' => $entry_by,
            'pre_investigation_entry_date' => $entry_date,
            'pre_investigation_created_at' => $created_at,
            'pre_investigation_status' => $status
          );
          $this->prescription_model->save_pre_investigation($pre_investigation);
        }
        }

        $patient_advice = $this->input->post("patient_advice");
        $advice_array = explode("\r\n", $patient_advice);
        foreach($advice_array as $advice){
          if($advice){
            $pre_advice = array(
            'prescription_id' => $template_id,
            'pre_health_advice_id' => "PAI-".uniqid(),
            'pre_health_advice' => $advice,
            'pre_health_advice_entry_by' => $entry_by,
            'pre_health_advice_entry_date' => $entry_date,
            'pre_health_advice_created_at' => $created_at,
            'pre_health_advice_status' => $status
          );
          $this->prescription_model->save_pre_advice($pre_advice);
        }
        }

        $patient_note = $this->input->post("patient_note");
        $note_array = explode("\r\n", $patient_note);
        foreach($note_array as $note){
          if($note){
            $pre_note = array(
            'prescription_id' => $template_id,
            'pre_special_note_id' => "PNI-".uniqid(),
            'pre_special_note' => $note,
            'pre_special_note_entry_by' => $entry_by,
            'pre_special_note_entry_date' => $entry_date,
            'pre_special_note_created_at' => $created_at,
            'pre_special_note_status' => $status
          );
          $this->prescription_model->save_pre_note($pre_note);
        }
        }
    
    redirect("template-detail/".$template_id);
    }else{
            $sdata = array();
            $sdata['error'] = "<div class='alert alert-danger fade in'>Please select at least one Department.</div>";
            $this->session->set_userdata($sdata);
            redirect("template-detail/".$template_id);

        }
  }

  //template list
  public function template_list()
  {
    $data = array();
    $data['main'] = true;
    $data['templates'] = $this->prescription_model->get_template_list();
    $data['main_content'] = $this->load->view('home/template_list', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  //template list
  public function doctorwise_template_list()
  {
    $data = array();
    $data['main'] = true;
    $data['templates'] = $this->prescription_model->get_doctorwise_template_list();
    $data['main_content'] = $this->load->view('home/doctorwise_template_list', $data,true);
    $this->load->view('home/admin_home', $data);    
  }
///////////End template//////////

////////////////Report Start////////////////////////////
 //report list
  public function report_list()
  {
    $data = array();
    $data['main'] = true;
    $data['main_content'] = $this->load->view('home/report_list', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  //view report
  public function view_report()
  {
    $report = $this->input->post('report_title');
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    redirect("$report/$from_date/$to_date"); 
  }

  //consultant wise patient report
  public function consultant_patient($from_date, $to_date)
  {
    $data = array();
    $data['main'] = true;
    $data['from_date'] = $from_date;
    $data['to_date'] = $to_date;
    $data['doctors'] = $this->prescription_model->get_doctors();
    $data['main_content'] = $this->load->view('home/report_consultant_patient', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  //consultant wise patient summary report
  public function consultant_patient_summary($from_date, $to_date)
  {
    $data = array();
    $data['main'] = true;
    $data['from_date'] = $from_date;
    $data['to_date'] = $to_date;
    $data['doctors'] = $this->prescription_model->get_doctors();
    $data['main_content'] = $this->load->view('home/report_consultant_patient_summary', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  //consultant wise investigation report
  public function consultant_investigation($from_date, $to_date)
  {
    $data = array();
    $data['main'] = true;
    $data['from_date'] = $from_date;
    $data['to_date'] = $to_date;
    $data['doctors'] = $this->prescription_model->get_doctors();
    $data['main_content'] = $this->load->view('home/report_consultant_investigation', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  //patient wise investigation report
  public function patient_investigation($from_date, $to_date)
  {
    $data = array();
    $data['main'] = true;
    $data['from_date'] = $from_date;
    $data['to_date'] = $to_date;
    $data['doctors'] = $this->prescription_model->get_doctors();
    $data['main_content'] = $this->load->view('home/report_patient_investigation', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  //patient wise report
  public function datewise_patient_list($from_date, $to_date)
  {
    $data = array();
    $data['main'] = true;
    $data['from_date'] = $from_date;
    $data['to_date'] = $to_date;
    $data['patients'] = $this->prescription_model->get_datewise_patient($from_date, $to_date);
    $data['main_content'] = $this->load->view('home/report_datewise_patient_list', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

  //patient wise report
  public function datewise_patient_type($from_date, $to_date)
  {
    $data = array();
    $data['main'] = true;
    $data['from_date'] = $from_date;
    $data['to_date'] = $to_date;
    $data['main_content'] = $this->load->view('home/report_datewise_patient_type', $data,true);
    $this->load->view('home/admin_home', $data);    
  }

////////////////Report End////////////////////////////


////////////////schedule start////////////////////////////
  /////Start shift/////
    //shift List
    public function shift_list()
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = "";
        $data['shift'] = $this->prescription_model->get_shift();
        $data['main_content'] = $this->load->view('home/shift_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save shift
    public function save_shift()
    {
        $shift = array(
            'shift_id' => "SFI-".uniqid(),
            'shift_title' => $this->input->post('shift_name'),
            'shift_start' => $this->input->post('shift_start'),
            'shift_end' => $this->input->post('shift_end'),
            'shift_entry_by' => $this->session->userdata('user_id'),
            'shift_entry_date' => date('Y-m-d'),
            'shift_created_at' => date('Y-m-d h:i:s'),
            'shift_status' => 1
        );

        $this->form_validation->set_rules('shift_name', 'shift', 'required|is_unique[shifts.shift_title]');
        $this->form_validation->set_rules('shift_start', 'shift', 'required');
        $this->form_validation->set_rules('shift_end', 'shift', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = "";
            $data['shift'] = $this->prescription_model->get_shift();
            $data['main_content'] = $this->load->view('home/shift_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                $this->prescription_model->save_shift($shift);
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'>New Entry Created Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("shift-setup");
            }
    }

    //shift edit Form
    public function edit_shift($shift_id)
    {
        $data = array();
        $data['main'] = true;
        $data['edit_info'] = $this->prescription_model->get_shift_by_id($shift_id);
        $data['shift'] = $this->prescription_model->get_shift();
        $data['main_content'] = $this->load->view('home/shift_list', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Update shift info
    public function update_shift($shift_id)
    {
        $shift = array(
            'shift_title' => $this->input->post('shift_name'),
            'shift_start' => $this->input->post('shift_start'),
            'shift_end' => $this->input->post('shift_end'),
            'shift_updated_by' => $this->session->userdata('user_id'),
            'shift_updated_at' => date('Y-m-d h:i:s'),
        );

        $this->form_validation->set_rules('shift_name', 'shift', 'required');
        $this->form_validation->set_rules('shift_start', 'shift', 'required');
        $this->form_validation->set_rules('shift_end', 'shift', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['main'] = true;
            $data['edit_info'] = $this->prescription_model->get_shift_by_id($shift_id);
            $data['shift'] = $this->prescription_model->get_shift();
            $data['main_content'] = $this->load->view('home/shift_list', $data,true);
            $this->load->view('home/admin_home', $data);
        }else{
                
                $this->prescription_model->update_shift($shift, $shift_id);
            
                $sdata = array();
                $sdata['success'] = "<div class='alert alert-success fade in'> Entry Updated Successfully!</div>";
                $this->session->set_userdata($sdata);
                redirect("shift-setup");
            }
    }

///////////end shift //////////

/////Start schedule/////
    //schedule List
    public function schedule_list()
    {
        $data = array();
        $data['main'] = true;
        $data['shift'] = $this->prescription_model->get_shift();
        $data['main_content'] = $this->load->view('home/schedule_setup', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    //doctor search
    public function get_doctor_list()
    {
    $postData = $this->input->post();
    $data = $this->prescription_model->ddoctor_search($postData);
    echo json_encode($data);
    }

    //get doctor info for schedule form
    public function get_doctor_schedule()
    {
        $doctor_id = $this->input->post('doctor_id');
       
        if($doctor_id){
        $doctor = $this->prescription_model->get_doctor_by_id($doctor_id);
        $doctor_schedule = $this->prescription_model->get_doctor_schedule($doctor_id);
        
        $p = 1;
        if($doctor_schedule){
        echo '<center><h3>'.$doctor->doctor_name.'</h3></center><br>';
        echo '<div class="table-responsive"><table class="table table-bordered table-striped">
                <tr>
                    <th width="15">Sl</th>
                    <th>Shift</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Slot</th>
                    <th>Week Days</th>
                    <th>Action</th>
                </tr>';
                foreach($doctor_schedule as $schedule){
                $schedule_day = $this->prescription_model->get_schedule_day($schedule->schedule_id);
                
                
          echo '<tr>
                    <td>'.$p++.'</td>
                    <td>'.$schedule->shift_title.'</td>
                    <td>'.date("d/m/Y", strtotime($schedule->start_date)).'</td>
                    <td>'.date("d/m/Y", strtotime($schedule->end_date)).'</td>
                    <td>'.$schedule->start_time.'</td>
                    <td>'.$schedule->end_time.'</td>
                    <td>'.$schedule->schedule_slots.'</td>';
         echo       '<td>';
                    if ($schedule_day) {
                    foreach ($schedule_day as $sday) {
                      echo  $sday->schedule_day;
                      if (next($schedule_day )) {
                            echo ', ';
                        }
                    }
                    }

         echo       '</td>
                    <td><a class="btn btn-primary btn-xs" href="'.base_url().'edit-schedule/'.$schedule->schedule_id.'">Edit
                            </a></td>
                </tr>';
                }          
           echo '</table></div>';
           }else{echo "No Data Found.";}

        }
        
    }

    // Save schedule
    public function save_schedule()
    {
        $schedule_id =  "SCH-".uniqid();
        $doctor = $this->input->post('doctor_id');
        $department = $this->input->post('department_id');
        $day = $this->input->post('day');
        $shift = $this->input->post('shift');
        $slot = $this->input->post('slot');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $qty = count($day);

        if($qty != 0){
            for($i=0; $i<$qty;$i++){
                $day_id = explode(":",$day[$i]);
                $schedule_day = array(
                'schedule_day_id' => "SDI-".uniqid(),
                'schedule_id' => $schedule_id,
                'doctor_id' => $doctor,
                'department_id' => $department,
                'schedule_day' => $day_id[0],
                'schedule_day_code' => $day_id[1],
                'schedule_day_shift' => $shift,
                'schedule_day_slots' => $slot,
                'schedule_day_start_time' => $start_time,
                'schedule_day_end_time' => $end_time,
                'schedule_day_entry_by' => $this->session->userdata('user_id'),
                'schedule_day_entry_date' => date('Y-m-d'),
                'schedule_day_created_at' => date('Y-m-d h:i:s'),
                'schedule_day_status' => 1
            );

            $this->prescription_model->add_schedule_day($schedule_day);
            }

            $schedule = array(
                'schedule_id' => $schedule_id,
                'doctor_id' => $doctor,
                'department_id' => $department,
                'schedule_shift' => $shift,
                'schedule_slots' => $slot,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'schedule_entry_by' => $this->session->userdata('user_id'),
                'schedule_entry_date' => date('Y-m-d'),
                'schedule_created_at' => date('Y-m-d h:i:s'),
                'schedule_status' => 1
            );
            $this->prescription_model->save_schedule($schedule);

            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in'> Entry Successfull!</div>";
            $this->session->set_userdata($sdata);
            redirect("schedule-setup");

        }else{
            $sdata = array();
            $sdata['error'] = "<div class='alert alert-danger fade in''>Fill up at least one Day!</div>";
            $this->session->set_userdata($sdata);
           redirect("schedule-setup"); 
        }
        
    }

    //schedule edit Form
    public function edit_schedule($schedule_id)
    {
        $data = array();
        $data['main'] = true;
        $data['schedule_info'] = $this->prescription_model->get_schedule_by_id($schedule_id);
        $data['schedule_day'] = $this->prescription_model->get_schedule_day($schedule_id);
        $data['main_content'] = $this->load->view('home/schedule_edit_form', $data,true);
        $this->load->view('home/admin_home', $data);
    }

    // Save schedule
    public function update_schedule($schedule_id)
    {
        $schedule_info = $this->prescription_model->get_schedule_by_id($schedule_id);
        $day = $this->input->post('day');
        $shift = $this->input->post('shift');
        $slot = $this->input->post('slot');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $qty = count($day);

        $this->prescription_model->remove_schedule_days($schedule_id);

        if($qty != 0){
            for($i=0; $i<$qty;$i++){
                $day_id = explode(":",$day[$i]);
                $schedule_day = array(
                'schedule_day_id' => "SDI-".uniqid(),
                'schedule_id' => $schedule_id,
                'doctor_id' => $schedule_info->doctor_id,
                'department_id' => $schedule_info->department_id,
                'schedule_day' => $day_id[0],
                'schedule_day_code' => $day_id[1],
                'schedule_day_shift' => $shift,
                'schedule_day_slots' => $slot,
                'schedule_day_start_time' => $start_time,
                'schedule_day_end_time' => $end_time,
                'schedule_day_entry_by' => $this->session->userdata('user_id'),
                'schedule_day_entry_date' => date('Y-m-d'),
                'schedule_day_created_at' => date('Y-m-d h:i:s'),
                'schedule_day_status' => 1
            );

            $this->prescription_model->add_schedule_day($schedule_day);
            }

            $schedule = array(
                'schedule_shift' => $shift,
                'schedule_slots' => $slot,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'schedule_updated_by' => $this->session->userdata('user_id'),
                'schedule_updated_at' => date('Y-m-d h:i:s')
            );
            $this->prescription_model->update_schedule($schedule, $schedule_id);

            $sdata = array();
            $sdata['success'] = "<div class='alert alert-success fade in'> Schedule Updated!</div>";
            $this->session->set_userdata($sdata);
            redirect("schedule-setup");

        }else{
            $sdata = array();
            $sdata['error'] = "<div class='alert alert-danger fade in''>Fill up at least one Day!</div>";
            $this->session->set_userdata($sdata);
           redirect("schedule-setup"); 
        }
        
    }
////////////////schedule end////////////////////////////


}
