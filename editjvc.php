<?php 
  require_once("connection.php"); 

  require_once('common.php');
  /*echo $_SESSION['MM_Username'];
  echo "<br>";
  echo $_SESSION['MM_UserId'];
  echo "<br>";
  echo $_SESSION['MM_CompName'];*/






$StrSql = "Select * from JournalVC WHERE Id = '".$_GET['id']."'";
$Result = sqlsrv_query( $connSelComp, $StrSql) or die ( print_r(sqlsrv_errors(), true));
$row_dataset = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);





if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {


 $Id = $_GET['id'];
 $VoucherCode = $_POST['VoucherCode'];
 $DescriptionAr = $_POST['DescriptionAr'];
 $DescriptionEn = $_POST['DescriptionEn'];
 $SerializationType = $_POST['SerializationType'];
 $SerializationMethod = $_POST['SerializationMethod'];
 if ($_POST['IsActive'] == '1'){ $IsActive = "1";}else{$IsActive = "0";}


$tsql = "UPDATE JournalVC  SET 
          VoucherCode = (?),
          DescriptionAr = (?),
          DescriptionEn= (?),
          SerializationType= (?),
          SerializationMethod= (?),
          IsActive= (?)
          WHERE Id = (?)";  

/* Set parameter values. */  
$params = array($VoucherCode, $DescriptionAr, $DescriptionEn, $SerializationType,  $SerializationMethod, $IsActive, $Id);

/* Prepare and execute the query. */  
$stmt20 = sqlsrv_query($connSelComp, $tsql, $params);  
if ($stmt20) {  
    echo "Row successfully updates.\n";  
} else {  
    echo "Row update failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  

sqlsrv_free_stmt($stmt20);  
sqlsrv_close($connSelComp);  


 
  $updateGoTo = "editjvc.php?id=".$Id;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
   header(sprintf("Location: editjvc.php?id=".$Id, $insertGoTo));
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

.fancytree-container {
  outline: none;
}


.fancytree-title{ 

  text-decoration: underline;
  color: blue !important;

   }

   .fancytree-childcounter{

font-size: 10px !important;
height: 15px !important;


   }

     .mainhead-childcounter{

font-size: 20px !important;
height: 15px !important;


   }

   .mainhead{

   font-weight: bold;
   font-size: 20px !important;

   } 

.mainhead .fancytree-title{

   margin-top: 30px !important;
   color: black  !important;
   text-decoration: blink !important;

}


   .mainicon{
background-image: url('https://img.icons8.com/bubbles/2x/company.png');
background-size: 100% 100% !important;
width: 80px !important;
height: 90px !important;
background-repeat: no-repeat;

   }


</style>

  <title>
   Online Accounting System   
  </title>

 </head>
 <body>
 
<div id="headerr"></div>

<div>


<br>


</div>





<div class="container">
	
	<div class="heading">

		<h3 class="col-md-8"><i class="far fa-file-alt"></i> Edit Journal Voucher Code <a href='Journalvc.php' class='btn btn-outline-primary' >Go Back</a>
  </h3> 
		

</div>

	
		<hr/>


<div class="">
  
    <form method="post" name="form1" action="editjvc.php?id=<?php echo $row_dataset['Id']; ?>">

<div class="row">
<div class="col-md-2">Voucher Code</div>
<div class="col-md-3">
  <input type="text" name="VoucherCode" id="VoucherCode" class="form-control" tabindex="1"  maxlength="4" autofocus value="<?php echo $row_dataset['VoucherCode']; ?>" />
</div>
</div>

<div class="col-md-12"><br></div>

<div class="row">
<div class="col-md-2">Description (Arabic)</div>
<div class="col-md-4"><input type="text" name="DescriptionAr" class="form-control" tabindex="2" value="<?php echo $row_dataset['DescriptionAr']; ?>"  /></div>

<div class="col-md-2">Description (English)</div>
<div class="col-md-4"><input type="text" name="DescriptionEn" class="form-control" tabindex="3" value="<?php echo $row_dataset['DescriptionEn']; ?>" /></div>

</div>
<div class="col-md-12"><br></div>









<div class="row">
  <div class="card-body bg-light col-md-5 text-center">
<div class="col-md-12">Type of Serialization</div>

<div class="row">
<div class="col-md-12 text-left"><input type="checkbox" name="SerializationType" id="manualSerializationType" class="SerializationType" value="manual"    onmouseleave="unhideautoSerializationoptions();" 
  <?php if($row_dataset['SerializationType'] == 'manual'){echo "Checked";} ?>
  > <label for="manualSerializationType" >Manual</label>

  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   

  <input type="checkbox" id="autoSerializationType"  class="SerializationType" 
   <?php if($row_dataset['SerializationType'] == 'autoonsave' || $row_dataset['SerializationType'] == 'autooncreate'){
    echo "Checked";
   

 } ?>
     > <label for="autoSerializationType" >Auto</label>

</div> 






<div class="col-md-12 .offset-md-6 text-left autooptions" style="display:none;" >

<input type="checkbox" name="SerializationType" id="autocreateSerializationType" value="autooncreate" class="SerializationType" 
   <?php if($row_dataset['SerializationType'] == 'autooncreate'){echo "Checked";} ?>
   > <label for="autocreateSerializationType"  >Auto on Creation</label>

<input type="checkbox" name="SerializationType" id="autosaveSerializationType" value="autoonsave" class="SerializationType"
   <?php if($row_dataset['SerializationType'] == 'autoonsave'){echo "Checked";} ?>
   > <label for="autosaveSerializationType">Automatic on Save</label></div>

</div>
</div>





<?php if($row_dataset['SerializationType'] == 'autoonsave' || $row_dataset['SerializationType'] == 'autooncreate'){
    echo "<script>$('.autooptions').show();</script>";
 } ?>
 




<div class="col-md-2"><br></div>

  <div class="card-body bg-light col-md-5 text-center SerializationMethodcard" style="display: ;">
<div class="col-md-12">Serialization Method</div>

<div class="row">
<div class="col-md-12 text-left"><input type="checkbox" name="SerializationMethod" class="SerializationMethod" value="continous"
   <?php if($row_dataset['SerializationMethod'] == 'continous'){echo "Checked";} ?>
   > Continous</div>
<div class="col-md-12 text-left"><input type="checkbox" name="SerializationMethod" class="SerializationMethod" value="yearly"
   <?php if($row_dataset['SerializationMethod'] == 'yearly'){echo "Checked";} ?>
   > Yearly</div>
<div class="col-md-12 text-left"><input type="checkbox" name="SerializationMethod" class="SerializationMethod" value="monthly"
  <?php if($row_dataset['SerializationMethod'] == 'monthly'){echo "Checked";} ?>
  > Monthly</div>


</div>
</div>
</div>


<div class="col-md-12"><br></div>


<div class="row">



<div class="col-md-1">IsActive</div>
<div class="col-md-1"><input type="checkbox" name="IsActive" value="1" class="" tabindex="7" <?php if($row_dataset['IsActive'] == '1'){echo "Checked";} ?> /></div>

<div class="col-md-4"></div>

 <input type="submit" id="addbtn" value="Edit Voucher Code" class="col-md-2 btn btn-primary offset-md-3" tabindex="9" >


</div>



  <input type="hidden" name="MM_update" value="form1">
 

    
</div>
</form>






<div id="footer"></div>

 </body>
 </html>

 
 <script type="text/javascript">  

$("#headerr").load("mainheader.php");
$("#footer").load("mainfooter.php");

 </script>

<script type="text/javascript">

  $( document ).ready(function() {
  $("#Code").focus();
});



</script>





<script type="text/javascript">


//this lets us only select one checkbox in the particular class

  
$('input[class="SerializationType"]').on('change', function() {
   $('input[class="SerializationType"]').not(this).prop('checked', false);

    unhideautoSerializationoptions();


 
});



$('input[class="SerializationMethod"]').on('change', function() {
   $('input[class="SerializationMethod"]').not(this).prop('checked', false);
    unhideautoSerializationoptions();
});







</script>




<script type="text/javascript">


//this function let us unhide options if auto is selected.

function unhideautoSerializationoptions(){
  

console.log("called");

    if($("#SerializationType").prop('checked') == true){ 

              $(".autooptions").hide();
              $("#autoSerializationType").addClass("SerializationType");

 
} else if($("#autoSerializationType").prop('checked') == true){ 

              $(".autooptions").show();
              $("#autoSerializationType").removeClass("SerializationType");


 
} else if($("#autoSerializationType").prop('checked') == false){ 

              $(".autooptions").hide();
              $("#autoSerializationType").addClass("SerializationType");
 
}

if($("#manualSerializationType").prop('checked') == true){ 

              $(".autooptions").hide();
              $("#autoSerializationType").addClass("SerializationType");
              $("#autoSerializationType").prop('checked') = false;
 
} 
} 



$('input[class="SerializationType"]').click(



function unhideautoSerializationoptions(){
  

console.log("called");

    if($("#SerializationType").prop('checked') == true){ 

              $(".autooptions").hide();
              $("#autoSerializationType").addClass("SerializationType");

 
} else if($("#autoSerializationType").prop('checked') == true){ 

              $(".autooptions").show();
              $("#autoSerializationType").removeClass("SerializationType");


 
} else if($("#autoSerializationType").prop('checked') == false){ 

              $(".autooptions").hide();
              $("#autoSerializationType").addClass("SerializationType");
 
} 

 
if($("#manualSerializationType").prop('checked') == true){ 

              $(".autooptions").hide();
              $("#autoSerializationType").addClass("SerializationType");
              $("#autoSerializationType").prop('checked') = false;
 
} 
});





</script>