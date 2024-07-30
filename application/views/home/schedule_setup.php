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
        Schedule Entry
        <small>Form<b class="box-title text-red"> ( * ) Marked Fields are Required.</b></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Master Data Setup</li>
        <li class="active">Schedule Entry</li>
    </ol>
</section>

<section class="content">
    <?php echo $success_msg; ?>
          <?php echo $error_msg; ?>
    <form class="form-horizontal" action="<?php echo base_url().'add-schedule';?>" method="post" enctype="multipart/form-data"  role="form">
    <div class="row">
        <div class="col-md-5">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Schedule Info</h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                    <label for="doctor_name" class="col-sm-2 control-label">Doctor<span class="text-red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="doctor_name" name="doctor_name" required autocomplete="off">
                        <input type="hidden" class="form-control" id="doctor_id" name="doctor_id" required>
                        <input type="hidden" class="form-control" id="department_id" name="department_id" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="shift" class="col-sm-4 control-label">Shift<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="shift" id="shift" style="width: 100%;"required>
                            <option value="">Select Shift</option>
                             <?php if ($shift) {
                            foreach ($shift as $sft) {
                            ?>
                            <option value="<?php echo $sft->shift_id; ?>"><?php echo $sft->shift_title ." (From".$sft->shift_start." To ".$sft->shift_end.")"; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Shift</option>
                          <?php } ?>
                        </select>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('shift'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_date" class="col-sm-4 control-label">Start Date<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control  pull-right datepicker2" id="start_date" name="start_date" value="<?php echo date('Y-m-d'); ?>" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('start_date'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date" class="col-sm-4 control-label">End Date<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control  pull-right datepicker2" id="end_date" name="end_date" value="<?php echo date('Y-m-d'); ?>" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('end_date'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_time" class="col-sm-4 control-label">Start Time<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control  pull-right" id="start_time" name="start_time" value=""  placeholder="00:00 AM/PM" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('start_time'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="end_time" class="col-sm-4 control-label">End Time<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control  pull-right" id="end_time" name="end_time" value=""  placeholder="00:00 AM/PM" required>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('end_time'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="slot" class="col-sm-4 control-label">Slot<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control  pull-right" id="slot" name="slot" value="" required min="1">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('slot'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="day" class="col-sm-4 control-label">Week Days<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <label>
                          <input type="checkbox" class="minimal1" name="day[]" value="Sunday:0"> Sunday
                        </label><br>
                        <label>
                          <input type="checkbox" class="minimal1" name="day[]" value="Monday:1"> Monday
                        </label><br>
                        <label>
                          <input type="checkbox" class="minimal1" name="day[]" value="Tuesday:2"> Tuesday
                        </label><br>
                        <label>
                          <input type="checkbox" class="minimal1" name="day[]" value="Wednesday:3"> Wednesday
                        </label><br>
                        <label>
                          <input type="checkbox" class="minimal1" name="day[]" value="Thursday:4"> Thursday
                        </label><br>
                        <label>
                          <input type="checkbox" class="minimal1" name="day[]" value="Friday:5"> Friday
                        </label><br>
                        <label>
                          <input type="checkbox" class="minimal1" name="day[]" value="Saturday:6"> Saturday
                        </label><br>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('day'); ?></span>
                    </div>
                </div>

                

               
              </div>
               <div class="box-footer">
                 <div class="col-sm-offset-4 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="actionbtn">Submit</button>
                 </div>
                </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Schedule Info</h3>
            </div>
              <div class="box-body" id="schedule_info">

            </div>
        </div>
      </div>
    </div>
    </form>

</section>