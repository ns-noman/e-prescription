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
    <form class="form-horizontal" action="<?php echo base_url();?>add-direct-appointment" method="post" enctype="multipart/form-data"  role="form">
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
                        <input type="text" class="form-control  pull-right datepicker2" id="app_date" name="app_date" value="<?php echo date('Y-m-d'); ?>" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off">
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
                            <option value="">Select Shift</option>
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
                        <input type="text" class="form-control" id="patient_mobile" name="patient_mobile" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_mobile'); ?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="patient_name" class="col-sm-4 control-label">Patient Name<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="patient_name" name="patient_name" required autocomplete="off">
                        <input type="hidden" class="form-control" id="patient_id" name="patient_id" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_name'); ?></span>
                    </div>
                </div>

                

                <div class="form-group">
                    <label for="age" class="col-sm-3 control-label">Age</label>
                    <div class="col-sm-3">
                      Year<br>
                     <input type="number" class="form-control" name="year" id="year" value="0" autocomplete="off" min="0">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('year'); ?></span>
                    </div>
                     <div class="col-sm-3">
                      Month<br>
                      <input type="number" class="form-control" name="month" id="month" value="0" autocomplete="off" min="0">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('month'); ?></span>
                    </div>
                    <div class="col-sm-3">
                      Day<br>
                      <input type="number" class="form-control" name="day" id="day" value="0" required autocomplete="off" min="0">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('day'); ?></span>
                    </div>

                </div>


                <div class="form-group">
                    <label for="type" class="col-sm-4 control-label"> Type<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="type" id="type" style="width: 100%;" value="<?php echo set_value('type'); ?>" required>
                            <option value="">Select Type</option>
                            <option value="Consultation" selected>Consultation</option>
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
                        <textarea class="form-control limited" name="remark" id="remark" maxlength="250"></textarea>
                        <span id="charNum" style="color:red;font-size: 10px;float: left;"><?php echo form_error('remark'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="patient_ref" class="col-sm-4 control-label">Ref.</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="patient_ref" name="patient_ref" autocomplete="off">
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

            </div>
        </div>
      </div>

      <div class="col-md-3">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Slot Info</h3>
            </div>
              <div class="box-body" id="slot_info" style="height: 500px; overflow-y: scroll;">

            </div>
        </div>
      </div>
    </div>
    </form>


</section>