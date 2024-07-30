<?php
$success_msg = $this->session->userdata('success');
$error_msg = $this->session->userdata('error');
?>
<?php
$this->session->unset_userdata('success');
$this->session->unset_userdata('error');
?>
<section class="content-header">
    <h1>
        Patient Vital
        <small>Form<b class="box-title text-red"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Transaction</li>
        <li class="active">Patient Appointment List</li>
        <li class="active">Patient Vital</li>
    </ol>
</section>

<section class="content">
    <?php echo $success_msg; ?>
          <?php echo $error_msg; ?>
    <form class="form-horizontal" action="<?php echo base_url() . "update-patient-vital/" . $vital_info->appointment_id; ?>" method="post" enctype="multipart/form-data"  role="form">
    <div class="row">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Basic Info</h3>
            </div>
              <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-6">
                              <label for="height_feet">Height(feet)</label>
                              <select class="form-control bmi" name="height_feet" id="height_feet">
                                <option value="<?php echo $vital_info->vital_height_feet; ?>"><?php echo $vital_info->vital_height_feet; ?></option>
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
                            <div class="col-sm-6">
                                <label for="height_inch">Height(Inch)</label>
                               <select class="form-control bmi" name="height_inch" id="height_inch">
                                    <option value="<?php echo $vital_info->vital_height_inch; ?>"><?php echo $vital_info->vital_height_inch; ?></option>
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
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="patient_temperature_f">Temperature F</label>
                                <input type="number" class="form-control" name="patient_temperature_f" id="patient_temperature_f" value="<?php echo $vital_info->vital_temperature_f; ?>" step="0.01">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_temperature_f'); ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="patient_temperature_c">Temperature C</label>
                                <input type="number" class="form-control" name="patient_temperature_c" id="patient_temperature_c" value="<?php echo $vital_info->vital_temperature_c; ?>" step="0.01">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_temperature_c'); ?></span>
                            </div>
                        </div>
                     
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="patient_weight_kg">Weight (KG) </label>
                                <input type="number" class="form-control" name="patient_weight_kg" id="patient_weight_kg" value="<?php echo $vital_info->vital_weight_kg; ?>" step="0.01">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_weight_kg'); ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="patient_weight_lbs">Weight (Lbs) </label>
                                <input type="text" class="form-control" name="patient_weight_lbs" id="patient_weight_lbs" value="<?php echo number_format((float)$vital_info->vital_weight_kg*2.20462262, 2, '.', '');?>" readonly>
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_weight_lbs'); ?></span>
                            </div>
                        </div>

                          <div class="form-group">
                            <div class="col-sm-6">
                                <label for="patient_respiration">Respiration</label>
                                <input type="text" class="form-control" name="patient_respiration" id="patient_respiration" value="<?php echo $vital_info->vital_respiration; ?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_respiration'); ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="patient_pulse">Pulse </label>
                                <input type="text" class="form-control" name="patient_pulse" id="patient_pulse" value="<?php echo $vital_info->vital_pulse; ?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_pulse'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="patient_bp_sys">BP (Systolic)</label>
                                <input type="text" class="form-control" name="patient_bp_sys" id="patient_bp_sys" value="<?php echo $vital_info->vital_bp_sys; ?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_bp_sys'); ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="patient_bp_dia">BP(Diastolic)</label>
                                <input type="text" class="form-control" name="patient_bp_dia" id="patient_bp_dia" value="<?php echo $vital_info->vital_bp_dia; ?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_bp_dia'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="patient_smoking_habit">Smoking Habit</label>
                                <select class="form-control" name="patient_smoking_habit" id="patient_smoking_habit">
                                    <option value="<?php echo $vital_info->vital_smoking_habit; ?>"><?php echo $vital_info->vital_smoking_habit; ?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_smoking_habit'); ?></span>
                            </div>
                            <div class="col-sm-6">
                                <label for="patient_other">Others</label>
                                <input type="text" class="form-control" name="patient_other" id="patient_other" value="<?php echo $vital_info->vital_other; ?>">
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_other'); ?></span>
                            </div>
                        </div>
                    </div>
                   
                    <div class="box-footer">
                       <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary pull-left">Update</button>
                          <button type="reset" class="btn btn-danger pull-right">Reset</button>
                       </div> 
                    </div>
                </div>
        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Patient Info</h3>
            </div>
              <div class="box-body" id="patient_info" style="height: 520px;">
                              <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url();?>assets/img/user.png" alt="Patient Photo">
                </div>
                <h3 class="profile-username text-center"><?php echo $app_info->patient_first_name." ".$app_info->patient_last_name; ?> </h3>
                <p class="text-muted text-center">Reg.#:<?php echo $app_info->patient_reg_no; ?> </p>
                <div class="col-md-12"><ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Father Name: </b> <a class="float-right"><?php echo $app_info->patient_father_name; ?> </a>
                  </li>
                  <li class="list-group-item">
                    <b>Age: </b> <a class="float-right">
                      <?php
                     if($app_info->patient_dob != "0000-00-00")
                            {
                                $interval = date_diff(date_create(), date_create($app_info->patient_dob));
                                echo $interval->format("%Y Year, %M Months, %d Days");
                            }
                        ?>
                </a>
                  </li>
                  <li class="list-group-item">
                    <b>Mobile: </b> <a class="float-right"><?php echo $app_info->patient_mobile; ?> </a>
                  </li>
                  <li class="list-group-item">
                    <b>Address: </b> <a class="float-right"><?php echo $app_info->patient_address; ?> </a>
                  </li>
                  <li class="list-group-item">
                    <b>Registration Date: </b> <a class="float-right"><?php echo date("d/m/Y", strtotime($app_info->patient_entry_date)); ?> </a>
                  </li>
                  <li class="list-group-item">
                    <b>Appointment Date: </b> <a class="float-right"><?php echo date("d/m/Y", strtotime($app_info->appointment_date)); ?> </a>
                  </li>
                  <li class="list-group-item">
                    <b>Doctor: </b> <a class="float-right"><?php echo $app_info->doctor_name; ?> </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
      </div>
    </div>
    </form>

</section>