<?php 
require_once('connection.php');
require_once('mainheader.php');






$datefrom1 = $_GET['fromdate'];
$dateto1 = $_GET['todate'];






?>

<!DOCTYPE html>
<html <?php 
if($_GET['culture'] == 'en'){

} elseif($_GET['culture'] == 'ar'){ 
  echo "dir='rtl'";
} ?>
>

<head>
   <title>Order Report</title>

<style>

#maincontent{
 
 padding:1%;
 
 }

 
.noScreen {display:none !important;}

@media print {

   .noPrint {display:none !important;}

   div .dt-button {display:none !important; }

   .dataTables_filter {display:none !important; }

   .dataTables_length {display:none !important; }

   .dataTables_info {display:none !important; }

   .dataTables_paginate {display:none !important; }

   .paging_simple_numbers {display:none !important; }

   .logo {display:block !important;} 




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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.6.0/src/jquery.fancytree.filter.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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
<div class="col-md-12">

<div class="col-md-6 <?php if($_GET['culture'] == "ar"){ ?> pull-right <?php } ?>">

<h2>

<img src="images/logo.png" class="noScreen logo col-md-3" width="20%">
<?php if($_GET['culture'] == "en"){ ?>
     Orders Report
 <?php }  elseif($_GET['culture'] == "ar"){ ?>

<?php } ?> <a href="orderreportindex.php?culture=<?php echo $_GET['culture']; ?>" class="btn btn-primary noPrint">
<?php if($_GET['culture'] == "en"){ ?>
    Go Back 
 <?php }  elseif($_GET['culture'] == "ar"){ ?>
ﻋﻮﺩﺓ 
<?php } ?>
</a>

</h2>


</div>

 <div class="col-md-2 <?php if($_GET['culture'] == "ar"){ ?> pull-left <?php } ?>" style="float: <?php if($_GET['culture'] == 'ar'){ ?> left; margin: left:200px; <?php } else {echo "right;";} ?>">
    <?php




        if(!empty($_GET['fromdate'])){
      

            ?>

            <p><div><table width='200px; '><tr><td align="<?php if($_GET['culture'] == 'ar'){ ?>left<?php } else {echo "right";} ?>" ><?php if($_GET['culture'] == 'ar'){ ?>ﻣﻦ اﻟﺘﺎﺭﻳﺦ  <?php } else {echo "Report From:";} ?> <?php echo $datefrom1; ?></td></tr>
            <tr><td align="<?php if($_GET['culture'] == 'ar'){ ?>left<?php } else {echo "right";} ?>"><?php if($_GET['culture'] == 'ar'){ ?> ﺣﺘﻰ ﺗﺎﺭﻳﺨﻪ  <?php } else {echo "To Date:";} ?>  <?php echo $dateto1; ?></td></tr>

            




          </table></table></div></p>

            <?php }


   

    ?></div>

</div>



<?php

$status = stripslashes($_GET['status']);
$fromdate = stripslashes($_GET['fromdate']);
$todate = stripslashes($_GET['todate']);


if(!empty($status) & !empty($fromdate) & !empty($todate)) {


   ?>




<table id='Report' class="Report" >

<thead style='background-color:#6EC5E9; color:white;' class=''>
<tr>

<th>S.No:</th>
<th>Date</th>
<th>Order No.</th>
<th>Mobile.</th>
<th>Status</th>
<th>Issue Logged</th>
<th>Issue Resolved</th>
<th>Feedback Logged</th>



</tr>
</thead>


<tbody>


<?php 



$sqlreport = "
SELECT COUNT(*) AS countorders, ID, OrderNo, CustMobile, IsOpen, issueTime, isIssueResolved, Feedback1, date
 FROM Orders
 WHERE IsOpen = '".$status."'
 AND date BETWEEN '".$fromdate."' AND '".$todate."'
 GROUP BY ID, OrderNo, CustMobile, IsOpen, issueTime, isIssueResolved, Feedback1, date
";

$stmtreport = sqlsrv_query( $connSelComp, $sqlreport);
if( $stmtreport === false ) {
     die( print_r( sqlsrv_errors(), true));
}


$snn='';
$total='';

While($rowreport = sqlsrv_fetch_array( $stmtreport, SQLSRV_FETCH_ASSOC)){ 

$snn++;



?>
<tr>


  <td><?php echo $snn; ?></td>
  <td><?php echo $rowreport['date']; ?></td>
  <td><?php echo $rowreport['OrderNo']; ?></td>
  <td><?php echo $rowreport['CustMobile']; ?></td>
  <td><?php  if($rowreport['IsOpen'] == 1){echo "Open";}else{echo "Closed";} ?></td>
  <td><?php  if(empty($rowreport['issueTime'])){echo "No Logged";}else{echo "Logged";} ?></td>
 <td><?php  

  if(empty($rowreport['issueTime'])){echo "No Issues";}else{
 if($rowreport['isIssueResolved'] == 1){echo "Resolved";}else{echo "No Issues";}} ?></td>
  <td><?php  if(empty($rowreport['Feedback1'])){echo "No Logged";}else{echo "Logged";}  ?></td>
   
</tr>
<?php $total +=  $rowreport['countorders']; 

} ?>

</tbody>

<tfoot>
  
<tr>
  <td colspan="7">Total</td>
  <td><?php echo $total; ?></td>
</tr>


</tfoot>
</table> 




<?php 

}elseif(empty($status) & !empty($fromdate) & !empty($todate)) { 



   ?>




<table id='Report' class="Report" >

<thead style='background-color:#6EC5E9; color:white;' class=''>
<tr>

<th>S.No:</th>
<th>Date</th>
<th>Order No.</th>
<th>Mobile.</th>
<th>Status</th>
<th>Issue Logged</th>
<th>Issue Resolved</th>
<th>Feedback Logged</th>



</tr>
</thead>


<tbody>


<?php 



$sqlreport = "
SELECT COUNT(*) AS countorders, ID, OrderNo, CustMobile, IsOpen, issueTime, isIssueResolved, Feedback1, date
 FROM Orders
 WHERE date BETWEEN '".$fromdate."' AND '".$todate."'
 GROUP BY ID, OrderNo, CustMobile, IsOpen, issueTime, isIssueResolved, Feedback1, date
";

$stmtreport = sqlsrv_query( $connSelComp, $sqlreport);
if( $stmtreport === false ) {
     die( print_r( sqlsrv_errors(), true));
}


$snn='';
$total='';

While($rowreport = sqlsrv_fetch_array( $stmtreport, SQLSRV_FETCH_ASSOC)){ 

$snn++;



?>
<tr>


  <td><?php echo $snn; ?></td>
  <td><?php echo $rowreport['date']; ?></td>
  <td><?php echo $rowreport['OrderNo']; ?></td>
  <td><?php echo $rowreport['CustMobile']; ?></td>
  <td><?php  if($rowreport['IsOpen'] == 1){echo "Open";}else{echo "Closed";} ?></td>
  <td><?php  if(empty($rowreport['issueTime'])){echo "No Logged";}else{echo "Logged";} ?></td>
 <td><?php  

  if(empty($rowreport['issueTime'])){echo "No Issues";}else{
 if($rowreport['isIssueResolved'] == 1){echo "Resolved";}else{echo "No Issues";}} ?></td>
  <td><?php  if(empty($rowreport['Feedback1'])){echo "No Logged";}else{echo "Logged";}  ?></td>
   
</tr>
<?php $total +=  $rowreport['countorders']; 

} ?>

</tbody>

<tfoot>
  
<tr>
  <td colspan="7">Total</td>
  <td><?php echo $total; ?></td>
</tr>


</tfoot>
</table> 




<?php 



}elseif(empty($status) & empty($fromdate) & empty($todate)) {




   ?>




<table id='Report' class="Report" >

<thead style='background-color:#6EC5E9; color:white;' class=''>
<tr>

<th>S.No:</th>
<th>Date</th>
<th>Order No.</th>
<th>Mobile.</th>
<th>Status</th>
<th>Issue Logged</th>
<th>Issue Resolved</th>
<th>Feedback Logged</th>



</tr>
</thead>


<tbody>


<?php 



$sqlreport = "
SELECT COUNT(*) AS countorders, ID, OrderNo, CustMobile, IsOpen, issueTime, isIssueResolved, Feedback1, date
 FROM Orders
 GROUP BY ID, OrderNo, CustMobile, IsOpen, issueTime, isIssueResolved, Feedback1, date
";

$stmtreport = sqlsrv_query( $connSelComp, $sqlreport);
if( $stmtreport === false ) {
     die( print_r( sqlsrv_errors(), true));
}


$snn='';
$total='';

While($rowreport = sqlsrv_fetch_array( $stmtreport, SQLSRV_FETCH_ASSOC)){ 

$snn++;



?>
<tr>


  <td><?php echo $snn; ?></td>
  <td><?php echo $rowreport['date']; ?></td>
  <td><?php echo $rowreport['OrderNo']; ?></td>
  <td><?php echo $rowreport['CustMobile']; ?></td>
  <td><?php  if($rowreport['IsOpen'] == 1){echo "Open";}else{echo "Closed";} ?></td>
  <td><?php  if(empty($rowreport['issueTime'])){echo "No Logged";}else{echo "Logged";} ?></td>
 <td><?php  

  if(empty($rowreport['issueTime'])){echo "No Issues";}else{
 if($rowreport['isIssueResolved'] == 1){echo "Resolved";}else{echo "No Issues";}} ?></td>
  <td><?php  if(empty($rowreport['Feedback1'])){echo "No Logged";}else{echo "Logged";}  ?></td>
   
</tr>
<?php $total +=  $rowreport['countorders']; 

} ?>

</tbody>

<tfoot>
  
<tr>
  <td colspan="7">Total</td>
  <td><?php echo $total; ?></td>
</tr>


</tfoot>
</table> 




<?php 



}elseif(!empty($status) & empty($fromdate) & empty($todate)) {




   ?>




<table id='Report' class="Report" >

<thead style='background-color:#6EC5E9; color:white;' class=''>
<tr>

<th>S.No:</th>
<th>Date</th>
<th>Order No.</th>
<th>Mobile.</th>
<th>Status</th>
<th>Issue Logged</th>
<th>Issue Resolved</th>
<th>Feedback Logged</th>



</tr>
</thead>


<tbody>


<?php 



$sqlreport = "
SELECT COUNT(*) AS countorders, ID, OrderNo, CustMobile, IsOpen, issueTime, isIssueResolved, Feedback1, date
 FROM Orders
 WHERE date BETWEEN '".$fromdate."' AND '".$todate."'
 GROUP BY ID, OrderNo, CustMobile, IsOpen, issueTime, isIssueResolved, Feedback1, date
";

$stmtreport = sqlsrv_query( $connSelComp, $sqlreport);
if( $stmtreport === false ) {
     die( print_r( sqlsrv_errors(), true));
}


$snn='';
$total='';

While($rowreport = sqlsrv_fetch_array( $stmtreport, SQLSRV_FETCH_ASSOC)){ 

$snn++;



?>
<tr>


  <td><?php echo $snn; ?></td>
  <td><?php echo $rowreport['date']; ?></td>
  <td><?php echo $rowreport['OrderNo']; ?></td>
  <td><?php echo $rowreport['CustMobile']; ?></td>
  <td><?php  if($rowreport['IsOpen'] == 1){echo "Open";}else{echo "Closed";} ?></td>
  <td><?php  if(empty($rowreport['issueTime'])){echo "No Logged";}else{echo "Logged";} ?></td>
 <td><?php  

  if(empty($rowreport['issueTime'])){echo "No Issues";}else{
 if($rowreport['isIssueResolved'] == 1){echo "Resolved";}else{echo "No Issues";}} ?></td>
  <td><?php  if(empty($rowreport['Feedback1'])){echo "No Logged";}else{echo "Logged";}  ?></td>
   
</tr>
<?php $total +=  $rowreport['countorders']; 

} ?>

</tbody>

<tfoot>
  
<tr>
  <td colspan="7">Total</td>
  <td><?php echo $total; ?></td>
</tr>


</tfoot>
</table> 




<?php 

}   


?>




</div>


<script type="text/javascript">

   
 
   
$(document).ready(function() {
   var table = $('.Report').DataTable({
      

   
   
     
      'columnDefs': [
         {
            'targets': 0,
           
         }
      ],
     
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
            
          

                extend: 'pdfHtml5',
                orientation: 'potrait',
                pageSize: 'A4'






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

";}

?>



</body>
</html>
