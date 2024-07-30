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
       Patient Wise Investigation
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
                                <center><span class="top-title">Patient Wise Investigation</span></center>
                                <br>
                                <table>
                                    <tr>
                                        <td>From : <?php echo date("d/m/Y", strtotime($from_date)); ?></td>
                                        <td>To : <?php echo date("d/m/Y", strtotime($to_date)); ?></td>
                                        <td>Print Date : <?php echo date("d/m/Y"); ?></td>
                                    </tr>
                                </table>

                                <?php if($doctors){
                                foreach ($doctors as $doctor) {
                                    $doctor_patient =  $this->prescription_model->get_doctor_wise_patient($doctor->doctor_id, $from_date, $to_date);
                                    if ($doctor_patient) {
                                        $x = 1;
                                ?>
                                <table style="margin-top: 10px;">
                                    <tr>
                                        <th colspan="5" style="background-color: #dfdfdf;"><?php echo $doctor->doctor_name; ?></th>
                                    </tr>
                                    <tr>
                                        <th width="50">SL</th>
                                        <th width="100">Date</th>
                                        <th width="100">Reg. No</th>
                                        <th width="200">Patient</th>
                                        <th width="200">Service Name</th>
                                    </tr>
                                    <?php foreach ($doctor_patient as $patient) { 
                                        $pre_investigation =  $this->prescription_model->get_pre_investigation($patient->prescription_id);
                                        if ($pre_investigation) {
                                        ?>
                                    <tr>
                                        <td align="center"><?php echo $x++; ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($patient->visit_date)); ?></td>
                                        <td><?php echo $patient->patient_reg_no; ?></td>
                                        <td><?php echo $patient->patient_first_name." ".$patient->patient_last_name; ?></td>
                                        <td><?php 
                                            foreach ($pre_investigation as $investigation) { 
                                                echo $investigation->pre_investigation."\n";
                                            } ?>
                                        </td>
                                    </tr>
                                <?php }} ?>
                                </table>
                            <?php }}} ?>
                            </div>
                        </div>
                    </div>

                </div>
              </div>
            </div>
        </div>
        
    </div>

</section>
