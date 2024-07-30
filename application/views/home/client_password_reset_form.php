 <?php
		$success_msg = $this->session->userdata('success');
		$error_msg = $this->session->userdata('error');
		?>
		<?php
		$this->session->unset_userdata('success');
		$this->session->unset_userdata('error');
		?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Re-Set Password 
        <small>Information Form. <b style="color:red;">( * ) Marked Fields are Required.</b></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Clients</li>
        <li class="active">Client List </li>
		<li class="active">Reset Password</li>
      </ol>
    </section>

    <!-- Main content -->
  
		
		<section class="content">
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
							
           <form class="form-horizontal" action="<?php echo base_url(); ?>update-client-password" method="post" enctype="multipart/form-data"  role="form">
				
			   <div class="form-group">
				<label for="email" class="col-sm-4 control-label">Email Address <!--<span style="color:red;">*</span>--></label>
				<div class="col-sm-6">
				<input type="hidden" name="client_id" value="<?php echo $client_info->client_id;?>">
				  <input type="text" class="form-control" name="email" id="email" value="<?php echo $client_info->client_email; ?>" readonly>
				  <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('email'); ?></span>
				</div>
			  </div>
			  
			   <div class="form-group">
				<label for="password" class="col-sm-4 control-label">Password <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <input type="password" class="form-control" name="password" id="password" required>
				  <span style="color:red;font-size: 10px;float: left;">Minimum 6 Character and Special Characters (e.g : #, $, @, _) required<?php echo form_error('password'); ?></span>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="repassword" class="col-sm-4 control-label">Retype password <span style="color:red;">*</span></label>
				<div class="col-sm-6">
				  <input type="password" class="form-control" name="repassword" id="repassword" required>
				  <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('repassword'); ?></span>
				</div>
			  </div>
			  <br>
			  
			  <div class="form-group">
				<div class="col-sm-offset-4 col-sm-10">
				  <button type="submit" class="btn btn-primary">Submit</button>
				  <button type="reset" class="btn btn-danger">Reset</button>
				  
				</div>
			  </div>
			
			</form>
			<br>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (left) -->
		
		
      </div>
      <!-- /.row -->
	  
    </section>
					
    <!-- /.content -->
  