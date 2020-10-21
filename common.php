<?php 



if(!isset($_SESSION)){				
session_start();				
}	

  if(!isset($_SESSION['MM_Username'])){

   header(sprintf("Location: index.php"));
}

	date_default_timezone_set('Asia/Riyadh');

?>