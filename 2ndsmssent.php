<?php 
require_once('common.php');
require("mainheader.php");
require("connection.php");


//echo $_SESSION['MM_Username'];
//echo "<br>";
//echo $_SESSION['MM_UserId'];



  



 ?>



 <!DOCTYPE html>
 <html>
 <head>
 	<!-- To Add Jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


 	<title>
 		Tarteeb		
 	</title>


 	<style type="text/css">
 		

.table .thead-light th {
 
  color: #401500;
 
  background-color: #03A9F4;
 
  border-color: #696969;

  font-weight: normal;

}

 	</style>

 </head>
 <body>

<?php



$StrSql = "Select * from Orders WHERE Id = '".$_GET['id']."'";
$Result = sqlsrv_query( $connSelComp, $StrSql) or die ( print_r(sqlsrv_errors(), true));
$row_dataset = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);




$StrSql1 = "Select COUNT(*) as count from Orders WHERE IsOpen=1";
$Result1 = sqlsrv_query( $connSelComp, $StrSql1) or die ( print_r(sqlsrv_errors(), true));
$row_custcount = sqlsrv_fetch_array( $Result1, SQLSRV_FETCH_ASSOC);


?>


<br>
<br>
<br>

<div class="container col-md-6">

	<h6>This is a preview of sms that has been sent to the customer</h6>
	


<br>
<br>

	<div class="card">
  <h5 class="card-header">TarteebSA</h5>
  <div class="card-body">
    <p class="card-text">Dear Customer, Your order is ready. Hope you are satisfied with our service. Service duration was <?php


   $start_t = new DateTime($row_dataset['TimeofOrder']);
$current_t = new DateTime($row_dataset['TimeofOrderClose']);
$difference = $start_t ->diff($current_t );
$return_time = $difference ->format('%H:%I:%S');

  echo $return_time; ?>. 


<p> Please click the link below to send feedback. </p>
     	<br>
    <a href="feedback.php?id=<?php echo $_GET['id']; ?>">Send Feedback</a>
  </div>
</div>

<br>

</div>



 
 </body>
 </html>

 	





