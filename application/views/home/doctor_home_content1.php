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
              <h3>15</h3>

              <p>Consultation Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>10</h3>

              <p>Followup Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>4</h3>

              <p>General Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>2</h3>

              <p>Emergency Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-stethoscope"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
              <h3 class="box-title">Waiting Patients</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Registration#</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Type</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="#">OR9842</a></td>
                    <td>Demo Patient</td>
                    <td>01/07/2020</td>
                    <td>
                     <span class="label label-info">Consultation</span>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">OR9842</a></td>
                    <td>Demo Patient</td>
                    <td>01/07/2020</td>
                    <td>
                     <span class="label label-danger">Emergency</span>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="#">OR9842</a></td>
                    <td>Demo Patient</td>
                    <td>01/07/2020</td>
                    <td>
                     <span class="label label-success">Followup</span>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Demo Patient</td>
                    <td>01/07/2020</td>
                    <td>
                     <span class="label label-warning">General</span>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Demo Patient</td>
                    <td>01/07/2020</td>
                    <td>
                     <span class="label label-success">Followup</span>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Demo Patient</td>
                    <td>01/07/2020</td>
                    <td>
                     <span class="label label-info">Consultation</span>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Demo Patient</td>
                    <td>01/07/2020</td>
                    <td>
                     <span class="label label-success">Followup</span>
                    </td>
                  </tr>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Prescription Entry</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Appointment</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Consultation Patient</span>
              <span class="info-box-number">200</span>

              <div class="progress">
                <div class="progress-bar" style="width: 8%"></div>
              </div>
              <span class="progress-description">
                    in last 30 Days
                  </span>
            </div>
          </div>
          <!-- /.info-box -->

          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Followup Patient</span>
              <span class="info-box-number">150</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                     in last 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->

          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">General Patient</span>
              <span class="info-box-number">30</span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
              <span class="progress-description">
                    in Last 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->

          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Emergency Patient</span>
              <span class="info-box-number">20</span>

              <div class="progress">
                <div class="progress-bar" style="width: 6%"></div>
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