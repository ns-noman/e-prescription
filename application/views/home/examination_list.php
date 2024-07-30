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
            Examination Entry
            <small class="text-red">(*) Marked Fields are Required.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master Data Setup</li>
            <li class="active">Examination Entry</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Examination List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>All Examination List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Exam Description (English)</th>
                        <th>Exam Description (বাংলা)</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-examination/" . $edit_info->examination_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <textarea class="form-control" name="examination_eng" id="examination_eng" required placeholder="Write Description Here........" cols="50" maxlength="250"><?php echo $edit_info->examination_eng; ?></textarea>
                      <span class="text-red"> * <?php echo form_error('examination_eng'); ?></span>
                    </td>
                    <td>
                      <textarea class="form-control" name="examination_ban" id="examination_ban" placeholder="বিবরণ গুলো লিখুন......" cols="50" maxlength="250"><?php echo $edit_info->examination_ban; ?></textarea>
                      <span class="text-red"><?php echo form_error('examination_ban'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-examination" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <textarea class="form-control" name="examination_eng" id="examination_eng" required placeholder="Write Description Here........" cols="50" maxlength="250"></textarea>
                      <span class="text-red"> * <?php echo form_error('examination_eng'); ?></span>
                    </td>
                    <td>
                      <textarea class="form-control" name="examination_ban" id="examination_ban" placeholder="বিবরণ গুলো লিখুন......" cols="50" maxlength="250"></textarea>
                      <span class="text-red"><?php echo form_error('examination_ban'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>

                    <?php
                    if ($examination){ 
                    $x = 1;
                    foreach($examination as $exam){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $exam->examination_eng;?></td>
						            <td><?php echo $exam->examination_ban  ;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-examination/" . $exam->examination_id; ?>">
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