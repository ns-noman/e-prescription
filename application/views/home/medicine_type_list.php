<section class="content">
 <?php
    $success_msg = $this->session->userdata('success');
    $error_msg = $this->session->userdata('error');
    ?>
    <?php
    $this->session->unset_userdata('success');
    $this->session->unset_userdata('error');
    ?>
	
	<div class="col-md-12">
  <?php echo $success_msg; ?>
  <?php echo $error_msg; ?>
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Medicine Dosage</h3>
              
            </div>
         
            <div class="box-body table-responsive">
            
              <table id="" class="table table-bordered table-striped table-hover example2">
                <thead>
                <tr>
				          <th width="30">SL.</th>
                  <th>Medicine Dosage</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-medicine-type/" . $edit_info->med_type_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <input type="text" class="form-control" name="med_type_name" id="med_type_name" value="<?php echo $edit_info->med_type_name; ?>" required ><span style="color:red;"> *</span>
                      <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('med_type_name'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-medicine-type" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <input type="text" class="form-control" name="med_type_name" id="med_type_name" required ><span style="color:red;"> *</span>
                      <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('med_type_name'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>

                <?php
                if ($medicine_type_info){ 
                  $x = 1;
                  foreach($medicine_type_info as $info){
                ?>
                  <tr>
                    <td><?php echo $x++; ?>.</td>
                    <td>
            					<?php echo $info->med_type_name;?><br>
            				</td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-medicine-type/". $info->med_type_id; ?>">
                        <i class="glyphicon glyphicon-pen"></i> Edit
                      </a>
                    </td>
                  </tr>
    				      
                  <?php } } ?>
                  </tbody>
                <!--<tfoot>
                <tr>
                  <th>
                    footer
                  </th>
                </tr>
                </tfoot>-->
              </table>
            </div>
    </div>
	</div> 
</section>