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
            Doses Duration Entry
            <small class="text-red">(*) Marked Fields are Required.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master Data Setup</li>
            <li class="active">Doses Duration</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Doses Duration List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>All Doses Duration List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Doses Duration (English)</th>
                        <th>Doses Duration (Bangla)</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-doses-duration/" . $edit_info->doses_duration_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <input type="text" class="form-control" name="doses_duration_eng" id="doses_duration_eng" value="<?php echo $edit_info->doses_duration_eng; ?>" required ><span class="text-red"> * <?php echo form_error('doses_duration_eng'); ?>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="doses_duration_ban" id="doses_duration_ban" value="<?php echo $edit_info->doses_duration_ban; ?>">
                      <span class="text-red"><?php echo form_error('doses_duration_ban'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-doses-duration" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <input type="text" class="form-control" name="doses_duration_eng" id="doses_duration_eng" required><span class="text-red"> * <?php echo form_error('doses_duration_eng'); ?></span>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="doses_duration_ban" id="doses_duration_ban">
                      <span class="text-red"><?php echo form_error('doses_duration_ban'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>

                    <?php
                    if ($doses_duration){ 
                    $x = 1;
                    foreach($doses_duration as $duration){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $duration->doses_duration_eng;?></td>
						            <td><?php echo $duration->doses_duration_ban  ;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-doses-duration/" . $duration->doses_duration_id; ?>">
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