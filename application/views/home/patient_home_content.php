<section class="content-header">
<?php
	$success_msg = $this->session->userdata('success');
	$error_msg = $this->session->userdata('error');
	$this->session->unset_userdata('success');
	$this->session->unset_userdata('error');
?>
  <h1>
    Dashboard
    <small>Patient</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Home</li>
  </ol>
</section>

<section class="content">
      
</section>