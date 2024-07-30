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
        Reports
        <small>List<b class="box-title text-red"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Reports</li>
    </ol>
</section>

<section class="content">
    <?php echo $success_msg; ?>
          <?php echo $error_msg; ?>
    <form class="form-horizontal" action="<?php echo base_url();?>view-report" method="post" enctype="multipart/form-data"  role="form">
    <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">List</h3>
            </div> -->
              <div class="box-body">
             
                <div class="form-group">
                    <label for="from_date" class="col-sm-4 control-label">From Date<span class="text-red">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control  pull-right datepicker3" id="from_date" name="from_date" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('from_date'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="to_date" class="col-sm-4 control-label">To Date<span class="text-red">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control  pull-right datepicker3" id="to_date" name="to_date" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('to_date'); ?></span>
                    </div>
                </div>

              <div class="form-group">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-7">
                  <label>
                    <input type="radio" name="report_title" value="consultant-patient-report">
                    Visited Patient List of Each Consultant
                  </label>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-7">
                  <label>
                    <input type="radio" name="report_title" value="consultant-summary-report">
                    Consultant Wise Patient Summary
                  </label>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                  <label>
                    <input type="radio" name="report_title" value="consultant-investigation-report">
                    Consultant Wise Investigation
                  </label>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                  <label>
                    <input type="radio" name="report_title" value="patient-investigation-report">
                    Patient Wise Investigation
                  </label>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                  <label>
                    <input type="radio" name="report_title" value="patient-list-report">
                    Date Wise Visited Patient List
                  </label>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8">
                  <label>
                    <input type="radio" name="report_title" value="patient-type-report">
                    Date Wise Patient Type
                  </label>
                </div>
              </div>

              


              </div>
               <div class="box-footer">
                 <div class="col-sm-offset-4 col-sm-10">
                    <button type="submit" class="btn btn-primary">View</button>
                 </div>
                </div>
          </div>
        </div>

       
    </div>
    </form>

</section>