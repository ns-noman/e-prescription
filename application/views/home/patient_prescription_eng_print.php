<!DOCTYPE html>
<html>

<head>
  <style type="text/css">
table.pinfo {
    border: 1px solid #000;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
  }

  th, td {
    padding: 1px;
    vertical-align: top;
  }
.page-footer {
  position: fixed;
  bottom: 60px;
  width: 100%;
 /* font-size: 26px;
  text-align: center;
  padding: 30px; */
}

.page-header {
  position: fixed;
  top: 0mm;
 width: 90%;
  /*background-color: black;*/
  /*color: white;*/
  /*text-align: center;
  padding: 30px;*/
}

.page {
  page-break-after: always;
}

.top-title{
      font-size: 20px;
      font-weight: bold;
      background-color: #b3c7dc;
      padding: 5px;
      border: 1px solid #000;
      border-radius: 5px;
  }

  .pvital td{
    border: 1px solid #000;
  }


@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}

   /*body {margin: 0;}*/
   @page {
      size: A4;
      margin-top: .6in;
      margin-bottom: .6in;
    }
   /*body { margin-left: 1cm; }*/
}

  </style>
</head>

<body>

  <table width="100%">
<!-- 
    <thead>
      <tr>
        <td style="height: 150px;">
            <div class="page-header">
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
        </td>
      </tr>
    </thead> -->

    <tbody>
      <tr>
        <td>
          <div class="page">
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
            <table cellpadding="3" style="width: 100%;">
              <tbody>
                <td>
                  <center><span class="top-title">Prescription / ব্যবস্থাপত্র</span></center>
                  <br>
                    
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
                     
                  <table class="pvital" cellspacing="0" cellpadding="0" style="text-align:center;border-color: #000; width:100%; margin-top: 5px;">
                    <tr>
                      <?php if($app_info->pre_bp_sys || $app_info->pre_bp_dia){ ?>
                      <td >
                        BP <br> <?php echo $app_info->pre_bp_sys."(Sys) / ".$app_info->pre_bp_dia."(Dias) "; ?>
                      </td>
                    <?php } if($app_info->pre_temperature_f || $app_info->pre_temperature_c){ ?>
                      <td >
                        Temperature <br> <?php echo $app_info->pre_temperature_f."F / ".$app_info->pre_temperature_c."C"; ?>
                      </td>
                      <?php } if($app_info->pre_pulse){ ?>
                      <td>
                        Pulse <br> <?php echo $app_info->pre_pulse; ?>
                      </td>
                      <?php } if($app_info->pre_height_feet || $app_info->pre_height_inch){ ?>
                      <td>
                        Height <br> <?php echo (int)$app_info->pre_height_feet."ft ".(int)$app_info->pre_height_inch."in / "; ?>
                          <?php $metre = (intval($app_info->pre_height_feet)*12+intval($app_info->pre_height_inch))*0.0254;
                          echo number_format((float)$metre, 2, '.', '')."M";
                           ?>
                         </td>
                        <?php } if($app_info->pre_weight_kg){ ?>
                      <td>
                        Weight <br> <?php echo $app_info->pre_weight_kg;?>(Kg) / <?php echo number_format((float)$app_info->pre_weight_kg*2.20462262, 2, '.', '');?>(Lbs)
                      </td>
                      <?php }
                        $height = intval($app_info->pre_height_feet)*12+intval($app_info->pre_height_inch);
                          if($app_info->pre_weight_kg && $height){
                            $bmi = intval($app_info->pre_weight_kg)/pow((($height)*0.0254), 2); 
                       ?>
                      <td>
                        BMI <br> <?php echo number_format((float)$bmi, 2, '.', '');  ?>
                      </td>
                    <?php }  ?>
                    </tr>
                   
                  </table>
                 
                  <table class="history" style="border-left:none; border-top:none; border-right:1px solid #000; border-bottom:none; float:left; width:20%; font-size: 13px; margin-top: 2px;">
                      
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
                  </table>

                  <table style="border:none; float:left; width:78%; font-size: 13px; margin-left: 10px;">
                      <tr>
                          <td colspan="4">
                              <br>
                              <img src="<?php echo base_url(); ?>assets/img/prescription-symble.png" height="25" width="25">
                              
                          </td>
                      </tr>
                      <?php if ($pre_medicine) {
                                  foreach ($pre_medicine as $medicine) { ?>
                      <tr>
                          <td width="40%" style="border-bottom: 1px solid #dfdfdf;"><?php echo $medicine->pre_medicine_name; ?></td>
                          <td width="20%" style="border-bottom: 1px solid #dfdfdf;"><?php echo $medicine->pre_medicine_doses; ?></td>
                          <td width="25%" style="border-bottom: 1px solid #dfdfdf;"><?php echo $medicine->pre_medicine_advice; ?></td>
                          <td width="15%" style="border-bottom: 1px solid #dfdfdf;"><?php echo $medicine->pre_medicine_duration; ?></td>
                      </tr>
                      <?php } } ?>
                      
                      <?php if ($pre_advice) { ?>
                      <tr>
                          <td colspan="4">
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
                              <u><b>Next Visit : </b></u> <?php echo date("d/m/Y", strtotime($app_info->pre_next_visit)); ?>
                          </td>
                      </tr>
                  <?php } ?>
                  <?php if($app_info->pre_ref_org){ ?>
                      <tr>
                          <td colspan="4">
                              <u><b>Referral Doctor/Organization:</b></u> <?php echo $app_info->pre_ref_org; ?>
                          </td>
                      </tr>
                      
                  <?php } ?>

                <?php if($app_info->pre_remarks){ ?>
                    <tr>
                        <td colspan="4">
                            <u><b>Cause / Remarks:</b></u> <?php echo $app_info->pre_remarks; ?>
                        </td>
                    </tr>
                    
                <?php } ?>
                </table>
                        
                  
                </td>
                 
              </tbody>
            </table>
          </div>
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td style="height: 200px;">
          <div class="page-footer">
            <table cellpadding="1" style="width: 100%; table-layout:fixed">
              <tr>
                <td style="font-size: 8pt; line-height: 13px;" align="right">
                  <br><br>
                  <div style="float:right; text-align: center;">
                      __________________________<br>
                    <?php 
                          echo $app_info->doctor_name;
                      
                       ?>
                  </div>
              </td>
              </tr>

              </table>
         
          </div>
        </td>
      </tr>
    </tfoot>
  </table>

  
<script type="text/javascript">
  window.onload = function() { 
    window.print();
    setTimeout(window.close, 0);
  }
</script>
</body>

</html>