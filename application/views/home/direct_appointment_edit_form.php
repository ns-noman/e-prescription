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
        New Appointment
        <small>Form<b class="box-title text-red"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Transaction</li>
        <li class="active">Patient Appointment</li>
    </ol>
</section>

<section class="content">
    <?php echo $success_msg; ?>
          <?php echo $error_msg; ?>
    <form class="form-horizontal" action="<?php echo base_url().'update-direct-appointment/'.$appointment_info->appointment_id;?>" method="post" enctype="multipart/form-data"  role="form">
    <div class="row">
        <div class="col-md-5">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Appointment Info</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                    <label for="app_date" class="col-sm-4 control-label">Date<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control  pull-right datepicker2" id="app_date" name="app_date" value="<?php echo $appointment_info->appointment_date; ?>" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('app_date'); ?></span>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="doctor_department" class="col-sm-4 control-label">Department <span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="doctor_department" id="doctor_department" style="width: 100%;" required="">
                            <option value="">Select Department</option>
                            <?php if ($department) {
                                foreach ($department as $dept) {
                             ?>
                              <option value="<?php echo $dept->department_id; ?>"><?php echo $dept->department_name; ?></option>
                          <?php }} ?>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_department'); ?></span>
                    </div>
                </div> -->

                <div class="form-group">
                    <label for="shift" class="col-sm-4 control-label">Shift<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="shift" id="shift" style="width: 100%;"required>
                            <option value="<?php echo $appointment_info->shift_id; ?>"><?php echo $appointment_info->shift_title ." (".$appointment_info->shift_start." - ".$appointment_info->shift_end.")"; ?></option>
                             <?php if ($shift) {
                            foreach ($shift as $sft) {
                            ?>
                            <option value="<?php echo $sft->shift_id; ?>"><?php echo $sft->shift_title ." (".$sft->shift_start." - ".$sft->shift_end.")"; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Shift</option>
                          <?php } ?>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('shift'); ?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="patient_mobile" class="col-sm-4 control-label">Patient Mobile<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="patient_mobile1" name="patient_mobile" required autocomplete="off" value="<?php echo $appointment_info->patient_mobile; ?>" readonly>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_mobile'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="patient_name" class="col-sm-4 control-label">Patient Name<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="patient_name1" name="patient_name" required autocomplete="off" value="<?php echo $appointment_info->patient_first_name." ".$appointment_info->patient_last_name; ?>" readonly>
                        <input type="hidden" class="form-control" id="patient_id" name="patient_id" required value="<?php echo $appointment_info->patient_id; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_name'); ?></span>
                    </div>
                </div>
                <?php
                    if($appointment_info->patient_dob != "0000-00-00")
                        {
                            $interval = date_diff(date_create(), date_create($appointment_info->patient_dob));
                            //echo $interval->format("%Y Year, %M Months, %d Days");
                            $year = $interval->format("%Y");
                            $month = $interval->format("%M");
                            $day = $interval->format("%d");
                        }else{
                            $year = 0;
                            $month = 0;
                            $day = 0;
                        }
                 ?>

                <div class="form-group">
                    <label for="age" class="col-sm-3 control-label">Age</label>
                    <div class="col-sm-3">
                      Year<br>
                     <input type="number" class="form-control" name="year" id="year" value="<?php echo $year; ?>" autocomplete="off" min="0">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('year'); ?></span>
                    </div>
                     <div class="col-sm-3">
                      Month<br>
                      <input type="number" class="form-control" name="month" id="month" value="<?php echo $month; ?>" autocomplete="off" min="0">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('month'); ?></span>
                    </div>
                    <div class="col-sm-3">
                      Day<br>
                      <input type="number" class="form-control" name="day" id="day" value="<?php echo $day; ?>" required autocomplete="off" min="0">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('day'); ?></span>
                    </div>

                </div>


                <div class="form-group">
                    <label for="type" class="col-sm-4 control-label"> Type<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="type" id="type" style="width: 100%;" value="<?php echo set_value('type'); ?>" required>
                            <option value="<?php echo $appointment_info->appointment_type; ?>"><?php echo $appointment_info->appointment_type; ?></option>
                            <option value="Consultation">Consultation</option>
                            <option value="Emergency">Emergency</option>
                            <option value="Followup">Followup</option>
                            <option value="Report">Report</option>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('type'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="remark" class="col-sm-4 control-label"> Remark</label>
                    <div class="col-sm-8">
                        <textarea class="form-control limited" name="remark" id="remark" maxlength="250"><?php echo $appointment_info->appointment_remark; ?></textarea>
                        <span id="charNum" style="color:red;font-size: 10px;float: left;"><?php echo form_error('remark'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="patient_ref" class="col-sm-4 control-label">Ref.</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="patient_ref" name="patient_ref" autocomplete="off" value="<?php echo $appointment_info->appointment_ref; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_ref'); ?></span>
                    </div>
                </div>

              </div>
               <div class="box-footer">
                 <div class="col-sm-offset-4 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                 </div>
                </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Doctor Info</h3>
            </div>
              <div class="box-body" id="doctor_info" style="height: 500px; overflow-y: scroll;">
                <?php 
                    $date =  $appointment_info->appointment_date;
                    $shift = $appointment_info->shift_id;
                    $day = date('l', strtotime($date));
                    if($shift && $date){
                     $doctor = $this->prescription_model->get_schedule_day_doctor($shift, $day);
                        
                         if($doctor){
                            echo '<div class="col-md-12"><table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Available Doctors</th>
                                    </tr>';
                                    foreach($doctor as $doc){
                                        if ($doc->doctor_id == $appointment_info->doctor_id) {
                                            echo "<tr>
                                                <td><label><input type ='radio' name='schedule_doctor' value='".$doc->doctor_id.":".$doc->schedule_id."' onclick=doctor_slot('".$doc->schedule_id."') required checked > ".$doc->doctor_name."</label>
                                                </td>
                                            </tr>";
                                        }else{
                                            echo "<tr>
                                                <td><label><input type ='radio' name='schedule_doctor' value='".$doc->doctor_id.":".$doc->schedule_id."' onclick=doctor_slot('".$doc->schedule_id."') required> ".$doc->doctor_name."</label>
                                                </td>
                                            </tr>";
                                        }
                              
                                    }          
                               echo '</table></div>';
                               }

                        }else{echo "Select Date & Shift first.";}
                ?>

            </div>
        </div>
      </div>

      <div class="col-md-3">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Slot Info</h3>
            </div>
              <div class="box-body" id="slot_info" style="height: 500px; overflow-y: scroll;">
                <?php
                    $schedule_id = $appointment_info->schedule_id;
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
                                if ($i == $appointment_info->appointment_slot) {
                                    echo "<label class='text-yellow'><input type ='radio' name='schedule_slot' value='".$i."' required checked> ".$i.".".$patient->patient_first_name."-".$time_slot."</label><br>"; 
                                }else{
                                    echo '<label class="text-red">'.$i.'.  '.$patient->patient_first_name."-".$time_slot.')</label><br>';
                                }
                                
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
                 ?>
            </div>
        </div>
      </div>
    </div>
    </form>


</section>