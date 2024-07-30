	<!-- Content Header (Page header) -->
    <section class="content-header">
    <?php
	$success_msg = $this->session->userdata('success');
	$error_msg = $this->session->userdata('error');
	$this->session->unset_userdata('success');
	$this->session->unset_userdata('error');
?>
      <h1>
        User List
        <small>All</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Users</li>
        <li class="active">User List</li>
      </ol>
    </section>

    <!-- Main content -->
  
		
		<section class="content">
      
       
       <div class="box">
            <div class="box-header">
              <h3 class="box-title">All User List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<?php echo $success_msg; ?>
			<?php echo $error_msg; ?>
			<?php if ($users){ ?>
              <table class="table table-bordered table-striped table-hover example2">
                <thead>
                <tr>
					<th style="width:30px;">SL.</th>
					<th style="min-width:200px;">Full Name</th>
					<th>Designation</th>
					<th>Username</th>
					<th>User Type</th>
					<th>User Status</th>
					<th style="min-width:200px;">Action</th>
				</tr>
                </thead>
                <tbody>
				<tr>
                <?php
						$x = 1;
								foreach($users as $user){
							?>
										<td style="width:10px;"><?php echo $x++; ?>.</td>
										<td><?php echo $user->user_name;?></td>
										<td><?php echo $user->user_designation;?></td>
										<td><?php echo $user->user_email;?></td>
										<td width="100"><?php echo $user->user_type;?></td>
										<td>
											<?php
											
											if($user->user_status == 1){ ?>
											
											<a class="btn btn-success btn-xs" href="<?php echo base_url() . "deactivate-user/" . $user->user_id; ?>">
												<i class="glyphicon glyphicon-eye-open"></i>  
												Active                                            
											</a>
												
											<?php }else{ ?>
												
											
											<a class="btn btn-danger btn-xs" href="<?php echo base_url() . "activate-user/" . $user->user_id; ?>">
												<i class="glyphicon glyphicon-eye-close"></i>  
												Deactivated                                          
											</a>
											 <?php } ?>
										</td>
										<td>
											<a class="btn btn-primary btn-xs" href="<?php echo base_url() . "reset-user/" . $user->user_id; ?>">
												<i class="glyphicon glyphicon-pencil"></i>  
												Edit                                           
											</a>
											
											<a class="btn btn-primary btn-xs" href="<?php echo base_url() . "reset-password/" . $user->user_id; ?>">
												<i class="glyphicon glyphicon-pencil"></i>  
												Re-set Password                                         
											</a>
											
										</td>
									</tr>
									<?php } ?>
                </tbody>
              </table>
			  <?php }else{ echo "No data  found!";} ?>
            </div>
            <!-- /.box-body -->
          </div>
        
		
		 
		
      <!-- /.row -->
	  
    </section>
					
    <!-- /.content -->