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
        Patient Prescription
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
    <?php echo $success_msg; ?>
    <?php echo $error_msg; ?>
        
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">prescription</b></h3> -->
               
              <!-- <a class="btn btn-warning btn-sm pull-right" href="#" onclick="printDiv('printableArea')">Print</a> -->
              <a class="btn btn-warning btn-sm pull-right" href="<?php echo base_url() . 'print-prescription/'. $app_info->prescription_id; ?>" target="_blank">Print</a>
              <!-- <a class="btn btn-warning btn-sm" href="#">Print in Bangla</a> -->
              <?php if($this->session->userdata('user_id') == $app_info->doctor_id){ ?>
              <a class="btn btn-info btn-sm" href="<?php echo base_url() . "edit-prescription/" . $app_info->prescription_id; ?>">Edit</a>
              <?php } ?> 
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
                        table.pinfo {
                          border: 1px solid #000;
                          margin-left: auto;
                          margin-right: auto;
                          width: 100%;
                        }

                        th, td {
                          padding: 1px;
                        }
                        </style>
                        
                    <div class="row">
                        <div class="col-md-12">
                            <table width="100%" style="font-size: 8pt; line-height: 13px;">
                                  <tr>
                                    <td width="50%" valign="top">
                                        <?php if($app_info->doctor_seal_bn){
                                              echo  $app_info->doctor_seal_bn;
                                            } ?>
                                    </td>
                                    <td width="50%" valign="top" align="right">
                                        <?php if($app_info->doctor_seal){
                                              echo  $app_info->doctor_seal;
                                            } ?>
                                    </td>
                                  </tr>
                            </table>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <br>
                                <center><span class="top-title">Prescription / ব্যবস্থাপত্র</span></center>
                                <br>
                            </div>
                            <table class="pinfo">
                                  <tr>
                                    <td width="150" valign="top">Registration No</td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->patient_reg_no; ?></td>
                                    <td width="150" valign="top"> Visit No </td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->visit_no; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="150" valign="top">Patient Name</td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->patient_first_name; ?> <?php echo $app_info->patient_last_name; ?></td>
                                    <td width="150" valign="top">Visit Date </td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo date("d/m/Y", strtotime($app_info->visit_date)); ?></td>
                                  </tr>
                                  <tr>
                                    <td width="150" valign="top">Age</td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->pre_age; ?></td>
                                    <td width="150" valign="top"> Prescription No</td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->prescription_no; ?></td>
                                            
                                  </tr>
                                <tr>
                                    <td width="150" valign="top">Marital Status</td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->pre_marital_status; ?></td>
                                    <td width="150" valign="top">Contact No </td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->patient_mobile ; ?></td>
                                  </tr>     
                                            
                                     <tr>
                                    <td width="150" valign="top">Gender</td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->patient_gender; ?></td>
                                    <td width="150" valign="top">Blood Group</td>
                                    <td width="2" valign="top">:</td>
                                    <td valign="top"><?php echo $app_info->patient_blood_group; ?></td>         
                                  </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 2px;">
                        <div class="col-md-12">
                            <table border="1" cellspacing="0" cellpadding="0" style="text-align:center;border-color: #000; width:100%">
                              <tr>
                                <td width="60">BP <br> (Sys)/(Dias) </td>
                                <td width="60">Temperature <br> F/C  </td>
                                <td width="60">Pulse <br> &nbsp; </td>
                                <td width="60">Height <br> (Feet/Inch/Meter) </td>
                                <td width="60">Weight <br> (Kg/Lbs) </td>
                                <td width="60"> BMI <br> &nbsp;</td>
                              </tr><tr>
                                 <td width="60"><?php echo $app_info->pre_bp_sys."/".$app_info->pre_bp_dia; ?></td>
                                <td width="60"><?php echo $app_info->pre_temperature_f." F / ".$app_info->pre_temperature_c." C"; ?></td>
                                <td width="60"><?php echo $app_info->pre_pulse; ?></td>
                                <td width="60"><!-- 5'2"/1.59 -->
                                    <?php echo $app_info->pre_height_feet."'".$app_info->pre_height_inch."''"; ?>/ 
                                    <?php $metre = (intval($app_info->pre_height_feet)*12+intval($app_info->pre_height_inch))*0.0254;
                                    echo number_format((float)$metre, 2, '.', '');
                                     ?>
                                </td>
                                <td width="60"><?php echo $app_info->pre_weight_kg;?>/<?php echo number_format((float)$app_info->pre_weight_kg*2.20462262, 2, '.', '');?></td>
                                <td width="60">
                                    <?php $height = intval($app_info->pre_height_feet)*12+intval($app_info->pre_height_inch);
                                    if($app_info->pre_weight_kg && $height){$bmi = intval($app_info->pre_weight_kg)/pow((($height)*0.0254), 2); echo number_format((float)$bmi, 2, '.', '');} ?>
                                </td>
                              </tr>
                          </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 2px;">
                        <div class="col-md-12">
                            <table class="history" style="border-left:none; border-top:none; border-right:1px solid #000; border-bottom:none; float:left;width:20%; font-size: 12px;">

                                <?php if ($pre_complaint) { ?>
                                <tr>
                                    <td valign="top" style="font-weight:bold">
                                        <u>Chief Complaint</u>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php 
                                            foreach ($pre_complaint as $complaint) { 
                                                echo str_replace("-", " ", $complaint->pre_complaint)."<br>";
                                           }  ?>
                                    </td>
                                </tr>
                                <?php } ?>

                                 <?php if ($pre_history) { ?>
                                <tr>
                                    <td valign="top" style="font-weight:bold">
                                        <br>
                                        <u>History</u>
                                    </td>
                                </tr>
                               
                                <tr>
                                    <td>
                                         <?php
                                            foreach ($pre_history as $history) { 
                                                echo $history->pre_history;
                                                if (next($pre_history)) {
                                                    echo '<br>';
                                                }
                                           }  ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                
                                <?php if ($pre_exam) { ?>
                                <tr>
                                    <td valign="top" style="font-weight:bold">
                                        <u>On Exam</u>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <?php 
                                            foreach ($pre_exam as $exam) { 
                                                echo $exam->pre_examination."<br>";
                                           } ?>
                                    </td>
                                </tr>
                                <?php } ?>

                                <?php if ($pre_diagnosis) { ?>
                                <tr>
                                    <td valign="top" style="font-weight:bold">
                                        <u>Diagnosis</u>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <?php 
                                            foreach ($pre_diagnosis as $diagnosis) { 
                                                echo $diagnosis->pre_diagnosis."<br>";
                                           }  ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                
                                <?php if ($pre_investigation) { ?>
                                <tr>
                                    <td valign="top" style="font-weight:bold">
                                        <u>Investigation</u>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                         <?php
                                            foreach ($pre_investigation as $investigation) { 
                                                //echo $investigation->pre_investigation_type." ".$investigation->pre_investigation."<br>";
                                                echo $investigation->pre_investigation."<br>";
                                           } ?>
                                    </td>
                                </tr>
                               <?php } ?>
                                <tr class="no-print">
                                    <td>
                                        <?php if ($pre_file) { ?>
                                            <b><u>Patient Files</u></b><br><br>

                                        <?php foreach ($pre_file as $file) { ?>
                                                <a  href="<?php echo base_url() . "download/". $file->pre_file_id; ?>">
                                            <i class="glyphicon glyphicon-download"></i> <?php echo $file->pre_file_name;?></a><br><br>
                                         <?php }} ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br> -->
                                        
                                    </td>
                                </tr>
                            </table>

                            <table style="border:none; float:left; width:78%; font-size: 12px; margin-left: 10px;">
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <img src="<?php echo base_url(); ?>assets/img/prescription-symble.png" height="25" width="25">
                                        
                                    </td>
                                </tr>
                                <?php if ($pre_medicine) {
                                            foreach ($pre_medicine as $medicine) { ?>
                                <tr>
                                    <td><?php echo $medicine->pre_medicine_name; ?></td>
                                    <td><?php echo $medicine->pre_medicine_doses; ?></td>
                                    <td><?php echo $medicine->pre_medicine_advice; ?></td>
                                    <td><?php echo $medicine->pre_medicine_duration; ?></td>
                                </tr>
                                <?php } } ?>
                                
                                <?php if ($pre_advice) { ?>
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <u><b>Advice</b></u>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                         <?php
                                            foreach ($pre_advice as $advice) { 
                                                echo $advice->pre_health_advice."<br>";
                                           } ?>

                                    </td>
                                </tr>
                                <?php } ?>


                                <?php if ($pre_note) { ?>
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <u><b>Special Note</b></u>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                         <?php 
                                            foreach ($pre_note as $note) { 
                                                echo $note->pre_special_note."<br>";
                                           } ?>
                                    </td>
                                </tr>
                               <?php } ?>
                                <?php if($app_info->pre_next_visit != 0000-00-00){ ?>
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <u><b>Next Visit : </b></u> <?php echo date("d/m/Y", strtotime($app_info->pre_next_visit)); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <?php if($app_info->pre_ref_org){ ?>
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <u><b>Referral Doctor/Organization</b></u>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                         <?php echo $app_info->pre_ref_org; ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php if($app_info->pre_remarks){ ?>
                                <tr>
                                    <td colspan="4">
                                        <br>
                                        <u><b>Cause / Remarks</b></u>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                         <?php echo $app_info->pre_remarks; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                                <tr>
                                    <td colspan="4" style="font-size: 8pt; line-height: 13px;">
                                        <br><br>
                                        <div style="float: right; border-top: 1px solid #000;">
                                            <?php 
                                                echo $app_info->doctor_name;
                                            
                                             ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                    </div>
                    
                    
                </div>
              </div>
            </div>
        </div>
        
    </div>

</section>
