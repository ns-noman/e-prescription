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
  <!-- validator -->
  <!-- <link href="<?php echo base_url(); ?>assets/themes/bvalidator.theme.bootstrap.rt.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/themes/bvalidator.theme.bootstrap.rc.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/themes/bvalidator.theme.gray3.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/bvalidator.css" rel="stylesheet" type="text/css" /> -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- custom css -->
  <link href="<?php echo base_url(); ?>assets/custom.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/tab.css" rel="stylesheet" type="text/css">
  <style>
  @media print {
    a[href]:after {
        content: none !important;
    }
}
  </style>
  
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="urlchange()">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url();?>doctor" class="logo">
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
                   <?php echo $this->session->userdata('user_name'); ?>
                </p>
              </li>
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>sign-out" class="btn btn-default btn-flat">Sign out</a>
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
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->session->userdata('designation'); ?></a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active menu-open">
          <a href="<?php echo base_url(); ?>doctor">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or $this->session->userdata('user_type') == "Doctor"){ ?>
        <li class="treeview">
          <a href="#">
          <i class="fa fa-list"></i> <span>Appointments</span>
          <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>doctor-appointment-list"><i class="glyphicon glyphicon-tasks"></i>Waiting Appointments</a></li>
          </ul>
        </li>
      <?php } ?>


      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or $this->session->userdata('user_type') == "Doctor"){ ?>
        <li>
            <a href="<?php echo base_url(); ?>doctor-prescription-list">
              <i class="fa fa-list"></i> <span>Prescriptions</span>
            </a>
        </li>
      <?php } ?>



      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or $this->session->userdata('user_type') == "Doctor"){ ?>
        <li class="treeview">
            <a href="#">
              <i class="fa fa-sticky-note"></i> <span>Templats</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url(); ?>new-doctor-template"><i class="glyphicon glyphicon-tasks"></i> New Template</a>
              </li>
              <li><a href="<?php echo base_url(); ?>doctor-template-list"><i class="glyphicon glyphicon-tasks"></i>Template List</a>
              </li>
            </ul>
        </li>
      <?php } ?>

      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or $this->session->userdata('user_type') == "Doctor"){ ?>
        <li class="treeview" id="setup">
          <a href="#">
          <i class="fa fa-cog"></i> <span>Master Data Setup</span>
          <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>chief-complaint-setup"><i class="glyphicon glyphicon-list"></i> Chief Complaint Entry</a></li>     
          <li><a href="<?php echo base_url(); ?>examination-setup"><i class="glyphicon glyphicon-list"></i> Examination Entry</a></li>
          <li><a href="<?php echo base_url(); ?>history-setup"><i class="glyphicon glyphicon-list"></i> History Entry</a></li>
          <li><a href="<?php echo base_url(); ?>diagnosis-setup"><i class="glyphicon glyphicon-list"></i> Diagnosis Entry</a></li>
          <li><a href="<?php echo base_url(); ?>health-advice-setup"><i class="glyphicon glyphicon-list"></i> Health Advice</a></li>
          <li><a href="<?php echo base_url(); ?>special-note-setup"><i class="glyphicon glyphicon-list"></i> Special Note</a></li>
          <li><a href="<?php echo base_url(); ?>doses-administration-setup"><i class="glyphicon glyphicon-list"></i> Doses Administration</a></li>
          <li><a href="<?php echo base_url(); ?>doses-duration-setup"><i class="glyphicon glyphicon-list"></i> Doses Duration</a></li>
          <li><a href="<?php echo base_url(); ?>meal-administration-setup"><i class="glyphicon glyphicon-list"></i> Meal Administration</a></li>
          </ul>
        </li>
      <?php } ?>

      <?php if($this->session->userdata('user_type') == "Super Admin" or $this->session->userdata('user_type') == "Admin" or $this->session->userdata('user_type') == "Doctor"){ ?>
        <li>
            <a href="<?php echo base_url() . "doctor-password/" . $this->session->userdata('user_id'); ?>">
              <i class="fa fa-key"></i> <span>Change Password</span>
            </a>
        </li>
      <?php } ?>

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

  <footer class="main-footer no-print">
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
 <!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
  maxDate: new Date,
  changeYear: true
  });

  //Date picker
  $('.datepicker2').datepicker({
  autoclose: true,
  dateFormat: 'yy-mm-dd',
  changeMonth: true,
  yearRange: "-100:+50",
  changeYear: true,
  minDate: 0
  });

  //DataTables
  $('.example1').DataTable()
    $('.example2').DataTable({
      'scrollY': '400px',
      //'scrollX': "100%",
      'scrollCollapse': true,
      'paging': false,
      'lengthChange': false,
      'ordering'    : false,
       dom: 'Bfrtip',
       buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    })

    //DataTables
    $('.example3').DataTable({
      'autoWidth': true,
      'searching': false,
      'paging': false,
      'ordering': false,
      'lengthChange': false,
      'info': false,
      fixedHeader: {
            header: true
        }
    });

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

<!-- bmi calculation -->
<script type="text/javascript">
$(document).ready(function(){

 function bmi_calculation()
 {
    var height_feet = document.getElementById("height_feet").value * 0.3048;
    var height_inch = document.getElementById("height_inch").value * 0.0254;
    var weight_kg = document.getElementById("patient_weight_kg").value;
    //var height_total_in = height_feet + height_inch;
    //var height_mt = height_total_in * 0.0254;
    var height_mt = height_feet+height_inch;
    var height_mt_pow = Math.pow(height_mt, 2);
    var bmi = weight_kg / height_mt_pow;
  
   document.getElementById("patient_bmi").value = bmi.toFixed(2);
 }

 $('.bmi').change(function(){
   bmi_calculation();
 });

 $('#patient_weight_kg').keyup(function(){
   bmi_calculation();
 });
});
</script>

<!-- history search -->
<script type='text/javascript'>
$(document).ready(function()
{
 $( "#history_search" ).autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo site_url('doctor/history_search');?>",
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
      $('#history_search').val(ui.item.label);
      return false;
    }
  });
});
</script>

<!-- add history -->
<script type="text/javascript">
$(document).ready(function(){

 function add_history()
 {
    var content = document.getElementById("patient_history").value;
    var history = document.getElementById("history_search").value;

    document.getElementById("patient_history").value = content+'\n'+history;
    document.getElementById("history_search").value = "";
 }

 $('#add_history').click(function(){
   add_history();
 });

 $('#history_search' ).on( 'keydown', function ( evt ) {
    if( evt.keyCode == 13 )
        add_history();
}); 

});
</script>

<!-- complaint search -->
<script type='text/javascript'>
$(document).ready(function()
{
 $( "#complaint_search" ).autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo site_url('doctor/complaint_search');?>",
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
      $('#complaint_search').val(ui.item.label);
      return false;
    }
  });
});
</script>

<!-- add complaint -->
<script type="text/javascript">
$(document).ready(function(){

 function add_complaint()
 {
    var chief_complaint = document.getElementById("chief_complaint").value;
    var complaint = document.getElementById("complaint_search").value;
    var duration = document.getElementById("complaint_duration").value;
    var unit = document.getElementById("complaint_Unit").value;

    document.getElementById("chief_complaint").value = chief_complaint+'\n'+complaint+'-'+duration+'-'+unit;
    document.getElementById("complaint_search").value = "";
    document.getElementById("complaint_duration").value = "";
    document.getElementById("complaint_Unit").value = "";
 }

 $('#add_complaint').click(function(){
   add_complaint();
 });

});
</script>

<!-- exam search -->
<script type='text/javascript'>
$(document).ready(function()
{
 $( "#exam_search" ).autocomplete({
    source: function( request, response ) {
      $.ajax({
        url: "<?php echo site_url('doctor/exam_search');?>",
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
      $('#exam_search').val(ui.item.label);
      return false;
    }
  });
});
</script>

<!-- add on exam -->
<script type="text/javascript">
$(document).ready(function(){

 function add_exam()
 {
    var on_exam = document.getElementById("on_exam").value;
    var exam = document.getElementById("exam_search").value;

    document.getElementById("on_exam").value = on_exam+'\n'+exam;
    document.getElementById("exam_search").value = "";
 }

 $('#add_exam').click(function(){
   add_exam();
 });

  $('#exam_search' ).on( 'keydown', function ( evt ) {
    if( evt.keyCode == 13 )
        add_exam();
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

 $('#diagnosis_search' ).on( 'keydown', function ( evt ) {
    if( evt.keyCode == 13 )
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
          search: request.term
          //service_type : $("#service_type").val()
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
    //var service_type = document.getElementById("service_type").value;
    var test_name = document.getElementById("test_name").value;

    document.getElementById("patient_test").value = patient_test+'\n'+test_name;
    //document.getElementById("service_type").value = "";
    document.getElementById("test_name").value = "";
 }

 $('#add_test').click(function(){
   add_test();
 });

 $('#test_name' ).on( 'keydown', function ( evt ) {
    if( evt.keyCode == 13 )
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

 $('#advice_search' ).on( 'keydown', function ( evt ) {
    if( evt.keyCode == 13 )
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

 $('#note_search' ).on( 'keydown', function ( evt ) {
    if( evt.keyCode == 13 )
        add_note();
});

});
</script>

<!-- ref search -->
<script type='text/javascript'>
$(document).ready(function()
{
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

<!-- prescription search -->
<script type="text/javascript">
$(document).ready(function(){

 //load_prescription_data();

 function load_prescription_data(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>doctor/prescription_search",
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

<!-- prescription template -->
<script type="text/javascript">
$(document).ready(function(){

 function load_prescription_template(query)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>get-prescription-template",
   method:"POST",
   data:{query:query},
   success:function(data){
    //$('#patient_history').val(data);
    var temp = jQuery.parseJSON(data);
    $('#patient_diagnosis').val(temp.diagnosis);
    $('#patient_medicine').val(temp.medicine);
    $('#patient_test').val(temp.test);
    $('#patient_advice').val(temp.advice);
    $('#patient_note').val(temp.note);

   }
  });
  

 }

 $('#template').change(function(){
  var template_id = $(this).val();

  if(template_id != '')
  {
   load_prescription_template(template_id);
  }
  else
  {
   load_prescription_template();
  }
 });
});
</script>

<script type="text/javascript">
  $('#pre_form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13 && !$(document.activeElement).is('textarea')) { 
    e.preventDefault();
    return false;
  }
});
</script>

</body>
</html>
