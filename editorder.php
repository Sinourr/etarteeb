<?php 
require_once('common.php');
require("mainheader.php");
require("connection.php");


//echo $_SESSION['MM_Username'];
//echo "<br>";
//echo $_SESSION['MM_UserId'];








 

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 
 
 $Id = $_POST['id'];
 $OrderNo = $_POST['InvoiceNo'];
 $CustMobile = $_POST['CustMobile'];
 $Comment = $_POST['Comment'];
 $IsOpen = "0";

 $TimeofOrderClose =  date("h:i:s a");

 
 
 $tsql= "UPDATE dbo.Orders SET 
 OrderNo = (?),
 CustMobile = (?), 
 Comment = (?), 
 IsOpen = (?), 
 TimeofOrderClose = (?)
 WHERE Id = (?)";
            
   

/* Set parameter values. */  
$params = array($OrderNo, $CustMobile, $Comment, $IsOpen, $TimeofOrderClose, $Id);

/* Prepare and execute the query. */  
$stmt20 = sqlsrv_query($connSelComp, $tsql, $params);  
if ($stmt20) {  
    echo "Row successfully updates.\n";  
} else {  
    echo "Row update failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  


/* exit(); */

  $updateGoTo = "2ndsmssent.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %sid=".$Id, $updateGoTo));
}




$sql2 = "
SELECT * FROM Orders Where id = '".$_GET['id']."'";
$stmt2 = sqlsrv_query( $connSelComp, $sql2) or die ( print_r(sqlsrv_errors(), true));
$row_data = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC);




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





$StrSql = "Select * from Orders WHERE IsOpen=1";
$Result = sqlsrv_query( $connSelComp, $StrSql) or die ( print_r(sqlsrv_errors(), true));


?>


<br>

<form id="form1" name="form1" method="post" action="editorder.php">
<div class="container">

	<div class="card card-body bg-light ">Customer Orders</div>

<br>


<div class="col-md-6 float-left">
	<div class="col-md-8">
		<div><label for="InvoiceNo">Invoice No.</label></div>
		<div><input name="InvoiceNo" id="InvoiceNo" maxlength="10" type="text" class="form-control" value="<?php echo $row_data['OrderNo']; ?>" readonly ></div>
	</div>




	<div class="col-md-12">
		<div><label for="CustMobile">Mobile No.</label></div>
		<div><input name="CustMobile" id="CustMobile" maxlength="10" type="text" class="form-control" placeholder="Exemple: 0512345678"  value="<?php echo $row_data['CustMobile']; ?>" readonly ></div>
	</div>



	<div class="col-md-12">
		<div><label for="Comment">Notes:</label></div>
		<div><textarea name="Comment" id="Comment" class="form-control"  ><?php echo $row_data['Comment']; ?></textarea></div>
	</div>

<br>
<br>

<!--<div class="col-md-12">
		<div><label for="IsOpen">Finished:</label></div>
		<div><input type="checkbox" name="IsOpen" id="IsOpen" value="1"></div>
	</div>-->


          <input type="hidden" name="id" value="<?php echo $row_data['ID']; ?>">
   

<br>
<br>

	<div class="col-md-12 row">
		<!--<div><button class="btn btn-outline-success"><i class="far fa-save" aria-hidden="true"></i> Save Order</button></div>-->

		<div class="col-md-1"></div>

		<!--<input type="time" name="TimeofOrder" id="TimeofOrder" value="<?php
	
		 echo date('H:i:s'); ?>"> -->
		
		<input type="hidden" name="MM_insert" value="form1">


		<div class="col-md-12"><button class="btn btn-outline-primary col-md-12"><i class="far fa-edit" aria-hidden="true"></i> Close Order</button></div>

	</div>
</div>

</form>

<div class="col-md-6 float-right">
	
	<table class="table table-bordered table-sm" style="font-size: 12px; font-">
		<thead class="thead-light">
			<tr class="center">
				<th colspan="4" align="center">Ongoing orders</th>
			</tr>
			<tr>
				<th>S.No</th>
				<th>Order Number</th>
				<th>Mobile No</th>
				<th>Order Duration</th>

			</tr>
		</thead>

<tbody style="font-weight: normal;">

	<?php 

$sn = '';
	while ($row_orders = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC)){ 


		$sn++;

		?>
		<tr>
				<td><?php echo $sn; ?></td>
				<td><?php echo $row_orders['OrderNo']; ?></td>
				<td><?php echo $row_orders['CustMobile'];; ?></td>

				
				<td><p id="Timerp<?php echo $sn; ?>" class="text" > <?php
 
				$first  = new DateTime( $row_orders['TimeofOrder'] );
				$second = new DateTime( date('H:i:s') );

				$diff = $first->diff( $second );

				$duration = $diff->format( '%H:%I:%S' ); // -> 00:25:25

				echo $duration;


				?></p>

				


			</td>

			</tr>

		<?php } ?>
	
	</tbody>	
	</table>

</div>


</div>




 
 </body>
 </html>

 	





