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
        Doctor
        <small>Update Form<b class="box-title" style="color:red;"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Doctors</li>
        <li class="active">New Doctor</li>
        <li class="active">Edit Doctor</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
          <?php echo $success_msg; ?>
          <?php echo $error_msg; ?>
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Information Form</h3>
            </div>
            <form class="form-horizontal" action="<?php echo base_url() . "update-doctor/" . $doctors_info->doctor_id; ?>" method="post" enctype="multipart/form-data"  role="form">
              <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-4">
                        <img src="<?php echo base_url().$doctors_info->doctor_image; ?>" onerror="this.onerror=null;this.src='<?php echo base_url(); ?>assets/img/qr.png';" height="150" width="100">
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_name" class="col-sm-2 control-label">Doctor Name <span class="text-red">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="doctor_name" id="doctor" value="<?php echo $doctors_info->doctor_name; ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_username" class="col-sm-2 control-label">Login Username <span class="text-red">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="doctor_username" id="doctor_username" value="<?php echo $doctors_info->doctor_username; ?>" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_username'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_designation" class="col-sm-2 control-label">Designation</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="doctor_designation" id="doctor_designation" value="<?php echo $doctors_info->doctor_designation; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_designation'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_department" class="col-sm-2 control-label">Department <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <select class="form-control select2" name="doctor_department" id="doctor_department" style="width: 100%;" required="">
                            <option value="<?php echo $doctors_info->department_id; ?>"><?php echo $doctors_info->department_name; ?></option>
                            <?php if ($department) {
                                foreach ($department as $dept) {
                             ?>
                              <option value="<?php echo $dept->department_id; ?>"><?php echo $dept->department_name; ?></option>
                          <?php }} ?>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_department'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_email" class="col-sm-2 control-label">Email Address</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="doctor_email" id="doctor_email" value="<?php echo $doctors_info->doctor_email; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_email'); ?></span>
                    </div>
                </div>
              
              <div class="form-group">
                    <label for="doctor_mobile" class="col-sm-2 control-label">Mobile No. <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="doctor_mobile" id="doctor_mobile" value="<?php echo $doctors_info->doctor_mobile; ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_mobile'); ?></span>
                    </div>
                </div>

              <div class="form-group">
                    <label for="consultation_fee" class="col-sm-2 control-label">Consultation Fee (TK.)</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="consultation_fee" id="consultation_fee" value="<?php echo $doctors_info->doctor_consultation_fee; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('consultation_fee'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="emergency_fee" class="col-sm-2 control-label">Emergency Fee (TK.)</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="emergency_fee" id="emergency_fee" value="<?php echo $doctors_info->doctor_emergency_fee; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('emergency_fee'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="followup_fee" class="col-sm-2 control-label">Followup Fee (TK.)</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="followup_fee" id="followup_fee" value="<?php echo $doctors_info->doctor_followup_fee; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('followup_fee'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="general_fee" class="col-sm-2 control-label">Report Fee (TK.)</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="general_fee" id="general_fee" value="<?php echo $doctors_info->doctor_general_fee; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('general_fee'); ?></span>
                    </div>
                </div>

              <div class="form-group">
                    <label for="doctor_address" class="col-sm-2 control-label">Address </label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="doctor_address" id="doctor_address"><?php echo $doctors_info->doctor_address; ?></textarea>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_address'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_image" class="col-sm-2 control-label">Doctor Photo</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="doctor_image" id="doctor_image" value="<?php echo set_value('doctor_image'); ?>">
                        <input type="hidden" class="form-control" name="old_doctor_image" id="old_doctor_image" value="<?php echo $doctors_info->doctor_image; ?>">
                        <span style="color:red;font-size: 10px;float: left;">Please use a png, jpg or jpeg File. Max File size 2MB.<?php echo form_error('doctor_image'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_sign" class="col-sm-2 control-label">Doctor Signature</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="doctor_sign" id="doctor_sign" value="<?php echo set_value('doctor_sign'); ?>">
                        <input type="hidden" class="form-control" name="old_doctor_sign" id="old_doctor_sign" value="<?php echo $doctors_info->doctor_sign; ?>">
                        <span style="color:red;font-size: 10px;float: left;">Please use a png, jpg or jpeg File. Max File size 2MB.<?php echo form_error('doctor_sign'); ?></span>
                    </div>
                    <div class="col-sm-2">
                        <img src="<?php echo base_url().$doctors_info->doctor_sign; ?>" onerror="this.onerror=null;this.src='<?php echo base_url(); ?>assets/img/qr.png';" height="50" width="100">
                    </div>
                </div>


                <div class="form-group">
                    <label for="doctor_seal" class="col-sm-2 control-label">Seal (English)</label>
                    <div class="col-sm-6">
                        <textarea class="form-control editor1" id="doctor_seal" name="doctor_seal" rows="50"><?php echo $doctors_info->doctor_seal; ?></textarea>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_seal'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="doctor_seal_bn" class="col-sm-2 control-label">Seal (Bangla)</label>
                    <div class="col-sm-6">
                        <textarea class="form-control editor1" id="doctor_seal_bn" name="doctor_seal_bn" rows="50"><?php echo $doctors_info->doctor_seal_bn; ?></textarea>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_seal_bn'); ?></span>
                    </div>
                </div>

              </div>
              <div class="box-footer">
                 <div class="col-sm-offset-4 col-sm-10">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</section>