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
                    <div class="col-sm-3">
                        <label for="app_date" class="control-label">Date<span class="text-red">*</span></label>
                        <input type="text" class="form-control  pull-right datepicker2" id="app_date" name="app_date" value="<?php echo date('Y-m-d'); ?>" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('app_date'); ?></span>
                    </div>
                    <div class="col-sm-3">
                        <label for="shift" class="control-label">Shift<span class="text-red">*</span></label>
                        <select class="form-control select2" name="app_shift" id="app_shift" style="width: 100%;"required>
                            <option value="">Select Shift</option>
                             <?php if ($shift) {
                            foreach ($shift as $sft) {
                            ?>
                            <option value="<?php echo $sft->shift_id; ?>"><?php echo $sft->shift_title ." (From".$sft->shift_start." To ".$sft->shift_end.")"; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Shift</option>
                          <?php } ?>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('app_shift'); ?></span>
                    </div>
                    <div class="col-sm-4">
                         <label for="doctor_name" class="control-label">Doctor<span class="text-red">*</span></label>
                        <select class="form-control select2" name="doctor_name" id="doctor_name" style="width: 100%;" required>
                            <option value="">Select Date & Shift first</option>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_name'); ?></span>
                    </div>
                    <div class="col-sm-2">
                        <label for="doctor_name" class="control-label col-sm-12">&nbsp;</label>
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
                       /* @media print {
                          @page { margin: 0; }
                          body { margin: 1.6cm; }
                         }*/


                        </style>
                        
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <!-- <br>
                                <center><span class="top-title">Appointed Patient List of Consultant</span></center>
                                <br> -->
                                <table style="margin-top: 10px;">
                                    <thead>
                                        <tr>
                                            <th colspan="6">
                                             <center><span >Appointed Patient List of Consultant</span></center>
                                         </th>
                                        </tr>
                                        <tr>
                                        <th colspan="3" style="background-color: #dfdfdf;"><?php echo $doctor_name; ?></th>
                                        <th colspan="3" style="background-color: #dfdfdf;">Date : <?php echo date("d/m/Y", strtotime($date)); ?></th>
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
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $appcount = array_column($appointments, 'appointment_slot');
                                            for($i = 1; $i<=$slot; $i++ ){
                                            if(in_array($i,$appcount)){
                                            foreach ($appointments as $patient) { ?>
                                            <tr>
                                                
                                                
                                                <td align="center"><?php echo $i; ?></td>
                                                <td><?php echo $patient->patient_reg_no; ?></td>
                                                
                                                <td><?php echo $patient->patient_first_name." ".$patient->patient_last_name; ?></td>
                                               
                                                <td><?php echo $patient->appointment_type; ?></td>
                                                <td><?php echo $patient->appointment_remark; ?></td>
                                                <td class="no-print">
                                                    <a class="btn btn-primary btn-xs" href="#<?php //echo base_url() . "reset-password/" . $user->user_id; ?>">Edit</a>
                                                </td>
                                         
                                            </tr>
                                        <?php }} else { ?>
                                            <tr>
                                                <td align="center"><?php echo $i; ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Reserved</td>
                                                <td class="no-print">
                                                    N/A
                                                </td>
                                            </tr>
                                        <?php  }} ?>
                                    </tbody>
                                    
                                    
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
