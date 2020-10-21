<?php 
require_once('common.php');
require("connection.php");


//echo $_SESSION['MM_Username'];
//echo "<br>";
//echo $_SESSION['MM_UserId'];






if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 
 $Id = $_POST['id'];
 $issueCustName = $_POST['issueCustName'];
 $issueCustEmail = $_POST['issueCustEmail'];
 $issueCustDescription = $_POST['issueCustDescription'];
 $isIssueResolved = '0';
 $issueTime =  date("h:i:s a");


 
 
 $tsql= "UPDATE dbo.Orders SET 
 issueCustName = (?),
 issueCustEmail = (?), 
 issueCustDescription = (?), 
 isIssueResolved = (?), 
 issueTime = (?)
 WHERE Id = (?)";
            
   

/* Set parameter values. */  
$params = array($issueCustName, $issueCustEmail, $issueCustDescription, $isIssueResolved, $issueTime, $Id);

/* Prepare and execute the query. */  
$stmt20 = sqlsrv_query($connSelComp, $tsql, $params);  
if ($stmt20) {  
    echo "Row successfully updates.\n";  
} else {  
    echo "Row update failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  


/* exit(); */

  $updateGoTo = "thanks.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}




$sql = "SELECT max(CAST(Id AS INT))+1 as countofid  FROM Orders";
$stmt1 = sqlsrv_query( $connSelComp, $sql);
if( $stmt1 === false ) {die( print_r( sqlsrv_errors(), true));}


$sql2 = "SELECT * FROM Orders";
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
 		
.firma-ara{
    padding-bottom: 100px;
    padding-top: 100px;
}
.form-arka-plan{
    background-image: url("https://cdn.filepicker.io/api/file/1WxRtkAQG5h70aoPQdGA/convert?format=jpeg&quality=50");
        background-position: center;
        background-repeat: no-repeat;
        background-size: 100% 100%;
}
.acik-renk-form{
    background: rgba(255, 255, 255, 0.58);
}
.siyah-cerceve{
    -webkit-text-fill-color: white;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black;
}


body{

}
 	</style>

 </head>
 <body>

<form id="form1" name="form1" method="post" action="problem.php">
 	<section class="search-banner text-white py-3 form-arka-plan" id="search-banner">
    <div class="container py-5 my-5">
        <div class="row text-center pb-4">
            <div class="col-md-12">
                <h3 class="text-white siyah-cerceve">Welcome.☹ We are sorry to hear that you are having problem with our services.  Please inform us your issue and we will try our best to solve it right away 😊.</h3>
            </div>
        </div>


        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card acik-renk-form">
                    <div class="card-body">


                    	   



                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <input type="text" id="issueCustName" name="issueCustName" class="form-control" placeholder="Your Name" required >
                                </div>
                            </div>
                            </div>


                               <div class="row">
                          <div class="col-md-4">
                                <div class="form-group ">
                                    <input  type="email" id="issueCustEmail" name="issueCustEmail" class="form-control" placeholder="Your Email" required >
                                </div>
                            </div>
                        </div>
                            

                        	   <div class="row">
                            <div class="col-md-8">
                                <div class="form-group ">
                                    <textarea id="issueCustDescription" name="issueCustDescription" class="form-control" placeholder="Describe The Issue" cols="150" required></textarea>
                                </div>
                            </div>
                      
                            
                        
                        
                            <div class="col-md-3">

                            	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
								<input type="hidden" name="MM_insert" value="form1">
								<br>
                                <input type="Submit" class="btn btn-warning  pl-5 pr-5" value='Submit'>


                            </div>
                         </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

</form>







 
 </body>
 </html>

 	





