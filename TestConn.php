<?php 



$serverName = "(local)";
$connectionInfo = array( "Database" => "LASComp071", "CharacterSet" => "UTF-8");

$conn = sqlsrv_connect( $serverName, $connectionInfo);


if( $conn ) {

}else{
     die( print_r( sqlsrv_errors(), true));
}
	
// echo phpinfo();




      $sql151 = "Select * from LASChartOfAcc";

$stmt31 = sqlsrv_query( $conn, $sql151);
if( $stmt31 === false ) {
     die( print_r( sqlsrv_errors(), true));
}



echo "<table>";
 while( $row = sqlsrv_fetch_array( $stmt31, SQLSRV_FETCH_ASSOC) ) {
   
  	    echo "<tr>";
		   	echo "<td>".$row['Code']."</td>";
			echo "<td>".$row['AName']."</td>";;
			echo "<td>".$row['EName']."</td>";;
			echo "<td>".$row['IsActive']."</td>";
		echo "</tr>"; 
 }
echo "</table>";


?>

