<?php 
  require_once("connection.php");
  require("common.php");
  require("mainheader.php"); 




$StrSql = "Select * from Branches WHERE Id = '".$_GET['id']."'";
$Result = sqlsrv_query( $conn, $StrSql) or die ( print_r(sqlsrv_errors(), true));
$row_dataset = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {



 $nameEnglish = $_POST['nameEnglish'];
 $nameArabic = $_POST['nameArabic'];
 $code = $_POST['code'];
 if (isset($_POST['isActive']) == '1'){ $isActive = "1";}else{$isActive = "0";}
 $Id = $_GET['id'];


$tsql = "UPDATE Branches  SET 
          nameEn = (?),
          nameAr = (?),
          Code= (?),
          isActive= (?)
          WHERE Id = (?)";  

/* Set parameter values. */  
$params = array($nameEnglish, $nameArabic, $code, $isActive, $Id);

/* Prepare and execute the query. */  
$stmt21 = sqlsrv_query($conn, $tsql, $params);  
if ($stmt21) {  
    echo "Row successfully updates.\n";  
} else {  
    echo "Row update failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  



 
  $updateGoTo = "editbranch.php?culture=".$_GET['culture']."&id=".$Id;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
   header(sprintf("Location: editbranch.php?culture=".$_GET['culture']."&id=".$Id, $updateGoTo));
}

 ?>


 <!DOCTYPE html>
 <html>
 <head>
  <!-- To Add Jquery -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/jquery.fancytree-all-deps.min.js" integrity="sha256-d8VPSMnDtzaOgN+kb4JLYj2XklbYR1S7jiPkrMIyuHA=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/skin-win7/ui.fancytree.min.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<!-- To Add Select2 to can search inside the list box -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js" integrity="sha256-vucLmrjdfi9YwjGY/3CQ7HnccFSS/XRS1M/3k/FDXJw=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
<script src="js/sweetalert.min.js"></script>


<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="css/sweetalert.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.6.0/src/jquery.fancytree.filter.js" crossorigin="anonymous"></script>



<style type="text/css">
 


table, tr, td, th
{

    border-collapse:collapse;
}
tr.header
{
  font-size: 18px;
    cursor:pointer;
    
}

.mainheader
{
 
 font-size: 22px;


   
}




</style>

  <title>
   <?php echo $sysheadertitle; ?>   
  </title>

 </head>
 <body onload="showusers();">
 
<div id="headerr"></div>

<div>


<br>


</div>





<div class="container">
	
	<div class="heading">

<div class="col-md-12"><br></div>
<div class="col-md-12"><br></div>

<h2 class="<?php echo $float; ?>"><?php echo $Edit." ".$Branches; ?> <a href="branches.php?culture=<?php echo $culture; ?>" class="btn btn-outline-primary" style=""><?php echo $Goback; ?></a>
 </h2>

<br>
<br>
		

</div>

	
		<hr/>

<div class="">
  
    <form method="post" name="form1" action="editbranch.php?culture=<?php echo $culture; ?>&id=<?php echo $_GET['id']; ?>">

<div class="row">
<div class="col-md-2"><?php echo $Code; ?></div>
<div class="col-md-3">
  <input type="text" name="code" id="code" value="<?php echo $row_dataset['Code']; ?>" class="form-control" tabindex="1"  maxlength="12" autofocus />
</div>
</div>

<div class="col-md-12"><br></div>

<div class="row">
<div class="col-md-2"><?php echo $NameA; ?></div>
<div class="col-md-4"><input type="text" name="nameArabic" value="<?php echo $row_dataset['nameAr']; ?>" class="form-control" tabindex="2"  required /></div>

<div class="col-md-2"><?php echo $NameE; ?></div>
<div class="col-md-4"><input type="text" name="nameEnglish" value="<?php echo $row_dataset['nameEn']; ?>" class="form-control" tabindex="3"  required /></div>

</div>
<div class="col-md-12"><br></div>




<div class="col-md-12"><br></div>

<div class="row">
<div class="col-md-1"><?php echo $IsActive; ?></div>
<div class="col-md-1"><input type="checkbox" name="isActive" value="1" <?php if($row_dataset['isActive'] == 1){echo "Checked";}else{} ?>   ></div>



</div>



<br>

<div class="row">


 <input type="submit" id="addbtn" value="<?php echo $Save; ?>" class="col-md-1 btn btn-primary offset-md-8" tabindex="9" >

 &nbsp;

   <a href="addbranch.php?culture=<?php echo $culture; ?>" class="btn btn-success">Add New</a>
</div>

  <input type="hidden" name="MM_update" value="form1">
 

    
</div>
</form>


<div id="footer"></div>

 </body>
 </html>

 

<script type="text/javascript">

  $( document ).ready(function() {
  $("#Code").focus();
});



</script>



<script type="text/javascript"> 
 // In your Javascript (external .js resource or <script> tag)
$(document).ready(function()
 {
    $('.dropdownn').select2();
});
</script>



<!--
<script type="text/javascript">
  


 
 
   $('.dropdownn').on('change', function() {

     var user_Id=$("#user_Id").val();
 
 
 if(user_Id == ""){
   
   
   alert("Please fill all feilds");
   }
 
                          var projid=$("#projid").val();
                  


              
          
             
                          $.ajax({
                              type:"post",
                              url:"phphandler.php?user_Id="+user_Id+"&projid="+projid+"&action=assigntoproject",
                              data:"action=assigntoproject",
                

                
                              success:function(data){
                  

                  console.log("Working");
                  showusers();
                  location.reload();

                    }
 
                          });
              
              
                    
 
                
             
            });
                 
  

                       function showusers(){

                        var projid=$("#projid").val();
                      $.ajax({
                        type:"post",
                        url:"phphandler.php?action=showprojectusers&projid="+projid,
                        data:"action=showprojectusers",
                        success:function(data){$("#showusersdiv").html(data);}});
             };



function deleteusers (){



        var id=$("#id").val();
        


    $.ajax({
        type:"post",
        url:"phphandler.php?id="+id+"&action=deleteusers",
        data:"action=deleteusers",

        success:function(data){


            console.log("deleted user");
            location.reload();
            showusers();


        }

    });

};



</script>

-->