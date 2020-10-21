<?php
require_once("connection.php");
require("mainheader.php");


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
FROM AspNetUsers 
 
";
$stmt = sqlsrv_query( $connSelComp, $sql);
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/jquery.fancytree-all-deps.min.js" integrity="sha256-d8VPSMnDtzaOgN+kb4JLYj2XklbYR1S7jiPkrMIyuHA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.6.0/src/jquery.fancytree.filter.js" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/skin-win7/ui.fancytree.min.css" crossorigin="anonymous" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />  
<link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/css/dataTables.checkboxes.css" media="all" type="text/css"/>
<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


</head>



<body>

<div id="header"></div>

<div class="container" id="maincontent">


<h2>System Users <a href="addcompuser.php" class="btn btn-outline-primary float-right" style="float:right">Add User</a>
 </h2>


<hr>
<table id='example'>

<thead>
<tr>
<th>S.No</th>
<!--<th>Employee Code</th>-->
<th>Name</th>
<th>Username</th>
<th>Role</th>

<th>Action</th>
</tr>
</thead>


<tfoot hidden='hidden'>

<tr>
<th>S.No</th>
<!--<th>Code</th>-->
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
    <!--<td></td>-->
      <td><?php 

   echo $row_users['nameEnglish'];
 

 ?></td>
      <td><?php
	  
	  
	 
	 echo $row_users['UserName'];
 
 

    ?></td>
     
       <td><?php echo $row_users['Role']; ?></td>
     
<td><a href="editcompusers.php?emp_id=<?php echo $row_users['Id']; ?>&empcode=<?php echo $row_users['EmployeeId']; ?>" class="btn btn-primary">Edit</a>
      
     <a href="deletecompusers.php?id=<?php echo $row_users['Id']; ?>" class="btn btn-danger">Delete</a>
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
