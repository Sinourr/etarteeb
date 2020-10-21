<?php 


require('connection.php');



if (isset($_POST['username']))



 	{

 if($_POST['ccompanylst'] == 'db0' & $_POST['username'] == "Owner" & $_POST['Password'] == 'User100+'){


	$_SESSION['Role'] =  'Owner';
	$_SESSION['MM_Username'] =  'Owner';
    
    header("Location: dashboard.php");

 } else if($_POST['ccompanylst'] == 'db0' & $_POST['username'] !== "owner"){ 


	$ccompanylst =$_POST['ccompanylst'];
 	$username = stripslashes($_POST['username']); 
	$Password = stripslashes($_POST['Password']);
		


$StrSqlCo = "Select ID, Count(ID) as IDCount from AspNetUsers 
where UserName = '".$username."' 
And Password2 = '".md5($Password)."'
And isActive = 1
 Group by ID";
$ResulCo = sqlsrv_query( $conn, $StrSqlCo) or die ( print_r(sqlsrv_errors(), true));
$ChkLogin = sqlsrv_fetch_array( $ResulCo, SQLSRV_FETCH_ASSOC);


if( $ResulCo === false ) {
     die( print_r( sqlsrv_errors(), true));
}



if($ChkLogin['IDCount'] == 1) 
{

	
	$_SESSION['Role'] =  'Owner';
	$_SESSION['MM_Username'] =  $username;



	header("Location: dashboard.php");
} else if($ChkLogin['IDCount'] == 0) {

header("Location: errorlogin.php");

} 




  } else if($_POST['ccompanylst'] != 'db0') {


 	$ccompanylst =$_POST['ccompanylst'];
 	$username = stripslashes($_POST['username']); 
	$Password = stripslashes($_POST['Password']);


		
    $serverName = ".\SQLExpress";	
	$connectionComapny = array( "Database" => $ccompanylst, "CharacterSet" => "UTF-8");

	$connCompany = sqlsrv_connect( $serverName, $connectionComapny);

		if( $connCompany ) 
		{


		}
		else
		{
		     die( print_r( sqlsrv_errors(), true));
		}
 		


$StrSqlCo = "Select ID, Count(ID) as IDCount, Role from AspNetUsers 
where UserName = '".$username."' 
And Password2 = '".md5($Password)."'
And isActive = 1
 Group by ID, Role";
$ResulCo = sqlsrv_query( $connCompany, $StrSqlCo) or die ( print_r(sqlsrv_errors(), true));
$ChkLogin = sqlsrv_fetch_array( $ResulCo, SQLSRV_FETCH_ASSOC);


if( $ResulCo === false ) {
     die( print_r( sqlsrv_errors(), true));
}


	
	


if($ChkLogin['IDCount'] == 1) 
{

	
	$_SESSION['MM_Username'] =  $username;
	$_SESSION['MM_UserId'] = $ChkLogin['UserID'];
	$_SESSION['MM_CompName'] = $ccompanylst;
	$_SESSION['Loggedin'] = '1';
	$_SESSION['Role'] =  $ChkLogin['Role'];
	$_SESSION['compid'] = $ccompanylst;

	header("Location: dashboard.php");
} else if($ChkLogin['IDCount'] == 0) {

header("Location: errorlogin.php");

} 




}
}


?>
<!DOCTYPE html>
<html>
<head>

	<title>
		Tarteeb		
	</title>

<!-- To Add Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>


<!-- To Add Select2 to can search inside the list box -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js" integrity="sha256-vucLmrjdfi9YwjGY/3CQ7HnccFSS/XRS1M/3k/FDXJw=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />


	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--================================================================

</head>
<body>

<form action="index.php" method="POST">


<div style="margin-top: 10%;">  	 <!--  200px but not reponsive, for responsive 10%-->


<form method="post" action="index.php">





<div class="limiter">


		<div class="container-login100" style="background-image: url('https://colorlib.com/etc/lf/Login_v16/images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<div class="login100-form validate-form p-b-33 p-t-5">




					<br>
					<center>

						<div class=" validate-input" data-validate = "Enter username">
						 
 
					<SELECT name = "ccompanylst" id="ccompanylst" style="width: 80%">

						<?php 

							$Strsql = "Select * from LASCompanies WHERE IsActive = '1'";
							$Resutl = sqlsrv_query( $conn, $Strsql);
							if( $Resutl === false ) {
					     	die( print_r( sqlsrv_errors(), true));
					}

					 
					 while( $row = sqlsrv_fetch_array( $Resutl, SQLSRV_FETCH_ASSOC) ) 
					 {
					   
					  	     
							   	echo "<option value = 'db".$row['Code']."'>".$row['EName']."</option> " ;
					 		 
					 }
					 


						 ?>

					</SELECT>	


					
					</div>

					</center>


					<div class="wrap-input100 validate-input" data-validate = "Select Company">
						<input class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>



					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="Password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">

						<input type="submit" name="button" value="login" class="login100-form-btn" >
					
							
					</div>

				</div>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

	</form>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>






<script type="text/javascript"> 
	// In your Javascript (external .js resource or <script> tag)
$(document).ready(function()
 {
    $('#ccompanylst').select2();
});
</script>