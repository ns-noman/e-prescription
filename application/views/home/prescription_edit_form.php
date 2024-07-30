
<?php
$success_msg = $this->session->userdata('success');
$error_msg = $this->session->userdata('error');
?>
<?php
$this->session->unset_userdata('success');
$this->session->unset_userdata('error');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Prescription
    <small>Entry</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Appointment List</li>
    <li class="active">Prescription Entry</li>
    </ol>
</section>

<section class="content">
    <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-user-md"></i> Patient Information
            <small class="pull-right">Visit Date: <?php echo date("d/m/Y", strtotime($app_info->visit_date )); ?></small>
          </h2>
        </div>
      </div>

      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            Patient Name : <?php echo $app_info->patient_first_name; ?> <?php echo $app_info->patient_last_name; ?><br>
            Contact No: <?php echo $app_info->patient_mobile ; ?><br>
            Address: <?php echo $app_info->patient_address; ?><br>
            Email: <?php echo $app_info->patient_email; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>
           <!--  Gender : <?php echo $app_info->patient_gender; ?><br>
            Age : <?php echo $app_info->pre_age; ?>
            <br>
            Blood Group : <?php echo $app_info->patient_blood_group; ?><br>
            Marital Status : <?php echo $app_info->patient_marital_status; ?> -->
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Patient reg. No. : <?php echo $app_info->patient_reg_no; ?></b><br>
          <b>Appointment Type : <?php echo $app_info->appointment_type; ?></b><br>
          <b> Visit Count : <?php echo $app_info->appointment_number; ?></b><br>
          <b> Consultent : <?php echo $app_info->doctor_name; ?></b>
        </div>
        <!-- /.col -->
      </div>

      <!-- form row -->
    <div class="row">
        <form class="form-horizontal" action="<?php echo base_url() . "update-prescription/" . $app_info->prescription_id; ?>" method="post" enctype="multipart/form-data"  role="form" id="pre_form">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-left">Update</button>
                        <button type="reset" class="btn btn-danger pull-right">Reset</button>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Patient Information</h3>
                    </div>
                    <div class="box-body">
                      <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-sm-3">
                                <label for="age">Age</label>
                                <input type="text" class="form-control" name="age" id="age" value="<?php echo $app_info->pre_age; ?>" autocomplete="off" placeholder="00 Year, 00 Months, 0 Days">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('age'); ?></span>
                            </div>
                            <div class="col-sm-3">
                                <label for="gender">Gender</label>
                                  <select class="form-control" name="gender" id="gender" value="<?php echo set_value('gender'); ?>">
                                <option value="<?php echo $app_info->patient_gender; ?>"><?php echo $app_info->patient_gender; ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Female">Other</option>
                            </select>
                            <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('gender'); ?></span>
                            </div>
                            <div class="col-sm-3">
                                <label for="marital_status">Marital Status</label>
                                <select class="form-control" name="marital_status" id="marital_status" value="<?php echo set_value('marital_status'); ?>">
                                <option value="<?php echo $app_info->pre_marital_status; ?>"><?php echo $app_info->patient_marital_status; ?></option>
                                <option value="Married">Married</option>
                                <option value="Single">Single</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                            <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('marital_status'); ?></span>
                            </div>
                            <div class="col-sm-3">
                                <label for="blood_group">Blood Group</label>
                                <select class="form-control" name="blood_group" id="blood_group" value="<?php echo set_value('blood_group'); ?>">
                                <option value="<?php echo $app_info->patient_blood_group; ?>"><?php echo $app_info->patient_blood_group; ?></option>
                                <option value="O+">O+</option>
                                <option value="O–">O–</option>
                                <option value="A+">A+</option>
                                <option value="A–">A–</option>
                                <option value="B+">B+</option>
                                <option value="B–">B–</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                            <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('blood_group'); ?></span>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>        

            <div class="col-md-12">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Clinical Info</h3>
                    </div>
                    <div class="box-body">
                      <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="height_feet">Height(feet)</label>
                              <select class="form-control bmi" name="height_feet" id="height_feet" value="<?php echo set_value('height_feet'); ?>">
                                <option value="<?php echo $app_info->patient_height_feet;?>"><?php echo $app_info->pre_height_feet;?></option>
                                <option value="1">1'</option>
                                <option value="2">2'</option>
                                <option value="3">3'</option>
                                <option value="4">4'</option>
                                <option value="5">5'</option>
                                <option value="6">6'</option>
                                <option value="7">7'</option>
                                <option value="8">8'</option>
                                <option value="9">9'</option>
                            </select>
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('height_feet'); ?></span>
                            </div>
                            <div class="col-sm-2">
                                <label for="height_inch">Height(Inch)</label>
                               <select class="form-control bmi" name="height_inch" id="height_inch" value="<?php echo set_value('height_inch'); ?>">
                                    <option value="<?php echo $app_info->patient_height_inch;?>"><?php echo $app_info->pre_height_inch;?></option>
                                    <option value="0">0"</option>
                                    <option value="1">1"</option>
                                    <option value="2">2"</option>
                                    <option value="3">3"</option>
                                    <option value="4">4"</option>
                                    <option value="5">5"</option>
                                    <option value="6">6"</option>
                                    <option value="7">7"</option>
                                    <option value="8">8"</option>
                                    <option value="9">9"</option>
                                    <option value="10">10"</option>
                                    <option value="11">11"</option>
                                    <option value="12">12"</option>
                                </select>
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('height_inch'); ?></span>
                            </div>

                            <div class="col-sm-2">
                                <label for="patient_temperature_f">Temperature F</label>
                                <input type="number" class="form-control" name="patient_temperature_f" id="patient_temperature_f" value="<?php echo $app_info->pre_temperature_f;?>" step="0.01">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_temperature_f'); ?></span>
                            </div>

                            <div class="col-sm-2">
                                <label for="patient_temperature_c">Temperature C</label>
                                <input type="number" class="form-control" name="patient_temperature_c" id="patient_temperature_c" value="<?php echo $app_info->pre_temperature_c;?>" step="0.01">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_temperature_c'); ?></span>
                            </div>

                            <div class="col-sm-2">
                                <label for="patient_weight_kg bmi">Weight (KG) </label>
                                <input type="number" class="form-control" name="patient_weight_kg" id="patient_weight_kg" value="<?php echo $app_info->pre_weight_kg;?>" step="0.01">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_weight_kg'); ?></span>
                            </div>
                            <div class="col-sm-2">
                                <label for="patient_weight_lbs">Weight (Lbs) </label>
                                <input type="text" class="form-control" name="patient_weight_lbs" id="patient_weight_lbs" value="<?php echo number_format((float)$app_info->pre_weight_kg*2.20462262, 2, '.', '');?>" readonly>
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_weight_lbs'); ?></span>
                            </div>
                            <div class="col-sm-2">
                                <label for="patient_respiration">Respiration</label>
                                <input type="text" class="form-control" name="patient_respiration" id="patient_respiration" value="<?php echo $app_info->pre_respiration;?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_respiration'); ?></span>
                            </div>

                            <div class="col-sm-2">
                                <label for="patient_bmi">BMI </label>
                                <input type="text" class="form-control" name="patient_bmi" id="patient_bmi" value="<?php $height = intval($app_info->pre_height_feet)*12+intval($app_info->pre_height_inch);
                                if($app_info->pre_weight_kg && $height){$bmi = intval($app_info->pre_weight_kg)/pow((($height)*0.0254), 2); echo number_format((float)$bmi, 2, '.', '');} ?>" readonly>
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_bmi'); ?></span>
                            </div>
                            <div class="col-sm-2">
                                <label for="patient_pulse">Pulse </label>
                                <input type="text" class="form-control" name="patient_pulse" id="patient_pulse" value="<?php echo $app_info->pre_pulse;?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_pulse'); ?></span>
                            </div>

                            <div class="col-sm-2">
                                <label for="patient_bp_sys">BP (Systolic)</label>
                                <input type="text" class="form-control" name="patient_bp_sys" id="patient_bp_sys" value="<?php echo $app_info->pre_bp_sys;?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_bp_sys'); ?></span>
                            </div>
                            <div class="col-sm-2">
                                <label for="patient_bp_dia">BP(Diastolic)</label>
                                <input type="text" class="form-control" name="patient_bp_dia" id="patient_bp_dia" value="<?php echo $app_info->pre_bp_dia;?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_bp_dia'); ?></span>
                            </div>

                            <div class="col-sm-2">
                                <label for="patient_smoking_habit">Smoking Habit</label>
                                <select class="form-control" name="patient_smoking_habit" id="patient_smoking_habit" value="<?php echo set_value('patient_smoking_habit'); ?>">
                                    <option value="<?php echo $app_info->pre_smoking_habit;?>"><?php echo $app_info->pre_smoking_habit;?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_smoking_habit'); ?></span>
                            </div>

                            <!-- <div class="col-sm-2">
                                <label for="patient_other">Others</label>
                                <input type="text" class="form-control" name="patient_other" id="patient_other" value="<?php echo $app_info->pre_others;?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_other'); ?></span>
                            </div> -->
                        </div>
                        
                    </div>

                    </div>
                </div>
            </div>

            <?php if ($file_info) { ?>
            <div class="col-md-4">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Patient Files</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="col-sm-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <th>Date</th>
                                        <th>File Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $x = 1;
                                        foreach ($file_info as $file) {
                                    ?>
                                    <tr>
                                        <td><?php echo date("d/m/Y", strtotime( $file->pre_file_entry_date)); ?></td>
                                        <td><?php echo $file->pre_file_name;?></td>
                                        <td>
                                            <a  href="<?php echo base_url() . "download/". $file->pre_file_id; ?>">
                                            <i class="glyphicon glyphicon-download"></i> Download</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <div class="col-md-4">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Chief Complaint</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="complaint_search">Chief Complaint</label>
                                    <input type="text" class="form-control" name="complaint_search" id="complaint_search" >                             
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="complaint_duration">Duration</label>
                                <input type="text" class="form-control" name="complaint_duration" id="complaint_duration">
                            </div>
                            <div class="col-sm-6">
                                <label for="complaint_unit">Unit</label>
                               <select class="form-control" name="complaint_Unit" id="complaint_Unit">
                                    <option value="">Select Option</option>
                                    <option value="Month">Month</option>
                                    <option value="Week">Week</option>
                                    <option value="Days">Days</option>
                                    <option value="Hours">Hours</option>
                                    <option value="Minutes">Minutes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-10">
                                <button type="button" id="add_complaint">Add</button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="10" id="chief_complaint" name="chief_complaint"><?php if ($pre_complaint) {
                                    foreach ($pre_complaint as $complaint) { 
                                                echo $complaint->pre_complaint;
                                                if (next($pre_complaint)) {
                                                    echo "\n";
                                                    }
                                }} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">History</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="history_search">History Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="history_search" id="history_search" >
                                    <span class="input-group-addon"><button type="button" id="add_history">Add</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="16" id="patient_history" name="patient_history"><?php 
                               if ($pre_history) {
                                foreach ($pre_history as $history) {
                                  echo $history->pre_history;
                                  if (next($pre_history )) {
                                        echo "\n";
                                        }
                                    }
                                }
                    ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">On Exam</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="exam_search">Exam Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="exam_search" id="exam_search" >
                                    <span class="input-group-addon"><button type="button" id="add_exam">Add</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="16" id="on_exam" name="on_exam"><?php if ($pre_exam) {
                                    foreach ($pre_exam as $exam) { 
                                                echo $exam->pre_examination;
                                                if (next($pre_exam)) {
                                                    echo "\n";
                                                    }
                                }} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Diagnosis</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="diagnosis_search">Diagnosis Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="diagnosis_search" id="diagnosis_search" >
                                    <span class="input-group-addon"><button type="button" id="add_diagnosis">Add</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="16" id="patient_diagnosis" name="patient_diagnosis"><?php if ($pre_diagnosis) {
                                    foreach ($pre_diagnosis as $diagnosis) { 
                                                echo $diagnosis->pre_diagnosis;
                                                if (next($pre_diagnosis)) {
                                                    echo "\n";
                                                    }
                                }} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Medicine</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="medicine_search">Medicine Name</label>
                                <input type="text" class="form-control" name="medicine_search" id="medicine_search">
                            </div>
                            <div class="col-sm-6">
                                <label for="doses_administration">Doses</label>
                               <select class="form-control" name="doses_administration" id="doses_administration">
                                    <option value="">Select Doses</option>
                                    <?php if ($doses_administration) {
                                        foreach ($doses_administration as $doses) { ?>
                                            <option value="<?php echo $doses->doses_administration_eng; ?>"><?php echo $doses->doses_administration_eng; ?></option>
                                       <?php }}else{ ?>
                                        <option value="">No Doses</option>
                                       <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="doses_duration">Duration</label>
                               <select class="form-control" name="doses_duration" id="doses_duration">
                                    <option value="">Select Duration</option>
                                    <?php if ($doses_duration) {
                                        foreach ($doses_duration as $duration) { ?>
                                            <option value="<?php echo $duration->doses_duration_eng; ?>"><?php echo $duration->doses_duration_eng; ?></option>
                                       <?php }}else{ ?>
                                        <option value="">No Duration</option>
                                       <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="meal_administration">Advice</label>
                               <select class="form-control" name="meal_administration" id="meal_administration">
                                    <option value="">Select Advice</option>
                                    <?php if ($meal_administration) {
                                        foreach ($meal_administration as $meal) { ?>
                                            <option value="<?php echo $meal->meal_administration_eng; ?>"><?php echo $meal->meal_administration_eng; ?></option>
                                       <?php }}else{ ?>
                                        <option value="">No Advice</option>
                                       <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-10">
                                <button type="button" id="add_medicine">Add</button>
                                <button type="button" id="old_medicine" data-toggle="modal" data-target="#oldMedicine">Previous Medicine</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="11" id="patient_medicine" name="patient_medicine"><?php if ($pre_medicine) {
                                            foreach ($pre_medicine as $medicine) { 
                                                echo $medicine->pre_medicine_name."|".$medicine->pre_medicine_doses."|".$medicine->pre_medicine_duration."|".$medicine->pre_medicine_advice;
                                                    if (next($pre_medicine)) {
                                                    echo "\n";
                                                    }
                                }}?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Investigation</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        
                        <!-- <div class="form-group">
                            <div class="col-sm-6">
                                <label for="service_type">Service Type</label>
                               <select class="form-control" name="service_type" id="service_type">
                                    <option value="">Select Option</option>
                                    <?php if ($investigation_type) {
                                        foreach ($investigation_type as $itype) { ?>
                                            <option value="<?php echo $itype->investigation_type_id; ?>"><?php echo $itype->investigation_type; ?></option>
                                       <?php }}else{ ?>
                                        <option value="">No Type</option>
                                       <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="test_name">Test Name</label>
                                <input type="text" class="form-control" name="test_name" id="test_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-10">
                                <button type="button" id="add_test">Add</button>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="test_name">Test Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="test_name" id="test_name" >
                                    <span class="input-group-addon"><button type="button" id="add_test">Add</button></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="14" id="patient_test" name="patient_test"><?php if ($pre_investigation) {
                                    foreach ($pre_investigation as $investigation) { 
                                                //echo $investigation->pre_investigation_type."|".$investigation->pre_investigation."\n";
                                                echo $investigation->pre_investigation;
                                                if (next($pre_investigation)) {
                                                    echo "\n";
                                                    }
                                }} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Advice</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="advice_search">Advice</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="advice_search" id="advice_search" >
                                    <span class="input-group-addon"><button type="button" id="add_advice">Add</button></span> <span class="input-group-addon"><button type="button" id="add_advice">Add</button> <button type="button" id="all_advice" data-toggle="modal" data-target="#adviceModal">More</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="12" id="patient_advice" name="patient_advice"><?php if ($pre_advice) {
                                    foreach ($pre_advice as $advice) { 
                                                echo $advice->pre_health_advice;
                                                if (next($pre_advice)) {
                                                    echo "\n";
                                                    }
                                    }} ?></textarea>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Special Note</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="note_search">Special Note</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="note_search" id="note_search" >
                                    <span class="input-group-addon"><button type="button" id="add_note">Add</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="12" id="patient_note" name="patient_note"><?php if ($pre_note) { 
                                    foreach ($pre_note as $note) { 
                                                echo $note->pre_special_note;
                                                if (next($pre_note)) {
                                                    echo "\n";
                                                    }
                                    }} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-info box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Other Info</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="note_search">Next Visit</label>
                                    <input type="text" class="form-control  pull-right datepicker2" id="next_visit" name="next_visit" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" value="<?php echo $app_info->pre_next_visit; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="note_search">Referral Doctor/Organization</label>
                                    <input type="text" class="form-control" id="patient_ref" name="patient_ref" value="<?php echo $app_info->pre_ref_org; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="note_search">Cause / Remarks</label>
                                <textarea class="form-control" rows="7" id="patient_remark" name="patient_remark"><?php echo $app_info->pre_remarks; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="template_name">For Save as Template</label>
                                    <input type="text" class="form-control" id="template_name" name="template_name" placeholder="Enter Template Name">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
             <div class="col-md-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-left">Update</button>
                        <button type="reset" class="btn btn-danger pull-right">Reset</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Medicine Modal -->
  <div class="modal fade" id="oldMedicine" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Previous Medicine</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
               <?php if($prescriptions){
                foreach ($prescriptions as $prescription) {
               ?>
               <div>
                   <b><u><?php echo date("d/m/Y", strtotime($prescription->visit_date)); ?></u></b><br>
                   <?php
                   $medicine = $this->prescription_model->get_pre_medicine($prescription->prescription_id);
                   if($medicine){
                    foreach ($medicine as $med) {
                   ?>
                   <input type="checkbox" class="minimal" value="<?php echo $med->pre_medicine_name."|".$med->pre_medicine_doses."|".$med->pre_medicine_duration."|".$med->pre_medicine_advice; ?>" name="pre_med">
                  <?php echo $med->pre_medicine_name." | ".$med->pre_medicine_doses." | ".$med->pre_medicine_duration." | ".$med->pre_medicine_advice; ?>
                </label><br>

                   <?php }} ?>
               </div><br>
               
            <?php }}else{echo "No Data Found.";} ?>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="med_list">Add</button>
        </div>
      </div>
      
    </div>
  </div>

<!-- Advice Modal -->
  <div class="modal fade" id="adviceModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Health Advice</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
               <?php if($health_advice){
                foreach ($health_advice as $advice) {
               ?>
                <label>
                  <input type="checkbox" class="minimal" value="<?php echo $advice->health_advice_eng; ?>" name="advice">
                  <?php echo $advice->health_advice_eng; ?>
                </label><br>
            <?php }} ?>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="advice_list">Add</button>
        </div>
      </div>
      
    </div>
  </div>