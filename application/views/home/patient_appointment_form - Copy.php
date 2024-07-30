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
    <form class="form-horizontal" action="<?php echo base_url();?>add-appointment" method="post" enctype="multipart/form-data"  role="form">
    <div class="row">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Basic Info</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                    <label for="patient_reg" class="col-sm-4 control-label">Registration Number<span class="text-red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="patient_reg" id="patient_reg" style="width: 100%;" value="<?php echo set_value('patient_reg'); ?>" required>
                            <option value="">Select Reg. No.</option>
                            <?php  if($patients){ foreach($patients as $patient) { ?>
                            <option value="<?php echo $patient->patient_id; ?>"><?php echo $patient->patient_reg_no; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Patient</option>
                          <?php } ?>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('patient_reg'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_name" class="col-sm-4 control-label">Doctor Name<span class="text-red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="doctor_name" id="doctor_name" style="width: 100%;" value="<?php echo set_value('doctor_name'); ?>" required>
                            <option value="">Select Doctor</option>
                            <?php  if($doctors){ foreach($doctors as $doctor) { ?>
                            <option value="<?php echo $doctor->doctor_id; ?>"><?php echo $doctor->doctor_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Doctor</option>
                          <?php } ?>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="type" class="col-sm-4 control-label">Appointment Type<span class="text-red">*</span></label>
                    <div class="col-sm-7">
                        <select class="form-control select2" name="type" id="type" style="width: 100%;" value="<?php echo set_value('type'); ?>" required>
                            <option value="">Select Type</option>
                            <option value="Consultation">Consultation</option>
                            <option value="Emergency">Emergency</option>
                            <option value="Followup">Followup</option>
                            <option value="General">General</option>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('type'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="app_date" class="col-sm-4 control-label">Appointment Date<span class="text-red">*</span></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control  pull-right datepicker2" id="app_date" name="app_date" value="<?php echo date('Y-m-d'); ?>" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('app_date'); ?></span>
                    </div>
                </div>
              </div>
               <div class="box-footer">
                 <div class="col-sm-offset-4 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                 </div>
                </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Patient Info</h3>
            </div>
              <div class="box-body" id="patient_info">

            </div>
        </div>
      </div>
    </div>
    </form>


    <div class="row">
        <div class="col-md-8">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Today Appointments list</h3>
            </div>
              <div class="box-body">
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>Appointment List of <?php echo date("d/m/Y"); ?></center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Registration #</th>
                        <th>Patient Name</th>
                        <th>Father Name</th>
                        <th>Age</th>
                        <th>Mobile</th>
                        <th>Doctor</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $x = 1;
                            if($appointments){
                            foreach($appointments as $patient){ ?>
                                <tr>
                                    <td style="width:12px;"><?php echo $x++; ?>.</td>
                                    <td><?php echo $patient->patient_reg_no;?></td>
                                    <td><?php echo $patient->patient_first_name." ".$patient->patient_last_name;?></td>
                                    <td><?php echo $patient->patient_father_name;?></td>
                                    <td>
                                        <?php
                                            if($patient->patient_dob != "0000-00-00")
                                            {
                                                $interval = date_diff(date_create(), date_create($patient->patient_dob));
                                                echo $interval->format("%Y Year, %M Months, %d Days");
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $patient->patient_mobile;?></td>
                                    <td><?php echo $patient->doctor_name;?></td>
                                    <td><?php echo $patient->appointment_type;?></td>
                                </tr>
                        <?php }} ?>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Doctor Wise Appointments Count</h3>
            </div>
              <div class="box-body" id="appointments_list">
                <table class="table table-bordered table-striped table-hover">
                    <caption><center>Appointment Count of <?php echo date("d/m/Y"); ?></center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Doctor</th>
                        <th>Appointment</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $a = 1;
                            if($doc_app){
                            foreach($doc_app as $app){ ?>
                                <tr>
                                    <td style="width:12px;"><?php echo $a++; ?>.</td>
                                    <td><?php echo $app->doctor_name; ?></td>
                                    <td><?php $date = date('Y-m-d');
                                              $app = $this->prescription_model->get_datewise_doctor_appointment_count($date, $app->doctor_id);
                                    echo count($app); ?>
                                    </td>
                                </tr>
                        <?php }} ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
</section>