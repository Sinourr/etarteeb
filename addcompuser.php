<?php
require_once("connection.php");
require_once('common.php');





$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
 
 
 $Id = $_POST['id'];
 $nameEnglish = $_POST['nameEnglish'];
 $nameArabic = $_POST['nameArabic'];
 $branchId = $_POST['branchId'];
 if (isset($_POST['isActive']) == '1'){ $isActive = "1";}else{$isActive = "0";}
 $EmployeeId = $_POST['EmployeeId'];
 $UserName = $_POST['UserName'];
 $Role = $_POST['Role'];
 $Password2 = md5($_POST['Password2']);

 
 
 
 
 $tsql= "INSERT INTO dbo.AspNetUsers (
             nameEnglish, nameArabic, branchId, isActive, Role, EmployeeId, UserName, Password2) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)";
            
			$var = array($nameEnglish, $nameArabic, $branchId, $isActive, $Role, $EmployeeId, $UserName, $Password2);
            if (!sqlsrv_query($connSelComp, $tsql, $var))
                 {
					  print_r($var); 
					  
            die('Error: ' . print_r(sqlsrv_errors()));
                 }
            echo "1 record added"; 
			
			
  
  $insertGoTo = "editcompusers.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: editcompusers.php?emp_id=".$Id."&empcode=".$EmployeeId, $insertGoTo));
}



$sql = "
SELECT max(CAST(Id AS INT))+1 as countofid  FROM AspNetUsers";

$stmt1 = sqlsrv_query( $conn, $sql);
if( $stmt1 === false ) {
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


<h2>Add Users <a href="compusers.php?culture=en" class="btn btn-outline-primary" style="">Go Back</a>
 </h2>


<hr>



<div class="alert alert-danger" id="danger-alert" style="display:none">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Error! </strong>
    Please Add User first before assigning permissions.
</div>

<div class="container">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
 


<div class="row">
 <div class="col-md-1">
 <label for="code">Employee Code:</label>
      </div>
      
      <div class="col-md-1">
      <input type="text" name="EmployeeId" id="EmployeeId" required class="form-control">
      
     </div>
     </div>
     

<div class="col-md-12"><br/></div>

<div class="row">
  <div class="col-md-1">
 <label for="code">Name (Arabic):</label>
      </div>
      
      <div class="col-md-3">
      <input type="text" name="nameArabic" id="nameArabic" required class="form-control">
     </div>



 <div class="col-md-1">
 <label for="code">Name (English):</label>
      </div>
      
      <div class="col-md-3">
      <input type="text" name="nameEnglish" id="nameEnglish" required class="form-control">
      
     </div> 
     </div>


     <div class="col-md-12"><br/></div>
  


<div class="row">


   <div class="col-md-1"><label>Branch:</label></div>
      
      
       <div class="col-md-3"><select name="branchId"id="branchId" class="form-control js-example-basic-single" required >
       
       <option value="1">Main Branch</option>
       
       </select></div>
       

       
   <div class="col-md-1"><label>Role:</label></div>
      
      
       <div class="col-md-3"><select name="Role"id="Role" class="form-control js-example-basic-single" required >
       
       <option value="">Select</option>
       <option value="admin">Admin</option>
       <option value="user">User</option> 
       </select></div>
       




  </div>


    
   
   <div class="col-md-12"><br/></div>
   
   
    <div class="row">
    <div class="col-md-1"><label>Login:</label></div>
   
      <div class="col-md-3"><input type="text" name="UserName" value="" size="32" class="form-control" autocomplete="off" ></div>
   
   </div>
 
   
   <div class="col-md-12"><br/></div>
   

   <div class="row">
   <div class="col-md-1"><label>Password:</label></div>
      
      
       <div class="col-md-3"><input type="text" name="Password2" value="" size="32" id="Password2" class="form-control" autocomplete="off" required ></div>
    
         
   
  
       
    
  
   <div class="col-md-1"><label>Confirm Password:</label></div>
      
       <div class="col-md-3"><input type="text" name="CPassword2" id="CPassword2" value="" size="32" class="form-control" onChange="checkpass()" autocomplete="off" required >
       
       <p id="passerror" style="display:none;" >The passsword you have entered does not match.</p>
       
        
       
       </div>
     </div>

    <div class="col-md-12"><br/></div>
       

       <div class="row">

        <div class="col-md-2"><label>Is Admin:&nbsp;</label><input type="checkbox" name="isAdmin" value="1" size="32" id="isAdmin" autocomplete="off"  ></div>
      


   <div class="col-md-2"><label>Is Active: &nbsp;</label><input type="checkbox" name="isActive" value="1" size="32" id="isActive" autocomplete="off"  ></div>
       

</div>
       
     
  
    
    
    
    
      
       
    <div class="col-md-12">&nbsp;</div>
       
       
    <div class="col-md-4">
    
    
     <span>&nbsp;</span>
     
    <input type="submit" id="addbtn" value="Add User" class="col-md-4 btn btn-primary">

     <span class="col-md-1"></span>
    

  
    <input type="" id="myWish" value="Assign Permissions"  class="col-md-6 btn btn-default " hidden> <span>&nbsp;</span>
    
    
    </div>
    
    
 <?php  while( $row_id = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
 ?>
          <input type="hidden" name="id" value="<?php 
		  
		  if(!$row_id['countofid']){ 
		  echo "1"; 
		  } else {
			  echo $row_id['countofid'];
			  } ?>">
    <?php } ?>      
           
            <input type="hidden" name="AddedBy" value="<?php echo $_SESSION['MM_Username']; ?>">
            <input type="hidden" name="AddedDate" value="">
            
             <input type="hidden" name="CreatedFrom" value="2">
              <input type="hidden" name="PasswordHash" value="Ebu Sys">
          
              <input type="hidden" name="PhoneNumber" value="">
              <input type="hidden" name="PhoneNumberConfirmed" value="">
              <input type="hidden" name="TwoFactorEnabled" value="">
              <input type="hidden" name="LockoutEndDateUtc" value="">
              <input type="hidden" name="LockoutEnabled" value="">
              <input type="hidden" name="AccessFailedCount" value="">
              
            

            
  <input type="hidden" name="time_created" value="">
  <input type="hidden" name="MM_insert" value="form1">
</form>


</div>

</div>





<script>

function checkpass() {
	
	if(document.getElementById("Password2").value == document.getElementById("CPassword2").value )
	{
		
		document.getElementById("passerror").style.display = "none";
		document.getElementById("addbtn").disabled = false;
		
		
	
} else { 
document.getElementById("passerror").style.display = "block";

document.getElementById("addbtn").disabled = true;
document.getElementById("CPassword2").value = '';
		

}
}
	
	

</script>


<script type="text/javascript">

   $(document).ready (function(){
            $("#danger-alert").hide();
            $("#myWish").click(function showAlert() {
                $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#danger-alert").slideUp(500);
                });   
            });
 });

   
</script>




<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
  <script>
$("#header").load("mainheader.php");
$("#footer").load("mainfooter.php");
</script>




</body>
</html>
<?php
sqlsrv_free_stmt($stmt1);
sqlsrv_close($conn);
?>
