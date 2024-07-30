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
            Shift Entry
            <small class="text-red">(*) Marked Fields are Required.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master Data Setup</li>
            <li class="active">Shift Entry</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>All shift List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Shift Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-shift/" . $edit_info->shift_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <input type="text" class="form-control" name="shift_name" id="shift_name" value="<?php echo $edit_info->shift_title; ?>" required ><span class="text-red"> * <?php echo form_error('shift_name'); ?>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="shift_start" id="shift_start" value="<?php echo $edit_info->shift_start; ?>" required placeholder="00:00 AM/PM" autocomplete="off"><span class="text-red"> * <?php echo form_error('shift_start'); ?>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="shift_end" id="shift_end" value="<?php echo $edit_info->shift_end; ?>" required placeholder="00:00 AM/PM" autocomplete="off"><span class="text-red"> * <?php echo form_error('shift_end'); ?>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-shift" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <input type="text" class="form-control" name="shift_name" id="shift_name" required><span class="text-red"> * <?php echo form_error('shift_name'); ?></span>
                    </td>
                    <td>
                      <input type="text" class="form-control timepicker" name="shift_start" id="shift_start" required placeholder="00:00 AM/PM" autocomplete="off"><span class="text-red"> * <?php echo form_error('shift_start'); ?>
                    </td>
                    <td>
                      <input type="text" class="form-control timepicker" name="shift_end" id="shift_end" required placeholder="00:00 AM/PM" autocomplete="off"><span class="text-red"> * <?php echo form_error('shift_end'); ?>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>

                    <?php
                    if ($shift){ 
                    $x = 1;
                    foreach($shift as $dept){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $dept->shift_title;?></td>
                        <td><?php echo $dept->shift_start;?></td>
                        <td><?php echo $dept->shift_end;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-shift/" . $dept->shift_id; ?>">
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