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
            Health Advice Entry
            <small class="text-red">(*) Marked Fields are Required.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master Data Setup</li>
            <li class="active">Health Advice Entry</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Health Advice List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>All Health Advice List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Health Advice (English)</th>
                        <th>Health Advice (বাংলা)</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-health-advice/" . $edit_info->health_advice_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <textarea class="form-control" name="health_advice_eng" id="health_advice_eng" required placeholder="Write Description Here........" cols="50" maxlength="250"><?php echo $edit_info->health_advice_eng; ?></textarea>
                      <span class="text-red"> * <?php echo form_error('health_advice_eng'); ?></span>
                    </td>
                    <td>
                      <textarea class="form-control" name="health_advice_ban" id="health_advice_ban" placeholder="বিবরণ গুলো লিখুন......" cols="50" maxlength="250"><?php echo $edit_info->health_advice_ban; ?></textarea>
                      <span class="text-red"><?php echo form_error('health_advice_ban'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-health-advice" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <textarea class="form-control" name="health_advice_eng" id="health_advice_eng" required placeholder="Write Description Here........" cols="50" maxlength="250"></textarea>
                      <span class="text-red"> * <?php echo form_error('health_advice_eng'); ?></span>
                    </td>
                    <td>
                      <textarea class="form-control" name="health_advice_ban" id="health_advice_ban" placeholder="বিবরণ গুলো লিখুন......" cols="50" maxlength="250"></textarea>
                      <span class="text-red"><?php echo form_error('health_advice_ban'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>

                    <?php
                    if ($health_advice){ 
                    $x = 1;
                    foreach($health_advice as $advice){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $advice->health_advice_eng;?></td>
						            <td><?php echo $advice->health_advice_ban  ;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-health-advice/" . $advice->health_advice_id; ?>">
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