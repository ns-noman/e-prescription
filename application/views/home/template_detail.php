
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
    Template
    <small>Entry</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Templates</li>
    <li class="active">Template Detail</li>
    </ol>
</section>

<section class="content">

      <!-- form row -->
    <div class="row">
        <form class="form-horizontal" action="<?php echo base_url() . "update-template/" . $app_info->template_id; ?>" method="post" enctype="multipart/form-data"  role="form">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-left">Update</button>
                        <button type="reset" class="btn btn-danger pull-right">Reset</button>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
               <?php echo $success_msg;
                echo $error_msg ; ?>
                <div class="box box-info box-solid">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="template_name" class="col-sm-2 control-label">Template Name <span class="text-red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="template_name" id="template_name" value="<?php echo $app_info->template_name; ?>" required>
                                <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('template_name'); ?></span>
                            </div>
                            <label for="department" class="col-sm-2 control-label">Department</label>
                        <div class="col-sm-2">
                             <input type="text" class="form-control" name="department" id="department" autocomplete="off">
                         <input type="hidden" class="form-control" name="department_id" id="department_id">
                         <div id="department_wrapper" class="department_wrapper">
                            <?php if ($temp_dept) {
                            foreach ($temp_dept as $dept) {
                         ?>
                            <div><a href="javascript:void(0);" class="remove_grp_button btn btn-danger btn-xs"><i class="fa fa-remove"></i></a> <label class="control-label"><?php echo $dept->department_name; ?></label><input type="hidden" class="form-control" name="department_code[]" value="<?php echo $dept->department_id; ?>"> </div>
                        <?php }} ?>
                        </div>
                        </div>
                        <div class="col-sm-2">
                         <a href="javascript:void(0);" class="add_grp_button btn btn-info btn-sm">Add</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Diagnosis</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="diagnosis_search">Diagnosis Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="diagnosis_search" id="diagnosis_search" >
                                    <span class="input-group-addon"><button type="button" id="add_diagnosis">Add</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="16" id="patient_diagnosis" name="patient_diagnosis"><?php if ($pre_diagnosis) {
                                    foreach ($pre_diagnosis as $diagnosis) { 
                                                echo $diagnosis->pre_diagnosis."\n";
                                }} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Medicine</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="medicine_search">Medicine Name</label>
                                <input type="text" class="form-control" name="medicine_search" id="medicine_search">
                            </div>
                            <div class="col-sm-6">
                                <label for="doses_administration">Doses</label>
                               <select class="form-control" name="doses_administration" id="doses_administration">
                                    <option value="">Select Doses</option>
                                    <?php if ($doses_administration) {
                                        foreach ($doses_administration as $doses) { ?>
                                            <option value="<?php echo $doses->doses_administration_eng; ?>"><?php echo $doses->doses_administration_eng; ?></option>
                                       <?php }}else{ ?>
                                        <option value="">No Doses</option>
                                       <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="doses_duration">Duration</label>
                               <select class="form-control" name="doses_duration" id="doses_duration">
                                    <option value="">Select Duration</option>
                                    <?php if ($doses_duration) {
                                        foreach ($doses_duration as $duration) { ?>
                                            <option value="<?php echo $duration->doses_duration_eng; ?>"><?php echo $duration->doses_duration_eng; ?></option>
                                       <?php }}else{ ?>
                                        <option value="">No Duration</option>
                                       <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="meal_administration">Advice</label>
                               <select class="form-control" name="meal_administration" id="meal_administration">
                                    <option value="">Select Advice</option>
                                    <?php if ($meal_administration) {
                                        foreach ($meal_administration as $meal) { ?>
                                            <option value="<?php echo $meal->meal_administration_eng; ?>"><?php echo $meal->meal_administration_eng; ?></option>
                                       <?php }}else{ ?>
                                        <option value="">No Advice</option>
                                       <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-10">
                                <button type="button" id="add_medicine">Add</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="11" id="patient_medicine" name="patient_medicine"><?php if ($pre_medicine) {
                                            foreach ($pre_medicine as $medicine) { 
                                                echo $medicine->pre_medicine_name."|".$medicine->pre_medicine_doses."|".$medicine->pre_medicine_duration."|".$medicine->pre_medicine_advice."\n";
                                }}?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Investigation</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="service_type">Service Type</label>
                               <select class="form-control" name="service_type" id="service_type">
                                    <option value="">Select Option</option>
                                    <?php if ($investigation_type) {
                                        foreach ($investigation_type as $itype) { ?>
                                            <option value="<?php echo $itype->investigation_type_id; ?>"><?php echo $itype->investigation_type; ?></option>
                                       <?php }}else{ ?>
                                        <option value="">No Type</option>
                                       <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="test_name">Test Name</label>
                                <input type="text" class="form-control" name="test_name" id="test_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-10">
                                <button type="button" id="add_test">Add</button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="14" id="patient_test" name="patient_test"><?php if ($pre_investigation) {
                                    foreach ($pre_investigation as $investigation) { 
                                                //echo $investigation->pre_investigation_type."|".$investigation->pre_investigation."\n";
                                                echo $investigation->pre_investigation."\n";
                                }} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Advice</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="advice_search">Advice</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="advice_search" id="advice_search" >
                                    <span class="input-group-addon"><button type="button" id="add_advice">Add</button></span> <span class="input-group-addon"><button type="button" id="add_advice">Add</button> <button type="button" id="all_advice" data-toggle="modal" data-target="#adviceModal">More</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="12" id="patient_advice" name="patient_advice"><?php if ($pre_advice) {
                                    foreach ($pre_advice as $advice) { 
                                                echo $advice->pre_health_advice."\n";
                                    }} ?></textarea>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Special Note</h3>
                    </div>
                    <div class="box-body" style="height: 500px;">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="note_search">Special Note</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="note_search" id="note_search" >
                                    <span class="input-group-addon"><button type="button" id="add_note">Add</button></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" rows="12" id="patient_note" name="patient_note"><?php if ($pre_note) { 
                                    foreach ($pre_note as $note) { 
                                                echo $note->pre_special_note."\n";
                                    }} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-md-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-left">Update</button>
                        <button type="reset" class="btn btn-danger pull-right">Reset</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


<!-- Advice Modal -->
  <div class="modal fade" id="adviceModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Health Advice</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
               <?php if($health_advice){
                foreach ($health_advice as $advice) {
               ?>
                <label>
                  <input type="checkbox" class="minimal" value="<?php echo $advice->health_advice_eng; ?>" name="advice">
                  <?php echo $advice->health_advice_eng; ?>
                </label><br>
            <?php }} ?>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="advice_list">Add</button>
        </div>
      </div>
      
    </div>
  </div>