<?php 
require('connection.php');
require('mainheader.php');






?>

<!DOCTYPE html>
<html <?php 
if($_GET['culture'] == 'en'){

} elseif($_GET['culture'] == 'ar'){ 
  echo "dir='rtl'";
} ?>
>

<head>
   <title></title>


<style>

#maincontent{
 
 padding:1%;
 
 }

</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js" ></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js" ></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js" ></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js" ></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js" ></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js" ></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js" ></script>
<script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/jquery.fancytree-all-deps.min.js" integrity="sha256-d8VPSMnDtzaOgN+kb4JLYj2XklbYR1S7jiPkrMIyuHA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.6.0/src/jquery.fancytree.filter.js" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
<script src="js/sweetalert.min.js"></script>


<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="css/sweetalert.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/skin-win7/ui.fancytree.min.css" crossorigin="anonymous" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />  
<link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/css/dataTables.checkboxes.css" media="all" type="text/css"/>
<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


</head>



<body>

<div id="header"></div>

<div class="container" id="maincontent">


<h2>

<?php if($_GET['culture'] == "en"){ ?>
    Order Report
 <?php }  /*elseif($_GET['culture'] == "ar"){ ?>
  تقرير الإنتاجية الشهري
<?php } */ ?> 
</h2>


<hr>

<form action="orderreport.php?culture=<?php echo $_GET['culture']; ?>" >


<input type="hidden" id="culture" name="culture" value="<?php echo $_GET['culture']; ?>"  />


<div class="col-md-12"><br></div>


<div class="row">
<div class="col-md-2">

Order Status

</div>

<div class="col-md-3">
<select id="status" name="status" class="form-control" >
  
<option value="">All</option>
<option value="1">Open</option>
<option value="false">Closed</option>

</select>
</div>
</div>



<div class="col-md-12"><br></div>





<div class="row">

<div class="col-md-2">
From Date:
</div>

<div class="col-md-2">
<input type="date" id="fromdate" name="fromdate" class="form-control " style="width:100%;">
</div>



<div class="col-md-2">
To Date:
</div>

<div class="col-md-2">
<input type="date" id="todate" name="todate" class="form-control " style="width:100%;">
</div>


</div>


<div class="col-md-12"><br></div>



<div class="row">
<div class="col-md-12 pull-right">
<input type="submit" class="btn btn-success <?php if($_GET['culture'] == "en"){ ?>
    col-md-1
 <?php }  elseif($_GET['culture'] == "ar"){ ?>
 col-md-12
<?php } ?> " value="
<?php if($_GET['culture'] == "en"){ ?>
    Search
 <?php }  elseif($_GET['culture'] == "ar"){ ?>
ﺑﺤﺚ
<?php } ?>" />


</div>
</div>


<div class="col-md-12"><br></div>



</div>
</form>
    
  
   
</div>


<script>


$(document).ready(function() {
    $('.drpdpwn').select2();
});


</script>



<script type="text/javascript">

   
   
$(document).ready(function() {
   var table = $('#example').DataTable({
      
   
     
      'columnDefs': [
         {
            'targets': 0,
           
         }
      ],
      'select': {
        
      },
      'order': [[0, 'asc']],
           'dom': 'Blfrtip',
           'buttons': [
            {
                'extend': 'print', 
                'text': 'Print All',   
            },
      
         {
            'extend': 'excel', 
                'text': 'excel',
            },
            
            {
            
            'extend': 'pdf', 
                'text': 'pdf',
              'orientation': 'landscape',
                'pageSize': 'LEGAL'
            },
            
            {
                'extend': 'print',
                'text': 'Print selected',
                'exportOptions': {
                    'modifier': {
                        'selected': true
                    }
               
                }
            }
        ],  
   
   
           
         
           });
  
   
 
   
} );
   
</script>




<?php if($_GET['culture'] == 'en'){
  echo "
  <script>

$('#header').load('header.php');
$('#footer').load('footer.php');
</script>";

} elseif($_GET['culture'] == 'ar'){
  echo "
 <script>

$('#header').load('headerar.php');
$('#footer').load('footer.php');
</script>

";} ?>


</body>
</html>
