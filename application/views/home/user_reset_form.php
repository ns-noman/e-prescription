<!-- Content Header (Page header) -->
    <section class="content-header">
    <?php
		$success_msg = $this->session->userdata('success');
		$error_msg = $this->session->userdata('error');
		$this->session->unset_userdata('success');
		$this->session->unset_userdata('error');
	?>
      <h1>
       Re-Set User 
        <small>Information Form. <b style="color:red;">( * ) Marked Fields are Required.</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Users</li>
		<li class="active">Re-Set User</li>
      </ol>
    </section>

    <!-- Main content -->
  
		
		<section class="content">
     <form class="form-horizontal" action="<?php echo base_url() . "update-user/" . $update_user->user_id; ?>" method="post" enctype="multipart/form-data"  role="form">
      <div class="row">
       
        <!-- left column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
							<?php echo $success_msg; ?>
							<?php echo $error_msg; ?>
							<br>
							
           
								  
			  <div class="form-group">
				<label for="name" class="col-sm-4 control-label">full Name <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="name" id="name" value="<?php echo $update_user->user_name; ?>" required >
				  <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('name'); ?></span>
				</div>
			  </div>
			  
			   <div class="form-group">
				<label for="user_designation" class="col-sm-4 control-label">Designation </label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="user_designation" id="user_designation" value="<?php echo $update_user->user_designation; ?>">
				  <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('user_designation'); ?></span>
				</div>
			  </div>
			  
			   <div class="form-group">
				<label for="email" class="col-sm-4 control-label">Username </label>
				<div class="col-sm-6">
				  <input type="text" class="form-control" name="email" id="email" value="<?php echo $update_user->user_email; ?>" placeholder="" readonly>
				  <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('email'); ?></span>
				</div>
			  </div>
              
			  <div class="form-group">
				<label for="type" class="col-sm-4 control-label">User Type <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <select class="form-control" name="type" id="type" value="<?php echo set_value('type'); ?>">
					<option value="<?php echo $update_user->user_type; ?>"><?php echo $update_user->user_type; ?></option>
					 <?php if($this->session->userdata('user_type') == "Super Admin"){ ?>
                        <option value="Admin">Admin</option>
                        <?php } ?>
                        <option value="Operator">Operator</option>
				  </select>
				  <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('type'); ?></span>
				</div>
			  </div>
			
			  <br>
			  
			  <div class="form-group">
				<div class="col-sm-offset-4 col-sm-10">
				  <button type="submit" class="btn btn-primary">Update</button>
				  
				</div>
			  </div>
			
			
			<br>
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
	                        <?php
                            $privilege_set = array_column($privilege, 'menu_id');
                            
							 if ($menu) {foreach ($menu as $men) {?>
                        	<label>
	                          <input type="checkbox" class="minimal1" name="menue_prev[]" value="<?php echo $men->menu_id;?>" <?php if(in_array($men->menu_id, $privilege_set)) echo "checked=\"checked\""; ?>> <?php echo $men->menu_name;?>
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
