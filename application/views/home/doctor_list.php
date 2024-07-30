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
            Doctor List
            <small>All</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Doctors</li>
            <li class="active">Doctor List</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Doctor List</h3>
				<h3 class="box-title" style="float:right;"><a href="<?php echo base_url(); ?>new-doctor" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New Entry</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				<?php if ($doctors){ ?>
                <table class="table table-bordered table-striped table-hover example2">
                <caption>All doctor List</caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th style="min-width:300px;">Doctor Name</th>
                        <th style="min-width:100px;">Login Username</th>
                         <th style="min-width:200px;">Designation</th>
						 <th>Department</th>
                        <th>Mobile No.</th>
                        <th>Email Address</th>
                        <th>Address</th>
                        <!-- <th style="min-width:200px;">Seal</th> -->
                        <th style="min-width:300px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $x = 1;
                    foreach($doctors as $doctor){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $doctor->doctor_name;?></td>
                        <td><?php echo $doctor->doctor_username;?></td>
                        <td><?php echo $doctor->doctor_designation;?></td>
						<td><?php echo $doctor->department_name;?></td>
                        <td><?php echo $doctor->doctor_mobile;?></td>
                        <td><?php echo $doctor->doctor_email;?></td>
                        <td><?php echo $doctor->doctor_address;?></td>
                        <!-- <td><?php //echo $doctor->doctor_seal;?></td> -->
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-doctor/" . $doctor->doctor_id; ?>">
                                View | Edit
                            </a>
                            <?php if($doctor->doctor_status == 1){ ?>
                            <a class="btn btn-success btn-xs" href="<?php echo base_url() . "deactivate-doctor/" . $doctor->doctor_id; ?>">
                                <i class="glyphicon glyphicon-eye-open"> Activated</i>
                            </a>
                            <?php } else if($doctor->doctor_status == 0){ ?>
                            <a class="btn btn-danger btn-xs" href="<?php echo base_url() . "activate-doctor/" . $doctor->doctor_id; ?>">
                                <i class="glyphicon glyphicon-eye-close"> Deactivated</i>
                            </a>
                            <?php } ?>

                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "reset-password/" . $doctor->doctor_id; ?>">
                                <i class="glyphicon glyphicon-lock"></i>  
                                Reset Password                                         
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