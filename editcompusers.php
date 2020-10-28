<?php
require_once('Connection.php');


if(!isset($_SESSION)){        
session_start();        
}       
  
  if(!isset($_SESSION['MM_Username'])){

   header(sprintf("Location: index.php"));
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {



 $nameEnglish = $_POST['nameEnglish'];
 $nameArabic = $_POST['nameArabic'];
 if (isset($_POST['isActive'])){ $isActive = "1";}else{$isActive = "0";}
 $AddedBy = $_POST['AddedBy'];
 $AddedDate = $_POST['AddedDate'];
 $EmployeeId = $_POST['EmployeeId'];
 $UserName = $_POST['UserName'];
 $Role = $_POST['Role'];
 $branchId = $_POST['branchId'];
 $Id = $_GET['emp_id'];



/* Set up the parameterized query. */  
$tsql = "UPDATE AspNetUsers  SET 
      	   
			 nameEnglish = (?),
			 nameArabic = (?),
			 isActive = (?),
			
			 EmployeeId = (?),
			
			 UserName = (?),
			 Role = (?),
       branchId = (?)
			
			 WHERE Id = (?)";  

/* Set parameter values. */  
$params = array($nameEnglish, $nameArabic, $isActive, $EmployeeId, $UserName, $Role, $branchId, $Id);

/* Prepare and execute the query. */  
$stmt20 = sqlsrv_query($conn, $tsql, $params);  
if ($stmt20) {  
    echo "Row successfully updates.\n";  
} else {  
    echo "Row update failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  

sqlsrv_free_stmt($stmt20);  
sqlsrv_close($conn);  


/* exit(); */

  $updateGoTo = "editcompusers.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_edituser = "-1";
if (isset($_GET['emp_id'])) {
  $colname_edituser = $_GET['emp_id'];
}





$sql = "
SELECT  *
FROM AspNetUsers
WHERE AspNetUsers.Id = '".$_GET['emp_id']."'";
$stmt111 = sqlsrv_query( $conn, $sql);
if( $stmt111 === false ) {
     die(print_r(sqlsrv_errors(), true));
}
$row_edituser = sqlsrv_fetch_array( $stmt111, SQLSRV_FETCH_ASSOC);








$sql10 = "
SELECT  Role
FROM AspNetUsers
WHERE AspNetUsers.Id = '".$_GET['emp_id']."'";
$stmt12 = sqlsrv_query( $conn, $sql10);
if( $stmt12 === false ) {
     die( print_r( sqlsrv_errors(), true));
}




?>
<!DOCTYPE html>
<html>

<head>
   <title>Tarteeb</title>


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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


<h2>Edit User <a href="compusers.php?culture=en" class="btn btn-outline-primary" style="">Go Back</a>
 </h2>


<hr>


<div class="container">


<form method="post" name="form2" action="<?php echo $editFormAction; ?>">
 


<div class="row">
 <div class="col-md-1">
 <label for="code">Employee Code:</label>
      </div>
      
      <div class="col-md-1">
      <input type="text" name="EmployeeId" id="EmployeeId" value="<?php echo $row_edituser['EmployeeId']; ?>" required class="form-control">
      
     </div>
   </div>
     

<div class="col-md-12"><br/></div>

<div class="row">

 <div class="col-md-1">
 <label for="code">Name (Arabic):</label>
      </div>
      
      <div class="col-md-3">
<input type="text" name="nameArabic" id="nameArabic" required class="form-control" value="<?php echo $row_edituser['nameArabic']; ?>" >
      
     </div>


      <div class="col-md-1">
 <label for="code">Name (English):</label>
      </div>
      
      <div class="col-md-3">
<input type="text" name="nameEnglish" id="nameEnglish" required class="form-control" value="<?php echo $row_edituser['nameEnglish']; ?>">
      
     </div>
     


     
   </div>
     
     <div class="col-md-12"><br/></div>
  

   <div class="row">




   <div class="col-md-1"><label>Branch:</label></div>
      
      
       <div class="col-md-3"><select name="branchId"id="branchId" class="form-control js-example-basic-single dropdownn" required >
       
                     
              <option value="1" selected>Main Branch</option>
       
  
       
       </select></div>




   <div class="col-md-1"><label>Role:</label></div>
      
      
       <div class="col-md-3"><select name="Role"id="Role" class="form-control js-example-basic-single dropdownn" required >
       
              <option value="admin" >Admin</option>       
              <option value="user" selected>User</option>
       
  
       
       </select></div>
       
  </div>
    
   
   <div class="col-md-12"><br/></div>
   
   
    <div class="row">
    <div class="col-md-1"><label>Login:</label></div>
   
      <div class="col-md-3"><input type="text" name="UserName" size="32" class="form-control" autocomplete="off" value="<?php echo $row_edituser['UserName']; ?>"  ></div>
   
   </div>
 
    <div class="col-md-12"><br/></div>
       
<div class="row">
       
      


   <div class="col-md-2"><label>Is Active: &nbsp;</label><input type="checkbox" name="isActive" value="1" size="32" id="isActive"  autocomplete="off" <?php if($row_edituser['isActive'] == 1){echo "Checked";}else{} ?> ></div>
       
       
</div>
     
       
    <div class="col-md-12">&nbsp;</div>
       
       
    <div class="col-md-12">
    
    
     <span>&nbsp;</span>
     


     <span>&nbsp;</span>
      
     

    <input type="submit" id="addbtn" value="Edit User" class="col-md-1 btn btn-primary ">


    <a href='addcompuser.php' class='col-md-2 col-xs-offset-1 btn btn-success'>Add User</a>

    
    
 <span>&nbsp;</span>
    
    

    
    </div>
    
 
          <input type="hidden" name="id" value="<?php echo $row_edituser['Id']; ?>" >
        
           
            <input type="hidden" name="AddedBy" value="<?php echo $_SESSION['MM_Username']; ?>">
            <input type="hidden" name="AddedDate" value="">
            <input type="hidden" name="CompanyId" value="<?php echo $row_edituser['CompanyId']; ?>">
            <input type="hidden" name="companyCode" value="<?php echo $row_edituser['companyCode']; ?>">
            
             <input type="hidden" name="CreatedFrom" value="2">
              <input type="hidden" name="PasswordHash" value="Ebu Sys">
          
              <input type="hidden" name="PhoneNumber" value="">
              <input type="hidden" name="PhoneNumberConfirmed" value="">
              <input type="hidden" name="TwoFactorEnabled" value="">
              <input type="hidden" name="LockoutEndDateUtc" value="">
              <input type="hidden" name="LockoutEnabled" value="">
              <input type="hidden" name="AccessFailedCount" value="">
              
            

            
  <input type="hidden" name="time_created" value="">
  <input type="hidden" name="MM_update" value="form2">
</form>



    
  

</div>

</div>


<script>

$(document).ready(function() {
    $('.dropdownn').select2();
});

</script>



  <script>
$("#header").load("mainheader.php");
$("#footer").load("mainfooter.php");
</script>




</body>
</html>

