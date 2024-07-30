	<!-- Content Header (Page header) -->
    <section class="content-header">
    <?php
		$success_msg = $this->session->userdata('success');
		$error_msg = $this->session->userdata('error');
		$this->session->unset_userdata('success');
		$this->session->unset_userdata('error');
	?>
      <h1>
        New User 
        <small>Information Form. <b class="text-red">( * ) Marked Fields are Required.</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Users</li>
		<li class="active">New User</li>
      </ol>
    </section>

    <!-- Main content -->
  
		
		<section class="content">
      <form class="form-horizontal" action="<?php echo base_url();?>add-user" method="post" enctype="multipart/form-data"  role="form">
      <div class="row">
       
        <!-- left column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <!-- <div class="box-header with-border">
              
            </div> -->
            <!-- /.box-header -->
            <!-- form start -->
							<?php echo $success_msg; ?>
							<?php echo $error_msg; ?>
							<br>
			<div class="box-body">				
           
								  
			  <div class="form-group">
				<label for="name" class="col-sm-4 control-label">Full Name <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name'); ?>" required>
				  <span class="text-red"><?php echo form_error('name'); ?></span>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="user_designation" class="col-sm-4 control-label">Designation</label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="user_designation" id="user_designation" value="<?php echo set_value('user_designation'); ?>">
				  <span class="text-red"><?php echo form_error('user_designation'); ?></span>
				</div>
			  </div>
			  
			   <div class="form-group">
				<label for="email" class="col-sm-4 control-label">Username <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" required>
				  <span class="text-red"><?php echo form_error('email'); ?></span>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="password" class="col-sm-4 control-label">Password <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <input type="password" class="form-control" name="password" id="password" required>
				  <span class="text-red">Minimum 6 Character and Special Characters (e.g : #, $, @, _) required<?php echo form_error('password'); ?></span>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="repassword" class="col-sm-4 control-label">Retype password <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <input type="password" class="form-control" name="repassword" id="repassword" required>
				  <span class="text-red"><?php echo form_error('repassword'); ?></span>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="type" class="col-sm-4 control-label">User Type <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <select class="form-control" name="type" id="type" value="<?php echo set_value('type'); ?>" required>
                        <option value="">Select Role</option>
                        <?php if($this->session->userdata('user_type') == "Super Admin"){ ?>
                        <option value="Admin">Admin</option>
                        <?php } ?>
                        <option value="Operator">Operator</option>
                  </select>
                        <span class="text-red"><?php echo form_error('type'); ?></span>
             </div>
          </div>
            <br>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger">Reset</button>

                </div>
            </div>

           
            <br>
            </div>
        </div>
          <!-- /.box -->

      </div>
            <!--/.col (left) -->

            <!-- right column -->
            <div class="col-md-6">

                <div class="box box-info">
                    <div class="box-header with-border">
                        <center><h4>System Access Privileges</h4></center>
                    </div>
                    <br>
                    <div class="box-body" id="menus">
                        <div id="admin">
                        	<dl class="dl-horizontal">
		                        <dt>Admin :</dt>
		                        <dd>All Modules permission.</dd>
		                        
							</dl>
                        </div>

                        <div id="operator">
                        	<label>
	                          Menu Privilege
	                        </label><br>
	                        <?php if ($menu) {foreach ($menu as $men) {?>
                        	<label>
	                          <input type="checkbox" class="minimal1" name="menue_prev[]" value="<?php echo $men->menu_id;?>"> <?php echo $men->menu_name;?>
	                        </label><br>
	                    <?php }} ?>
                        </div>
                        
					</div>
				</div>
			</div>
		 <!--/.col (right) -->
      </div>
      <!-- /.row -->
	   </form>
    </section>
					
    <!-- /.content -->
