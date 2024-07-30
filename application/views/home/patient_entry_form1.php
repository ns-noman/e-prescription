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
        New Patient
        <small>Registration Form<b class="box-title text-red"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Transaction</li>
        <li class="active">Patient Registration</li>
    </ol>
</section>

<section class="content">
    <?php echo $success_msg; ?>
          <?php echo $error_msg; ?>
    <form class="form-horizontal" action="<?php echo base_url();?>add-patient" method="post" enctype="multipart/form-data"  role="form">
    <div class="row">
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Basic Info</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                    <label for="patient_name" class="col-sm-4 control-label">Patient Name</label>
                    <div class="col-sm-4">
                      First Name<span class="text-red">*</span><br>
                     <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('first_name'); ?></span>
                    </div>
                     <div class="col-sm-4">
                      Last Name<br>
                      <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo set_value('last_name'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('last_name'); ?></span>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="age" class="col-sm-4 control-label">Age<span class="text-red">*</span></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="age" id="age" value="<?php echo set_value('age'); ?>" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('age'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="mobile">Mobile<span class="text-red">*</span></label>
                    <div class="col-md-7">
                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo set_value('mobile'); ?>" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('mobile'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email Address</label>
                    <div class="col-md-7">
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('email'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="present_address">Present Address</label>
                    <div class="col-md-7">
                    <textarea class="form-control limited" name="present_address" id="present_address" maxlength="250"><?php echo set_value('present_address'); ?></textarea>
                        <span id="charNum" style="color:red;font-size: 10px;float: left;"><?php echo form_error('present_address'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gender" class="col-sm-4 control-label">Gender</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="gender" id="gender" value="<?php echo set_value('gender'); ?>">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Female">Other</option>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('gender'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="father_name" class="col-sm-4 control-label">Father's Name </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="father_name" id="father_name" value="<?php echo set_value('father_name'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('father_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mother_name" class="col-sm-4 control-label">Mother's Name </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="mother_name" id="mother_name" value="<?php echo set_value('mother_name'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('mother_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="national_id" class="col-sm-4 control-label">NID</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="national_id" id="national_id" value="<?php echo set_value('national_id'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('national_id'); ?></span>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="date_of_birth" class="col-sm-4 control-label">Date of Birth</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control  pull-right datepicker" id="date_of_birth" name="date_of_birth" value="<?php echo set_value('date_of_birth'); ?>" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('date_of_birth'); ?></span>
                    </div>
                </div> -->
              </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Info</h3>
            </div>
              <div class="box-body">
                
                <div class="form-group">
                    <label for="blood_group" class="col-sm-4 control-label">Blood Group</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="blood_group" id="blood_group" value="<?php echo set_value('blood_group'); ?>">
                            <option value="">Select Group</option>
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
                <div class="form-group">
                    <label class="col-sm-4 control-label">Height</label>
                    <div class="col-sm-3">
                        'Feet<br>
                        <select class="form-control" name="height_feet" id="height_feet" value="<?php echo set_value('height_feet'); ?>">
                            <option value=""></option>
                            <option value="3">3'</option>
                            <option value="4">4'</option>
                            <option value="5">5'</option>
                            <option value="6">6'</option>
                            <option value="7">7'</option>
                        </select>
                    </div>
                     <div class="col-sm-3">
                      "Inch<br>
                      <select class="form-control" name="height_inch" id="height_inch" value="<?php echo set_value('height_inch'); ?>">
                        <option value=""></option>
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
                    </div>
                </div>

                <div class="form-group">
                    <label for="weight_kg" class="col-sm-4 control-label">Weight (Kg)</label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control" name="weight_kg" id="weight_kg" value="<?php echo set_value('weight_kg'); ?>" step="0.01" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('weight_kg'); ?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="religion" class="col-sm-4 control-label">Religion</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="religion" id="religion" value="<?php echo set_value('religion'); ?>">
                            <option value="">Select Religion</option>
                            <option value="Islam">Islam</option>
                            <option value="Hinduism">Hinduism</option>
                            <option value="Buddhism">Buddhism</option>
                            <option value="Christianity">Christianity</option>
                            <option value="Other">Other</option>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('religion'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="marital_status" class="col-sm-4 control-label">Marital Status</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="marital_status" id="marital_status" value="<?php echo set_value('marital_status'); ?>">
                            <option value="">Select a Status</option>
                            <option value="Married">Married</option>
                            <option value="Single">Single</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('marital_status'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="occupation" class="col-sm-4 control-label">Occupation</label></label>
                    <div class="col-sm-7">
                        <select class="form-control" name="occupation" id="occupation" value="<?php echo set_value('occupation'); ?>">
                        <option value="">Select Occupation</option>
                        <option value="Job">Job</option>
                        <option value="Business">Business</option>
                        <option value="Service">Service</option>
                        <option value="Student">Student</option>
                    </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('occupation'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ref_doc_name" class="col-sm-4 control-label">Ref. Doctor Name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="ref_doc_name" id="ref_doc_name" value="<?php echo set_value('ref_doc_name'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('ref_doc_name'); ?></span>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="patient_image" class="col-sm-4 control-label">Patient Photo</label>
                    <div class="col-sm-7">
                        <input type="file" class="form-control" name="patient_image" id="patient_image" value="<?php echo set_value('patient_image'); ?>">
                        <span class="text-red">
                            Note: Please use a correct Image - .jpg, .jpeg, .png - Max Size[2MB, 600x600]
                            <?php echo form_error('patient_image'); ?>
                        </span>
                    </div>
                </div> -->

              </div>
            </div>
        </div>

        <div class="col-md-12">
          <div class="box">
              <div class="box-body">
                 <div class="col-sm-offset-5 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                 </div>
              </div>
            </div>
        </div>
    </div>
    </form>
    <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Patient List</h3>
            </div>
              <div class="box-body">
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>Patient List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Registration #</th>
                        <th>Patient Name</th>
                        <th>Father's Name</th>
                        <th>Age</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Blood Group</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $x = 1;
                            if($patient_info){
                            foreach($patient_info as $patient){ ?>
                                <tr>
                                    <td style="width:12px;"><?php echo $x++; ?>.</td>
                                    <td><?php echo $patient->patient_reg_no;?></td>
                                    <td><?php echo $patient->patient_first_name." ".$patient->patient_last_name;?></td>
                                    <td><?php echo $patient->patient_father_name;?></td>
                                    <td><?php echo $patient->patient_age;?></td>
                                    <td><?php echo $patient->patient_mobile;?></td>
                                    <td><?php echo $patient->patient_email;?></td>
                                    <td><?php echo $patient->patient_address;?></td>
                                    <td><?php echo $patient->patient_blood_group;?></td>
                                    <td>na</td>
                                </tr>
                        <?php }} ?>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</section>