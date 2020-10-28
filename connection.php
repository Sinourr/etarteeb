<?php

if(!isset($_SESSION)){				
session_start();				
}	



$connectionInfo = array("UID" => "adminuser", "pwd" => "User100+", "Database" => "etarteeb", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:mssqlserver11.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);



		
				
$conn = sqlsrv_connect( $serverName, $connectionInfo);				
if( $conn ) 				
{				
			
				
}				
				
else				
				
{				
     die( print_r( sqlsrv_errors(), true));				
}				
			

					
				
?>				
