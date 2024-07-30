<section class="content-header">
<?php
  $success_msg = $this->session->userdata('success');
  $error_msg = $this->session->userdata('error');
  $this->session->unset_userdata('success');
  $this->session->unset_userdata('error');
?>
  <h1>
    Dashboard
    <small>Admin</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Home</li>
  </ol>
</section>
<?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin"){ ?>
<section class="content">
      <!-- Info boxes -->
      <div class="row">
        <?php echo $success_msg; ?>
        <?php echo $error_msg; ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <?php 
                        $date = date('Y-m-d');
                        $consultation = "Consultation";
                        $consultation_data = $this->prescription_model->get_datewise_appointment_type($consultation, $date);
                        echo count($consultation_data);
                   ?> 

              </h3>

              <p>Consultation Patient Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="<?php echo base_url(); ?>appointment-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                  <?php 
                        $followup = "Followup";
                        $followup_data = $this->prescription_model->get_datewise_appointment_type($followup, $date);
                        echo count($followup_data);
                   ?>
              </h3>

              <p>Followup Patient Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="<?php echo base_url(); ?>appointment-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                  <?php 
                        $general = "Report";
                        $general_data = $this->prescription_model->get_datewise_appointment_type($general, $date);
                        echo count($general_data);
                   ?>
              </h3>

              <p>Report Patient Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="<?php echo base_url(); ?>appointment-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                <?php 
                        $emergency = "Emergency";
                        $emergency_data = $this->prescription_model->get_datewise_appointment_type($emergency, $date);
                        echo count($emergency_data);
                   ?>
              </h3>

              <p>Emergency Patient Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="<?php echo base_url(); ?>appointment-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Visit: Last 30 Days</strong><br>
                    <span class="label label-primary">Male</span>
                    <span class="label label-warning">Female</span>
                  </p>

                  <!-- <div class="chart">
                    <canvas id="visitChart" style="height: 180px;"></canvas>
                  </div> -->
                  <div class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-8">
                      <p class="text-center">
                        <strong>Visit Ratio : Last 30 Days</strong>
                      </p>
                      <div class="chart-responsive">
                        <canvas id="pieChart" height="180"></canvas>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> Emergency</li>
                        <li><i class="fa fa-circle-o text-green"></i> Followup </li>
                        <li><i class="fa fa-circle-o text-yellow"></i> Report</li>
                        <li><i class="fa fa-circle-o text-aqua"></i> Consultation</li>
                      </ul>
                    </div>
              </div>
                </div>
                
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <!-- <div class="col-md-8">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Appointments</h3>
              
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <?php if ($appointments) {  ?>
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Registration#</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Doctor</th>
                    <th>Type</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($appointments as $patient){ ?>
                  <tr>
                    <td><a href="#"><?php echo $patient->patient_reg_no;?></a></td>
                    <td><?php echo $patient->patient_first_name." ".$patient->patient_last_name;?></td>
                    <td><?php
                          if($patient->patient_dob != "0000-00-00")
                          {
                              $interval = date_diff(date_create(), date_create($patient->patient_dob));
                              echo $interval->format("%Y Year, %M Months, %d Days");
                          }
                      ?>
                        
                    </td>
                    <td>
                      <?php echo $patient->doctor_name;?>
                    </td>
                    <td>
                      <?php if ($patient->appointment_type == "Consultation") {$label = 'label-info';}
                       else if ($patient->appointment_type == "Emergency") {$label = 'label-danger';}
                       else if ($patient->appointment_type == "Followup") {$label = 'label-success';}
                       else if ($patient->appointment_type == "Report") {$label = 'label-warning';} ?>
                     <span class="label <?php echo $label;?>"><?php echo $patient->appointment_type;?></span>
                    </td>
                    <td>
                     <?php if ($patient->appointment_status == 1) {echo "Pending";}else{echo "Done";} ?>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              <?php }else{echo "None";}  ?>
              </div>
            </div>
          </div>
        </div> -->
         <!-- <div class="col-md-4">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Doctor Wise Appointments Count</h3>
            </div>
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Doctor</th>
                        <th>Appointment</th>
                        <th>Visit</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $a = 1;
                            if($doc_app){
                            foreach($doc_app as $app){ ?>
                                <tr>
                                    <td style="width:12px;"><?php echo $a++; ?>.</td>
                                    <td><?php //echo $app->doctor_name; ?></td>
                                    <td><?php //$date = date('Y-m-d');
                                              //$appi = $this->prescription_model->get_datewise_doctor_appointment_count($date, $app->doctor_id);
                                    //echo count($appi); ?>
                                    </td>
                                    <td>
                                     <?php 
                                      //$app_visit = $this->prescription_model->get_datewise_doctor_visit_count($date, $app->doctor_id);
                                      //echo count($app_visit); ?>
                                    </td>
                                </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
 -->
        
      </div>
    </section>

<?php } ?>