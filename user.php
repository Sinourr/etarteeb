<?php
require_once("connection.php"); 

session_start();

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}



$sql = "
SELECT  *
FROM AspNetUsers WHERE CreatedFrom = '2'
 
";
$stmt = sqlsrv_query( $conn, $sql);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}





?>

<!DOCTYPE html>
<html>

<head>
   <title>EBU System</title>


<style>

#maincontent{
	
	padding:1%;
	
	}

</style>

<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="js/jquery-3.2.0.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.4.js" ></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js" ></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js" ></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js" ></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js" ></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js" ></script>
<script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js" ></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js" ></script>
<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js" ></script>
<script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/js/dataTables.checkboxes.min.js" ></script>

 
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />  
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/css/dataTables.checkboxes.css" media="all" type="text/css"/>
<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>



<body>

<div id="header"></div>

<div class="container" id="maincontent">


<h2>System Users <a href="addsysuser.php" class="btn btn-default" style="float:right">Add User</a>
 </h2>


<hr>
<table id='example'>

<thead>
<tr>
<th>S.No</th>
<th>Employee Code</th>
<th>Name</th>
<th>Username</th>
<th>Role</th>

<th>Action</th>
</tr>
</thead>


<tfoot hidden='hidden'>

<tr>
<th>S.No</th>
<th>Code</th>
<th>Name</th>
<th>Username</th>
<th>Role</th>

<th>Action</th>
</tr>

</tfoot>

<tbody>
  <?php
  
   $sn=0;
   while( $row_users = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	   
	$sn++;
	
	?>
    <tr>
    <td><?php echo $sn; ?></td>
      <td><?php 






      



      $sql151 = "
SELECT  *
FROM Employees
WHERE Employees.Id = '".$row_users['EmployeeId']."'";

$stmt31 = sqlsrv_query( $conn2, $sql151);
if( $stmt31 === false ) {
     die( print_r( sqlsrv_errors(), true));
}

 while( $row_empcode = sqlsrv_fetch_array( $stmt31, SQLSRV_FETCH_ASSOC) ) {
   
   echo $row_empcode['employeeCode'];
 }

 ?></td>
      <td><?php
	  
	  
$sql15 = "
SELECT  *
FROM Employees
WHERE Employees.Id = '".$row_users['EmployeeId']."'";

$stmt3 = sqlsrv_query( $conn2, $sql15);
if( $stmt3 === false ) {
     die( print_r( sqlsrv_errors(), true));
}

 while( $row_username = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC) ) {
	 
	 echo $row_username['Name'];
 }
 

    ?></td>
      <td><?php echo $row_users['UserName']; ?></td>
       <td><?php echo $row_users['Role']; ?></td>
     
<td><a href="editsysusers.php?emp_id=<?php echo $row_users['Id']; ?>&empcode=<?php echo $row_users['EmployeeId']; ?>" class="btn btn-primary">Edit</a>
      
     <a href="deleteusers.php?id=<?php echo $row_users['Id'].'&Hex=44dD55d22s4888dS44s51s58S55s8412s5'; ?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    <?php }; ?>

</tbody></table>




</div>
<script type="text/javascript">

   
   
$(document).ready(function() {
   var table = $('#example').DataTable({
      
   
     
      'columnDefs': [
         {
            'targets': 0,
           
         }
      ],
      'select': {
        
      },
      'order': [[0, 'asc']],
           'dom': 'Blfrtip',
           'buttons': [
            {
                'extend': 'print', 
                'text': 'Print All',   
            },
      
         {
            'extend': 'excel', 
                'text': 'excel',
            },
            
            {
            
            'extend': 'pdf', 
                'text': 'pdf',
              'orientation': 'landscape',
                'pageSize': 'LEGAL'
            },
            
            {
                'extend': 'print',
                'text': 'Print selected',
                'exportOptions': {
                    'modifier': {
                        'selected': true
                    }
               
                }
            }
        ],  
   
   
           
         
           });
  
   
 
   
} );
   
</script>

  <script>
$("#header").load("header.php");
$("#footer").load("footer.php");
</script>




</body>
</html>
