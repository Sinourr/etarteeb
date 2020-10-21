<?php 

session_start();
unset($_SESSION);
session_destroy();

 header(sprintf("Location: index.php"));
?>