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
        Manufacturer
        <small>Edit Form<b class="box-title" style="color:red;"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Manufacturer</li>
        <li class="active">Manage Manufacturer</li>
        <li class="active">Edit</li>
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
            <form class="form-horizontal" action="<?php echo base_url() . "update-manufacturer/" . $manufacturer_info->man_id; ?>" method="post" enctype="multipart/form-data"  role="form">
              <div class="box-body">
                <div class="form-group">
                    <label for="man_name" class="col-sm-2 control-label">Manufacturer Name <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="man_name" id="man_name" value="<?php echo $manufacturer_info->man_name; ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('man_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="man_email" class="col-sm-2 control-label">Email Address </label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" name="man_email" id="man_email" value="<?php echo $manufacturer_info->man_email; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('man_email'); ?></span>
                    </div>
                </div>
              
              <div class="form-group">
                    <label for="man_mobile" class="col-sm-2 control-label">Mobile No.</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="man_mobile" id="man_mobile" value="<?php echo $manufacturer_info->man_mobile; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('man_mobile'); ?></span>
                    </div>
                </div>
              
              <div class="form-group">
                    <label for="man_address" class="col-sm-2 control-label">Address </label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="man_address" id="man_address" placeholder=""><?php echo $manufacturer_info->man_address; ?></textarea>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('man_address'); ?></span>
                    </div>
              </div>

              <div class="form-group">
                    <label for="man_cr_amount" class="col-sm-2 control-label">Credit Amount</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="man_cr_amount" id="man_cr_amount" value="<?php echo $manufacturer_info->man_cr_amount; ?>" step="0.01">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('man_cr_amount'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="man_cr_amount_dt" class="col-sm-2 control-label">Daily Credit Limit</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="man_cr_amount_dt" id="man_cr_amount_dt" value="<?php echo $manufacturer_info->man_cr_amount_dt; ?>" step="0.01">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('man_cr_amount_dt'); ?></span>
                    </div>
                </div>

              </div>
              <div class="box-footer">
                 <div class="col-sm-offset-3 col-sm-10">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</section>

  