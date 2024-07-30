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
            Waiting Appointment List
            <small>All</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Appointments</li>
            <li class="active">Waiting Appointments</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <!-- <div class="box-header">
                <h3 class="box-title">Waiting Appointment List</h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				<?php if ($appointments){ ?>
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>Waiting Appointment List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Registration #</th>
                        <th>Patient Name</th>
                        <th>Father Name</th>
                        <th>Age</th>
                        <th>Mobile</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                            $x = 1;
                            foreach($appointments as $patient){ ?>
                                <tr>
                                    <td style="width:12px;"><?php echo $x++; ?>.</td>
                                    <td><?php echo $patient->patient_reg_no;?></td>
                                    <td><?php echo $patient->patient_first_name." ".$patient->patient_last_name;?></td>
                                    <td><?php echo $patient->patient_father_name;?></td>
                                    <td>
                                        <?php
                                            if($patient->patient_dob != "0000-00-00")
                                            {
                                                $interval = date_diff(date_create(), date_create($patient->patient_dob));
                                                echo $interval->format("%Y Year, %M Months, %d Days");
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $patient->patient_mobile;?></td>
                                    <td><?php echo $patient->appointment_type;?></td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "prescription-entry/". $patient->appointment_id; ?>">
                                            <i class="glyphicon glyphicon-pen"></i> Visit</a>
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