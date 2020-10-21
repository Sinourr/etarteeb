<?php
require_once('Connection.php');


if(!isset($_SESSION)){        
session_start();        
}       
  
  if(!isset($_SESSION['MM_Username'])){

   header(sprintf("Location: index.php"));
}

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {

    $id = $_GET['id'];

    $query = "DELETE FROM JournalVC WHERE Id='".$id."'";
    $stmt = sqlsrv_query( $connSelComp, $query);

    if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
    } else {


    $deleteGoTo = "masterusers.php?culture=en";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $deleteGoTo));

    }

}
?>
