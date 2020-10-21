<?php 

require('connection.php');




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
WHERE IsOpen = '0'
GROUP by IsOpen";
$resultpending = sqlsrv_query( $connSelComp, $sql, array(), array( "Scrollable" => 'static' ));
if( $resultpending === false ) {
    die( print_r( sqlsrv_errors(), true));
}
$row_pending = sqlsrv_fetch_array( $resultpending, SQLSRV_FETCH_ASSOC);



$sql = "
SELECT IsOpen, COUNT(ID) AS Count from Orders GROUP By IsOpen";
$resultdone = sqlsrv_query( $connSelComp, $sql, array(), array( "Scrollable" => 'static' ));
if( $resultdone === false ) {
    die( print_r( sqlsrv_errors(), true));
}
$row_done = sqlsrv_fetch_array( $resultdone, SQLSRV_FETCH_ASSOC);







?>

 <!DOCTYPE html >
 <html>
 <head>
 	
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />



 </head>
 <body>
 
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
                      <p class="card-category">Pending</p>
                      <p class="card-title"><?php echo $row_pending['Count']; ?></p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  These Problems are pending
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
                      <p class="card-category">Done</p>
                      <p class="card-title"><?php echo $row_done['Count']; ?></p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i>
                  These Problems are Done
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
                      <p class="card-title"><?php echo $row_deffered['Count']+$row_pending['Count']+$row_done['Count']; ?></p><p>
                    </p></div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  <a>Total Problems</a>
                </div>
              </div>
            </div>
          </div>
        </div>

 </body>
 </html>

 





