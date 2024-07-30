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
          <?php if ($edit_info) {?>
             <form class="form-horizontal" action="<?php echo base_url().'update-patient/'.$edit_info->patient_id;?>" method="post" enctype="multipart/form-data"  role="form">
    <div class="row">
        <div class="col-md-6">
          <div class="box box-info">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Basic Info</h3>
            </div> -->
              <div class="box-body" style="height: 350px;">
                
                <div class="form-group">
                    <label class="col-md-3 control-label" for="mobile">Patient Name<span class="text-red">*</span></label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $edit_info->patient_first_name; ?>" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('first_name'); ?></span>
                    </div>
                </div>



                <div class="form-group">
                    <label for="age" class="col-sm-3 control-label">Age</label>
                    <?php
                        if($edit_info->patient_dob != "0000-00-00")
                        {
                            $interval = date_diff(date_create(), date_create($edit_info->patient_dob));
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
                      Day<span class="text-red">*</span><br>
                      <input type="number" class="form-control" name="day" id="day" value="<?php echo $day; ?>" required autocomplete="off" min="0">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('day'); ?></span>
                    </div>

                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label" for="mobile">Mobile<span class="text-red">*</span></label>
                    <div class="col-md-7">
                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $edit_info->patient_mobile; ?>" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('mobile'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Email</label>
                    <div class="col-md-7">
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $edit_info->patient_email; ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('email'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="present_address">Present Address</label>
                    <div class="col-md-7">
                    <textarea class="form-control limited" name="present_address" id="present_address" maxlength="250"><?php echo $edit_info->patient_address; ?></textarea>
                        <span id="charNum" style="color:red;font-size: 10px;float: left;"><?php echo form_error('present_address'); ?></span>
                    </div>
                </div>
              </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Basic Info</h3>
            </div> -->
              <div class="box-body" style="height: 350px;">
                <div class="form-group">
                    <label for="gender" class="col-sm-5 control-label">Gender</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="gender" id="gender" value="<?php echo set_value('gender'); ?>">
                            <option value="<?php echo $edit_info->patient_gender; ?>"><?php echo $edit_info->patient_gender; ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Female">Other</option>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('gender'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="blood_group" class="col-sm-5 control-label">Blood Group</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="blood_group" id="blood_group" value="<?php echo set_value('blood_group'); ?>">
                            <option value="<?php echo $edit_info->patient_blood_group; ?>"><?php echo $edit_info->patient_blood_group; ?></option>
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
                    <label for="father_name" class="col-sm-5 control-label">Father's Name </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="father_name" id="father_name" value="<?php echo $edit_info->patient_father_name; ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('father_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mother_name" class="col-sm-5 control-label">Mother's Name </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="mother_name" id="mother_name" value="<?php echo $edit_info->patient_mother_name; ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('mother_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="national_id" class="col-sm-5 control-label">NID</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="national_id" id="national_id" value="<?php echo $edit_info->patient_nid; ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('national_id'); ?></span>
                    </div>
                </div>

                
                <div class="form-group">
                    <label for="religion" class="col-sm-5 control-label">Religion</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="religion" id="religion" value="<?php echo set_value('religion'); ?>">
                            <option value="<?php echo $edit_info->patient_religion; ?>"><?php echo $edit_info->patient_religion; ?></option>
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
                    <label for="occupation" class="col-sm-5 control-label">Occupation</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="occupation" id="occupation" value="<?php echo set_value('occupation'); ?>">
                        <option value="<?php echo $edit_info->patient_occupation; ?>"><?php echo $edit_info->patient_occupation; ?></option>
                        <option value="Job">Job</option>
                        <option value="Business">Business</option>
                        <option value="Service">Service</option>
                        <option value="Student">Student</option>
                        <option value="Housewife">Housewife</option>
                        <option value="Unemployed">Unemployed</option>
                        <option value="Other">Other</option>
                    </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('occupation'); ?></span>
                    </div>
                </div>

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
          <?php }else{ ?>
 <form class="form-horizontal" action="<?php echo base_url();?>add-patient" method="post" enctype="multipart/form-data"  role="form">
    <div class="row">
        <div class="col-md-6">
          <div class="box box-info">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Basic Info</h3>
            </div> -->
              <div class="box-body" style="height: 350px;">
                
                <div class="form-group">
                    <label class="col-md-3 control-label" for="mobile">Patient Name<span class="text-red">*</span></label>
                    <div class="col-md-9">
                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('first_name'); ?></span>
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
                      Day<span class="text-red">*</span><br>
                      <input type="number" class="form-control" name="day" id="day" value="0" required autocomplete="off" min="0">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('day'); ?></span>
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
                    <label class="col-md-4 control-label" for="email">Email</label>
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
              </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Basic Info</h3>
            </div> -->
              <div class="box-body" style="height: 350px;">
                <div class="form-group">
                    <label for="gender" class="col-sm-5 control-label">Gender</label>
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
                    <label for="blood_group" class="col-sm-5 control-label">Blood Group</label>
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
                    <label for="father_name" class="col-sm-5 control-label">Father's Name </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="father_name" id="father_name" value="<?php echo set_value('father_name'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('father_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mother_name" class="col-sm-5 control-label">Mother's Name </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="mother_name" id="mother_name" value="<?php echo set_value('mother_name'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('mother_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="national_id" class="col-sm-5 control-label">NID</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="national_id" id="national_id" value="<?php echo set_value('national_id'); ?>" autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('national_id'); ?></span>
                    </div>
                </div>

                
                <div class="form-group">
                    <label for="religion" class="col-sm-5 control-label">Religion</label>
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
                    <label for="occupation" class="col-sm-5 control-label">Occupation</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="occupation" id="occupation" value="<?php echo set_value('occupation'); ?>">
                        <option value="">Select Occupation</option>
                        <option value="Job">Job</option>
                        <option value="Business">Business</option>
                        <option value="Service">Service</option>
                        <option value="Student">Student</option>
                        <option value="Housewife">Housewife</option>
                        <option value="Unemployed">Unemployed</option>
                        <option value="Other">Other</option>
                    </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('occupation'); ?></span>
                    </div>
                </div>

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

<?php } ?>

    <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Patient List</h3>
            </div>
              <div class="box-body">
                 <div class="form-group">
                <div class="input-group">
                 <span class="input-group-addon">Search</span>
                 <input type="text" name="patient_search" id="patient_search" placeholder="Registration #, Name or Mobile" class="form-control" />
                </div>
               </div>
               <div id="patient_result">
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
                                    <td><?php echo $patient->patient_email;?></td>
                                    <td><?php echo $patient->patient_address;?></td>
                                    <td><?php echo $patient->patient_blood_group;?></td>
                                    <td><a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-patient/" . $patient->patient_id; ?>">Edit</a>
                                    </td>
                                </tr>
                        <?php }} ?>
                    </tbody>
                </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>