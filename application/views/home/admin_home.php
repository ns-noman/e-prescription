<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Prescription</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
   <!-- bootstrap datepicker -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- custom css -->
  <link href="<?php echo base_url(); ?>assets/custom.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/tab.css" rel="stylesheet" type="text/css">
  <style type="text/css">
    @media print {
  body{
    -webkit-print-color-adjust: exact; /*chrome & webkit browsers*/
    color-adjust: exact; /*firefox & IE */
  } 
  a[href]:after {
        content: none !important;
    }
}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>E</b>PS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>E-</b>Prescription</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/dist/img/avatar.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('user_name'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar.jpg" class="img-circle" alt="User Image">

                <p>
                   <?php echo $this->session->userdata('user_name'); ?> <br> <?php echo $this->session->userdata('designation'); ?>
                </p>
              </li>
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>admin/admin_log_out" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/dist/img/avatar.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('user_name'); ?></p>
          <p><?php echo $this->session->userdata('designation'); ?></p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active menu-open">
          <a href="<?php echo base_url(); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php
        $privilege = $this->prescription_model->get_user_privilege($this->session->userdata('user_id'));
        $privilege_set = array_column($privilege, 'menu_code');
         ?>

        <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or $this->session->userdata('user_type') == "Operator"){ ?>
        <li class="treeview" id="transaction">
            <a href="#">
              <i class="fa fa-ambulance"></i> <span>Transaction</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('direct-appointment', $privilege_set)){ ?>
              <li><a href="<?php echo base_url(); ?>direct-appointment"><i class="glyphicon glyphicon-tasks"></i> Direct Appointment</a>
              </li>
              <?php } ?> 
              <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('patient-registration', $privilege_set)){ ?>
               <li><a href="<?php //echo base_url(); ?>patient-registration"><i class="glyphicon glyphicon-tasks"></i> Patient Registration</a>
              </li>
              <?php } ?>
             <!-- <li><a href="<?php //echo base_url(); ?>patient-appointment"><i class="glyphicon glyphicon-tasks"></i>Appointment Entry</a>
              </li> -->
            <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('appointment-list', $privilege_set)){ ?>
              <li><a href="<?php echo base_url(); ?>appointment-list"><i class="glyphicon glyphicon-tasks"></i>Appointment List</a>
              </li>
               <?php } ?>
               <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('prescription-list', $privilege_set)){ ?>
              <li><a href="<?php echo base_url(); ?>prescription-list"><i class="glyphicon glyphicon-tasks"></i> Prescriptions</a>
              </li>
               <?php } ?>
            </ul>
        </li>
      <?php } ?> 

       <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('report-list', $privilege_set)){ ?>
        <li>
            <a href="<?php echo base_url(); ?>report-list">
              <i class="fa fa-file-text"></i> <span>Reports</span>
            </a>
        </li>
      <?php } ?>


      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('setup', $privilege_set)){ ?>
        <li class="treeview" id="setup">
          <a href="#">
          <i class="fa fa-cog"></i> <span>Master Data Setup</span>
          <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>department-setup"><i class="glyphicon glyphicon-list"></i> Department Entry</a></li>
          <li><a href="<?php echo base_url(); ?>shift-setup"><i class="glyphicon glyphicon-list"></i> Shift Entry</a></li>
          <li><a href="<?php echo base_url(); ?>schedule-setup"><i class="glyphicon glyphicon-list"></i> Schedule Entry</a></li>
          <li><a href="<?php echo base_url(); ?>chief-complaint-setup"><i class="glyphicon glyphicon-list"></i> Chief Complaint Entry</a></li>     
          <li><a href="<?php echo base_url(); ?>examination-setup"><i class="glyphicon glyphicon-list"></i> Examination Entry</a></li>
          <li><a href="<?php echo base_url(); ?>history-setup"><i class="glyphicon glyphicon-list"></i> History Entry</a></li>
          <li><a href="<?php echo base_url(); ?>diagnosis-setup"><i class="glyphicon glyphicon-list"></i> Diagnosis Entry</a></li>
          <li><a href="<?php echo base_url(); ?>investigation-type-setup"><i class="glyphicon glyphicon-list"></i> Investigation Type</a></li>
          <li><a href="<?php echo base_url(); ?>investigation-setup"><i class="glyphicon glyphicon-list"></i> Investigation</a></li>
          <li><a href="<?php echo base_url(); ?>health-advice-setup"><i class="glyphicon glyphicon-list"></i> Health Advice</a></li>
          <li><a href="<?php echo base_url(); ?>special-note-setup"><i class="glyphicon glyphicon-list"></i> Special Note</a></li>
          <li><a href="<?php echo base_url(); ?>doses-administration-setup"><i class="glyphicon glyphicon-list"></i> Doses Administration</a></li>
          <li><a href="<?php echo base_url(); ?>doses-duration-setup"><i class="glyphicon glyphicon-list"></i> Doses Duration</a></li>
          <li><a href="<?php echo base_url(); ?>meal-administration-setup"><i class="glyphicon glyphicon-list"></i> Meal Administration</a></li>
          <li><a href="<?php echo base_url(); ?>refer-setup"><i class="glyphicon glyphicon-list"></i> Referral Organization / Doctor</a></li>
          </ul>
        </li>
      <?php } ?>

      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('pharmacy', $privilege_set)){ ?>
        <li class="treeview" id="pharmacy">
            <a href="#">
              <i class="fa fa-medkit"></i> <span>Pharmacy</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>medicine-setup"><i class="glyphicon glyphicon-tasks"></i> Medicine Entry</a></li>     
              <li><a href="<?php echo base_url(); ?>medicine-type"><i class="glyphicon glyphicon-tasks"></i> Medicine Dosage</a></li>     
              <li><a href="<?php echo base_url(); ?>medicine-generic"><i class="glyphicon glyphicon-list"></i> Medicine Generic</a></li>
               <li class="treeview">
                <a href="#">
                <i class="fa fa-gavel"></i> <span>Manufacturer</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>new-manufacturer"><i class="glyphicon glyphicon-tasks"></i> Add Manufacturer</a></li>     
                <li><a href="<?php echo base_url(); ?>manufacturer-list"><i class="glyphicon glyphicon-list"></i> Manage Manufacturer</a></li>
                </ul>
              </li>
            </ul>
        </li>
      <?php } ?>

      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('doctors', $privilege_set)){ ?>
        <li class="treeview" id="doctors">
            <a href="#">
              <i class="fa fa-stethoscope"></i> <span>Doctors</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>new-doctor"><i class="glyphicon glyphicon-tasks"></i> New Doctor</a>
              </li>
              <li><a href="<?php echo base_url(); ?>doctor-list"><i class="glyphicon glyphicon-tasks"></i> Doctor List</a>
              </li>
            </ul>
        </li>
      <?php } ?>

      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('templats', $privilege_set)){ ?>
        <li class="treeview" id="templats">
            <a href="#">
              <i class="fa fa-sticky-note"></i> <span>Templats</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>new-template"><i class="glyphicon glyphicon-tasks"></i> New Template</a>
              </li>
              <li><a href="<?php echo base_url(); ?>template-list"><i class="glyphicon glyphicon-tasks"></i>Department Template List</a>
              <li><a href="<?php echo base_url(); ?>doctorwise-template-list"><i class="glyphicon glyphicon-tasks"></i> Doctor Template List</a>
              </li>
            </ul>
        </li>
      <?php } ?>


      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or in_array('users', $privilege_set)){ ?>
        <li class="treeview" id="users">
          <a href="#">
          <i class="fa fa-user"></i> <span>Users</span>
          <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>new-user"><i class="glyphicon glyphicon-tasks"></i> New User</a></li>     
          <li><a href="<?php echo base_url(); ?>user-list"><i class="glyphicon glyphicon-list"></i> User List</a></li>
           <?php if($this->session->userdata('user_type') == "Super Admin"){ ?>
          <li><a href="<?php echo base_url(); ?>menu-setup"><i class="glyphicon glyphicon-list"></i> Menu Setup</a></li>
          <?php } ?>
          </ul>
        </li>
      <?php } ?>

        <li>
            <a href="<?php echo base_url() . "reset-password/" . $this->session->userdata('user_id'); ?>">
              <i class="fa fa-key"></i> <span>Change Password</span>
            </a>
        </li>
    

    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <?php if($main){
            echo $main_content;
        }
        ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
   <strong>Developed by <a href="http://sysdevltd.com" target="_blank">Sys Dev Ltd.</a></strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<!-- <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard2.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script> -->

<!-- ckeditor -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/adapters/jquery.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script type="text/javascript">

    CKEDITOR.disableAutoInline = true;

    $( document ).ready( function() {
      $( '.editor1' ).ckeditor(); // Use CKEDITOR.replace() if element is <textarea>.
      
    } );
  </script>
<!-- page script -->
<script>
  //select2 
  $(function () {
    $('.select2').select2()
  });

  //Date picker
  $('.datepicker').datepicker({
  autoclose: true,
  dateFormat: 'yy-mm-dd',
  changeMonth: true,
  yearRange: "-100:+50",
  changeYear: true
  });

  //Date picker
  $('.datepicker2').datepicker({
  autoclose: true,
  dateFormat: 'yy-mm-dd',
  changeMonth: true,
  yearRange: "-100:+50",
  changeYear: true,
  //minDate: 0
  });

  //Date picker
  $('.datepicker3').datepicker({
  autoclose: true,
  dateFormat: 'yy-mm-dd',
  changeMonth: true,
  yearRange: "-100:+50",
  changeYear: true,
  maxDate: 0
  });



  //DataTables
  $('.example1').DataTable()
    $('.example2').DataTable({
      'scrollY': '400px',
      'scrollX': "100%",
      'scrollCollapse': true,
      'paging': false,
      'lengthChange': false,
      'ordering'    : false,
      //'scrollX': true,
       dom: 'Bfrtip',
       buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
</script>
<!-- text area limit -->
 <script type="text/javascript">
   $('.limited').keyup(function () {
  var max = 250;
  var len = $(this).val().length;
  if (len >= max) {
    $('#charNum').text(' you have reached the limit');
  } else {
    var char = max - len;
    $('#charNum').text(char + ' characters left');
  }
});
</script>

 <script>
function myFunction() {
  window.print();
}
</script>

<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
  document.body.style.marginTop=".5in";
  document.body.style.marginBottom=".5in";
    window.print();
    //document.body.innerHTML = originalContents;
    location.reload();
}
</script>


<!--date wise appointments info-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#app_date').change(function(){
            var app_date = $('#app_date').val();
            //alert(patient_reg);
            $.ajax({
                    type : 'POST',
                    data : {app_date : app_date},
                    url : '<?php echo site_url('admin/get_datewise_appointment'); ?>',
                    success : function(result){
                        $('#appointments_list').html(result);
                    }

                });
        });


    });
</script>

<!-- product search -->
<script type="text/javascript">
$(document).ready(function(){

 //load_data();

 function load_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>admin/product_search",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#result').html(data);
   }
  })
 }

 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>

<!-- patient search -->
<script type="text/javascript">
$(document).ready(function(){

 //load_patient_data();

 function load_patient_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>admin/patient_search",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#patient_result').html(data);
   }
  })
 }

 $('#patient_search').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_patient_data(search);
  }
  else
  {
   load_patient_data();
  }
 });
});
</script>

<!-- prescription search -->
<script type="text/javascript">
$(document).ready(function(){

 //load_prescription_data();

 function load_prescription_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>admin/prescription_search",
   method:"POST",
   data:{query:query},
   success:function(data){
    $('#prescription_result').html(data);
   }
  })
 }

 $('#prescription_search').keyup(function(){
  var search = $(this).val();

  if(search != '')
  {
   load_prescription_data(search);
  }
  else
  {
   load_prescription_data();
  }
 });
});
</script>

<!-- kg to lbs -->
<script type="text/javascript">
  $('#patient_weight_kg').keyup(function() {
    var patient_weight_kg = document.getElementById("patient_weight_kg").value;
    var patient_weight_lbs = patient_weight_kg*2.20462262;
    document.getElementById("patient_weight_lbs").value = patient_weight_lbs.toFixed(2);
});
</script>

<!-- f to c -->
<script type="text/javascript">
  $('#patient_temperature_f').keyup(function() {
    var patient_temperature_f = document.getElementById("patient_temperature_f").value;
    if(patient_temperature_f !=''){
    var patient_temperature_c = (patient_temperature_f-32)*5/9;
    document.getElementById("patient_temperature_c").value = patient_temperature_c.toFixed(2);
  }else{document.getElementById("patient_temperature_c").value = '';}
});
</script>

<!-- c to f -->
<script type="text/javascript">
  $('#patient_temperature_c').keyup(function() {
    var patient_temperature_c = document.getElementById("patient_temperature_c").value;
    if(patient_temperature_c !=''){
    var patient_temperature_f = patient_temperature_c*9/5+32;
    document.getElementById("patient_temperature_f").value = patient_temperature_f.toFixed(2);
    }else{document.getElementById("patient_temperature_f").value = '';}
});
</script>

<script type="text/javascript">
 $(function () {
    /* ChartJS*/
    var visitData = JSON.parse(`<?php echo $visit_data; ?>`);
    var areaChartData = {
      labels  : visitData.visit_label,
      datasets: [
        {
          label               : 'Male',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : visitData.male_count
        },
        {
          label               : 'Female',
          fillColor           : '#f39c12',
          strokeColor         : '#f39c12',
          pointColor          : '#f39c12',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgb(220,220,220)',
          data                : visitData.female_count
        }
      ]
    }


    
    //-------------
    //- BAR CHART option-
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    //barChartData.datasets[1].fillColor   = '#00a65a'
    //barChartData.datasets[1].strokeColor = '#00a65a'
   // barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  });

  //-------------
  //- BAR CHART -
  //-------------



  $(function () {
  var subData = JSON.parse(`<?php echo $visit_data; ?>`);
  var salesChartCanvas = $('#visitChart').get(0).getContext('2d');
  var salesChart       = new Chart(salesChartCanvas);
  
  var salesChartData = {
    labels  : subData.sub_label,
    datasets: [
      {
        label               : 'Male',
        fillColor           : 'rgb(210, 214, 222)',
        strokeColor         : 'rgb(210, 214, 222)',
        pointColor          : 'rgb(210, 214, 222)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgb(220,220,220)',
        data                : subData.female_count
      },
      {
        label               : 'Female',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : subData.male_count
      }
    ]
  };

  var salesChartOptions = {
    // Boolean - If we should show the scale at all
    showScale               : true,
    // Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines      : false,
    // String - Colour of the grid lines
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    // Number - Width of the grid lines
    scaleGridLineWidth      : 1,
    // Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    // Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines  : true,
    // Boolean - Whether the line is curved between points
    bezierCurve             : true,
    // Number - Tension of the bezier curve between points
    bezierCurveTension      : 0.3,
    // Boolean - Whether to show a dot for each point
    pointDot                : false,
    // Number - Radius of each point dot in pixels
    pointDotRadius          : 4,
    // Number - Pixel width of point dot stroke
    pointDotStrokeWidth     : 1,
    // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius : 20,
    // Boolean - Whether to show a stroke for datasets
    datasetStroke           : true,
    // Number - Pixel width of dataset stroke
    datasetStrokeWidth      : 2,
    // Boolean - Whether to fill the dataset with a color
    datasetFill             : true,
    // String - A legend template
    legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  };

  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

  // ---------------------------
  // - END MONTHLY SALES CHART -
  // ---------------------------
});

 $(function () { 
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieData = JSON.parse(`<?php echo $type_data; ?>`);
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    {
      value    : pieData.emergency,
      color    : '#f56954',
      highlight: '#f56954',
      label    : 'Emergency'
    },
    {
      value    : pieData.followup,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'Followup'
    },
    {
      value    : pieData.general,
      color    : '#f39c12',
      highlight: '#f39c12',
      label    : 'General'
    },
    {
      value    : pieData.consultation,
      color    : '#00c0ef',
      highlight: '#00c0ef',
      label    : 'Consultation'
    },
    
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%> Patients'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------

});

</script>
<!--patient info-->
<!-- <script type="text/javascript">
    $(document).ready(function(){

      function patientInfo(){
        var patient_reg = $('#patient_id').val();
            $.ajax({
                    type : 'POST',
                    data : {patient_reg : patient_reg},
                    url : '<?php echo site_url('admin/get_patient_info'); ?>',
                    success : function(result){
                        $('#patient_info').html(result);
                    }

                });
      
        }

      $('#patient_reg, #patient_mobile, #patient_name').click(function(){
          patientInfo();
        });


    });
</script> -->

<!-- department -->
<script type="text/javascript">
    $(document).ready(function(){
    // Initialize 
    $( "#department" ).autocomplete({
      source: function( request, response ) {
        // Fetch data
        $.ajax({
          url: "<?php echo site_url('doctor/department_search');?>",
          type: 'post',
          dataType: "json",
          data: {
            search: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      
      change: function(event, ui) {
        if (ui.item == null) {
          event.currentTarget.value = ''; 
          event.currentTarget.focus();
        }
      },

      select: function (event, ui) {
        // Set selection
        $('#department_id').val(ui.item.code); // display the selected code
        $('#department').val(ui.item.label); // display the selected text
        return false;
      }

    });

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
     var wrapper = $('.department_wrapper'); //Input field wrapper
      //Once add button is clicked
      $('.add_grp_button').click(function(){
      var department = $("#department").val();
      var department_id = $("#department_id").val();
      var fieldHTML = '<div><a href="javascript:void(0);" class="remove_grp_button btn btn-danger btn-xs"><i class="fa fa-remove"></i></a> <label class="control-label">'+ department +'</label><input type="hidden" class="form-control" name="department_code[]" value="'+ department_id +'"> </div>'; 
          if (department == "") {
              alert("department not Valid");
              return false;
            }
          
          $(wrapper).append(fieldHTML);
          $('#department').val('');
          
      });
      
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_grp_button', function(e){
          e.preventDefault();
          $(this).parent('div').remove(); //Remove field html
          
      });
  });
</script>

<!-- diagnosis search -->
<script type='text/javascript'>
$(document).ready(function()
{
 $( "#diagnosis_search" ).autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo site_url('doctor/diagnosis_search');?>",
        type: 'post',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('#diagnosis_search').val(ui.item.label);
      return false;
    }
  });
});
</script>


<!-- add diagnosis -->
<script type="text/javascript">
$(document).ready(function(){

 function add_diagnosis()
 {
    var patient_diagnosis = document.getElementById("patient_diagnosis").value;
    var diagnosis = document.getElementById("diagnosis_search").value;

    document.getElementById("patient_diagnosis").value = patient_diagnosis+'\n'+diagnosis;
    document.getElementById("diagnosis_search").value = "";
 }

 $('#add_diagnosis').click(function(){
   add_diagnosis();
 });

});
</script>

<!-- medicine search -->
<script type='text/javascript'>
$(document).ready(function()
{
 $( "#medicine_search" ).autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo site_url('doctor/medicine_search');?>",
        type: 'post',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('#medicine_search').val(ui.item.label);
      return false;
    }
  });
});
</script>

<!-- add medicine -->
<script type="text/javascript">
$(document).ready(function(){

 function add_medicine()
 {
    var patient_medicine = document.getElementById("patient_medicine").value;
    var medicine = document.getElementById("medicine_search").value;
    var doses = document.getElementById("doses_administration").value;
    var duration = document.getElementById("doses_duration").value;
    var meal = document.getElementById("meal_administration").value;

    document.getElementById("patient_medicine").value = patient_medicine+'\n'+medicine+'|'+doses+'|'+duration+
    '|'+meal;
    document.getElementById("medicine_search").value = "";
    document.getElementById("doses_administration").value = "";
    document.getElementById("doses_duration").value = "";
    document.getElementById("meal_administration").value = "";
 }

 $('#add_medicine').click(function(){
   add_medicine();
 });

});
</script>

<script>
    $(document).ready(function() {
        $("#med_list").click(function(){
            var med = [];
            $.each($("input[name='pre_med']:checked"), function(){            
                med.push($(this).val());
            });

            var patient_medicine = document.getElementById("patient_medicine").value;
            document.getElementById("patient_medicine").value = patient_medicine+'\n'+med.join("\n");
            $('input[type="checkbox"]').prop('checked', false);
        });
    });
</script>

<!-- test search -->
<script type='text/javascript'>
$(document).ready(function()
{
 $( "#test_name" ).autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo site_url('doctor/test_search');?>",
        type: 'post',
        dataType: "json",
        data: {
          search: request.term,
          service_type : $("#service_type").val()
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('#test_name').val(ui.item.label);
      return false;
    }
  });
});
</script>

<!-- add test -->
<script type="text/javascript">
$(document).ready(function(){

 function add_test()
 {
    var patient_test = document.getElementById("patient_test").value;
    var service_type = document.getElementById("service_type").value;
    var test_name = document.getElementById("test_name").value;
    document.getElementById("patient_test").value = patient_test+'\n'+test_name;
    document.getElementById("service_type").value = "";
    document.getElementById("test_name").value = "";
 }

 $('#add_test').click(function(){
   add_test();
 });

});
</script>

<!-- advice search -->
<script type='text/javascript'>
$(document).ready(function()
{
 $( "#advice_search" ).autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo site_url('doctor/advice_search');?>",
        type: 'post',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('#advice_search').val(ui.item.label);
      return false;
    }
  });
});
</script>

<!-- add advice -->
<script type="text/javascript">
$(document).ready(function(){

 function add_advice()
 {
    var patient_advice = document.getElementById("patient_advice").value;
    var advice = document.getElementById("advice_search").value;

    document.getElementById("patient_advice").value = patient_advice+'\n'+advice;
    document.getElementById("advice_search").value = "";
 }

 $('#add_advice').click(function(){
   add_advice();
 });

});
</script>

<script>
    $(document).ready(function() {
        $("#advice_list").click(function(){
            var favorite = [];
            $.each($("input[name='advice']:checked"), function(){            
                favorite.push($(this).val());
            });

            var patient_advice = document.getElementById("patient_advice").value;
            document.getElementById("patient_advice").value = patient_advice+'\n'+favorite.join("\n");
            $('input[type="checkbox"]').prop('checked', false);
        });
    });
</script>

<!-- note search -->
<script type='text/javascript'>
$(document).ready(function()
{
 $( "#note_search" ).autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo site_url('doctor/note_search');?>",
        type: 'post',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('#note_search').val(ui.item.label);
      return false;
    }
  });
});
</script>

<!-- add note -->
<script type="text/javascript">
$(document).ready(function(){

 function add_note()
 {
    var patient_note = document.getElementById("patient_note").value;
    var note = document.getElementById("note_search").value;

    document.getElementById("patient_note").value = patient_note+'\n'+note;
    document.getElementById("note_search").value = "";
 }

 $('#add_note').click(function(){
   add_note();
 });

});
</script>


<script type="text/javascript">
  $(document).ready(function () {
      $('#actionbtn').click(function() {
        checked = $("input[type=checkbox]:checked").length;
        if(!checked) {
          alert("You must check at least one Week Day.");
          return false;
        }
      });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
// Initialize 
$( "#doctor_name" ).autocomplete({
  source: function( request, response ) {
    // Fetch data
    $.ajax({
      url: "<?php echo site_url('get-doctor');?>",
      type: 'post',
      dataType: "json",
      data: {
        search: request.term
      },
      success: function( data ) {
        response( data );
      }
    });
  },
  
  change: function(event, ui) {
    if (ui.item == null) {
      event.currentTarget.value = ''; 
      event.currentTarget.focus();
    }
  },

  select: function (event, ui) {
    // Set selection
    $('#doctor_name').val(ui.item.label); // display the selected text
    $('#doctor_id').val(ui.item.value); // save selected id to input
    $('#department_id').val(ui.item.dept); // save selected id to input

    var doctor_id = $('#doctor_id').val();
        $.ajax({
                type : 'POST',
                data : {doctor_id : doctor_id},
                url : '<?php echo site_url('get-doctor-schedule'); ?>',
                success : function(result){
                    $('#schedule_info').html(result);
                }

            });
    
    return false;
  }

});

});
</script>

<!--shedule doctor -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#app_shift').change(function(){
            var shift = $('#app_shift').val();
            var app_date = $('#app_date').val();
            $.ajax({
                type : 'POST',
                data : {shift : shift,
                        app_date : app_date
                        },
                url : '<?php echo site_url('app-shift-doctor'); ?>',
                success : function(result){
                    $('#doctor_name').html(result);
                }
            });
        });
    }); 
</script>

<!-- Direct appointment form start -->
<!--menue list -->
<script type="text/javascript">
    $(document).ready(function(){
      var role = $('#type').val();
      if (role == "Operator") {
        $("#operator").show();
        $("#admin").hide();
      }else{
        $("#operator").hide();
        $("#admin").show();
      }
      $('#type').change(function(){
          var type = $('#type').val();
          if (type == "Operator") {
            $("#operator").show();
            $("#admin").hide();
          }else{
            $("#operator").hide();
            $("#admin").show();
          }
      });
    }); 
</script>

<!-- When Date selected and shift are changed -->
<!-- pull list of doctor available at that date -->
<!-- ajax 1 -->
<script type="text/javascript">
    $(document).ready(function(){
      $('#shift').change(function(){
          var shift = $('#shift').val();
          var app_date = $('#app_date').val();
          //var doctor_department = $('#doctor_department').val();
          //alert (pt_test);
          $.ajax({
              type : 'POST',
              data : {shift : shift,
                      app_date : app_date
                      //doctor_department : doctor_department
                      },
              url : '<?php echo site_url('shift-doctor'); ?>',
              success : function(result){
                  // alert('ajax-1');
                  $('#doctor_info').html(result);
              }
          });
      });
    }); 
</script>

<!-- When a doctor name is selected -->
<!-- this fumction is called to get the doctor slot -->
<!-- pull list of doctor slot -->
<!-- ajax 2 -->
<script>
function doctor_slot(a){
    var app_date = $('#app_date').val();
    $.ajax({
        type : 'POST',
        data : {schedule_id : a,
                app_date : app_date
        },
        url : '<?php echo site_url('doctor-app-list'); ?>',
        success : function(result){
            // alert('ajax-2');
            $('#slot_info').html(result);
        }
      });
    }
</script>

<!-- When patient name or mobile number trying to input -->
<!-- pull patient info if it exista in database -->
<!-- ajax 3 & 4 -->
<script type="text/javascript">
  $(document).ready(function(){
    // Initialize
    $( "#patient_name, #patient_mobile, #patient_reg" ).autocomplete({
      source: function( request, response ) {
        // Fetch data
        $.ajax({
          url: "<?php echo site_url('get-patient');?>",
          type: 'post',
          dataType: "json",
          data: {
            search: request.term
          },
          success: function( data ) {
            //alert('ajax-3');
            response( data );
          }
        });
      },
      select: function (event, ui) {
        // Set selection
        $('#patient_mobile').val(ui.item.code); // display the selected code
        $('#patient_name').val(ui.item.label); // display the selected text
        $('#patient_reg').val(ui.item.value); // save selected id to input
        $('#patient_id').val(ui.item.id); // save selected id to input
        $('#year').val(ui.item.year); // save selected id to input
        $('#month').val(ui.item.month); // save selected id to input
        $('#day').val(ui.item.day); // save selected id to input
        var patient_reg = $('#patient_id').val();
          $.ajax({
              type : 'POST',
              data : {patient_reg : patient_reg},
              url : '<?php echo site_url('admin/get_patient_info'); ?>',
              success : function(result){
                  // alert('ajax-4');
                  $('#patient_info').html(result);
              }
          });
        return false;
      }
    });
  });
</script>

<!-- While adding doctor references -->
<!-- will search given name in database -->
<!-- ajax-5 -->
<script type='text/javascript'>
    $(document).ready(function(){
      $( "#patient_ref" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: "<?php echo site_url('doctor/ref_search');?>",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              // alert('ajax-5');
              response( data );
            }
          });
        },
        select: function (event, ui) {
          $('#patient_ref').val(ui.item.label);
          return false;
        }
      });
    });
</script>
<!-- Direct appointment form end -->

</body>
</html>
