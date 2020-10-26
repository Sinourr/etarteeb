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
				
				
$serverName = ".\SQLExpress";				
$connectionInfo = array( "Database"=>"db000", "UID"=>"administrator", "PWD"=>"123456", "CharacterSet" => "UTF-8" );				
				
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
				
		$connSelectedCompany = array( "Database" => $Database, "CharacterSet" => "UTF-8");		
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
