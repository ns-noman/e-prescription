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
    <form class="form-horizontal" action="<?php echo base_url().'update-schedule/'.$schedule_info->schedule_id;?>" method="post" enctype="multipart/form-data"  role="form">
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
                        <input type="text" class="form-control" id="doctor_name" name="doctor_name" required autocomplete="off" value="<?php echo $schedule_info->doctor_name; ?>" readonly>
                        <input type="hidden" class="form-control" id="doctor_id" name="doctor_id" value="<?php echo $schedule_info->doctor_id; ?>">
                        <input type="hidden" class="form-control" id="department_id" name="department_id" value="<?php echo $schedule_info->department_id; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('doctor_name'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="shift" class="col-sm-4 control-label">Shift<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="shift" id="shift" style="width: 100%;"required>
                            <option value="<?php echo $schedule_info->schedule_shift; ?>"><?php echo $schedule_info->shift_title; ?></option>
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
                        <input type="text" class="form-control  pull-right datepicker2" id="start_date" name="start_date" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off" value="<?php echo $schedule_info->start_date; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('start_date'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date" class="col-sm-4 control-label">End Date<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control  pull-right datepicker2" id="end_date" name="end_date" data-date-format='yyyy-mm-dd' placeholder="yyyy-mm-dd" required autocomplete="off" value="<?php echo $schedule_info->end_date; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('end_date'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_time" class="col-sm-4 control-label">Start Time<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="start_time" name="start_time"  placeholder="00:00 AM/PM" required value="<?php echo $schedule_info->start_time; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('start_time'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="end_time" class="col-sm-4 control-label">End Time<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="end_time" name="end_time" placeholder="00:00 AM/PM" required value="<?php echo $schedule_info->end_time; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('end_time'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="slot" class="col-sm-4 control-label">Slot<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="slot" name="slot" required min="1" value="<?php echo $schedule_info->schedule_slots; ?>">
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('slot'); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="day" class="col-sm-4 control-label">Week Days<span class="text-red">*</span></label>
                    <div class="col-sm-8">
                        <?php
                            $recurringDays = array_column($schedule_day, 'schedule_day_code');
                            $days = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday", "Saturday");
                            for($i = 0; $i < 7; $i++ ){
                                if(in_array($i,$recurringDays)){
                                    echo '<label><input type="checkbox" class="minimal1" name="day[]" value="'.$days[$i].':'.$i.'" checked="checked"> '.$days[$i].'</label><br>';
                                     } else {
                                        echo '<label><input type="checkbox" class="minimal1" name="day[]" value="'.$days[$i].':'.$i.'"> '.$days[$i].'</label><br>';        
                                     }
                                 
                                }
                                ?>
                        <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('day'); ?></span>
                    </div>
                </div>

                

               
              </div>
               <div class="box-footer">
                 <div class="col-sm-offset-4 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="actionbtn">Update</button>
                 </div>
                </div>
          </div>
        </div>

        <!-- <div class="col-md-7">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Schedule Info</h3>
            </div>
              <div class="box-body" id="schedule_info">

            </div>
        </div>
      </div> -->
    </div>
    </form>

</section>