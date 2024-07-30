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
              <h3 class="box-title">Medicine Generic</h3>
              
            </div>
         
            <div class="box-body table-responsive">
            
              <table id="example2" class="table table-bordered table-striped table-hover example2">
                <thead>
                <tr>
				          <th width="30">SL.</th>
                  <th>Medicine Generic</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-medicine-generic/" . $edit_info->med_gen_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <input type="text" class="form-control" name="med_gen_name" id="med_gen_name" value="<?php echo $edit_info->med_gen_name; ?>" required ><span style="color:red;"> *</span>
                      <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('med_gen_name'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-medicine-generic" method="post" enctype="multipart/form-data"  role="form">
                    <td>0.</td>
                    <td>
                      <input type="text" class="form-control" name="med_gen_name" id="med_gen_name" required ><span style="color:red;"> *</span>
                      <span style="color:red;font-size: 10px;float: left;"><?php echo form_error('med_gen_name'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>

                <?php
                if ($medicine_gen_info){ 
                  $x = 1;
                  foreach($medicine_gen_info as $info){
                ?>
                  <tr>
                    <td><?php echo $x++; ?>.</td>
                    <td>
            					<?php echo $info->med_gen_name;?><br>
            				</td>
                    <td>
                      <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-medicine-generic/". $info->med_gen_id; ?>">
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