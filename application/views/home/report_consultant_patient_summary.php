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
       Consultant Wise Patient Summary
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
                        }

                        th {
                          text-align: center;
                        }


                        </style>
                        
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <br>
                                <center><span class="top-title">Consultant Wise Patient Summary</span></center>
                                <br>
                                <table>
                                    <tr>
                                        <td>From : <?php echo date("d/m/Y", strtotime($from_date)); ?></td>
                                        <td>To : <?php echo date("d/m/Y", strtotime($to_date)); ?></td>
                                        <td>Print Date : <?php echo date("d/m/Y"); ?></td>
                                    </tr>
                                </table>

                                <?php
                                    $total_appointment = 0;
                                    $total_visit = 0;
                                    if($doctors){
                                        foreach ($doctors as $doc) {
                                        $visit =  $this->prescription_model->get_doctor_wise_patient($doc->doctor_id, $from_date, $to_date);
                                        $appointment =  $this->prescription_model->get_doctor_wise_appointments($doc->doctor_id, $from_date, $to_date);
                                        $total_appointment += count($visit);
                                        $total_visit += count($appointment);
                                    }}
                                    ?>
                                <table style="margin-top: 10px;">
                                    <tr style="background-color: #dfdfdf;">
                                        <th>Total Appointed Patient : <?php echo $total_appointment; ?></th>
                                        <th>Total Visited Patient : <?php echo $total_visit; ?></th>
                                    </tr>
                                </table>

                                
                                <table style="margin-top: 10px;">
                                    <tr style="background-color: #dfdfdf;">
                                        <th width="50">SL</th>
                                        <th width="400">Consultant</th>
                                        <th width="100">Department</th>
                                        <th width="150">Appointed Patient</th>
                                        <th width="150">Visited Patient</th>
                                    </tr>
                                    <?php $x = 1;
                                    if($doctors){
                                        foreach ($doctors as $doctor) {
                                        $doctor_patient =  $this->prescription_model->get_doctor_wise_patient($doctor->doctor_id, $from_date, $to_date);
                                        $doctor_appointment =  $this->prescription_model->get_doctor_wise_appointments($doctor->doctor_id, $from_date, $to_date);
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $x++; ?></td>
                                        <td><?php echo $doctor->doctor_name; ?></td>
                                        <td align="center"><?php echo $doctor->department_name; ?></td>
                                        <td align="center"><?php echo count($doctor_appointment); ?></td>
                                        <td align="center"><?php echo count($doctor_patient); ?></td>
                                    </tr>
                                <?php }} ?>
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
