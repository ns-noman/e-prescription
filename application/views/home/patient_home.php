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
  
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="urlchange()">
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
                   <?php echo $this->session->userdata('user_name'); ?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>patient-logout" class="btn btn-default btn-flat">Sign out</a>
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
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active menu-open">
          <a href="<?php echo base_url(); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

      <?php if($this->session->userdata('user_type') == "Patient"){ ?>
        <li class="treeview">
          <a href="#">
          <i class="fa fa-ambulance"></i> <span>Visits</span>
          <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-tasks"></i>Visit List</a></li>
          <li><a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-tasks"></i>Request Visit</a></li>
          </ul>
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

<!--clculate unit price-->
<script type="text/javascript">
var a = document.getElementById("pack_size");
var b = document.getElementById("pack_price");
var astored = a.getAttribute("data-in");
var bstored = b.getAttribute("data-in");
setInterval(function(){
    if( a == document.activeElement ){
     var temp = a.value;
     if( astored != temp ){
       astored = temp;
       a.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
    if( b == document.activeElement ){
     var temp = b.value;
     if( bstored != temp ){
       bstored = temp;
       b.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
},50);

function totalcalculate(){
 var upsum = b.value / a.value;
 unit_price.value = upsum.toFixed(2);
}
b.onblur = totalcalculate;
totalcalculate();

</script>

<!--clculate unit MRP-->
<script type="text/javascript">
var c = document.getElementById("pack_size");
var d = document.getElementById("pack_mrp");
var cstored = c.getAttribute("data-in");
var dstored = d.getAttribute("data-in");
setInterval(function(){
    if( c == document.activeElement ){
     var temp = c.value;
     if( cstored != temp ){
       cstored = temp;
       c.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
    if( d == document.activeElement ){
     var temp = d.value;
     if( dstored != temp ){
       dstored = temp;
       d.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
},50);

function totalcalculate(){
 var mrpsum = d.value / c.value;
 unit_mrp.value = mrpsum.toFixed(2);
}
d.onblur = totalcalculate;
totalcalculate();

</script>

<!--clculate unit VAT-->
<script type="text/javascript">
var c = document.getElementById("pack_size");
var x = document.getElementById("pack_vat");
var cstored = c.getAttribute("data-in");
var xstored = x.getAttribute("data-in");
setInterval(function(){
    if( c == document.activeElement ){
     var temp = c.value;
     if( cstored != temp ){
       cstored = temp;
       c.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
    if( x == document.activeElement ){
     var temp = x.value;
     if( xstored != temp ){
       xstored = temp;
       x.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
},50);

function totalcalculate(){
 var mrpsum = x.value / c.value;
 unit_vat.value = mrpsum.toFixed(2);
}
x.onblur = totalcalculate;
totalcalculate();

</script>

<!--clculate TP+VAT-->
<script type="text/javascript">
var e = document.getElementById("pack_size");
var f = document.getElementById("unit_price");
var g = document.getElementById("unit_vat");
var estored = e.getAttribute("data-in");
var fstored = f.getAttribute("data-in");
var gstored = g.getAttribute("data-in");
setInterval(function(){
    if( e == document.activeElement ){
     var temp = e.value;
     if( estored != temp ){
       estored = temp;
       e.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
    if( f == document.activeElement ){
     var temp = f.value;
     if( fstored != temp ){
       fstored = temp;
       f.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
    if( g == document.activeElement ){
     var temp = g.value;
     if( gstored != temp ){
       gstored = temp;
       g.setAttribute("data-in",temp);
       totalcalculate();
     }
    }
},50);

function totalcalculate(){
 var unitvat = +f.value + +g.value;
 var pacvat = unitvat*e.value;
 pack_tp_vat.value = pacvat.toFixed(2);
 unit_tp_vat.value = unitvat.toFixed(2);
}
g.onblur = totalcalculate;
totalcalculate();

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".add-row").click(function(){
            var product_name = $("#product_name").val();
            //var batch = $("#batch").val();
            var stock_qty = $("#stock_qty").val();
            //var expiry_date = $("#expiry_date").val();
            var mrp = $("#mrp").val();
            var unit = $("#unit").val();
            var sales_qty = $("#sales_qty").val();
            var sales_discount = $("#sales_discount").val();
            var total_amount = $("#total_amount").val();
            var product_id = $("#product_id").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td><input class='form-control' name='product_name[]' value='" + product_name + "' readonly><input type='hidden' class='form-control' name='product_id[]' value='" + product_id + "' readonly></td><td><input type='text' class='form-control' name='stock_qty[]' value='" + stock_qty + "' readonly></td><td><input type='text' class='form-control' name='mrp[]' value='" + mrp + "' readonly></td><td><input type='text' class='form-control' name='unit[]' value='" + unit + "' readonly></td><td><input type='number' class='form-control sales_cal stock_cal' name='sales_qty[]' value='" + sales_qty + "' step='0.01' min='1'></td><td><input type='number' class='form-control sales_cal' name='sales_discount[]' value='" + sales_discount + "' step='0.01'></td><td colspan='2'><input type='text' class='form-control' name='total_amount[]' value='" + total_amount + "' readonly></td></tr>";
            //var markup = "<tr><td><input type='checkbox' name='record'></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
            $("#req").append(markup);
            document.getElementById("sales_form").reset();
        });
        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("#req").find('input[name="record"]').each(function(){
              if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });    
</script>

<script type="text/javascript">
      $(document).ready(function(){

   // Initialize 
   $( "#product_name" ).autocomplete({
      source: function( request, response ) {
        // Fetch data
        $.ajax({
          url: "<?php echo site_url('client/get_product_list');?>",
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
        // Set selection
        $('#product_name').val(ui.item.label); // display the selected text
        $('#product_id').val(ui.item.value); // save selected id to input
        $('#mrp').val(ui.item.mrp); // save selected id to input
        $('#unit').val(ui.item.unit); // save selected id to input
        $('#stock_qty').val(ui.item.stock); // save selected id to input
        return false;
      }
    });

  });
</script>

<script type="text/javascript">
$(document).ready(function(){

$('#req').on('keyup', '.sales_cal', function(){
    var sum = 0;
    var discounttotal = 0;
    var product = document.getElementsByName("product_name[]");
    //var stock = document.getElementsByName("stock_qty[]");
    var mrp = document.getElementsByName("mrp[]");
    var qty = document.getElementsByName("sales_qty[]");
    var sdiscount = document.getElementsByName("sales_discount[]");
    //var indiscount = document.getElementById("invoice_discount");
    var indiscount = $('#invoice_discount').val();
    var previous_due =  $('#previous_due').val();
    var paid_amount = $('#paid_amount').val();
    //alert (paid_amount);

for ( var i = 0; i < product.length; i++ ){
        sales_value = (mrp[i].value * qty[i].value)-sdiscount[i].value;
        sum += mrp[i].value * qty[i].value;
        document.getElementsByName("total_amount[]")[i].value = sales_value.toFixed(2);
        discounttotal += parseFloat(sdiscount[i].value);

        // if(qty[i].value > 10){
        //   alert ("You can Sale maximum "+ stock[i].value +" Items");
        // }
    }
   

   var total_discount = parseFloat(discounttotal)+parseFloat(indiscount);
   var grand_total = sum-total_discount;
   var net_total = grand_total+parseFloat(previous_due);
   var sales_due = net_total-parseFloat(paid_amount);
   var sales_change = parseFloat(paid_amount)-net_total;
   document.getElementById("gross_total").value = sum.toFixed(2);
   document.getElementById("total_discount").value = total_discount.toFixed(2);
   document.getElementById("grand_total").value = grand_total.toFixed(2);
   document.getElementById("net_total").value = net_total.toFixed(2);
   document.getElementById("sales_due").value = sales_due.toFixed(2);
   document.getElementById("sales_change").value = sales_change.toFixed(2);

});
 });
</script>

<script>
$(document).ready(function(){
$('#paytype').change(function() {
    $('.payment-info').hide();
    $('#' + $(this).val()).show();
}).change();

});
</script>

<script type="text/javascript">
$(document).ready(function(){

$('#sre').on('keyup', '.return_cal', function(){
    var sum = 0;
    var discounttotal = 0;
    var product = document.getElementsByName("product_id[]");
    var mrp = document.getElementsByName("mrp[]");
    //var qty = document.getElementsByName("sales_qty[]");
    var sdiscount = document.getElementsByName("sales_discount[]");
    var rtn_qty = document.getElementsByName("sales_return_qty[]");
    
    var sales_due =  $('#sales_due').val();
    var invoice_discount =  $('#invoice_discount').val();
    //var paid_amount = $('#paid_amount').val();
    
for ( var i = 0; i < product.length; i++ ){

        var return_value = mrp[i].value * rtn_qty[i].value;
        var discount = (sdiscount[i].value/100)* return_value;
        var return_total = return_value - discount;
        sum += return_value;
        document.getElementsByName("total_amount[]")[i].value = return_total.toFixed(2);
        discounttotal += parseFloat(discount);

    }
   
   var indiscount = (invoice_discount/100)* sum;
   var total_discount = parseFloat(discounttotal)+parseFloat(indiscount);
   var payable_total = sum-total_discount-sales_due;
   document.getElementById("gross_total").value = sum.toFixed(2);
   document.getElementById("total_discount").value = total_discount.toFixed(2);
   document.getElementById("payable_total").value = payable_total.toFixed(2);

});
 });
</script>

<script type="text/javascript">
  $('#sales_return_form').submit(function() {
    var elements = $("input[name='sales_return_qty[]']");
    var validated = false;
    elements.each(function() {
        if ($(this).val() != '') {
            validated = true;
            return false; // will break the each

        } else {
            validated = false;
        }
    });
    
    if(validated == false){
      alert("Fill up at least one Return QTY!");
      return false;
    } else {
      return true;
    }
    //return validated;
});
</script>




<script type="text/javascript">
$(document).ready(function () {
    $('#actionbtn').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("You must check at least one checkbox.");
        return false;
      }

    });
});

</script>

<script type="text/javascript">
  $('#req_form').submit(function() {
    var elements = $("input[name='req_qty[]']");
    var validated = false;
    elements.each(function() {
        if ($(this).val() != '') {
            validated = true;
            return false; // will break the each

        } else {
            validated = false;
        }
    });
    
    if(validated == false){
      alert("Fill up at least one Requisition QTY!");
      return false;
    } else {
      return true;
    }
    //return validated;
});
</script>

<script type="text/javascript">
  $('#sales_form').submit(function() {
    var elements = $("input[name='sales_qty[]']");
    var validated = false;
    elements.each(function() {
        if ($(this).val() != '') {
            validated = true;
            return false; // will break the each

        } else {
            validated = false;
        }
    });
    
    if(validated == false){
      alert("Fill up at least one Sales QTY!");
      return false;
    } else {
      return true;
    }
    //return validated;
});
</script>

<script type="text/javascript">
  $('#reci_form').submit(function() {
    var elements = $("input[name='receive_qty[]']");
    var validated = false;
    elements.each(function() {
        if ($(this).val() != '') {
            validated = true;
            return false; // will break the each

        } else {
            validated = false;
        }
    });
    
    if(validated == false){
      alert("Fill up at least one Receive QTY!");
      return false;
    } else {
      return true;
    }
    //return validated;
});
</script>

<script type="text/javascript">
  $('#req_form').submit(function() {
    pack_size = document.getElementsByName("pack_size[]");
    req_qty = document.getElementsByName("req_qty[]");


for ( var i = 0; i < pack_size.length; i++ ){
        remider = req_qty[i].value % pack_size[i].value
        if (remider !=0) {
          alert("Requisition QTY is not Match Pack Size");
          req_qty[i].focus();
            return false;
        }
    }
});
</script>

<script type="text/javascript">
  $('#reci_form').submit(function() {
    unit_mrp = document.getElementsByName("unit_mrp[]");
    receive_unit_price = document.getElementsByName("receive_unit_price[]");
    pack_size = document.getElementsByName("pack_size[]");
    receive_qty = document.getElementsByName("receive_qty[]");


for ( var i = 0; i < unit_mrp.length; i++ ){
        if ( +receive_unit_price[i].value >= +unit_mrp[i].value) {
            alert("Receive Rate is greater than MRP");
            receive_unit_price[i].focus();
            return false;
        }
        remider = receive_qty[i].value % pack_size[i].value
        if (remider !=0) {
          alert("Receive QTY is not Match Pack Size");
          receive_qty[i].focus();
            return false;
        }

    }
});
</script>

<!-- challan vat -->
<script type="text/javascript">
$('#challan_vat_percentage').keyup(function () {
    productNamae = document.getElementsByName("product_name[]");
    cvat = document.getElementById("challan_vat_percentage").value;
    for(var i = 0; i < productNamae.length; i++)
    {
        document.getElementsByName("vat_percentage[]")[i].value = cvat;
        //document.getElementsByName("vat_percentage[]")[i].readOnly = true; 
      }
    
});
</script>
<!-- challan discount -->
<script type="text/javascript">
$('#challan_discount_percentage').keyup(function () {
    productNamae = document.getElementsByName("product_name[]");
    cdiscount = document.getElementById("challan_discount_percentage").value;

    for(var i = 0; i < productNamae.length; i++)
    {
        document.getElementsByName("discount_percentage[]")[i].value = cdiscount;
        //document.getElementsByName("discount_percentage[]")[i].readOnly = true; 
      }
    
});
</script>

<script type="text/javascript">
$('.receive_qty').keyup(function () {
    var sum = 0;
    var discounttotal = 0;
    var vattotal = 0;
    product = document.getElementsByName("product_name[]");
    price = document.getElementsByName("receive_unit_price[]");
    receive = document.getElementsByName("receive_qty[]");
    pdiscount = document.getElementsByName("discount_percentage[]");
    pvat = document.getElementsByName("vat_percentage[]");
    var paid = document.getElementById("paid_amount").value;

for ( var i = 0; i < product.length; i++ ){
        receive_value = price[i].value * receive[i].value;
        sum += receive_value;
        document.getElementsByName("receive_value[]")[i].value = receive_value.toFixed(2);

        discountamount = (pdiscount[i].value / 100)*receive_value;
        discounttotal += discountamount;

        vatAmount = (pvat[i].value / 100)*receive_value;
        vattotal += vatAmount;
    }
   var payable = sum+vattotal-discounttotal;
   document.getElementById("total_amount").value = sum.toFixed(2);
   document.getElementById("discount_amount").value = discounttotal.toFixed(2);
   document.getElementById("vat_amount").value = vattotal.toFixed(2);
   document.getElementById("payable_amount").value = payable.toFixed(2);
   document.getElementById("due_amount").value = (payable-parseInt(paid)).toFixed(2);
   //payable_amount.innerHTML = (sum+vattotal-discounttotal).toFixed(2);
   
});
</script>


<script type="text/javascript">
  $('#rtn_form').submit(function() {
    var elements = $("input[name='return_qty[]']");
    var validated = false;
    elements.each(function() {
        if ($(this).val() != '') {
            validated = true;
            return false; // will break the each

        } else {
            validated = false;
        }
    });
    
    if(validated == false){
      alert("Fill up at least one Return QTY!");
      return false;
    } else {
      return true;
    }
    //return validated;
});
</script>

<script type="text/javascript">
  $('#rtn_form').submit(function() {
    pack_size = document.getElementsByName("pack_size[]");
    return_qty = document.getElementsByName("return_qty[]");


for ( var i = 0; i < pack_size.length; i++ ){
        
        remider = return_qty[i].value % pack_size[i].value
        if (remider !=0) {
          alert("Return QTY is not Match Pack Size");
          return_qty[i].focus();
            return false;
        }
    }
});
</script>

<script type="text/javascript">
  $('.preturn_qty').keyup(function() {
    //unit_price = document.getElementsByName("unit_price[]");
    unit_price = document.getElementsByName("total_price[]");
    return_qty = document.getElementsByName("return_qty[]");
    var total_receive = $("#total_receive").val();
    var total = 0;

for ( var i = 0; i < unit_price.length; i++ ){
        
        total += return_qty[i].value * unit_price[i].value
        total_amount.innerHTML = total.toFixed(2);
        payble_amount.innerHTML = (total_receive - total).toFixed(2);
    }
});
</script>

<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
  document.body.style.marginTop="0px";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>


</body>
</html>
