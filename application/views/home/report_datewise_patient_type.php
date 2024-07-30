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
        Date Wise Patient Type
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#"><i class="fa fa-dashboard"></i> Reports</a></li>
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
                          text-align: center;
                        }

                        </style>
                        
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <br>
                                <center><span class="top-title">Date Wise Patient Type</span></center>
                                <br>
                                <table>
                                    <tr>
                                        <td>From : <?php echo date("d/m/Y", strtotime($from_date)); ?></td>
                                        <td>To : <?php echo date("d/m/Y", strtotime($to_date)); ?></td>
                                        <td>Print Date : <?php echo date("d/m/Y"); ?></td>
                                    </tr>
                                </table>
                                
                                <table style="margin-top: 10px;">
                                    <tr style="background-color: #dfdfdf;">
                                        <th width="100" rowspan="2">Date</th>
                                        <th colspan="2">Consultation</th>
                                        <th colspan="2">Followup</th>
                                        <th colspan="2">Report</th>
                                        <th colspan="2">Emergency</th>
                                        <th rowspan="2" width="100">Total Appointment</th>
                                        <th rowspan="2" width="100">Total Visit</th>
                                    </tr>
                                    <tr style="background-color: #dfdfdf;">
                                        <th>App</th>
                                        <th>Visit</th>
                                        <th>App</th>
                                        <th>Visit</th>
                                        <th>App</th>
                                        <th>Visit</th>
                                        <th>App</th>
                                        <th>Visit</th>
                                    </tr>
                                    <?php
                                        $period = new DatePeriod(
                                            new DateTime($from_date), 
                                            new DateInterval('P1D'), 
                                            new DateTime($to_date.' +1 day'
                                        ));

                                        $x = 0;
                                        $total_consultation_app = 0;
                                        $total_followup_app = 0;
                                        $total_report_app = 0;
                                        $total_emergency_app = 0;
                                        $total_consultation_visit = 0;
                                        $total_followup_visit = 0;
                                        $total_report_visit = 0;
                                        $total_emergency_visit = 0;
                                        $total_appointment = 0;
                                        $total_visit = 0;

                                        foreach ($period as $day) {
                                            $qdate = $day->format("Y-m-d");
                                            $x++;
                                            

                                            $consultation_app =  $this->prescription_model->get_datewise_appointment_type('Consultation', $qdate);
                                            $followup_app =  $this->prescription_model->get_datewise_appointment_type('Followup', $qdate);
                                            $report_app =  $this->prescription_model->get_datewise_appointment_type('Report', $qdate);
                                            $emergency_app =  $this->prescription_model->get_datewise_appointment_type('Emergency', $qdate);

                                            $consultation_visit =  $this->prescription_model->get_datewise_visit_type('Consultation', $qdate);
                                            $followup_visit =  $this->prescription_model->get_datewise_visit_type('Followup', $qdate);
                                            $report_visit =  $this->prescription_model->get_datewise_visit_type('Report', $qdate);
                                            $emergency_visit =  $this->prescription_model->get_datewise_visit_type('Emergency', $qdate);


                                     ?>
                                     <tr>
                                        <td><?php echo $day->format("d-m-Y"); ?></td>
                                        <td>
                                            <?php echo count($consultation_app);
                                                $total_consultation_app += count($consultation_app);
                                            ?>
                                         </td>
                                        <td>
                                            <?php echo count($consultation_visit); 
                                                $total_consultation_visit += count($consultation_visit);
                                            ?>
                                            
                                        </td>
                                        <td>
                                            <?php echo count($followup_app); 
                                                $total_followup_app += count($followup_app);
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo count($followup_visit); 
                                                $total_followup_visit += count($followup_visit);
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo count($report_app);  
                                                $total_report_app += count($report_app);
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo count($report_visit);
                                                $total_report_visit += count($report_visit);
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo count($emergency_app);
                                                $total_emergency_app += count($emergency_app);
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo count($emergency_visit);
                                                $total_emergency_visit += count($emergency_visit); 
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $total_app = count($consultation_app)+
                                                       count($followup_app)+
                                                       count($report_app)+
                                                       count($emergency_app);
                                                    $total_appointment += $total_app; 
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $total_vsit = count($consultation_visit)+
                                                       count($followup_visit)+
                                                       count($report_visit)+
                                                       count($emergency_visit);
                                                $total_visit += $total_vsit;
                                            ?>
                                        </td>
                                    </tr>
                                 <?php } ?>
                                 <tr style="background-color: #dfdfdf;">
                                    <th><?php echo $x; ?> Day Total</th>
                                    <th><?php echo $total_consultation_app; ?></th>
                                    <th><?php echo $total_consultation_visit; ?></th>
                                    <th><?php echo $total_followup_app; ?></th>
                                    <th><?php echo $total_followup_visit; ?></th>
                                    <th><?php echo $total_report_app; ?></th>
                                    <th><?php echo $total_report_visit; ?></th>
                                    <th><?php echo $total_emergency_app; ?></th>
                                    <th><?php echo $total_emergency_visit; ?></th>
                                    <th><?php echo $total_appointment; ?></th>
                                    <th><?php echo $total_visit; ?></th>
                                </tr>

                                    
                                </table>
                            
                            </div>
                        </div>
                    </div>

                </div>
              </div>
            </div>
        </div>
        
    </div>

</section>
