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
        New Client
        <small>Entry Form<b class="box-title" style="color:red;"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Clients</li>
        <li class="active">New client</li>
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
            <form class="form-horizontal" action="<?php echo base_url();?>save-client" method="post" enctype="multipart/form-data"  role="form">
              <div class="box-body">
                <div class="form-group">
                    <label for="client_name" class="col-sm-2 control-label">Client Name <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="client_name" id="client_name" value="<?php echo set_value('client_name'); ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('client_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="business_name" class="col-sm-2 control-label">Business Name <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="business_name" id="business_name" value="<?php echo set_value('business_name'); ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('business_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="client_email" class="col-sm-2 control-label">Email Address <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="client_email" id="client_email" value="<?php echo set_value('client_email'); ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('client_email'); ?></span>
                    </div>
                </div>
              
              <div class="form-group">
                    <label for="client_mobile" class="col-sm-2 control-label">Mobile No. <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="client_mobile" id="client_mobile" value="<?php echo set_value('client_mobile'); ?>" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('client_mobile'); ?></span>
                    </div>
                </div>
              
              <div class="form-group">
                    <label for="client_address" class="col-sm-2 control-label">Address </label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="client_address" id="client_address" placeholder=""><?php echo set_value('client_address'); ?></textarea>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('client_address'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="package" class="col-sm-2 control-label">Package <span style="color:red;">*</span></label>
                    <div class="col-sm-4">
                        <select class="form-control select2" id="package_id" name="package_id" required>
                          <option value="">Select Project</option>
                          <?php  if($package){ foreach($package as $info) { ?>
                            <option value="<?php echo $info->package_id; ?>"><?php echo $info->package_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Package</option>
                          <?php } ?>
                        </select>
                        <!-- <a href="#" data-toggle="modal" data-target="#service_parts" >New Package</a> -->
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

<!-- Modal -->
  <div class="modal fade " id="service_parts" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Package</h4>
        </div>
        <div class="modal-body">
         
          <form class="form-horizontal" action="<?php echo base_url()?>admin/add_new_vendor_package" method="post" enctype="multipart/form-data"  role="form">
              <div class="box-body">
                <div class="form-group">
                    <label for="package_name" class="col-sm-4 control-label">Package Name <span style="color:red;">*</span></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="package_name" id="package_name" placeholder="Package Name" required >
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('package_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="package_price" class="col-sm-4 control-label">Package Price <span style="color:red;">*</span></label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control numbersOnly" name="package_price" id="package_price" placeholder="Package Price" required min="1">
                      <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('package_price'); ?></span>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="package_unit" class="col-sm-4 control-label">Package Unit <span style="color:red;">*</span> </label>
                    <div class="col-sm-6">
                         <select class="form-control select2" id="package_unit" name="package_unit" style="width: 100%;" required>
                          <option value="">Select Project</option>
                          <option value="Monthly">Monthly</option>
                          <option value="Yearly">Yearly</option>
                          <option value="Bill">Bill</option>
                        </select>
                      <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('package_unit'); ?></span>
                    </div>
                </div> -->

              </div>
              <div class="box-footer">
                 <div class="col-sm-offset-3 col-sm-10">
            <button type="submit" class="btn btn-primary" data-title="Delete" data-toggle="modal" data-target="#delete" >Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
    </div>
              </div>
            </form>


        </div>
    
        
      </div>
      
    </div>
  </div>