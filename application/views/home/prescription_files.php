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
        Patient Files
        <small>Form<b class="box-title text-red"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Transaction</li>
        <li class="active">Prescriptions</li>
        <li class="active">Patient Files</li>
    </ol>
</section>

<section class="content">
    <?php echo $success_msg; ?>
          <?php echo $error_msg; ?>
    
    <div class="row">
        <form class="form-horizontal" action="<?php echo base_url() . "add-prescription-file/" . $pre_info->prescription_id; ?>" method="post" enctype="multipart/form-data"  role="form">
            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">File Info</h3>
                </div>
                  <div class="box-body">
                    <div class="form-group">
                        <label for="file_name" class="col-sm-4 control-label">File Name<span class="text-red">*</span></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="file_name" id="file_name" value="<?php echo set_value('file_name'); ?>" required>
                            <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('file_name'); ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="patient_file" class="col-sm-4 control-label">File Upload<span class="text-red">*</span></label>
                        <div class="col-sm-7">
                           <input type="file" class="form-control" name="patient_file" id="patient_file" value="<?php echo set_value('patient_file'); ?>" required>
                            <span style="color:red;font-size: 10px;float: left;">
                                Please use a png, jpg, jpeg, pdf, docx or doc File. Max File size 2MB.
                                <?php echo form_error('patient_file'); ?></span>
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
        </form>

        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Patient Files</h3>
            </div>
              <div class="box-body" id="file_info">
                <div class="col-md-12">
                    <label class="col-md-4 control-label">Patient Name</label>
                    <label class="col-md-8 control-label"><?php echo $pre_info->patient_first_name." ".$pre_info->patient_last_name; ?></label>
                </div>
                <div class="col-md-12">
                    <label class="col-md-4 control-label">Patient Reg.</label>
                    <label class="col-md-8 control-label"><?php echo $pre_info->pre_reg_no; ?></label>
                </div>
                <div class="col-md-12">
                    <label class="col-md-4 control-label">Prescription No.</label>
                    <label class="col-md-8 control-label"><?php echo $pre_info->prescription_no; ?></label>
                </div>
                <div class="col-md-12">
                    <?php if ($file_info) { ?>
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>SL.</th>
                            <th>File Name</th>
                            <th>Action</th>
                        </tr>
                        <?php $x = 1;
                            foreach ($file_info as $file) {
                        ?>
                        <tr>
                            <td style="width:12px;"><?php echo $x++; ?>.</td>
                            <td><?php echo $file->pre_file_name;?></td>
                            <td>
                                <a  href="<?php echo base_url() . "download/". $file->pre_file_id; ?>">
                                <i class="glyphicon glyphicon-download"></i> Download</a>
                                <!-- <a  href="<?php echo base_url() . $file->pre_file; ?>" target="_blank">
                                <i class="glyphicon glyphicon-download"></i> View</a> -->
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                <?php }else{echo "No Files Found!";} ?>
                </div>
                

            </div>
        </div>
      </div>
    </div>
    

</section>