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
$stmt20 = sqlsrv_query($conn, $tsql, $params);  
if ($stmt20) {  
    echo "Row successfully updates.\n";  
} else {  
    echo "Row update failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  

sqlsrv_free_stmt($stmt20);  
sqlsrv_close($conn);  


/* exit(); */

  $updateGoTo = "thanks.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}




$sql = "SELECT max(CAST(Id AS INT))+1 as countofid  FROM Orders";
$stmt1 = sqlsrv_query( $conn, $sql);
if( $stmt1 === false ) {die( print_r( sqlsrv_errors(), true));}


$sql2 = "SELECT * FROM Orders";
$stmt2 = sqlsrv_query( $conn, $sql2) or die ( print_r(sqlsrv_errors(), true));
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
   
}
.acik-renk-form{
    background: rgba(255, 255, 255, 0.8);
}
.siyah-cerceve{
    -webkit-text-fill-color: white;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black;
}


body{

 background-image: url("https://www.marketingdonut.co.uk/sites/default/files/marketing-with-your-database_389579230_0.jpg");

        background-repeat: no-repeat;
        background-size: cover;
          /* Full height */
  height: 100%;
}
  </style>

 </head>
 <body>

  <section class="search-banner text-white py-3 form-arka-plan" id="search-banner">
    <div class="container py-5 my-5">
        <div class="row text-center pb-4">
         
        </div>


        <br>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card acik-renk-form">
                    <div class="card-body">


                        



                           <div class="col-md-12">
                <h3 class="text-white siyah-cerceve">Thanks for submitting your information. Our customer support agent will get in touch with you shortly.</h3>
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

  





