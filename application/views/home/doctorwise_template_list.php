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
            Doctor Template List
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Templates</li>
            <li class="active">Doctor Template List</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Doctor Template List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>Doctor Template List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th style="min-width: 100px">Template Name</th>
                        <th style="min-width: 200px">Doctor</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                  <tr>
                    <?php
                    if ($templates){ 
                    $x = 1;
                    foreach($templates as $template){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $template->template_name;?></td>
						<td><?php $temp_doc = $this->prescription_model->get_temp_doctor($template->template_id) ;
                            if ($temp_doc) {
                            foreach ($temp_doc as $doc) {
                                echo $doc->doctor_name;
                               
                            }}
                        ?>
                        </td>
                        <td>
                            <!-- <a class="btn btn-primary btn-xs" href="<?php //echo base_url() . "template-detail/" . $template->template_id; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                                View
                            </a> -->
                            N/A
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