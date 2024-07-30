<?php 
class Prescription_model extends CI_Model {

//////////////////start user//////////////////////
	//User access
	 public function check_user_exist($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_email', $email);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

	//Check User
	public function check_user_login($email, $password)
    {
        $arr_where = array
        (
            'user_email' => $email,
            'user_password' => $password
        );
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($arr_where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    //user registration
    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }
        
    //Get user Information
    public function get_user(){
        $this->db->select('*');
        $this->db->order_by("id", "asc");
        $this->db->from('users');
        $this->db->where("user_type!=", "Super Admin");
        $this->db->where("user_type!=", "Doctor");
        $query = $this->db->get();      
        return $query->result();            
    }
        
    //Update Selected User Record
    public function update_user_id($user_data, $id){
        $this->db->where('user_id', $id);
        $this->db->update('users', $user_data);
    }
    
    //Get Selected User Record
    public function show_user_by_id($id){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }


//////////////////end user//////////////////////

   // Get package Information
        public function get_package()
        {
            $this->db->select('*');
            $this->db->order_by("package_name", "asc");
            $this->db->from('vendor_package');
            $query = $this->db->get();      
            return $query->result();            
        }

        //package entry
        public function save_package($package)
        {
            return $this->db->insert('vendor_package', $package);
        }

        // Get package Information
        public function get_package_by_id($package_id)
        {
            $this->db->select('*');
            $this->db->from('vendor_package');
            $this->db->where('package_id', $package_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update package
        public function update_package($package, $package_id)
        {
            $this->db->where('package_id', $package_id);
            $this->db->update('vendor_package', $package);
        }
/////client/////
         //Client registration
        public function save_client($client)
        {
            return $this->db->insert('clients', $client);
        }

        // Get Client Information
        public function get_clients(){
            $this->db->select('*');
            $this->db->order_by("client_name", "asc");
            $this->db->from('clients');
            $this->db->join('vendor_package', 'clients.package_id = vendor_package.package_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        //get client by id    
        public function get_client_by_id($client_id)
        {
            $this->db->select('*');
            $this->db->from('clients');
            $this->db->where('client_id', $client_id);
            $this->db->join('vendor_package', 'clients.package_id = vendor_package.package_id', 'left');
            $query = $this->db->get();
            return $query->row();
        }

        //Update client
        public function update_client($client, $client_id)
        {
            $this->db->where('client_id', $client_id);
            $this->db->update('clients', $client);
        }
/////client/////

/////Start department/////
        // Get department Information
        public function get_department()
        {
            $this->db->select('*');
            $this->db->order_by("department_name", "asc");
            $this->db->from('departments');
            $query = $this->db->get();      
            return $query->result();            
        }

        //department entry
        public function save_department($department)
        {
            return $this->db->insert('departments', $department);
        }

        //Get department Information
        public function get_department_by_id($department_id)
        {
            $this->db->select('*');
            $this->db->from('departments');
            $this->db->where('department_id', $department_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update department
        public function update_department($department, $department_id)
        {
            $this->db->where('department_id', $department_id);
            $this->db->update('departments', $department);
        }
/////End department/////

 /////Start chief complaint/////
        // Get chief complaint Information
        public function get_chief_complaint()
        {
            $this->db->select('*');
            $this->db->order_by("chief_complaint_eng", "asc");
            $this->db->from('chief_complaints');
            $query = $this->db->get();      
            return $query->result();            
        }

        //chief complaint entry
        public function save_chief_complaint($complaint)
        {
            return $this->db->insert('chief_complaints', $complaint);
        }

        //Get chief complaint Information
        public function get_chief_complaint_by_id($chief_complaint_id)
        {
            $this->db->select('*');
            $this->db->from('chief_complaints');
            $this->db->where('chief_complaint_id', $chief_complaint_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update chief complaint
        public function update_chief_complaint($complaint, $chief_complaint_id)
        {
            $this->db->where('chief_complaint_id', $chief_complaint_id);
            $this->db->update('chief_complaints', $complaint);
        }
/////End chief complaint/////

/////Start examination/////
        // Get examination Information
        public function get_examination()
        {
            $this->db->select('*');
            $this->db->order_by("examination_eng", "asc");
            $this->db->from('examinations');
            $query = $this->db->get();      
            return $query->result();            
        }

        //examination entry
        public function save_examination($examination)
        {
            return $this->db->insert('examinations', $examination);
        }

        //Get examination Information
        public function get_examination_by_id($examination_id)
        {
            $this->db->select('*');
            $this->db->from('examinations');
            $this->db->where('examination_id', $examination_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update examination
        public function update_examination($examination, $examination_id)
        {
            $this->db->where('examination_id', $examination_id);
            $this->db->update('examinations', $examination);
        }
/////End examination/////

/////Start history/////
        // Get history Information
        public function get_history()
        {
            $this->db->select('*');
            $this->db->order_by("history_eng", "asc");
            $this->db->from('histories');
            $query = $this->db->get();      
            return $query->result();            
        }

        //history entry
        public function save_history($history)
        {
            return $this->db->insert('histories', $history);
        }

        //Get history Information
        public function get_history_by_id($history_id)
        {
            $this->db->select('*');
            $this->db->from('histories');
            $this->db->where('history_id', $history_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update history
        public function update_history($history, $history_id)
        {
            $this->db->where('history_id', $history_id);
            $this->db->update('histories', $history);
        }
/////End history/////

/////Start diagnosis/////
        // Get diagnosis Information
        public function get_diagnosis()
        {
            $this->db->select('*');
            $this->db->order_by("diagnosis_eng", "asc");
            $this->db->from('diagnoses');
            $query = $this->db->get();      
            return $query->result();            
        }

        //diagnosis entry
        public function save_diagnosis($diagnosis)
        {
            return $this->db->insert('diagnoses', $diagnosis);
        }

        //Get diagnosis Information
        public function get_diagnosis_by_id($diagnosis_id)
        {
            $this->db->select('*');
            $this->db->from('diagnoses');
            $this->db->where('diagnosis_id', $diagnosis_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update diagnosis
        public function update_diagnosis($diagnosis, $diagnosis_id)
        {
            $this->db->where('diagnosis_id', $diagnosis_id);
            $this->db->update('diagnoses', $diagnosis);
        }
/////End diagnosis/////

/////Start investigation type/////
        // Get investigation type Information
        public function get_investigation_type()
        {
            $this->db->select('*');
            $this->db->order_by("investigation_type", "asc");
            $this->db->from('investigation_types');
            $query = $this->db->get();      
            return $query->result();            
        }

        //investigation type entry
        public function save_investigation_type($complaint)
        {
            return $this->db->insert('investigation_types', $complaint);
        }

        //Get investigation type Information
        public function get_investigation_type_by_id($investigation_type_id)
        {
            $this->db->select('*');
            $this->db->from('investigation_types');
            $this->db->where('investigation_type_id', $investigation_type_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update investigation type
        public function update_investigation_type($complaint, $investigation_type_id)
        {
            $this->db->where('investigation_type_id', $investigation_type_id);
            $this->db->update('investigation_types', $complaint);
        }
/////End investigation type/////

/////Start investigation/////
        // Get investigation Information
        public function get_investigation()
        {
            $this->db->select('*');
            $this->db->order_by("investigation_type", "asc");
            $this->db->from('investigations');
            $this->db->join('investigation_types', 'investigations.investigation_type_id = investigation_types.investigation_type_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        //investigation entry
        public function save_investigation($investigation)
        {
            return $this->db->insert('investigations', $investigation);
        }

        //Get investigation Information
        public function get_investigation_by_id($investigation_id)
        {
            $this->db->select('*');
            $this->db->from('investigations');
            $this->db->where('investigation_id', $investigation_id);
            $this->db->join('investigation_types', 'investigations.investigation_type_id = investigation_types.investigation_type_id', 'left');
            $query = $this->db->get();
            return $query->row();
        }

        //Update investigation
        public function update_investigation($investigation, $investigation_id)
        {
            $this->db->where('investigation_id', $investigation_id);
            $this->db->update('investigations', $investigation);
        }
/////End investigation/////

/////Start health advice/////
        // Get health advice Information
        public function get_health_advice()
        {
            $this->db->select('*');
            $this->db->order_by("health_advice_eng", "asc");
            $this->db->from('health_advices');
            $query = $this->db->get();      
            return $query->result();            
        }

        //health advice entry
        public function save_health_advice($advice)
        {
            return $this->db->insert('health_advices', $advice);
        }

        //Get health advice Information
        public function get_health_advice_by_id($health_advice_id)
        {
            $this->db->select('*');
            $this->db->from('health_advices');
            $this->db->where('health_advice_id', $health_advice_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update health advice
        public function update_health_advice($advice, $health_advice_id)
        {
            $this->db->where('health_advice_id', $health_advice_id);
            $this->db->update('health_advices', $advice);
        }
/////End health advice///// 

/////Start special note/////
        // Get special note Information
        public function get_special_note()
        {
            $this->db->select('*');
            $this->db->order_by("special_note_eng", "asc");
            $this->db->from('special_notes');
            $query = $this->db->get();      
            return $query->result();            
        }

        //special note entry
        public function save_special_note($note)
        {
            return $this->db->insert('special_notes', $note);
        }

        //Get special note Information
        public function get_special_note_by_id($special_note_id)
        {
            $this->db->select('*');
            $this->db->from('special_notes');
            $this->db->where('special_note_id', $special_note_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update special note
        public function update_special_note($note, $special_note_id)
        {
            $this->db->where('special_note_id', $special_note_id);
            $this->db->update('special_notes', $note);
        }
/////End special note/////

/////Start doses administration/////
        // Get doses administration Information
        public function get_doses_administration()
        {
            $this->db->select('*');
            $this->db->order_by("doses_administration_eng", "asc");
            $this->db->from('doses_administrations');
            $query = $this->db->get();      
            return $query->result();            
        }

        //doses administration entry
        public function save_doses_administration($doses)
        {
            return $this->db->insert('doses_administrations', $doses);
        }

        //Get doses administration Information
        public function get_doses_administration_by_id($doses_administration_id)
        {
            $this->db->select('*');
            $this->db->from('doses_administrations');
            $this->db->where('doses_administration_id', $doses_administration_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update doses administration
        public function update_doses_administration($doses, $doses_administration_id)
        {
            $this->db->where('doses_administration_id', $doses_administration_id);
            $this->db->update('doses_administrations', $doses);
        }
/////End doses administration/////

/////Start doses duration/////
        // Get doses duration Information
        public function get_doses_duration()
        {
            $this->db->select('*');
            $this->db->order_by("doses_duration_eng", "asc");
            $this->db->from('doses_durations');
            $query = $this->db->get();      
            return $query->result();            
        }

        //doses duration entry
        public function save_doses_duration($duration)
        {
            return $this->db->insert('doses_durations', $duration);
        }

        //Get doses duration Information
        public function get_doses_duration_by_id($doses_duration_id)
        {
            $this->db->select('*');
            $this->db->from('doses_durations');
            $this->db->where('doses_duration_id', $doses_duration_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update doses duration
        public function update_doses_duration($duration, $doses_duration_id)
        {
            $this->db->where('doses_duration_id', $doses_duration_id);
            $this->db->update('doses_durations', $duration);
        }
/////End doses duration/////

/////Start meal administration/////
        // Get meal administration Information
        public function get_meal_administration()
        {
            $this->db->select('*');
            $this->db->order_by("meal_administration_eng", "asc");
            $this->db->from('meal_administrations');
            $query = $this->db->get();      
            return $query->result();            
        }

        //meal administration entry
        public function save_meal_administration($meal)
        {
            return $this->db->insert('meal_administrations', $meal);
        }

        //Get meal administration Information
        public function get_meal_administration_by_id($meal_administration_id)
        {
            $this->db->select('*');
            $this->db->from('meal_administrations');
            $this->db->where('meal_administration_id', $meal_administration_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update meal administration
        public function update_meal_administration($meal, $meal_administration_id)
        {
            $this->db->where('meal_administration_id', $meal_administration_id);
            $this->db->update('meal_administrations', $meal);
        }
/////End meal administration/////

/////Start refer/////
        // Get refer Information
        public function get_refer()
        {
            $this->db->select('*');
            $this->db->order_by("refer_org", "asc");
            $this->db->from('refers');
            $query = $this->db->get();      
            return $query->result();            
        }

        //refer entry
        public function save_refer($refer)
        {
            return $this->db->insert('refers', $refer);
        }

        //Get refer Information
        public function get_refer_by_id($refer_id)
        {
            $this->db->select('*');
            $this->db->from('refers');
            $this->db->where('refer_id', $refer_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update refer
        public function update_refer($refer, $refer_id)
        {
            $this->db->where('refer_id', $refer_id);
            $this->db->update('refers', $refer);
        }
/////End refer/////

    //save  manufacturar
        public function save_manufacturer($manufacturer_info)
        {
            return $this->db->insert('manufacturer', $manufacturer_info);
        }

        //get manufacturar by client
        public function get_manufacturer()
        {
            $this->db->select('*');
            $this->db->from('manufacturer');
            $query = $this->db->get();      
            return $query->result();
        }

        //get manufacturar by id    
        public function get_manufacturer_by_id($man_id)
        {
            $this->db->select('*');
            $this->db->from('manufacturer');
            $this->db->where('man_id', $man_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update manufacturer
        public function update_manufacturer($manufacturer_info, $man_id)
        {
            $this->db->where('man_id', $man_id);
            $this->db->update('manufacturer', $manufacturer_info);
        }

    //Medicine Type list
    public function get_medicine_type()
    {
        $this->db->select('*');
        $this->db->order_by("med_type_name", "asc");
        $this->db->from('medicine_type');
        $query = $this->db->get();      
        return $query->result();            
    }

    //save  Medicine Type
    public function save_medicine_type($type_info)
    {
        return $this->db->insert('medicine_type', $type_info);
    }

    //get Medicine Type by id    
    public function get_medicine_type_by_id($med_type_id)
    {
        $this->db->select('*');
        $this->db->from('medicine_type');
        $this->db->where('med_type_id', $med_type_id);
        $query = $this->db->get();
        return $query->row();
    }

    //Update Medicine Type
    public function update_medicine_type($type_info, $med_type_id)
    {
        $this->db->where('med_type_id', $med_type_id);
        $this->db->update('medicine_type', $type_info);
    }

   
//Medicine generic list
    public function get_medicine_generic()
    {
        $this->db->select('*');
        $this->db->order_by("med_gen_name", "asc");
        $this->db->from('medicine_generic');
        $query = $this->db->get();      
        return $query->result();            
    }

    //save  Medicine generic
    public function save_medicine_generic($generic_info)
    {
        return $this->db->insert('medicine_generic', $generic_info);
    }

    //get Medicine generic by id    
    public function get_medicine_generic_by_id($med_gen_id)
    {
        $this->db->select('*');
        $this->db->from('medicine_generic');
        $this->db->where('med_gen_id', $med_gen_id);
        $query = $this->db->get();
        return $query->row();
    }

    //Update Medicine generic
    public function update_medicine_generic($generic_info, $med_gen_id)
    {
        $this->db->where('med_gen_id', $med_gen_id);
        $this->db->update('medicine_generic', $generic_info);
    }

    /////Start pharmacy product/////
        // Get medicine Information
        public function get_medicine()
        {
            $this->db->select('*');
            $this->db->order_by("product_name", "asc");
            $this->db->from('pharmacy_product');
            // $this->db->join('medicine_type', 'pharmacy_product.product_type = medicine_type.med_type_id', 'left');
            // $this->db->join('medicine_generic', 'pharmacy_product.product_generic = medicine_generic.med_gen_id', 'left');
            // $this->db->join('manufacturer', 'pharmacy_product.product_manufacturer = medicine_generic.man_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get medicine Information
        public function get_medicine_limited()
        {
            $this->db->select('*');
            $this->db->order_by('id', 'desc');
            $this->db->from('pharmacy_product');
            $this->db->limit(10);
            $query = $this->db->get();      
            return $query->result();            
        }

        //medicine entry
        public function save_product($product_info)
        {
            return $this->db->insert('pharmacy_product', $product_info);
        }

        //Get medicine Information
        public function get_product_by_id($product_id)
        {
            $this->db->select('*');
            $this->db->from('pharmacy_product');
            $this->db->where('product_id', $product_id);
            // $this->db->join('medicine_type', 'pharmacy_product.product_type = medicine_type.med_type_id', 'left');
            // $this->db->join('medicine_generic', 'pharmacy_product.product_generic = medicine_generic.med_gen_id', 'left');
            // $this->db->join('manufacturer', 'pharmacy_product.product_manufacturer = medicine_generic.man_id', 'left');
            $query = $this->db->get();
            return $query->row();
        }

        //Update medicine
        public function update_product($product_info, $product_id)
        {
            $this->db->where('product_id', $product_id);
            $this->db->update('pharmacy_product', $product_info);
        }
/////End medicine/////

/////start doctor/////
         //doctor registration
        public function save_doctor($doctor)
        {
            return $this->db->insert('doctors', $doctor);
        }

        // Get doctor Information
        public function get_doctors(){
            $this->db->select('*');
            $this->db->order_by("doctor_name", "asc");
            $this->db->from('doctors');
            $this->db->join('departments', 'doctors.department_id = departments.department_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        //get doctor by id    
        public function get_doctor_by_id($doctor_id)
        {
            $this->db->select('*');
            $this->db->from('doctors');
            $this->db->where('doctor_id', $doctor_id);
            $this->db->join('departments', 'doctors.department_id = departments.department_id', 'left');
            $query = $this->db->get();
            return $query->row();
        }

        //Update doctor
        public function update_doctor($doctor, $doctor_id)
        {
            $this->db->where('doctor_id', $doctor_id);
            $this->db->update('doctors', $doctor);
        }
/////end doctor///// 

/////start patient/////
         //patient registration
        public function save_patient($patient)
        {
            return $this->db->insert('patient_info', $patient);
        }

        // Get patient Information
        public function get_patients(){
            $this->db->select('*');
            $this->db->order_by("patient_first_name", "asc");
            $this->db->from('patient_info');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get Last patient reg no
        public function get_patient_reg_no()
        {
            $this->db->select('*');
            $this->db->from('patient_info');
            $this->db->order_by('id','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->row();   
        }

        // Get medicine Information
        public function get_patient_limited()
        {
            $this->db->select('*');
            $this->db->order_by('id', 'desc');
            $this->db->from('patient_info');
            $this->db->where('patient_status', 1);
            $this->db->limit(100);
            $query = $this->db->get();      
            return $query->result();            
        }

        //get patient by id    
        public function get_patient_by_id($patient_id)
        {
            $this->db->select('*');
            $this->db->from('patient_info');
            $this->db->where('patient_id', $patient_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update patient
        public function update_patient($patient, $patient_id)
        {
            $this->db->where('patient_id', $patient_id);
            $this->db->update('patient_info', $patient);
        }
/////end patient/////

/////start appointment/////
        
    //patient search
    public function patient_search($postData)
      {
         $response = array();
         if(isset($postData['search']) ){
           // Select record
           $this->db->select('*');
           $this->db->where("patient_first_name like '%".$postData['search']."%' ");
           $this->db->or_where("patient_mobile like '%".$postData['search']."%' ");
           $this->db->or_where("patient_reg_no like '%".$postData['search']."%' ");
           $this->db->limit(10);

           
           $records = $this->db->get('patient_info')->result();

           foreach($records as $row ){
            if($row->patient_dob != "0000-00-00")
                {
                    $interval = date_diff(date_create(), date_create($row->patient_dob));
                    //echo $interval->format("%Y Year, %M Months, %d Days");
                    $year = $interval->format("%Y");
                    $month = $interval->format("%M");
                    $day = $interval->format("%d");
                }else{
                    $year = 0;
                    $month = 0;
                    $day = 0;
                }
              $response[] = array("value"=>$row->patient_reg_no,
                                  "code"=>$row->patient_mobile,
                                  "label"=>$row->patient_first_name.' '.$row->patient_last_name,
                                  "id"=>$row->patient_id,
                                  "year"=>$year,
                                  "month"=>$month,
                                  "day"=>$day
                              );
           }

         }

         return $response;
      }

        // Get datewise wise appointments
        public function get_datewise_doctor_appointment($date)
        {
            $this->db->select('*');
            //$this->db->order_by("appointments.id", "asc");
            $this->db->from('appointments');
            $this->db->where('appointment_date', $date);
            $this->db->group_by('appointments.doctor_id');
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get datewise wise appointments
        public function get_datewise_doctor_appointment_count($date, $doctor_id, $schedule_id)
        {
            $this->db->select('*');
            $this->db->order_by("appointments.appointment_slot", "asc");
            $this->db->from('appointments');
            $this->db->where('appointment_date', $date);
            $this->db->where('appointments.doctor_id', $doctor_id);
            $this->db->where('appointments.schedule_id', $schedule_id);
            $this->db->join('patient_info', 'appointments.patient_id = patient_info.patient_id', 'left');
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $this->db->join('doctor_schedules', 'appointments.schedule_id = doctor_schedules.schedule_id', 'left');
            $this->db->join('users', 'appointments.appointment_entry_by = users.user_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get datewise wise appointments
        public function get_schedule_patient($date, $doctor_id, $schedule_id, $slot)
        {
            $this->db->select('*');
            $this->db->order_by("appointments.appointment_slot", "asc");
            $this->db->from('appointments');
            $this->db->where('appointment_date', $date);
            $this->db->where('appointments.doctor_id', $doctor_id);
            $this->db->where('appointments.schedule_id', $schedule_id);
            $this->db->where('appointments.schedule_id', $schedule_id);
            $this->db->where('appointments.appointment_slot ', $slot);
            $this->db->join('patient_info', 'appointments.patient_id = patient_info.patient_id', 'left');
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $this->db->join('doctor_schedules', 'appointments.schedule_id = doctor_schedules.schedule_id', 'left');
            $query = $this->db->get();
            return $query->row();           
        }

        //Get datewise wise appointment slot   
        public function match_appointment_slot($date, $doctor_id, $schedule_id, $appointment_slot)
        {
            $this->db->select('*');
            $this->db->from('appointments');
            $this->db->where('appointment_date', $date);
            $this->db->where('appointments.doctor_id', $doctor_id);
            $this->db->where('appointments.schedule_id', $schedule_id);
            $this->db->where('appointments.appointment_slot', $appointment_slot);
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $this->db->join('doctor_schedules', 'appointments.schedule_id = doctor_schedules.schedule_id', 'left');
            $query = $this->db->get();
            return $query->row();
        }

        // Get datewise wise visit
        public function get_datewise_doctor_visit_count($date, $doctor_id)
        {
            $this->db->select('*');
            $this->db->order_by("appointments.id", "asc");
            $this->db->from('appointments');
            $this->db->where('appointment_date', $date);
            $this->db->where('appointments.doctor_id', $doctor_id);
            $this->db->where('appointment_status', 0);
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get datewise appointments
        public function get_datewise_appointment($date)
        {
            $this->db->select('*');
            $this->db->order_by("appointments.id", "asc");
            $this->db->from('appointments');
            $this->db->where('appointment_date', $date);
            $this->db->join('patient_info', 'appointments.patient_id = patient_info.patient_id', 'left');
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get patient reg no
        public function get_patient_reg()
        {
            $this->db->select('patient_id, patient_reg_no');
            $this->db->order_by("id", "desc");
            $this->db->from('patient_info');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get patient Information
        public function get_patient_appointment($patient_id)
        {
            $this->db->select('*');
            $this->db->order_by("id", "asc");
            $this->db->from('appointments');
            $this->db->where('patient_id', $patient_id);
            $query = $this->db->get();      
            return $query->result();            
        }

        //patient appointment entry
        public function save_appointment($appointment)
        {
            return $this->db->insert('appointments', $appointment);
        }

        //delete Selected appointment
        public function remove_appointment($appointment_id)
        {
            $this->db->where('appointment_id', $appointment_id);
            $this->db->delete('appointments');
        }



        // Get doctorwise wise appointments
        public function get_doctorwise_appointment($doctor_id)
        {
            $this->db->select('*');
            $this->db->order_by("appointments.id", "asc");
            $this->db->from('appointments');
            $this->db->where('appointments.doctor_id', $doctor_id);
            $this->db->join('patient_info', 'appointments.patient_id = patient_info.patient_id', 'left');
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get doctorwise wise appointments
        public function get_doctorwise_active_appointment($doctor_id, $date)
        {
            $this->db->select('*');
            $this->db->order_by("appointments.id", "asc");
            $this->db->from('appointments');
            $this->db->where('appointments.doctor_id', $doctor_id);
            $this->db->where('appointment_status', 1);
            $this->db->where('appointment_date', $date);
            $this->db->join('patient_info', 'appointments.patient_id = patient_info.patient_id', 'left');
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get doctorwise wise appointments
        public function get_doctorwise_appointment_type($type, $date, $doctor_id)
        {
            $this->db->select('*');
            $this->db->order_by("id", "asc");
            $this->db->from('appointments');
            $this->db->where('appointment_type', $type);
            $this->db->where('appointment_status', 1);
            $this->db->where('doctor_id', $doctor_id);
            $this->db->where('appointment_date', $date);
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get datewise wise appointments
        public function get_datewise_appointment_type($type, $date)
        {
            $this->db->select('*');
            $this->db->order_by("id", "asc");
            $this->db->from('appointments');
            $this->db->where('appointment_type', $type);
            //$this->db->where('appointment_status', 1);
            $this->db->where('appointment_date', $date);
            $query = $this->db->get();      
            return $query->result();            
        }

        // Get datewise wise appointments
        public function get_datewise_visit_type($type, $date)
        {
            $this->db->select('*');
            $this->db->order_by("id", "asc");
            $this->db->from('appointments');
            $this->db->where('appointment_type', $type);
            $this->db->where('appointment_status', 0);
            $this->db->where('appointment_date', $date);
            $query = $this->db->get();      
            return $query->result();            
        }


        //get appointment by id    
        public function get_appointment_by_id($appointment_id)
        {
            $this->db->select('*');
            $this->db->from('appointments');
            $this->db->where('appointment_id', $appointment_id);
            $this->db->join('patient_info', 'appointments.patient_id = patient_info.patient_id', 'left');
            $this->db->join('doctors', 'appointments.doctor_id = doctors.doctor_id', 'left');
            $this->db->join('doctor_schedules', 'appointments.schedule_id = doctor_schedules.schedule_id', 'left');
            $this->db->join('shifts', 'doctor_schedules.schedule_shift = shifts.shift_id', 'left');
            $query = $this->db->get();
            return $query->row();
        }

    //Update appointment
    public function update_appointment($appointment, $appointment_id)
    {
        $this->db->where('appointment_id', $appointment_id);
        $this->db->update('appointments', $appointment);
    }

/////end appointment///// 

//product search
public function fetch_product_data($query)
 {
  $this->db->select("*");
  $this->db->from("pharmacy_product");
  if($query != '')
  {
   $this->db->like('product_name', $query);
   //$this->db->or_like('product_type', $query);
   $this->db->or_like('product_generic', $query);
   $this->db->or_like('product_manufacturer', $query);
   $this->db->limit(100);
  }else{
    $this->db->limit(10);
  }
  $this->db->order_by('id', 'DESC');
  return $this->db->get();
 }

 

 //patient search
public function fetch_patient_data($query)
 {
  $this->db->select("*");
  $this->db->from("patient_info");
  if($query != '')
  {
   $this->db->like('patient_reg_no', $query);
   $this->db->or_like('patient_first_name', $query);
   $this->db->or_like('patient_last_name', $query);
   //$this->db->or_like('patient_father_name', $query);
   //$this->db->or_like('patient_mother_name', $query);
   $this->db->or_like('patient_mobile', $query);
   //$this->db->or_like('patient_email', $query);
   $this->db->or_like('patient_blood_group', $query);
   $this->db->limit(100);
  }else{
    $this->db->limit(100);
  }
  $this->db->order_by('id', 'DESC');
  return $this->db->get();
 }


//department search
function department_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->where("department_name like '%".$postData['search']."%' ");

       $records = $this->db->get('departments')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->department_name,
                              "code"=>$row->department_id);
       }
     }
     return $response;
  }


//history search
function history_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->where("history_eng like '%".$postData['search']."%' ");

       $records = $this->db->get('histories')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->history_eng);
       }
     }
     return $response;
  }

//complaint search
function complaint_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->where("chief_complaint_eng like '%".$postData['search']."%' ");

       $records = $this->db->get('chief_complaints')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->chief_complaint_eng);
       }
     }
     return $response;
  }

//exam search
function exam_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->where("examination_eng like '%".$postData['search']."%' ");

       $records = $this->db->get('examinations')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->examination_eng);
       }
     }
     return $response;
  }

//diagnosis search
function diagnosis_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->where("diagnosis_eng like '%".$postData['search']."%' ");

       $records = $this->db->get('diagnoses')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->diagnosis_eng);
       }
     }
     return $response;
  }

//diagnosis search
function medicine_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->limit(20);
       $this->db->where("product_name like '%".$postData['search']."%' ");
       $records = $this->db->get('pharmacy_product')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->product_type.' '.$row->product_name);
       }
     }
     return $response;
  }

//test search
function test_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->limit(20);
       //$this->db->where("investigation_type_id", $postData['service_type']);
       $this->db->where("investigation like '%".$postData['search']."%' ");
       $records = $this->db->get('investigations')->result();
       foreach($records as $row ){
          $response[] = array("label"=>$row->investigation);
       }
     }
     return $response;
  }

//advice search
function advice_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->where("health_advice_eng like '%".$postData['search']."%' ");

       $records = $this->db->get('health_advices')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->health_advice_eng);
       }
     }
     return $response;
  }

//note search
function note_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->where("special_note_eng like '%".$postData['search']."%' ");

       $records = $this->db->get('special_notes')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->special_note_eng);
       }
     }
     return $response;
  }

  //ref search
function ref_search($postData)
{
     $response = array();
     if(isset($postData['search']) ){
       $this->db->select('*');
       $this->db->where("refer_org   like '%".$postData['search']."%' ");
       $this->db->limit(10);


       $records = $this->db->get('refers')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->refer_org);
       }
     }
     return $response;
  }

    //prescription entry
    public function save_prescription($prescription)
    {
        return $this->db->insert('prescriptions', $prescription);
    }

    //prescription history entry
    public function save_pre_history($pre_history)
    {
        return $this->db->insert('pre_history', $pre_history);
    }

    //prescription complaint entry
    public function save_pre_complaint($pre_complaint)
    {
        return $this->db->insert('pre_complaint', $pre_complaint);
    }

    //prescription exam entry
    public function save_pre_exam($pre_exam)
    {
        return $this->db->insert('pre_exam', $pre_exam);
    }

    //prescription diagnosis entry
    public function save_pre_diagnosis($pre_diagnosis)
    {
        return $this->db->insert('pre_diagnosis', $pre_diagnosis);
    }

    //prescription medicine entry
    public function save_pre_medicine($pre_medicine)
    {
        return $this->db->insert('pre_medicine', $pre_medicine);
    }

    //prescription investigation entry
    public function save_pre_investigation($pre_investigation)
    {
        return $this->db->insert('pre_investigation', $pre_investigation);
    }

    //prescription advice entry
    public function save_pre_advice($pre_advice)
    {
        return $this->db->insert('pre_advice', $pre_advice);
    }

    //prescription note entry
    public function save_pre_note($pre_note)
    {
        return $this->db->insert('pre_special_note', $pre_note);
    }

    //get prescription by id    
    public function get_prescription_by_id($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('prescriptions');
        $this->db->where('prescription_id', $prescription_id);
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('doctors', 'prescriptions.doctor_id = doctors.doctor_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    //get prescription history  
    public function get_pre_history($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_history');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get prescription complaint  
    public function get_pre_complaint($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_complaint');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get prescription exam   
    public function get_pre_exam($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_exam');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get prescription diagnosis   
    public function get_pre_diagnosis($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_diagnosis');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get prescription investigation   
    public function get_pre_investigation($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_investigation');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get prescription medicine   
    public function get_pre_medicine($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_medicine');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get prescription advice   
    public function get_pre_advice($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_advice');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get prescription note   
    public function get_pre_note($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_special_note');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get prescription note   
    public function get_pre_file($prescription_id)
    {
        $this->db->select('*');
        $this->db->from('pre_file');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //get doctor prescription list    
    public function doc_prescription_by_date($date, $doctor_id)
    {
        $this->db->select('*');
        $this->db->order_by('prescriptions.id', 'DESC');
        $this->db->from('prescriptions');
        $this->db->where('visit_date', $date);
        $this->db->where('doctor_id', $doctor_id);
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        //$this->db->join('doctors', 'prescriptions.doctor_id = doctors.doctor_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }


    //doctor prescription search
    public function fetch_prescription_data($query, $doctor_id)
     {
      $this->db->select("*");
      $this->db->from("prescriptions");
      $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
      //$this->db->where('doctor_id', $doctor_id);

      if($query != '')
      {
       $this->db->like('prescription_no', $query);
       $this->db->or_like('pre_reg_no', $query);
       $this->db->or_like('patient_first_name', $query);
       $this->db->or_like('patient_last_name', $query);
       $this->db->or_like('patient_mobile', $query);
       $this->db->or_like('patient_blood_group', $query);
      }else{
        $this->db->where('visit_date', date('Y-m-d'));
        $this->db->where('doctor_id', $doctor_id);
      }

      $this->db->order_by('prescriptions.id', 'DESC');
      return $this->db->get();
     }

     //get prescription list    
    public function prescription_by_date($date)
    {
        $this->db->select('*');
        $this->db->order_by('prescriptions.id', 'DESC');
        $this->db->from('prescriptions');
        $this->db->where('visit_date', $date);
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('doctors', 'prescriptions.doctor_id = doctors.doctor_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

    //prescription search
    public function fetch_prescription($query)
     {
      $this->db->select("*");
      $this->db->from("prescriptions");
      $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
      $this->db->join('doctors', 'prescriptions.doctor_id = doctors.doctor_id', 'left');
      if($query != '')
      {
       $this->db->like('prescription_no', $query);
       //$this->db->like('pre_reg_no', $query);
       $this->db->or_like('patient_first_name', $query);
       $this->db->or_like('patient_last_name', $query);
       $this->db->or_like('patient_mobile', $query);
       $this->db->or_like('patient_blood_group', $query);
       $this->db->or_like('doctor_name', $query);
      }else{
        $this->db->where('visit_date', date('Y-m-d'));
      }
      $this->db->order_by('prescriptions.id', 'DESC');
      return $this->db->get();
     }
    //Update prescription
    public function update_prescription($prescription, $prescription_id)
    {
        $this->db->where('prescription_id', $prescription_id);
        $this->db->update('prescriptions', $prescription);
    }

    //prescription delete///
    function delete_pre_history($prescription_id)
    {
       $this->db->where('prescription_id', $prescription_id);
       $this->db->delete('pre_history'); 
    }

    function delete_pre_complaint($prescription_id)
    {
       $this->db->where('prescription_id', $prescription_id);
       $this->db->delete('pre_complaint'); 
    }

    function delete_pre_exam($prescription_id)
    {
       $this->db->where('prescription_id', $prescription_id);
       $this->db->delete('pre_exam'); 
    }

    function delete_pre_diagnosis($prescription_id)
    {
       $this->db->where('prescription_id', $prescription_id);
       $this->db->delete('pre_diagnosis'); 
    }

    function delete_pre_medicine($prescription_id)
    {
       $this->db->where('prescription_id', $prescription_id);
       $this->db->delete('pre_medicine'); 
    }

    function delete_pre_investigation($prescription_id)
    {
       $this->db->where('prescription_id', $prescription_id);
       $this->db->delete('pre_investigation'); 
    }

    function delete_pre_advice($prescription_id)
    {
       $this->db->where('prescription_id', $prescription_id);
       $this->db->delete('pre_advice'); 
    }

    function delete_pre_note($prescription_id)
    {
       $this->db->where('prescription_id', $prescription_id);
       $this->db->delete('pre_special_note'); 
    }
    ///prescription delete///

    // Get prescription files
    public function get_prescription_files($prescription_id)
    {
        $this->db->select('*');
        $this->db->order_by("id", "asc");
        $this->db->from('pre_file');
        $this->db->where('prescription_id', $prescription_id);
        $query = $this->db->get();      
        return $query->result();
    }

    // Get patient prescription files
    public function get_patient_file_by_doctor($patient_id, $doctor_id)
    {
        $this->db->select('*');
        $this->db->order_by("pre_file.id", "DESC");
        $this->db->from('pre_file');
        $this->db->join('prescriptions', 'pre_file.prescription_id = prescriptions.prescription_id', 'left');
        $this->db->where('pre_file.patient_id', $patient_id);
        $this->db->where('doctor_id', $doctor_id);
        $query = $this->db->get();      
        return $query->result();
    }

    //prescription file entry
    public function save_prescription_file($file)
    {
        return $this->db->insert('pre_file', $file);
    }

    //get prescription file by id    
    public function get_prescription_file($pre_file_id)
    {
        $this->db->select('*');
        $this->db->from('pre_file');
        $this->db->where('pre_file_id', $pre_file_id);
        $query = $this->db->get();
        return $query->row();
    }

    //vital entry
    public function save_patient_vital($vital)
    {
        return $this->db->insert('pre_vital', $vital);
    }

    //get vital by id    
    public function get_vital_by_id($appointment_id)
    {
        $this->db->select('*');
        $this->db->from('pre_vital');
        $this->db->where('appointment_id', $appointment_id);
        $query = $this->db->get();
        return $query->row();
    }

    //Update Selected User Record
    public function update_patient_vital($vital, $appointment_id)
    {
        $this->db->where('appointment_id', $appointment_id);
        $this->db->update('pre_vital', $vital);
    }

    // Get patient prescriptions
    public function get_patient_prescription_by_doctor($patient_id, $doctor_id)
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "DESC");
        $this->db->from('prescriptions');
        $this->db->where('patient_id', $patient_id);
        $this->db->where('doctor_id', $doctor_id);
        $query = $this->db->get();      
        return $query->result();
    }

    // Get patient prescriptions
    public function get_doctor_wise_patient($doctor_id, $from_date, $to_date)
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->where('prescriptions.doctor_id', $doctor_id);
        $this->db->where('visit_date >=', $from_date);
        $this->db->where('visit_date <=', $to_date);
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

    // Get patient prescriptions
    public function get_doctor_wise_visit_type($doctor_id, $from_date, $to_date, $type)
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->where('prescriptions.doctor_id', $doctor_id);
        $this->db->where('visit_date >=', $from_date);
        $this->db->where('visit_date <=', $to_date);
        $this->db->where('appointment_type', $type);
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

    // Get patient prescriptions
    public function get_doctor_wise_appointments($doctor_id, $from_date, $to_date)
    {
        $this->db->select('*');
        $this->db->order_by("appointments.id", "asc");
        $this->db->from('appointments');
        $this->db->where('appointments.doctor_id', $doctor_id);
        $this->db->where('appointment_date >=', $from_date);
        $this->db->where('appointment_date <=', $to_date);
        $this->db->join('patient_info', 'appointments.patient_id = patient_info.patient_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

    // Get patient prescriptions
    public function get_doctor_wise_test($doctor_id, $from_date, $to_date)
    {
        $this->db->select('*, COUNT(pre_investigation) as total');
        $this->db->order_by("pre_investigation.id", "asc");
        $this->db->from('pre_investigation');
        $this->db->where('prescriptions.doctor_id', $doctor_id);
        $this->db->where('visit_date >=', $from_date);
        $this->db->where('visit_date <=', $to_date);
        $this->db->join('prescriptions', 'pre_investigation.prescription_id = prescriptions.prescription_id', 'left');
        $this->db->join('doctors', 'prescriptions.doctor_id = doctors.doctor_id', 'left');
        $this->db->group_by('pre_investigation');
        $query = $this->db->get();      
        return $query->result();
    }

    // Get patient prescriptions
    public function get_datewise_patient($from_date, $to_date)
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->where('visit_date >=', $from_date);
        $this->db->where('visit_date <=', $to_date);
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

    // Get all prescriptions
    public function get_all_prescriptions()
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $this->db->where('visit_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
        $query = $this->db->get();      
        return $query->result();
    }

    // Get male by date prescriptions
    public function get_male_prescription($visit_date)
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $this->db->where('patient_gender', "Male");
        $this->db->where('visit_date', $visit_date);
        $query = $this->db->get();      
        return $query->result();
    }

    // Get female by date prescriptions
    public function get_female_prescription($visit_date)
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $this->db->where('patient_gender', "Female");
        $this->db->where('visit_date', $visit_date);
        $query = $this->db->get();      
        return $query->result();
    }

    // Get all emergency prescriptions
    public function get_emergency_prescription()
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $this->db->where('visit_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
        $this->db->where('appointment_type', "Emergency");
        $query = $this->db->get();      
        return $query->result();
    }

    // Get all followup prescriptions
    public function get_followup_prescription()
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $this->db->where('visit_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
        $this->db->where('appointment_type', "Followup");
        $query = $this->db->get();      
        return $query->result();
    }

    // Get all general prescriptions
    public function get_general_prescription()
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $this->db->where('visit_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
        $this->db->where('appointment_type', "Report");
        $query = $this->db->get();      
        return $query->result();
    }

    // Get all consultation prescriptions
    public function get_consultation_prescription()
    {
        $this->db->select('*');
        $this->db->order_by("prescriptions.id", "asc");
        $this->db->from('prescriptions');
        $this->db->join('patient_info', 'prescriptions.patient_id = patient_info.patient_id', 'left');
        $this->db->join('appointments', 'prescriptions.appointment_id = appointments.appointment_id', 'left');
        $this->db->where('visit_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
        $this->db->where('appointment_type', "Consultation");
        $query = $this->db->get();      
        return $query->result();
    }

    //check patient
     public function check_patient_exist($reg_no, $mobile_no)
    {
        $this->db->select('*');
        $this->db->from('patient_info');
        $this->db->where('patient_reg_no', $reg_no);
        $this->db->where('patient_mobile', $mobile_no);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    //patient otp
    public function save_otp_info($otp_info)
    {
        return $this->db->insert('patient_otp', $otp_info);
    }

    //check patient otp
     public function check_patient_otp($otp_no, $patient_id)
    {
        $this->db->select('*');
        $this->db->from('patient_otp');
        $this->db->where('patient_otp', $otp_no);
        $this->db->where('patient_id', $patient_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    //Update patient otp
    public function update_otp_info($otp_info, $patient_otp_id)
    {
        $this->db->where('patient_otp_id', $patient_otp_id);
        $this->db->update('patient_otp', $otp_info);
    }

    //template entry
    public function save_template($template)
    {
        return $this->db->insert('pre_template', $template);
    }

    //template entry
    public function save_temp_department($temp_department)
    {
        return $this->db->insert('pre_department', $temp_department);
    }

    //get prescription by id    
    public function get_template_by_id($template_id)
    {
        $this->db->select('*');
        $this->db->from('pre_template');
        $this->db->where('template_id', $template_id);
        $query = $this->db->get();
        return $query->row();
    }

    //get template department   
    public function get_temp_dept($template_id)
    {
        $this->db->select('*');
        $this->db->from('pre_department');
        $this->db->where('template_id', $template_id);
        $this->db->join('departments', 'pre_department.temp_department = departments.department_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

    //Update template
    public function update_template($template, $template_id)
    {
        $this->db->where('template_id', $template_id);
        $this->db->update('pre_template', $template);
    }

    //prescription delete
    function delete_pre_department($template_id)
    {
       $this->db->where('template_id', $template_id);
       $this->db->delete('pre_department'); 
    }

    //get template department   
    public function get_template_list()
    {
        $this->db->select('*');
        $this->db->from('pre_template');
        $this->db->where('template_access', "All");
        $query = $this->db->get();      
        return $query->result();
    }

    //get template department   
    public function get_doctorwise_template_list()
    {
        $this->db->select('*');
        $this->db->from('pre_template');
        $this->db->where('template_access', "doctor");
        $query = $this->db->get();      
        return $query->result();
    }

    //get template department   
    public function get_temp_doctor($template_id)
    {
        $this->db->select('*');
        $this->db->from('template_doctor');
        $this->db->where('template_id', $template_id);
        $this->db->join('doctors', 'template_doctor.temp_doctor = doctors.doctor_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

    //template doctor entry
    public function save_template_doctor($template_doctor)
    {
        return $this->db->insert('template_doctor', $template_doctor);
    }

    //get template list department   
    public function get_dept_template_list($department_id)
    {
        $this->db->select('*');
        $this->db->from('pre_department');
        $this->db->where('temp_department', $department_id);
        $this->db->join('pre_template', 'pre_department.template_id = pre_template.template_id', 'left');
        $this->db->join('departments', 'pre_department.temp_department = departments.department_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

    //get template list department   
    public function get_self_template_list($doctor_id)
    {
        $this->db->select('*');
        $this->db->from('template_doctor');
        $this->db->where('temp_doctor', $doctor_id);
        $this->db->join('pre_template', 'template_doctor.template_id = pre_template.template_id', 'left');
        $query = $this->db->get();      
        return $query->result();
    }

///////////////////////////////////////

    /////Start shift/////
    // Get shift Information
    public function get_shift()
    {
        $this->db->select('*');
        $this->db->order_by("shift_title", "asc");
        $this->db->from('shifts');
        $query = $this->db->get();      
        return $query->result();            
    }

    //shift entry
    public function save_shift($shift)
    {
        return $this->db->insert('shifts', $shift);
    }

    //Get shift Information
    public function get_shift_by_id($shift_id)
    {
        $this->db->select('*');
        $this->db->from('shifts');
        $this->db->where('shift_id', $shift_id);
        $query = $this->db->get();
        return $query->row();
    }

    //Update shift
    public function update_shift($shift, $shift_id)
    {
        $this->db->where('shift_id', $shift_id);
        $this->db->update('shifts', $shift);
    }
/////End shift///// 

/////Start schedule/////
    //doctor search
    public function ddoctor_search($postData)
      {
         $response = array();
         if(isset($postData['search']) ){
           // Select record
           $this->db->select('*');
           $this->db->where("doctor_name like '%".$postData['search']."%' ");
           $this->db->where("doctor_status", 1);

           
           $records = $this->db->get('doctors')->result();

           foreach($records as $row ){
              $response[] = array("value"=>$row->doctor_id,
                                  "label"=>$row->doctor_name,
                                  "dept"=>$row->department_id
                              );
           }

         }

         return $response;
      }

      // Get schedule Information
    public function get_doctor_schedule($doctor_id)
    {
        $this->db->select('*');
        $this->db->order_by("doctor_schedules.id", "asc");
        $this->db->from('doctor_schedules');
        $this->db->where("doctor_schedules.doctor_id ", $doctor_id);
        $this->db->join('doctors', 'doctor_schedules.doctor_id = doctors.doctor_id', 'left');
        $this->db->join('shifts', 'doctor_schedules.schedule_shift = shifts.shift_id', 'left');
        $query = $this->db->get();      
        return $query->result();            
    }


    // Get schedule Information
    public function get_schedule()
    {
        $this->db->select('*');
        $this->db->order_by("doctor_schedules.id", "asc");
        $this->db->from('doctor_schedules');
        $this->db->join('doctors', 'doctor_schedules.doctor_id = doctors.doctor_id', 'left');
        $this->db->join('departments', 'doctor_schedules.department_id = departments.department_id', 'left');
        $this->db->join('shifts', 'doctor_schedules.schedule_shift = shifts.shift_id', 'left');
        $query = $this->db->get();      
        return $query->result();            
    }

    // Get schedule Information
    public function get_schedule_day($schedule_id)
    {
        $this->db->select('*');
        $this->db->order_by("doctor_schedule_days.schedule_day_code", "asc");
        $this->db->from('doctor_schedule_days');
        $this->db->where('schedule_id', $schedule_id);
        $query = $this->db->get();      
        return $query->result();            
    }

    //schedule entry
    public function add_schedule_day($schedule_day)
    {
        return $this->db->insert('doctor_schedule_days', $schedule_day);
    }

    //schedule entry
    public function save_schedule($schedule)
    {
        return $this->db->insert('doctor_schedules', $schedule);
    }

    //Get schedule Information
    public function get_schedule_by_id($schedule_id)
    {
        $this->db->select('*');
        $this->db->from('doctor_schedules');
        $this->db->where('schedule_id', $schedule_id);
        $this->db->join('doctors', 'doctor_schedules.doctor_id = doctors.doctor_id', 'left');
        $this->db->join('departments', 'doctor_schedules.department_id = departments.department_id', 'left');
        $this->db->join('shifts', 'doctor_schedules.schedule_shift = shifts.shift_id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    //schedule day delete
    function remove_schedule_days($schedule_id)
    {
       $this->db->where('schedule_id', $schedule_id);
       $this->db->delete('doctor_schedule_days'); 
    }

    //Update schedule
     public function update_schedule($schedule, $schedule_id)
     {
         $this->db->where('schedule_id', $schedule_id);
         $this->db->update('doctor_schedules', $schedule);
     }
/////End schedule/////

     //Get schedule doctor
    public function get_schedule_day_doctor($shift, $day)
    {
        $this->db->select('*');
        $this->db->order_by("doctors.doctor_name", "asc");
        $this->db->from('doctor_schedule_days');
        //$this->db->where('doctor_schedule_days.department_id', $department);
        $this->db->where('doctor_schedule_days.schedule_day_shift', $shift);
        $this->db->where('doctor_schedule_days.schedule_day', $day);
        $this->db->where('doctor_schedule_days.schedule_day_status  ', 1);
        $this->db->join('doctor_schedules', 'doctor_schedule_days.schedule_id = doctor_schedules.schedule_id', 'left');
        $this->db->join('doctors', 'doctor_schedule_days.doctor_id = doctors.doctor_id', 'left');
        //$this->db->join('departments', 'doctor_schedule_days.department_id = departments.department_id', 'left');
        $this->db->join('shifts', 'doctor_schedule_days.schedule_day_shift = shifts.shift_id', 'left');
        //$this->db->group_by('doctor_schedule_days.doctor_id');
        $query = $this->db->get();      
        return $query->result();            
    } 

// Get schedule doctor
    // public function get_schedule_doctor($department, $shift)
    // {
    //     $this->db->select('*');
    //     $this->db->order_by("doctor_schedules.id", "asc");
    //     $this->db->from('doctor_schedules');
    //     $this->db->where('doctor_schedules.department_id', $department);
    //     $this->db->where('doctor_schedules.schedule_shift', $shift);
    //     $this->db->where('doctor_schedules.schedule_status', 1);
    //     $this->db->join('doctors', 'doctor_schedules.doctor_id = doctors.doctor_id', 'left');
    //     $this->db->join('departments', 'doctor_schedules.department_id = departments.department_id', 'left');
    //     $this->db->join('shifts', 'doctor_schedules.schedule_shift = shifts.shift_id', 'left');
    //     $query = $this->db->get();      
    //     return $query->result();            
    // }   

/////Start menu/////
        // Get menu Information
        public function get_menu()
        {
            $this->db->select('*');
            $this->db->order_by("id", "asc");
            $this->db->from('menus');
            $query = $this->db->get();      
            return $query->result();            
        }

        //menu entry
        public function save_menu($menu)
        {
            return $this->db->insert('menus', $menu);
        }

        //Get menu Information
        public function get_menu_by_id($menu_id)
        {
            $this->db->select('*');
            $this->db->from('menus');
            $this->db->where('menu_id', $menu_id);
            $query = $this->db->get();
            return $query->row();
        }

        //Update menu
        public function update_menu($menu, $menu_id)
        {
            $this->db->where('menu_id', $menu_id);
            $this->db->update('menus', $menu);
        }

        //menu privilege
        public function save_user_privilege($privilege)
        {
            return $this->db->insert('user_menu_privilege', $privilege);
        }

        // Get menu privilege
        public function get_user_privilege($user_id)
        {
            $this->db->select('*');
            $this->db->order_by("user_menu_privilege.id", "asc");
            $this->db->from('user_menu_privilege');
            $this->db->where('user_id', $user_id);
            $this->db->join('menus', 'user_menu_privilege.menu_id = menus.menu_id', 'left');
            $query = $this->db->get();      
            return $query->result();            
        }

        //delete privilege
        public function remove_user_privilege($user_id)
        {
            $this->db->where('user_id', $user_id);
            $this->db->delete('user_menu_privilege');
        }
/////End menu/////




}
?>