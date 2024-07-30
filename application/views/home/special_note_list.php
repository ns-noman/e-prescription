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
            Special Note Entry
            <small class="text-red">(*) Marked Fields are Required.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master Data Setup</li>
            <li class="active">Special Note Entry</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Special Note List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>All Special Note List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Special Note (English)</th>
                        <th>Special Note (বাংলা)</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-special-note/" . $edit_info->special_note_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <textarea class="form-control" name="special_note_eng" id="special_note_eng" required placeholder="Write Description Here........" cols="50" maxlength="250"><?php echo $edit_info->special_note_eng; ?></textarea>
                      <span class="text-red"> * <?php echo form_error('special_note_eng'); ?></span>
                    </td>
                    <td>
                      <textarea class="form-control" name="special_note_ban" id="special_note_ban" placeholder="বিবরণ গুলো লিখুন......" cols="50" maxlength="250"><?php echo $edit_info->special_note_ban; ?></textarea>
                      <span class="text-red"><?php echo form_error('special_note_ban'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-special-note" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <textarea class="form-control" name="special_note_eng" id="special_note_eng" required placeholder="Write Description Here........" cols="50" maxlength="250"></textarea>
                      <span class="text-red"> * <?php echo form_error('special_note_eng'); ?></span>
                    </td>
                    <td>
                      <textarea class="form-control" name="special_note_ban" id="special_note_ban" placeholder="বিবরণ গুলো লিখুন......" cols="50" maxlength="250"></textarea>
                      <span class="text-red"><?php echo form_error('special_note_ban'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>

                    <?php
                    if ($special_note){ 
                    $x = 1;
                    foreach($special_note as $advice){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $advice->special_note_eng;?></td>
						            <td><?php echo $advice->special_note_ban  ;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-special-note/" . $advice->special_note_id; ?>">
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