<?php 
require_once('common.php');
require("connection.php");
require("mainheader.php");


//echo $_SESSION['MM_Username'];
//echo "<br>";
//echo $_SESSION['MM_UserId'];






if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 
 $Id = $_POST['id'];
 $isIssueResolved = $_POST['isIssueResolved'];
 $resolvedescription = $_POST['resolvedescription'];



 
 $tsql= "UPDATE dbo.Orders SET 
 
 isIssueResolved = (?), 
 resolvedescription = (?),

 WHERE Id = (?)";
            
   

/* Set parameter values. */  
$params = array($isIssueResolved, $resolvedescription, $Id);

/* Prepare and execute the query. */  
$stmt20 = sqlsrv_query($connSelComp, $tsql, $params);  
if ($stmt20) {  
    echo "Row successfully updates.\n";  
} else {  
    echo "Row update failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  


/* exit(); */

  $updateGoTo = "problems.php?clture=en";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}




$sql = "SELECT max(CAST(Id AS INT))+1 as countofid  FROM Orders";
$stmt1 = sqlsrv_query( $connSelComp, $sql);
if( $stmt1 === false ) {die( print_r( sqlsrv_errors(), true));}


$sql2 = "SELECT * FROM Orders WHERE ID = '".$_GET['id']."'";
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
 		



body{

}
 	</style>

 </head>
 <body>


<br>

<div class="container">

    <form id="form1" name="form1" method="post" action="problem.php">
 	
                                   

                                   <div class="row">

                                    <div class="col-md-2"><label>Customer name:</label></div>

                                   <div class="col-md-4">
                                    <input type="text" id="issueCustName" name="issueCustName" class="form-control" placeholder="Your Name"  value="<?php echo $row_data['issueCustName']; ?>" readonly >
                                </div>
                                </div>
                           

                            <div class="col-md-12"><br></div>

                                    <div class="row">
                                    <div class="col-md-2"><label>Customer Email:</label></div>
                                     <div class="col-md-4">
                                    <input  type="email" id="issueCustEmail" name="issueCustEmail" class="form-control" placeholder="Your Email" required value="<?php echo $row_data['issueCustName']; ?>" readonly >
                                </div>
                                    </div>
                           

                            <div class="col-md-12"><br></div>                                    
                                    <div class="row">
                                        <div class="col-md-2"><label>Issue Description:</label></div>
                                         <div class="col-md-6">
                                    <textarea id="issueCustDescription" name="issueCustDescription" class="form-control" placeholder="Describe The Issue" cols="150" readonly ><?php echo $row_data['issueCustName']; ?> </textarea>
                                
                            </div>
                        </div>



                          <div class="col-md-12"><br></div>


                                 <div class="row">
                                        <div class="col-md-2"><label>Resolve Description:</label></div>
                                         <div class="col-md-6">
                                    <textarea id="resolvedescription" name="resolvedescription" class="form-control" placeholder="Describe The Issue" cols="150" required ></textarea>
                                    
                            </div>
                        </div>
     <div class="col-md-12"><br></div>

                                 <div class="row">
                                        <div class="col-md-2"><label>Is Issue resolved?:</label></div>
                                         <div class="col-md-6">
                                    <input type="checkbox" id="isIssueResolved" name="isIssueResolved" value="1">
                                </div>
                            </div>



                            	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
								<input type="hidden" name="MM_insert" value="form1">
								<br>
                                <input type="Submit" class="btn btn-warning  pl-5 pr-5" value='Submit'>


                         


</form>
</div>








 
 </body>
 </html>

 	





