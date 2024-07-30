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
         Client Information
        <small>Update Form<b class="box-title" style="color:red;"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Clients</li>
        <li class="active">Edit client</li>
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
            <form class="form-horizontal" id="" action="<?php echo base_url() . "update-client/" . $clients_info->client_id; ?>" method="post" enctype="multipart/form-data"  role="form">
              <div class="box-body">
                <div class="form-group">
                    <label for="client_name" class="col-sm-2 control-label">Client Name <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="client_name" id="client_name" value="<?php echo $clients_info->client_name; ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('client_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="business_name" class="col-sm-2 control-label">Business Name <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="business_name" id="business_name" value="<?php echo $clients_info->business_name; ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('business_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="client_email" class="col-sm-2 control-label">Email Address <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="client_email" id="client_email" value="<?php echo $clients_info->client_email; ?>" placeholder="" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('client_email'); ?></span>
                    </div>
                </div>
              
              <div class="form-group">
                    <label for="client_mobile" class="col-sm-2 control-label">Mobile No. <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="client_mobile" id="client_mobile" value="<?php echo $clients_info->client_mobile; ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('client_mobile'); ?></span>
                    </div>
                </div>
              
              <div class="form-group">
                    <label for="client_address" class="col-sm-2 control-label">Address </label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="client_address" id="client_address" placeholder=""><?php echo $clients_info->client_address; ?></textarea>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('client_address'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="package" class="col-sm-2 control-label">Package <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <select class="form-control select2" id="package_id" name="package_id" required>
                          <option value="<?php echo $clients_info->package_id; ?>"><?php echo $clients_info->package_name; ?></option>
                          <?php  if($package){ foreach($package as $info) { ?>
                            <option value="<?php echo $info->package_id; ?>"><?php echo $info->package_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Package</option>
                          <?php } ?>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('package_id'); ?></span>
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