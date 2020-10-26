<?php 
  require_once("connection.php"); 
if(!isset($_SESSION)){        
session_start();        
} 

$action = $_GET['action'];


if($action == 'codecheck' ){


$Code = $_GET['Code'];

//check it the code is already present in the databas or not.
$StrSql = "SELECT TOP(1) * FROM etarteeb WHERE Code = ".$Code." ORDER BY id DESC";
$Result = sqlsrv_query( $conn, $StrSql, array(), array( "Scrollable" => 'static' )) or die ( print_r(sqlsrv_errors(), true));
$code = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);
$row_count = sqlsrv_num_rows( $Result );

//

$output = '';




if($row_count == 0){

$output = 'not duplicate';

}else if($row_count > 0 )
{

$output = 'duplicate';
 
}


print json_encode($output);

} 









else if($action == 'anamecheck' ){


$AName = $_GET['AName'];
//check it the code is already present in the databas or not.
$StrSql = "SELECT TOP(1) * FROM LASCompanies WHERE AName = '".$AName."' ORDER BY id DESC";
$Result = sqlsrv_query( $conn, $StrSql, array(), array( "Scrollable" => 'static' )) or die ( print_r(sqlsrv_errors(), true));
$code = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);
$row_count = sqlsrv_num_rows( $Result );

//

$output = '';




if($row_count == 0){

$output = 'not duplicate';

}else if($row_count > 0 )
{

$output = 'duplicate';
 
}


print json_encode($output);

} else if($action == 'enamecheck' ){


$EName = $_GET['EName'];
//check it the code is already present in the databas or not.
$StrSql = "SELECT TOP(1) * FROM LASCompanies WHERE EName = '".$EName."' ORDER BY id DESC";
$Result = sqlsrv_query( $conn, $StrSql, array(), array( "Scrollable" => 'static' )) or die ( print_r(sqlsrv_errors(), true));
$code = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);
$row_count = sqlsrv_num_rows( $Result );

//

$output = '';




if($row_count == 0){

$output = 'not duplicate';

}else if($row_count > 0 )
{

$output = 'duplicate';
 
}

print json_encode($output);

}




    ?>