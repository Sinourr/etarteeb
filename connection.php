<?php

/*
$serverName = ".\SQLExpress";
$connectionInfo =  array( "Database"=>"Broker_MS_01", "UID"=>"administrator", "PWD"=>"123456", "CharacterSet" => "UTF-8");

$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) 
{

}else{
     die( print_r( sqlsrv_errors(), true));
 }


*/



if(!isset($_SESSION)){				
session_start();				
}				
				


// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "adminuser", "pwd" => "User100+", "Database" => "etarteeb", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:mssqlserver11.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

		
				
$conn = sqlsrv_connect( $serverName, $connectionInfo);				
if( $conn ) 				
{				
	/*echo "Success1";*/			
				
}				
				
else				
				
{				
     die( print_r( sqlsrv_errors(), true));				
}				
				
  				
	if(isset($_SESSION['Loggedin'])){			
if($_SESSION['Loggedin']=='1') 				
{				
		$Database = $_SESSION['MM_CompName'];		
				
		$connSelectedCompany = array("UID" => "adminuser", "pwd" => "User100+", "Database" => $Database, "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);		
		$connSelComp = sqlsrv_connect( $serverName, $connSelectedCompany);		
	if( $connSelComp ) 			
	{			
				
				/*echo "Success";*/
	}			
				
	else			
				
	{			
		 echo "Error connection";		
 				
				
	     die( print_r( sqlsrv_errors(), true));			
	}			
				
}				
 				
				
	}			
				
?>				
