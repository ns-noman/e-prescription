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
            Manage Manufacturer
            <small>All</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Manufacturer</li>
            <li class="active">Manage Manufacturer</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Manufacturer List</h3>
				<h3 class="box-title" style="float:right;"><a href="<?php echo base_url(); ?>new-manufacturer" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> New Entry</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				<?php if ($manufacturer_info){ ?>
                <table class="table table-bordered table-striped table-hover example2">
                <caption>All Manufacturer List</caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Name</th>
                        <th>Mobile No.</th>
                        <th>Email Address</th>
                        <th>Address</th>
                        <th>Credit Amount</th>
						<th>Daily Credit Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $x = 1;
                    foreach($manufacturer_info as $info){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $info->man_name;?></td>
                        <td><?php echo $info->man_mobile;?></td>
                        <td><?php echo $info->man_email;?></td>
                        <td><?php echo $info->man_address;?></td>
                        <td><?php echo $info->man_cr_amount;?></td>
						<td><?php echo $info->man_cr_amount_dt;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-manufacturer/" . $info->man_id; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Edit
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