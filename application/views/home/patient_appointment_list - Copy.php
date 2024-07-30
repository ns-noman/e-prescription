<?php
$success_msg = $this->session->userdata('success');
$error_msg = $this->session->userdata('error');
?>
<?php
$this->session->unset_userdata('success');
$this->session->unset_userdata('error');
?>
<section class="content-header">
    <h1>
        Appointment List
        <small>Today's</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Transaction</li>
        <li class="active">Appointment List</li>
    </ol>
</section>

<section class="content">
    <?php echo $success_msg; ?>
          <?php echo $error_msg; ?>
    <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Appointment List</h3>
            </div> -->
              <div class="box-body">
                 <!-- <div class="form-group">
                <div class="input-group">
                 <span class="input-group-addon">Search</span>
                 <input type="text" name="prescription_search" id="prescription_search" placeholder="..." class="form-control" />
                </div>
               </div> -->
               <div id="appointment_result">
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>Appointment List of <?php echo date("d/m/Y"); ?></center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Registration #</th>
                        <th>Patient Name</th>
                        <th>Father's Name</th>
                        <th>Age</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Doctor</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $x = 1;
                            if($appointments){
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
                                    <td><?php echo $patient->patient_address;?></td>
                                    <td><?php echo $patient->doctor_name;?></td>
                                    <td><?php echo $patient->appointment_type;?></td>
                                    <td><?php if($patient->appointment_status == 1){echo "Pending";}else{echo "Done";} ?></td>
                                    <td>
                                        <?php if($patient->appointment_status == 1){ ?>
                                        <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "patient-vital-entry/" . $patient->appointment_id; ?>">
                                            Vital Entry
                                        </a>
                                    <?php }else{echo "Done";} ?>
                                    </td>
                                </tr>
                        <?php }} ?>
                    </tbody>
                </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>