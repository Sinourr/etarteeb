<?php
require_once('Connection.php');
require('Common.php');
require('lang.php');

if ((isset($_GET['id'])) && ($_GET['id'] != "")) {

    $id = $_GET['id'];


    $query = "DELETE FROM Branches WHERE Id='".$id."'";
    $stmt = sqlsrv_query( $conn, $query);

    if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
    } else {


    $deleteGoTo = "branches.php?culture=en&id=".$id;
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $deleteGoTo));

    }

}
?>
