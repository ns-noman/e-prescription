<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		
		$this->load->model('prescription_model');
        $userType = $this->session->userdata('user_type');
        if($userType != "Super Admin" && $userType != "Admin" && $userType != "Doctor" && $userType != "Operator"){
            redirect("/");
        }
    }

	public function index()
	{
        $date = date('Y-m-d');
        $past_date = date('Y-m-d', strtotime('-30 days'));

        $data = array();
        $data['main'] = true;
        $doctor_id = ($this->session->userdata('user_id'));
        //$visit =  $this->prescription_model->get_doctor_wise_patient($doctor_id, $past_date, $date);
        $data['consultation_visit'] = $this->prescription_model->get_doctor_wise_visit_type($doctor_id, $past_date, $date, "Consultation");
        $data['followup_visit'] = $this->prescription_model->get_doctor_wise_visit_type($doctor_id, $past_date, $date, "Followup");
        $data['general_visit'] = $this->prescription_model->get_doctor_wise_visit_type($doctor_id, $past_date, $date, "Report");
        $data['emergency_visit'] = $this->prescription_model->get_doctor_wise_visit_type($doctor_id, $past_date, $date, "Emergency");
        $data['appointments'] = $this->prescription_model->get_doctorwise_active_appointment($doctor_id, $date);
        $data['main_content'] = $this->load->view('home/doctor_home_content', $data,true);
        $this->load->view('home/doctor_home', $data);
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
    
// User password re-set form
    public function doctor_password($user_id)
        {
            $data = array();
            $data['main'] = true;
            $data['update_user'] = $this->prescription_model->show_user_by_id($user_id);
            $data['main_content'] = $this->load->view('home/doctor_password_reset_form', $data,true);
            $this->load->view('home/doctor_home', $data);
        }
        
//Update User Password
    public function update_doctor_password ($user_id)
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
                $data['main_content'] = $this->load->view('home/doctor_password_reset_form', $data,true);
                $this->load->view('home/doctor_home', $data); 
            
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
                redirect("/");
        }
    }

	// doctor Log Out
	public function doctor_log_out() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('active_status');
        $this->session->unset_userdata('type');
        $this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
        redirect("/", "refresh");
    }

    //doctor appointment list
    public function doctor_appointment_list()
    {
        $date = date('Y-m-d');
        $data = array();
        $data['main'] = true;
        $doctor_id = ($this->session->userdata('user_id'));
        $data['appointments'] = $this->prescription_model->get_doctorwise_active_appointment($doctor_id, $date);
        $data['main_content'] = $this->load->view('home/doctor_appointment_list', $data,true);
        $this->load->view('home/doctor_home', $data);
    }

    //doctor appointment list
    public function doctor_prescription_entry($appointment_id)
    {
        $data = array();
        $data['main'] = true;
        $doctor_id = $this->session->userdata('user_id');
        $doctor_info = $this->prescription_model->get_doctor_by_id($doctor_id);
        $data['templates'] = $this->prescription_model->get_dept_template_list($doctor_info->department_id);
        $data['self_templates'] = $this->prescription_model->get_self_template_list($doctor_id);
        $app_info = $this->prescription_model->get_appointment_by_id($appointment_id);
        $data['app_info'] = $app_info;
        $data['vital_info'] = $this->prescription_model->get_vital_by_id($appointment_id);
        $data['file_info'] = $this->prescription_model->get_patient_file_by_doctor($app_info->patient_id, $doctor_id);
        $data['prescriptions'] = $this->prescription_model->get_patient_prescription_by_doctor($app_info->patient_id, $doctor_id);
        $data['doses_administration'] = $this->prescription_model->get_doses_administration();
        $data['doses_duration'] = $this->prescription_model->get_doses_duration();
        $data['meal_administration'] = $this->prescription_model->get_meal_administration();
        $data['investigation_type'] = $this->prescription_model->get_investigation_type();
        $data['health_advice'] = $this->prescription_model->get_health_advice();
        $data['main_content'] = $this->load->view('home/prescription_entry_form', $data,true);
        $this->load->view('home/doctor_home', $data);
    }

    //department serach
   public function department_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->department_search($postData);
    echo json_encode($data);
  }

    //history serach
   public function history_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->history_search($postData);
    echo json_encode($data);
    }

    //complaint serach
   public function complaint_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->complaint_search($postData);
    echo json_encode($data);
  }

  //exam serach
   public function exam_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->exam_search($postData);
    echo json_encode($data);
  }

  //diagnosis serach
   public function diagnosis_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->diagnosis_search($postData);
    echo json_encode($data);
  }

  //medicine serach
   public function medicine_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->medicine_search($postData);
    echo json_encode($data);
  }

  //test serach
   public function test_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->test_search($postData);
    echo json_encode($data);
  }

  //advice serach
   public function advice_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->advice_search($postData);
    echo json_encode($data);
  }

  //note serach
   public function note_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->note_search($postData);
    echo json_encode($data);
  }

  //ref serach
   public function ref_search()
   {
    $postData = $this->input->post();
    $data = $this->prescription_model->ref_search($postData);
    echo json_encode($data);
  }

  //prescription entry
   public function save_prescription_entry($appointment_id)
   {
        $app_info = $this->prescription_model->get_appointment_by_id($appointment_id);
        $prescription_id = "RXI-".uniqid();
        $entry_by = $this->session->userdata('user_id');
        $status = 1;
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');

        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $day = $this->input->post('day');
        $patient_dob = date('Y-m-d', strtotime($year . ' years ago'. "-$month months". "-$day days"));
        $patient = array(
            'patient_dob' => $patient_dob,
            'patient_gender' => $this->input->post('gender'),
            'patient_blood_group' => $this->input->post('blood_group'),
            'patient_updated_at' => $created_at
        );
        $this->prescription_model->update_patient($patient, $app_info->patient_id);
        
        $dob = date_diff(date_create(), date_create($patient_dob));
        $age = $dob->format("%Y Year, %M Months, %d Days");
         

        $prescription = array(
            'prescription_id' => $prescription_id,
            'appointment_id' => $appointment_id,
            'patient_id' => $app_info->patient_id,
            'pre_reg_no' => $app_info->patient_reg_no,
            'doctor_id' => $app_info->doctor_id,
            'visit_date' => $entry_date,
            'visit_no' => "VI-".date('s').rand(10,99),
            'prescription_no' => "PN-".date('s').rand(10,99),
            'pre_age' => $age,
            'pre_marital_status' => $this->input->post('marital_status'),
            'pre_height_feet' => $this->input->post('height_feet'),
            'pre_height_inch' => $this->input->post('height_inch'),
            'pre_weight_kg' => $this->input->post('patient_weight_kg'),
            'pre_pulse' => $this->input->post('patient_pulse'),
            'pre_bp_sys' => $this->input->post('patient_bp_sys'),
            'pre_bp_dia' => $this->input->post('patient_bp_dia'),
            'pre_temperature_f' => $this->input->post('patient_temperature_f'),
            'pre_temperature_c' => $this->input->post('patient_temperature_c'),
            'pre_remarks' => $this->input->post('patient_remark'),
            'pre_respiration' => $this->input->post('patient_respiration'),
            'pre_smoking_habit' => $this->input->post('patient_smoking_habit'),
            //'pre_others' => $this->input->post('patient_other'),
            'pre_next_visit' => $this->input->post('next_visit'),
            'pre_ref_org' => $this->input->post('patient_ref'),
            'prescription_entry_by' => $entry_by,
            'prescription_entry_date' => $entry_date,
            'prescription_created_at' => $created_at,
            'prescription_status' => $status
        );
        $this->prescription_model->save_prescription($prescription);

        // echo "<pre>";
        // print_r ($prescription);
        // echo "</pre>";
        // exit();

        $patient_history = $this->input->post("patient_history");
        $history_array = explode("\r\n", $patient_history);
        foreach($history_array as $history){
          if($history){
            $pre_history = array(
            'prescription_id' => $prescription_id,
            'pre_history_id' => "PHI-".uniqid(),
            'pre_history' => $history,
            'pre_history_entry_by' => $entry_by,
            'pre_history_entry_date' => $entry_date,
            'pre_history_created_at' => $created_at,
            'pre_history_status' => $status
          );
          $this->prescription_model->save_pre_history($pre_history);
        }
        }

        $chief_complaint = $this->input->post("chief_complaint");
        $complaint_array = explode("\r\n", $chief_complaint);
        foreach($complaint_array as $complaint){
          if($complaint){
            $pre_complaint = array(
            'prescription_id' => $prescription_id,
            'pre_complaint_id' => "PCI-".uniqid(),
            'pre_complaint' => $complaint,
            'pre_complaint_entry_by' => $entry_by,
            'pre_complaint_entry_date' => $entry_date,
            'pre_complaint_created_at' => $created_at,
            'pre_complaint_status' => $status
          );
          $this->prescription_model->save_pre_complaint($pre_complaint);
        }
        }

        $on_exam = $this->input->post("on_exam");
        $exam_array = explode("\r\n", $on_exam);
        foreach($exam_array as $exam){
          if($exam){
            $pre_exam = array(
            'prescription_id' => $prescription_id,
            'pre_examination_id' => "PXI-".uniqid(),
            'pre_examination' => $exam,
            'pre_examination_entry_by' => $entry_by,
            'pre_examination_entry_date' => $entry_date,
            'pre_examination_created_at' => $created_at,
            'pre_examination_status' => $status
          );
          $this->prescription_model->save_pre_exam($pre_exam);
        }
        }

        $patient_diagnosis = $this->input->post("patient_diagnosis");
        $diagnosis_array = explode("\r\n", $patient_diagnosis);
        foreach($diagnosis_array as $diagnosis){
          if($diagnosis){
            $pre_diagnosis = array(
            'prescription_id' => $prescription_id,
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
            'prescription_id' => $prescription_id,
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
            'prescription_id' => $prescription_id,
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
            'prescription_id' => $prescription_id,
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
            'prescription_id' => $prescription_id,
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

        $appointment = array(
            'appointment_updated_by' => $entry_by,
            'appointment_updated_at' => $created_at,
            'appointment_status' => 0
        );
        $this->prescription_model->update_appointment($appointment, $appointment_id);

        $template_name = $this->input->post('template_name');
        if ($template_name) {
        $template_id = "TMP-".uniqid();
        $template = array(
            'template_id' => $template_id,
            'template_name' => $this->input->post('template_name'),
            'template_entry_by' => $entry_by,
            'template_entry_date' => $entry_date,
            'template_created_at' => $created_at,
            'template_access' => "Doctor",
            'template_status' => $status
        );
        $this->prescription_model->save_template($template);

        $template_doctor = array(
            'template_id' => $template_id,
            'temp_doctor_id ' => "TDC-".uniqid(),
            'temp_doctor ' => $this->session->userdata('user_id'),
            'temp_doctor_entry_by' => $entry_by,
            'temp_doctor_entry_date' => $entry_date,
            'temp_doctor_created_at' => $created_at,
            'temp_doctor_status' => $status
        );
        $this->prescription_model->save_template_doctor($template_doctor);

        $this->template_entry($template_id);
        }
    
    redirect("patient-prescription/$prescription_id");
  }

  //view prescription
  public function view_patient_prescription($prescription_id)
  {
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
    $this->load->view('home/doctor_home', $data);
  }

  //view prescription list
  public function doctor_prescription_list()
  {
    $date = date('Y-m-d');
    $doctor_id = $this->session->userdata('user_id');
    $data = array();
    $data['main'] = true;
    $data['pre_info'] = $this->prescription_model->doc_prescription_by_date($date, $doctor_id);
    $data['main_content'] = $this->load->view('home/doctor_prescription_list', $data,true);
    $this->load->view('home/doctor_home', $data);    
  }

  // prescription search
    public function prescription_search()
 {
  $output = '';
  $query = '';
  $doctor_id = $this->session->userdata('user_id');
    if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->prescription_model->fetch_prescription_data($query, $doctor_id);
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
       <td><a class="btn btn-primary btn-xs" href="'.base_url().'patient-prescription/'. $row->prescription_id.'">
            </i>View/Print</a></td>
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

 //edit prescription
  public function edit_prescription($prescription_id)
  {
    $data = array();
    $data['main'] = true;
    $data['doses_administration'] = $this->prescription_model->get_doses_administration();
    $data['doses_duration'] = $this->prescription_model->get_doses_duration();
    $data['meal_administration'] = $this->prescription_model->get_meal_administration();
    $data['investigation_type'] = $this->prescription_model->get_investigation_type();
    $data['health_advice'] = $this->prescription_model->get_health_advice();
    $app_info = $this->prescription_model->get_prescription_by_id($prescription_id);
    $data['app_info'] = $app_info;
    $data['file_info'] = $this->prescription_model->get_patient_file_by_doctor($app_info->patient_id, $app_info->doctor_id);
    $data['prescriptions'] = $this->prescription_model->get_patient_prescription_by_doctor($app_info->patient_id, $app_info->doctor_id);
    $data['pre_history'] = $this->prescription_model->get_pre_history($prescription_id);
    $data['pre_complaint'] = $this->prescription_model->get_pre_complaint($prescription_id);
    $data['pre_exam'] = $this->prescription_model->get_pre_exam($prescription_id);
    $data['pre_diagnosis'] = $this->prescription_model->get_pre_diagnosis($prescription_id);
    $data['pre_investigation'] = $this->prescription_model->get_pre_investigation($prescription_id);
    $data['pre_medicine'] = $this->prescription_model->get_pre_medicine($prescription_id);
    $data['pre_advice'] = $this->prescription_model->get_pre_advice($prescription_id);
    $data['pre_note'] = $this->prescription_model->get_pre_note($prescription_id);
    $data['main_content'] = $this->load->view('home/prescription_edit_form', $data,true);
    $this->load->view('home/doctor_home', $data);
  }

  //prescription update
   public function update_prescription($prescription_id)
   {
        $app_info = $this->prescription_model->get_prescription_by_id($prescription_id);
        $entry_by = $this->session->userdata('user_id');
        $status = 1;
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');

        $patient = array(
            'patient_gender' => $this->input->post('gender'),
            'patient_blood_group' => $this->input->post('blood_group'),
            'patient_updated_at' => $created_at
        );
        $this->prescription_model->update_patient($patient, $app_info->patient_id);


        $prescription = array(
            'pre_age' => $this->input->post('age'),
            'pre_marital_status' => $this->input->post('marital_status'),
            'pre_height_feet' => $this->input->post('height_feet'),
            'pre_height_inch' => $this->input->post('height_inch'),
            'pre_weight_kg' => $this->input->post('patient_weight_kg'),
            'pre_pulse' => $this->input->post('patient_pulse'),
            'pre_bp_sys' => $this->input->post('patient_bp_sys'),
            'pre_bp_dia' => $this->input->post('patient_bp_dia'),
            'pre_temperature_f' => $this->input->post('patient_temperature_f'),
            'pre_temperature_c' => $this->input->post('patient_temperature_c'),
            'pre_remarks' => $this->input->post('patient_remark'),
            'pre_respiration' => $this->input->post('patient_respiration'),
            'pre_smoking_habit' => $this->input->post('patient_smoking_habit'),
            //'pre_others' => $this->input->post('patient_other'),
            'pre_next_visit' => $this->input->post('next_visit'),
            'pre_ref_org' => $this->input->post('patient_ref'),
            'prescription_updated_by' => $entry_by,
            'prescription_updated_at' => $created_at
        );
        $this->prescription_model->update_prescription($prescription, $prescription_id);

        $this->prescription_model->delete_pre_history($prescription_id);
        $this->prescription_model->delete_pre_complaint($prescription_id);
        $this->prescription_model->delete_pre_exam($prescription_id);
        $this->prescription_model->delete_pre_diagnosis($prescription_id);
        $this->prescription_model->delete_pre_medicine($prescription_id);
        $this->prescription_model->delete_pre_investigation($prescription_id);
        $this->prescription_model->delete_pre_advice($prescription_id);
        $this->prescription_model->delete_pre_note($prescription_id);

        $patient_history = $this->input->post("patient_history");
        $history_array = explode("\r\n", $patient_history);
        foreach($history_array as $history){
          if($history){
            $pre_history = array(
            'prescription_id' => $prescription_id,
            'pre_history_id' => "PHI-".uniqid(),
            'pre_history' => $history,
            'pre_history_entry_by' => $entry_by,
            'pre_history_entry_date' => $entry_date,
            'pre_history_created_at' => $created_at,
            'pre_history_status' => $status
          );
          $this->prescription_model->save_pre_history($pre_history);
        }
        }

        $chief_complaint = $this->input->post("chief_complaint");
        $complaint_array = explode("\r\n", $chief_complaint);
        foreach($complaint_array as $complaint){
          if($complaint){
            $pre_complaint = array(
            'prescription_id' => $prescription_id,
            'pre_complaint_id' => "PCI-".uniqid(),
            'pre_complaint' => $complaint,
            'pre_complaint_entry_by' => $entry_by,
            'pre_complaint_entry_date' => $entry_date,
            'pre_complaint_created_at' => $created_at,
            'pre_complaint_status' => $status
          );
          $this->prescription_model->save_pre_complaint($pre_complaint);
        }
        }

        $on_exam = $this->input->post("on_exam");
        $exam_array = explode("\r\n", $on_exam);
        foreach($exam_array as $exam){
          if($exam){
            $pre_exam = array(
            'prescription_id' => $prescription_id,
            'pre_examination_id' => "PXI-".uniqid(),
            'pre_examination' => $exam,
            'pre_examination_entry_by' => $entry_by,
            'pre_examination_entry_date' => $entry_date,
            'pre_examination_created_at' => $created_at,
            'pre_examination_status' => $status
          );
          $this->prescription_model->save_pre_exam($pre_exam);
        }
        }

        $patient_diagnosis = $this->input->post("patient_diagnosis");
        $diagnosis_array = explode("\r\n", $patient_diagnosis);
        foreach($diagnosis_array as $diagnosis){
          if($diagnosis){
            $pre_diagnosis = array(
            'prescription_id' => $prescription_id,
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
            'prescription_id' => $prescription_id,
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
            'prescription_id' => $prescription_id,
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
            'prescription_id' => $prescription_id,
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
            'prescription_id' => $prescription_id,
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

        $template_name = $this->input->post('template_name');
        if ($template_name) {
        $template_id = "TMP-".uniqid();
        $template = array(
            'template_id' => $template_id,
            'template_name' => $this->input->post('template_name'),
            'template_entry_by' => $entry_by,
            'template_entry_date' => $entry_date,
            'template_created_at' => $created_at,
            'template_access' => "Doctor",
            'template_status' => $status
        );
        $this->prescription_model->save_template($template);

        $template_doctor = array(
            'template_id' => $template_id,
            'temp_doctor_id ' => "TDC-".uniqid(),
            'temp_doctor ' => $this->session->userdata('user_id'),
            'temp_doctor_entry_by' => $entry_by,
            'temp_doctor_entry_date' => $entry_date,
            'temp_doctor_created_at' => $created_at,
            'temp_doctor_status' => $status
        );
        $this->prescription_model->save_template_doctor($template_doctor);

        $this->template_entry($template_id);
        }
    
    redirect("patient-prescription/$prescription_id");
  }

  //template Entry Form
    public function new_doctor_template()
    {
        $data = array();
        $data['main'] = true;
        $data['doses_administration'] = $this->prescription_model->get_doses_administration();
        $data['doses_duration'] = $this->prescription_model->get_doses_duration();
        $data['meal_administration'] = $this->prescription_model->get_meal_administration();
        $data['investigation_type'] = $this->prescription_model->get_investigation_type();
        $data['health_advice'] = $this->prescription_model->get_health_advice();
        $data['main_content'] = $this->load->view('home/doctor_template_entry_form', $data,true);
        $this->load->view('home/doctor_home', $data);
    }

     //template entry
   public function save_doctor_template()
   {
        $template_id = "TMP-".uniqid();
        $entry_by = $this->session->userdata('user_id');
        $status = 1;
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');

        $template = array(
            'template_id' => $template_id,
            'template_name' => $this->input->post('template_name'),
            'template_entry_by' => $entry_by,
            'template_entry_date' => $entry_date,
            'template_created_at' => $created_at,
            'template_access' => "Doctor",
            'template_status' => $status
        );
        $this->prescription_model->save_template($template);

        $template_doctor = array(
            'template_id' => $template_id,
            'temp_doctor_id ' => "TDC-".uniqid(),
            'temp_doctor ' => $this->session->userdata('user_id'),
            'temp_doctor_entry_by' => $entry_by,
            'temp_doctor_entry_date' => $entry_date,
            'temp_doctor_created_at' => $created_at,
            'temp_doctor_status' => $status
        );
        $this->prescription_model->save_template_doctor($template_doctor);

        $this->template_entry($template_id);
    
    redirect("doctor-template-detail/".$template_id);
    
  }

  //template entry
   public function template_entry($template_id)
   {
        $entry_by = $this->session->userdata('user_id');
        $status = 1;
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');

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
    
  }

  //edit template
  public function doctor_template_detail($template_id)
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
    $data['pre_diagnosis'] = $this->prescription_model->get_pre_diagnosis($template_id);
    $data['pre_investigation'] = $this->prescription_model->get_pre_investigation($template_id);
    $data['pre_medicine'] = $this->prescription_model->get_pre_medicine($template_id);
    $data['pre_advice'] = $this->prescription_model->get_pre_advice($template_id);
    $data['pre_note'] = $this->prescription_model->get_pre_note($template_id);
    $data['main_content'] = $this->load->view('home/doctor_template_detail', $data,true);
    $this->load->view('home/doctor_home', $data);
  }

  //template update
   public function update_doctor_template($template_id)
   {
        $entry_by = $this->session->userdata('user_id');
        $status = 1;
        $entry_date = date('Y-m-d');
        $created_at = date('Y-m-d H:i:s');

        $template = array(
            'template_name' => $this->input->post('template_name'),
            'template_updated_by' => $entry_by,
            'template_updated_at' => $created_at
        );
        $this->prescription_model->update_template($template, $template_id);
        
        $this->prescription_model->delete_pre_diagnosis($template_id);
        $this->prescription_model->delete_pre_medicine($template_id);
        $this->prescription_model->delete_pre_investigation($template_id);
        $this->prescription_model->delete_pre_advice($template_id);
        $this->prescription_model->delete_pre_note($template_id);

        $this->template_entry($template_id);
    
    redirect("doctor-template-detail/".$template_id);
    
  }

  //template list
  public function doctor_template_list()
  {
    $data = array();
    $data['main'] = true;
    $doctor_info = $this->prescription_model->get_doctor_by_id($this->session->userdata('user_id'));
    $data['templates'] = $this->prescription_model->get_dept_template_list($doctor_info->department_id);
    $data['self_templates'] = $this->prescription_model->get_self_template_list($this->session->userdata('user_id'));
    $data['main_content'] = $this->load->view('home/doctor_template_list', $data,true);
    $this->load->view('home/doctor_home', $data);    
  }

// prescription template
public function get_prescription_template()
 {
  $diagnosis_temp = "";
  $medicine_temp = "";
  $test_temp = "";
  $advice_temp = "";
  $note_temp = "";
  $doctor_id = $this->session->userdata('user_id');
  $template_id = $this->input->post('query');
    if($template_id){
        $pre_diagnosis = $this->prescription_model->get_pre_diagnosis($template_id);
        $pre_investigation = $this->prescription_model->get_pre_investigation($template_id);
        $pre_medicine = $this->prescription_model->get_pre_medicine($template_id);
        $pre_advice = $this->prescription_model->get_pre_advice($template_id);
        $pre_note = $this->prescription_model->get_pre_note($template_id);
        
        if ($pre_diagnosis) {
                foreach ($pre_diagnosis as $diagnosis) { 
                            $diagnosis_temp .=  $diagnosis->pre_diagnosis."\n";
            }}

        if ($pre_medicine) {
            foreach ($pre_medicine as $medicine) { 
                $medicine_temp .= $medicine->pre_medicine_name."|".$medicine->pre_medicine_doses."|".$medicine->pre_medicine_duration."|".$medicine->pre_medicine_advice."\n";
            }}

        if ($pre_investigation) {
            foreach ($pre_investigation as $investigation) { 
                       
                        $test_temp .= $investigation->pre_investigation."\n";
            }}

        if ($pre_advice) {
            foreach ($pre_advice as $advice) { 
                        $advice_temp .= $advice->pre_health_advice."\n";
            }}

        if ($pre_note) { 
            foreach ($pre_note as $note) { 
                        $note_temp .= $note->pre_special_note."\n";
            }}

        $data = array();
        $data['diagnosis'] = $diagnosis_temp;
        $data['medicine'] = $medicine_temp;
        $data['test'] = $test_temp;
        $data['advice'] = $advice_temp;
        $data['note'] = $note_temp;
        echo json_encode($data);
    }

  
 }

  



}
