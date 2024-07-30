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
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Transaction</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Appointment List</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <?php echo $success_msg; ?>
    <?php echo $error_msg; ?>
        <div class="col-md-12">
            <form class="form-horizontal" action="<?php echo base_url();?>patient-appointment-search" method="post" enctype="multipart/form-data"  role="form">
                <div class="form-group">
                    <label for="app_date" class="col-sm-2 control-label">Date<span class="text-red">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control  pull-right datepicker2" id="app_date" name="app_date" value="<?php echo date('Y-m-d'); ?>" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('app_date'); ?></span>
                    </div>
                    <label for="doctor_name" class="col-sm-2 control-label">Doctor<span class="text-red">*</span></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="doctor_name" name="doctor_name" required autocomplete="off">
                        <input type="hidden" class="form-control" id="doctor_id" name="doctor_id" required>
                        <input type="hidden" class="form-control" id="department_id" name="department_id" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_name'); ?></span>
                    </div>
                    <div class="col-sm-2">
                         <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    </div>
                </div>
            </form>
            <?php if($appointments){?>
          <div class="box box-info">
            <div class="box-header with-border">
              
              <a class="btn btn-warning btn-sm pull-right" href="#" onclick="printDiv('printableArea')">Print</a>
            </div>
              <div class="box-body table-responsiv">
                
                <div id="printableArea" style="margin-left:2px;">
                    <style>
                        .top-title{
                            font-size: 20px;
                            font-weight: bold;
                            background-color: #b3c7dc;
                            padding: 5px;
                            border: 1px solid #000;
                            border-radius: 10px;
                        }
                        table {
                          border: 1px solid #000;
                          margin-left: auto;
                          margin-right: auto;
                          width: 100%;
                        }

                        th, td {
                          padding: 5px;
                          border: 1px solid #000;
                        }

                        th {
                          text-align: center;
                        }


                        </style>
                        
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <br>
                                <center><span class="top-title">Appointed Patient List of Consultant</span></center>
                                <br>
                                <table>
                                    <tr>
                                        <td>Date : <?php echo date("d/m/Y", strtotime($date)); ?></td>
                                    </tr>
                                </table>

                                <table style="margin-top: 10px;">
                                    <tr>
                                        <th colspan="6" style="background-color: #dfdfdf;"><?php echo $doctor_name; ?> (Total Visit : <?php echo count($appointments); ?>)</th>
                                    </tr>
                                    <tr>
                                        <th>SL</th>
                                        <th>Reg. No</th>
                                        <th width="40%">Patient</th>
                                        <!-- <th>Age</th> -->
                                        <th>Visit Type</th>
                                        <th>Remark</th>
                                        <th class="no-print">Action</th>
                                    </tr>
                                    <?php foreach ($appointments as $patient) { ?>
                                    <tr>
                                        <td align="center"><?php echo $patient->appointment_slot; ?></td>
                                        <td><?php echo $patient->patient_reg_no; ?></td>
                                        <td><?php echo $patient->patient_first_name." ".$patient->patient_last_name; ?></td>
                                        <!-- <td><?php
                                                if($patient->patient_dob != "0000-00-00")
                                                {
                                                    $age = date_diff(date_create(), date_create($patient->patient_dob));
                                                    echo $age->format("%Y Year, %M Months, %d Days");
                                                }
                                            ?></td> -->
                                        <td><?php echo $patient->appointment_type; ?></td>
                                        <td><?php echo $patient->appointment_remark; ?></td>
                                        <td class="no-print">
                                            <a class="btn btn-primary btn-xs" href="#<?php //echo base_url() . "reset-password/" . $user->user_id; ?>">Edit</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </table>
                            
                            </div>
                        </div>
                    </div>

                </div>
            
              </div>
            </div>
            <?php } ?>
        </div>
        
    </div>

</section>
