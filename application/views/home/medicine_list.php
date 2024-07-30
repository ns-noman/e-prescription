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
            Medicine Entry
            <small class="text-red">(*) Marked Fields are Required.</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pharmacy</li>
            <li class="active">Medicine Entry</li>
        </ol>
    </section>

    <!-- Main content -->


    <section class="content">


        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Medicine List</h3>
            </div>
              <div class="box-body table-responsive">
                <?php echo $success_msg; ?>
                <?php echo $error_msg; ?>
                <div class="form-group">
                <div class="input-group">
                 <span class="input-group-addon">Search</span>
                 <input type="text" name="search_text" id="search_text" placeholder="...." class="form-control" />
                </div>
               </div>
				        
               <table class="table table-bordered table-striped table-hover">
                    
                    <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Product Name</th>
                        <th>Dosage Name</th>
                        <th>Generic Name</th>
                        <th>Box Size</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if($edit_info){ ?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url() . "update-medicine/" . $edit_info->product_id; ?>" method="post" enctype="multipart/form-data"  role="form">
                    <td>
                      <select class="form-control select2" id="product_manufacturer" name="product_manufacturer" required>
                          <option value="<?php echo $edit_info->product_manufacturer; ?>"><?php echo $edit_info->product_manufacturer; ?></option>
                          <?php  if($manufacturer_info){ foreach($manufacturer_info as $manufacturer) { ?>
                            <option value="<?php echo $manufacturer->man_name; ?>"><?php echo $manufacturer->man_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Manufacturer</option>
                          <?php } ?>
                        </select>
                      <span class="text-red"> * <?php echo form_error('product_manufacturer'); ?></span>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="product_name" id="product_name" required value="<?php echo $edit_info->product_name; ?>">
                      <span class="text-red">* <?php echo form_error('product_name'); ?></span>
                    </td>
                    <td>
                      <select class="form-control select2" id="product_type" name="product_type">
                          <option value="<?php echo $edit_info->product_type; ?>"><?php echo $edit_info->product_type; ?></option>
                          <option value="">Select Dosage </option>
                          <?php  if($medicine_type){ foreach($medicine_type as $type) { ?>
                            <option value="<?php echo $type->med_type_name; ?>"><?php echo $type->med_type_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Dosage</option>
                          <?php } ?>
                        </select>
                      <span class="text-red"> <?php echo form_error('product_type'); ?></span>
                    </td>
                    <td>
                      <select class="form-control select2" id="product_generic" name="product_generic">
                          <option value="<?php echo $edit_info->product_generic; ?>"><?php echo $edit_info->product_generic; ?></option>
                          <option value="">Select Generic</option>
                          <?php  if($medicine_generic){ foreach($medicine_generic as $generic) { ?>
                            <option value="<?php echo $generic->med_gen_name; ?>"><?php echo $generic->med_gen_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Generic</option>
                          <?php } ?>
                        </select>
                      <span class="text-red"> <?php echo form_error('product_generic'); ?></span>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="product_pack_size" id="product_pack_size" value="<?php echo $edit_info->product_pack_size; ?>" required>
                      <span class="text-red">* <?php echo form_error('product_pack_size'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php }else{?>
                  <tr>
                  <form class="form-horizontal" action="<?php echo base_url()?>add-medicine" method="post" enctype="multipart/form-data"  role="form">
                    <td>
                      <select class="form-control select2" id="product_manufacturer" name="product_manufacturer" required>
                          <option value="">Select Manufacturer</option>
                          <?php  if($manufacturer_info){ foreach($manufacturer_info as $manufacturer) { ?>
                            <option value="<?php echo $manufacturer->man_name; ?>"><?php echo $manufacturer->man_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Manufacturer</option>
                          <?php } ?>
                        </select>
                      <span class="text-red"> * <?php echo form_error('product_manufacturer'); ?></span>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="product_name" id="product_name" required>
                      <span class="text-red">* <?php echo form_error('product_name'); ?></span>
                    </td>
                    <td>
                      <select class="form-control select2" id="product_type" name="product_type">
                          <option value="">Select Dosage </option>
                          <?php  if($medicine_type){ foreach($medicine_type as $type) { ?>
                            <option value="<?php echo $type->med_type_name; ?>"><?php echo $type->med_type_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Dosage</option>
                          <?php } ?>
                        </select>
                      <span class="text-red"> <?php echo form_error('product_type'); ?></span>
                    </td>
                    <td>
                      <select class="form-control select2" id="product_generic" name="product_generic">
                          <option value="">Select Generic</option>
                          <?php  if($medicine_generic){ foreach($medicine_generic as $generic) { ?>
                            <option value="<?php echo $generic->med_gen_name; ?>"><?php echo $generic->med_gen_name; ?></option>
                          <?php } }else{ ?>
                          <option value="">No Generic</option>
                          <?php } ?>
                        </select>
                      <span class="text-red"> <?php echo form_error('product_generic'); ?></span>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="product_pack_size" id="product_pack_size" required>
                      <span class="text-red">* <?php echo form_error('product_pack_size'); ?></span>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-floppy-save"></i></button>
                    </td>
                    </form>
                  </tr>
                  <?php } ?>
                    </tbody>
                </table>


                <div id="result">
                <table class="table table-bordered table-striped table-hover example2">
                    <caption><center>All Medicine List</center></caption>
                    <thead>
                    <tr>
                        <th style="width:12px;">SL.</th>
                        <th>Company Name</th>
                        <th>Product Name</th>
                        <th>Dosage Name</th>
                        <th>Generic Name</th>
                        <th>Box Size</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($medicine){ 
                    $x = 1;
                    foreach($medicine as $med){
                        ?>
                        <td style="width:12px;"><?php echo $x++; ?>.</td>
                        <td><?php echo $med->product_manufacturer;?></td>
                        <td><?php echo $med->product_name;?></td>
                        <td><?php echo $med->product_type;?></td>
                        <td><?php echo $med->product_generic;?></td>
						            <td><?php echo $med->product_pack_size;?></td>
                        <td>
                            <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "edit-medicine/" . $med->product_id; ?>">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Edit
                            </a>
                        </td>
                        </tr>
                    <?php } }else{ echo "No data  found!";}?>
                    </tbody>
                </table>
                </div>
				
            </div>
            <!-- /.box-body -->
        </div>




        <!-- /.row -->

    </section>