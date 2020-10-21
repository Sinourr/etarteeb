<?php 
require_once('common.php');
require("mainheader.php");
require("connection.php");


//echo $_SESSION['MM_Username'];
//echo "<br>";
//echo $_SESSION['MM_UserId'];


if($_SESSION['Role'] == "user"){ 



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 
 $Id = $_POST['id'];
 $OrderNo = $_POST['InvoiceNo'];
 $CustMobile = $_POST['CustMobile'];
 $Comment = $_POST['Comment'];
 $IsOpen = "1";
 $date = date("Y-m-d");

 $time =  date("h:i:s a");


 
 
 $tsql= "INSERT INTO dbo.Orders (OrderNo, CustMobile, Comment, IsOpen, date, TimeofOrder) 
            VALUES
            (?, ?, ?, ?, ?, ?)";
            
      $var = array($OrderNo, $CustMobile, $Comment, $IsOpen, $date, $time);
            if (!sqlsrv_query($connSelComp, $tsql, $var))
                 {
            print_r($var); 
            
            die('Error: ' . print_r(sqlsrv_errors()));
                 }
            echo "1 record added"; 


      
      
  
  $insertGoTo = "1stsmssent.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: 1stsmssent.php?id=".$Id, $insertGoTo));
}




$sql = "
SELECT max(CAST(Id AS INT))+1 as countofid  FROM Orders";

$stmt1 = sqlsrv_query( $connSelComp, $sql);
if( $stmt1 === false ) {
     die( print_r( sqlsrv_errors(), true));
}


} elseif($_SESSION['Role'] == "admin"){ 






$sql = "
SELECT IsOpen, COUNT(ID) AS Count from Orders
WHERE IsOpen = '1'
GROUP by IsOpen";
$resultdeffered = sqlsrv_query( $connSelComp, $sql, array(), array( "Scrollable" => 'static' ));
if( $resultdeffered === false ) {
    die( print_r( sqlsrv_errors(), true));
}
$row_deffered = sqlsrv_fetch_array( $resultdeffered, SQLSRV_FETCH_ASSOC);



$sql = "
SELECT IsOpen, COUNT(ID) AS Count from Orders
WHERE IsOpen = 'false'
GROUP by IsOpen";
$resultpending = sqlsrv_query( $connSelComp, $sql, array(), array( "Scrollable" => 'static' ));
if( $resultpending === false ) {
    die( print_r( sqlsrv_errors(), true));
}
$row_pending = sqlsrv_fetch_array( $resultpending, SQLSRV_FETCH_ASSOC);



$sql = "
Select COUNT(ID) AS Count from Orders ";
$resultdone = sqlsrv_query( $connSelComp, $sql, array(), array( "Scrollable" => 'static' ));
if( $resultdone === false ) {
    die( print_r( sqlsrv_errors(), true));
}
$row_done = sqlsrv_fetch_array( $resultdone, SQLSRV_FETCH_ASSOC);



}



 ?>



 <!DOCTYPE html>
 <html>
 <head>
 	<!-- To Add Jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />




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


if($_SESSION['Role'] == "admin"){ ?>

<div class="container">

<h2 class="<?php echo $float; ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?php echo "Order Summry"; ?></h2>
<hr>

<br>
<div class="row center">
          

          <div class="col-lg-1 col-md-4 col-sm-6">
          </div>
         


          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-watch-time text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Open</p>
                      <p class="card-title"><?php echo $row_deffered['Count']; ?></p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  These are Open orders
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-vector text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Closed</p>
                      <p class="card-title"><?php echo $row_pending['Count']; ?></p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i>
                  These are closed orders
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-book-bookmark text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Total</p>
                      <p class="card-title"><?php echo $row_done['Count']; ?></p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  <a>Total Orders</a>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>


<?php }



if($_SESSION['Role'] == "user"){ 



$StrSql = "Select * from Orders where IsOpen = 1";
$Result = sqlsrv_query( $connSelComp, $StrSql) or die ( print_r(sqlsrv_errors(), true));


?>


<br>

<form id="form1" name="form1" method="post" action="dashboard.php">
<div class="container">

	<div class="card card-body bg-light ">Customer Orders</div>

<br>


<div class="col-md-6 float-left">
	<div class="col-md-8">
		<div><label for="InvoiceNo">Invoice No.</label></div>
		<div><input name="InvoiceNo" id="InvoiceNo" maxlength="10" type="text" class="form-control" ></div>
	</div>




	<div class="col-md-12">
		<div><label for="CustMobile">Mobile No.</label></div>
		<div><input name="CustMobile" id="CustMobile" maxlength="10" type="text" class="form-control" placeholder="Exemple: 0512345678" ></div>
	</div>



	<div class="col-md-12">
		<div><label for="Comment">Notes:</label></div>
		<div><textarea name="Comment" id="Comment" class="form-control" ></textarea></div>
	</div>

<br>
<br>

<!--<div class="col-md-12">
		<div><label for="IsOpen">Finished:</label></div>
		<div><input type="checkbox" name="IsOpen" id="IsOpen" value="1"></div>
	</div>-->

<?php  while( $row_id = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
 ?>
          <input type="hidden" name="id" value="<?php 
		  
		  if(!$row_id['countofid']){ 
		  echo "1"; 
		  } else {
			  echo $row_id['countofid'];
			  } ?>">
    <?php } ?>      

<br>
<br>

	<div class="col-md-12 row">
		<!--<div><button class="btn btn-outline-success"><i class="far fa-save" aria-hidden="true"></i> Save Order</button></div>-->

		<div class="col-md-1"></div>

		<!--<input type="time" name="TimeofOrder" id="TimeofOrder" value="<?php
	
		 echo date('H:i:s'); ?>"> -->
		
		<input type="hidden" name="MM_insert" value="form1">


		<div class="col-md-12"><button class="btn btn-outline-primary col-md-12"><i class="far fa-edit" aria-hidden="true"></i> Open Order</button></div>

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
<?php } ?>



 
 </body>
 </html>

 	





