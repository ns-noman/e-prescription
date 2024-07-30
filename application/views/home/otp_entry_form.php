<div class="container">
  <!-- Content Header (Page header) -->
  
  <section class="content-header">

    <div class="col-md-4 col-sm-offset-4">
    <div class="box box-primary">
      <div class="box-body">
        <p class="login-box-msg">Please Enter OPT Sent to Your Mobile Number</p>
      <?php
        $success = $this->session->userdata('success_message');
        $error = $this->session->userdata('error_message');
            $this->session->unset_userdata('success_message');
            $this->session->unset_userdata('error_message');
        echo $success;
        echo $error; 
      ?>
      <?php echo $this->session->flashdata('verify_msg'); ?>
    <form action="<?php echo base_url() . "patient-otp-login/" . $patient; ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="otp_no" id="otp_no" placeholder="OTP" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <div class="col-sm-4 pull-right">
          <a href="<?php echo base_url();?>" class="btn btn-danger btn-block btn-flat">Resend</a>
        </div>
      </div>
    </form>


      </div>
    </div>
    </div>
  </section>

</div>
