<div class="container">
  <!-- Content Header (Page header) -->
  
  <section class="content-header">

    <div class="col-md-4 col-sm-offset-4">
    <div class="box box-primary">
      <div class="box-body">
        <p class="login-box-msg">Use Your Registration Number and Mobile Number  to Sign In</p>
      <?php
        $success = $this->session->userdata('success_message');
        $error = $this->session->userdata('error_message');
            $this->session->unset_userdata('success_message');
            $this->session->unset_userdata('error_message');
        echo $success;
        echo $error; 
      ?>
      <?php echo $this->session->flashdata('verify_msg'); ?>
    <form action="<?php echo base_url(); ?>patient-login" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="reg_no" id="reg_no" placeholder="Registration Number" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile Number" required>
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      
      <div class="row">
        <div class="col-xs-4 col-sm-offset-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
      </div>
    </form>


      </div>
    </div>
    </div>
  </section>

</div>
