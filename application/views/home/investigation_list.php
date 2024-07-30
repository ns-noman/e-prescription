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
            Investigation Entry
            <small class="text-red">(*) Marked Fields are Required.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master Data Setup</li>
            <li class="active">Investigation Entry</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Investigation List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>All Investigation List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Investigation Type</th>
                        <th>Test Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-investigation/" . $edit_info->investigation_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <select class="form-control select2" id="investigation_type_id" name="investigation_type_id" required>
                          <option value="<?php echo $edit_info->investigation_type_id; ?>"><?php echo $edit_info->investigation_type; ?></option>
                          <?php  if($investigation_type){ foreach($investigation_type as $type) { ?>
                            <option value="<?php echo $type->investigation_type_id; ?>"><?php echo $type->investigation_type; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Type</option>
                          <?php } ?>
                        </select>
                      <span class="text-red"> * <?php echo form_error('investigation_type_id'); ?>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="investigation" id="investigation" value="<?php echo $edit_info->investigation; ?>" required>
                      <span class="text-red">* <?php echo form_error('investigation'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-investigation" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <select class="form-control select2" id="investigation_type_id" name="investigation_type_id" required>
                          <option value="">Select Type</option>
                          <?php  if($investigation_type){ foreach($investigation_type as $type) { ?>
                            <option value="<?php echo $type->investigation_type_id; ?>"><?php echo $type->investigation_type; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Type</option>
                          <?php } ?>
                        </select>
                      <span class="text-red"> * <?php echo form_error('investigation_type_id'); ?></span>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="investigation" id="investigation" required>
                      <span class="text-red">* <?php echo form_error('investigation'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>

                    <?php
                    if ($investigation){ 
                    $x = 1;
                    foreach($investigation as $inv){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $inv->investigation_type;?></td>
						            <td><?php echo $inv->investigation;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-investigation/" . $inv->investigation_id; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Edit
                            </a>
                        </td>
                        </tr>
                    <?php } }else{ echo "No data  found!";}?>
                    </tbody>
                </table>
				
            </div>
            <!-- /.box-body -->
        </div>




        <!-- /.row -->

    </section>