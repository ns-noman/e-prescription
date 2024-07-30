    <?php
    $success_msg = $this->session->userdata('success');
    $error_msg = $this->session->userdata('error');
    ?>
    <?php
    $this->session->unset_userdata('success');
    $this->session->unset_userdata('error');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Schedule Entry
            <small class="text-red">(*) Marked Fields are Required.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master Data Setup</li>
            <li class="active">Schedule Entry</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
				
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Depertment<span class="text-red"> * </span></th>
                        <th>Doctor<span class="text-red"> * </span></th>
                        <th>Day<span class="text-red"> * </span></th>
                        <th>Shift<span class="text-red"> * </span></th>
                        <th>Slot</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($edit_info){ ?>
                  <tr>
                  <!-- <form class="form-horizontal" action="<?php echo base_url() . "update-schedule/" . $edit_info->schedule_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>
                      <input type="text" class="form-control" name="schedule_name" id="schedule_name" value="<?php echo $edit_info->schedule_title; ?>" required ><span class="text-red"> * <?php echo form_error('schedule_name'); ?>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="schedule_start" id="schedule_start" value="<?php echo $edit_info->schedule_start; ?>" required placeholder="00:00 AM/PM" autocomplete="off"><span class="text-red"> * <?php echo form_error('schedule_start'); ?>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="schedule_end" id="schedule_end" value="<?php echo $edit_info->schedule_end; ?>" required placeholder="00:00 AM/PM" autocomplete="off"><span class="text-red"> * <?php echo form_error('schedule_end'); ?>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form> -->
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-schedule" method="post" enctype="multipart/form-data"  role="form">
                    <td>
                      <select class="form-control select2" name="department" id="department" required style="width: 100%;">
                        <option value="">Select Department</option>
                        <?php if($department){foreach ($department as $dpt) {?>
                        <option value="<?php echo $dpt->department_id; ?>">
                            <?php echo $dpt->department_title; ?>
                        </option>
                        <?php }} ?>
                      </select>
                      <span class="text-red"> <?php echo form_error('department'); ?></span>
                    </td>
                    <td>
                      <select class="form-control select2" name="doctor" id="doctor" required style="width: 100%;">
                        <option value="">Select Doctor</option>
                        <?php if($doctors_info){foreach ($doctors_info as $doctor) {?>
                        <option value="<?php echo $doctor->doctor_id; ?>">
                            <?php echo $doctor->doctor_name; ?>
                        </option>
                        <?php }} ?>
                      </select>
                      <span class="text-red"><?php echo form_error('doctor'); ?></span>
                    </td>
                    <td>
                        <div class="form-group">
                        <label>
                          <input type="checkbox" class="minimal1" name="day[]" value="Saturday:6"> Saturday
                        </label><br>
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
                        </label>
                        </div>
                    </td>
                    <td>
                        <?php if ($shift) {
                            foreach ($shift as $sft) {
                            ?>
                          <label>
                            <input type="radio" class="minimal1" name="shift" value="<?php echo $sft->shift_id; ?>" required> <?php echo $sft->shift_title ." (From".$sft->shift_start." To ".$sft->shift_end.")"; ?>
                            </label><br>
                        <?php }}  ?>
                      </label>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="slot" id="slot" min="1">
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs" id="actionbtn"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
                <br>

                <table class="table table-bordered table-striped example2">
                    <caption><center>All Schedule List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Depertment</th>
                        <th>Doctor</th>
                        <th>Day</th>
                        <th>Shift</th>
                        <th>Slot</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if ($schedule){ 
                    $x = 1;
                    foreach($schedule as $sch){
                        ?>
                       <tr> 
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $sch->department_title;  ?></td>
                        <td><?php echo $sch->doctor_name;?></td>
                        <td>
                            <?php 
                                $schedule_day = $this->prescription_model->get_schedule_day($sch->schedule_id);
                                foreach ($schedule_day as $sday) {
                                    echo $sday->schedule_day."<br>";
                                }
                             ?>
                        </td>
                        <td><?php echo $sch->shift_title;?></td>
                        <td><?php echo $sch->schedule_slots;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-schedule/" . $sch->schedule_id; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Edit
                            </a>
                        </td>
                        </tr>
                    <?php } }else{ echo "No data  found!";}?>
                    </tbody>
                </table>
				
            </div>
            <!-- /.box-body -->
        </div>




        <!-- /.row -->

    </section>