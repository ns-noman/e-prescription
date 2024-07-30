<section class="content-header">
<?php
	$success_msg = $this->session->userdata('success');
	$error_msg = $this->session->userdata('error');
	$this->session->unset_userdata('success');
	$this->session->unset_userdata('error');
?>
  <h1>
    Dashboard
    <small>Doctor</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Home</li>
  </ol>
</section>

<section class="content">
      <!-- Info boxes -->
      <div class="row">
        <?php echo $success_msg; ?>
              <?php echo $error_msg; ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3> <?php 
                        $date = date('Y-m-d');
                        $doctor_id = $this->session->userdata('user_id');
                        $consultation = "Consultation";
                        $consultation_data = $this->prescription_model->get_doctorwise_appointment_type($consultation, $date, $doctor_id);
                        echo count($consultation_data);
                   ?> 
              </h3>

              <p>Consultation Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="<?php echo base_url(); ?>doctor-appointment-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        $followup_data = $this->prescription_model->get_doctorwise_appointment_type($followup, $date, $doctor_id);
                        echo count($followup_data);
                   ?>
              </h3>

              <p>Followup Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="<?php echo base_url(); ?>doctor-appointment-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        $general_data = $this->prescription_model->get_doctorwise_appointment_type($general, $date, $doctor_id);
                        echo count($general_data);
                   ?>
              </h3>

              <p>Report Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="<?php echo base_url(); ?>doctor-appointment-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        $emergency_data = $this->prescription_model->get_doctorwise_appointment_type($emergency, $date, $doctor_id);
                        echo count($emergency_data);
                   ?>
              </h3>

              <p>Emergency Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="<?php echo base_url(); ?>doctor-appointment-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>


      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">

          <!-- TABLE: total Patients Current Month -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Today's Waiting Patients</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <?php if ($appointments) {  ?>
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Registration#</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Type</th>
                    <th>Action</th>
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
                      <?php if ($patient->appointment_type == "Consultation") {$label = 'label-info';}
                       else if ($patient->appointment_type == "Emergency") {$label = 'label-danger';}
                       else if ($patient->appointment_type == "Followup") {$label = 'label-success';}
                       else if ($patient->appointment_type == "Report") {$label = 'label-warning';} ?>
                     <span class="label <?php echo $label;?>"><?php echo $patient->appointment_type;?></span>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "prescription-entry/". $patient->appointment_id; ?>">
                                            <i class="glyphicon glyphicon-pen"></i> Visit</a>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              <?php }else{echo "None";}  ?>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Prescription Entry</a> -->
              <a href="<?php echo base_url(); ?>doctor-appointment-list" class="btn btn-sm btn-default btn-flat pull-right">View All Appointment</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-user-md"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Consultation Patient Visit</span>
              <span class="info-box-number"><?php echo count($consultation_visit); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    in last 30 Days
                  </span>
            </div>
          </div>
          <!-- /.info-box -->

          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-heart-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Followup Patient Visit</span>
              <span class="info-box-number"><?php echo count($followup_visit); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                     in last 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->

          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-medkit"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Report Patient Visit</span>
              <span class="info-box-number"><?php echo count($general_visit); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    in Last 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->

          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-wheelchair"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Emergency Patient Visit</span>
              <span class="info-box-number"><?php echo count($emergency_visit); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    in last 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
    </section>