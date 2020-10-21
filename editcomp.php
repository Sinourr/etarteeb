<?php 
  require_once("connection.php"); 

require_once('common.php');


  /*echo $_SESSION['MM_Username'];
  echo "<br>";
  echo $_SESSION['MM_UserId'];
  echo "<br>";
  echo $_SESSION['MM_CompName'];*/



$StrSql = "Select * from LASCompanies WHERE ID = '".$_GET['id']."'";
$Result = sqlsrv_query( $conn, $StrSql) or die ( print_r(sqlsrv_errors(), true));

$row_dataset = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


 $Code = $_POST['Code'];
 $AName = $_POST['AName'];
 $EName = $_POST['EName'];
 $AAddress = $_POST['AAddress'];
 $EAddress = $_POST['EAddress'];
 $Email = $_POST['Email'];
 $POBox = $_POST['POBox'];
 $Zip = $_POST['Zip'];
 $TelNo1 = $_POST['TelNo1'];
 $FaxNo1 = $_POST['FaxNo1'];
 $WebPage = $_POST['WebPage'];
 $OpeningEDate = $_POST['OpeningEDate'];
 $AccountNo = $_POST['AccountNo'];
 $CrNo = $_POST['CrNo'];
 if ($_POST['IsActive'] == '1'){ $IsActive = "1";}else{$IsActive = "0";};
 $ID = $_GET['id'];
 /*
 $TelNo2 = $_POST['TelNo2'];
 $FaxNo2 = $_POST['FaxNo2'];
 $OpeningADate = $_POST['OpeningADate'];
 */



           $tsql= "UPDATE dbo.LASCompanies SET
           Code = (?), 
           AName = (?), 
           EName = (?), 
           AAddress = (?), 
           EAddress = (?), 
           Email = (?),
           POBox = (?), 
           Zip = (?), 
           TelNo1 = (?), 
           FaxNo1 = (?), 
           WebPage = (?), 
           OpeningEDate = (?), 
           AccountNo = (?), 
           CrNo = (?), 
           IsActive = (?)
           WHERE ID = (?)";
            
            $var = array($Code, $AName, $EName, $AAddress, $EAddress, $Email, $POBox, $Zip, $TelNo1, $FaxNo1, $WebPage, $OpeningEDate, 
              $AccountNo, $CrNo, $IsActive, $ID);
          

            $stmt20 = sqlsrv_query($conn, $tsql, $var);  
           
            if ($stmt20) {  
                echo "Row successfully updates.\n";  
            } else {  
                echo "Row update failed.\n";  
                die(print_r(sqlsrv_errors(), true));  
            }  

            sqlsrv_free_stmt($stmt20);  
            sqlsrv_close($conn);  


             
              $updateGoTo = "editcomp.php?id=".$ID;
              if (isset($_SERVER['QUERY_STRING'])) {
                $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
                $updateGoTo .= $_SERVER['QUERY_STRING'];
              }
               header(sprintf("Location: editcomp.php?id=".$ID, $insertGoTo));
            }




 ?>


 <!DOCTYPE html>
 <html>
 <head>
  <!-- To Add Jquery -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/jquery.fancytree-all-deps.min.js" integrity="sha256-d8VPSMnDtzaOgN+kb4JLYj2XklbYR1S7jiPkrMIyuHA=" crossorigin="anonymous"></script>
<!-- To Add Select2 to can search inside the list box -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js" integrity="sha256-vucLmrjdfi9YwjGY/3CQ7HnccFSS/XRS1M/3k/FDXJw=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.6.0/src/jquery.fancytree.filter.js" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/skin-win7/ui.fancytree.min.css" crossorigin="anonymous" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

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

		<h3 class="col-md-8"><i class="far fa-building" aria-hidden="true"></i> Edit Company Information <a href='companies.php' class='btn btn-outline-primary' >Go Back</a>
  </h3> 
		

</div>

	
		<hr/>



<form action="editcomp.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data" method="post" name="form1"> 



<div class="col-md-9 float-left">

   


        


        <div class="form-group row">



            <label class="control-label col-md-2" for="Code">Short Code<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3 ">
                <input class="form-control text-box single-line" data-val="true" name="Code" id="Code" type="text" 
                value="<?php echo $row_dataset['Code']; ?>" readonly  autocomplete="off">
                <span class="text-danger" id="codeerror" style="display: none;">Code already exists in database</span>


                            </div>

                            <div class="col-md-1"></div>

            <label class="control-label col-md-2" for="OpeningEDate">Contract Date</label>
            <div class="col-md-3">
                <input class="form-control single-line" id="OpeningEDate" name="OpeningEDate" type="date"         
                value="<?php echo $row_dataset['OpeningEDate']; ?>"  >
             
            </div>


           
        </div>

        <div class="form-group row">
            

            <label class="control-label col-md-2" for="AName">Name (Arabic)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" id="AName" name="AName" type="text" readonly
                 value="<?php echo $row_dataset['AName']; ?>" autocomplete="off">
                 <span class="text-danger" id="anameerror" style="display: none;">Code already exists in database</span>
            </div>
            

                            <div class="col-md-1"></div>

            <label class="control-label col-md-2" for="EName">Name (English)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" id="EName" name="EName" type="text" value="<?php echo $row_dataset['EName']; ?>" readonly autocomplete="off" >
                 <span class="text-danger" id="enameerror" style="display: none;">Code already exists in database</span>
            </div>
           
        </div>

        <div class="form-group row">
            <label class="control-label col-md-2" for="Email">Email<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" tabindex="1" data-val="true" id="Email" name="Email" type="email" value="<?php echo $row_dataset['Email']; ?>">
            </div>


                            <div class="col-md-1"></div>

            <label class="control-label col-md-2" for="TelNo1">Telephone<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" data-val="true" id="TelNo1" name="TelNo1" type="tel" value="<?php echo $row_dataset['TelNo1']; ?>">
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-2" for="FaxNo1">Fax</label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" id="FaxNo1" name="FaxNo1" type="text" value="<?php echo $row_dataset['FaxNo1']; ?>" autocomplete="off">
            </div>


                            <div class="col-md-1"></div>

            <label class="control-label col-md-2" for="WebPage">Website</label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" data-val="true" id="WebPage" name="WebPage" type="url" value="<?php echo $row_dataset['WebPage']; ?>" autocomplete="off">
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="form-group row">
             <label class="control-label col-md-2" for="AAddress">Address (Arabic)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" data-val="true" id="AAddress" name="AAddress" type="text" value="<?php echo $row_dataset['AAddress']; ?>">
            </div>


                            <div class="col-md-1"></div>


            <label class="control-label col-md-2" for="EAddress">Address (English)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" data-val="true" id="EAddress" name="EAddress" type="text" value="<?php echo $row_dataset['EAddress']; ?>">
            </div>

           
            <div class="col-md-4"></div>
        </div>

       <!-- 
       <div class="form-group row">
            <label class="control-label col-md-2" for="bankNameEnglish">Bank Name (English)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" data-val-required="The Bank Name (English) field is required." id="bankNameEnglish" name="bankNameEnglish" type="text" value="">
                <span class="field-validation-valid text-danger" data-valmsg-for="bankNameEnglish" data-valmsg-replace="true"></span>
            </div>

            <label class="control-label col-md-2" for="bankNameArabic">Bank Name (Arabic)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" data-val-required="The Bank Name (Arabic) field is required." id="bankNameArabic" name="bankNameArabic" type="text" value="">
                <span class="field-validation-valid text-danger" data-valmsg-for="bankNameArabic" data-valmsg-replace="true"></span>
            </div>
            <div class="col-md-4"></div>
        </div>
      -->
 
        <div class="form-group row">
            <label class="control-label col-md-2" for="AccountNo">Account #<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line"  id="AccountNo" name="AccountNo" type="text" value="<?php echo $row_dataset['AccountNo']; ?>">
            </div>


                            <div class="col-md-1"></div>

            <label class="control-label col-md-2" for="CrNo">CR #<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" data-val="true" id="CrNo" name="CrNo" type="text" value="<?php echo $row_dataset['CrNo']; ?>">
            </div>

        </div>


           <div class="form-group row">
            <label class="control-label col-md-2" for="POBox">POBox #<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line"  id="POBox" name="POBox" type="text" value="<?php echo $row_dataset['POBox']; ?>">
            </div>


                            <div class="col-md-1"></div>

            <label class="control-label col-md-2" for="Zip">Zip #<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-3">
                <input class="form-control text-box single-line" data-val="true" id="Zip" name="Zip" type="text" value="<?php echo $row_dataset['Zip']; ?>">
            </div>
            <div class="col-md-4"></div>
        </div>




        <div class="form-group row">
            <label class="control-label col-md-2" for="IsActive">Is Active?</label>
            <div class="checkbox col-md-3">
                <input type="checkbox" name="IsActive" id="IsActive" value="1" <?php  if($row_dataset['IsActive'] == '1'){echo "Checked";} ?> class="" />
            </div>
         

         <!--   <div class="col-md-2">
                <b> Upload CR. No </b>
            </div>
            <div class="col-md-2">
                <input type="file" name="cr" accept=".png, .jpg, .jpeg" onchange="loadFile(event)">
            </div>
            <div class="col-md-4"></div>
        </div>


        <div class="form-group row">
            <div class="col-md-4">

            </div>
            <div class="col-md-2">
                <b> Upload Company Logo </b>
            </div>
            

         


            <div class="col-md-2">
                <input type="file" name="logo" accept=".png, .jpg, .jpeg" onchange="loadFile1(event)">
            </div>
            <div class="col-md-4"></div>
        </div>

           -->


                            <div class="col-md-4"></div>

         
                <input type="hidden" name="MM_insert" value="form1">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save </button>
                <br>

                
               
        

            </div>
        </div>




    </div>




<div class="col-md-3 float-right mr-5" >
    <div class="col-md-12">

<h6><small>Copy data from another system? <input type="checkbox" name="copydata" onchange="showprompt();"> </small></h6> 



</div>

<div class="card mb-2 shadow-sm copyprompt" style="display: none;">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Copy Data</h4>
      </div>
      <div class="card-body">
       
        <ul class="list-unstyled mt-3 mb-4">
          <li>From Company:</li> 

          <select class="dropdownn">

  <?php 

    $Strsql = "Select * from LASCompanies WHERE IsActive = '1'";
    $Resutl = sqlsrv_query( $conn, $Strsql);
    if( $Resutl === false ) {
      die( print_r( sqlsrv_errors(), true));
}

 
 while( $row = sqlsrv_fetch_array( $Resutl, SQLSRV_FETCH_ASSOC) ) 
 {
   
         
        echo "<option value = 'LASComp".$row['Code']."'>".$row['EName']."</option> " ;
     
 }
 


   ?>
            

          </select>
          <li><br></li>
          <li><input type="checkbox" name="chartsofacc" id="chartsofacc"> <label for="chartsofacc">Charts of Account</label></li>
          <li><input type="checkbox" name="costcenter" id="costcenter"> <label for="costcenter">Cost Center</label></li>
          <li><input type="checkbox" name="projects" id="projects"> <label for="projects">Projects</label></li>
          <li><input type="checkbox" name="branches" id="branches"> <label for="branches">Branches</label></li>
          <li><input type="checkbox" name="departments" id="departments"> <label for="departments">Departments</label></li>
        </ul>
 
      </div>
    </div>

</div>




</form>
</div>



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



<script>

$(document).ready(function() {
    $('.dropdownn').select2();
});

</script>


<script type="text/javascript">
  

function checkcode() {
  var Code = $('#Code').val();
 
  if(Code != '') {
    $.ajax({
      type : "get",
      dataType: "json",
      url: "phphandler.php?action=codecheck&Code="+Code,
      success: function (data) {
        

          console.log(data);

           if(data=="duplicate"){

             $('#Code').addClass('is-invalid');
                $('#Code').removeClass('is-valid');
             $('#codeerror').show();
             $('#Code').val('');
          }  
          else if(data=="not duplicate")
          {

             $('#Code').removeClass('is-invalid');
             $('#Code').addClass('is-valid');
             $('#codeerror').hide();
          } 
      
        }
    });
  }
}
</script> 




<script type="text/javascript">
  

function checkaname() {
  var AName = $('#AName').val();
 
  if(AName != '') {
    $.ajax({
      type : "get",
      dataType: "json",
      url: "phphandler.php?action=anamecheck&AName="+AName,
      success: function (data) {
        

          console.log(data);

           if(data=="duplicate"){

             $('#AName').addClass('is-invalid');
                $('#AName').removeClass('is-valid');
             $('#anameerror').show();
             $('#AName').val('');
          }  
          else if(data=="not duplicate")
          {

             $('#AName').removeClass('is-invalid');
             $('#AName').addClass('is-valid');
             $('#anameerror').hide();
          } 
      
        }
    });
  }
}
</script> 





<script type="text/javascript">
  

function checkename() {
  var EName = $('#EName').val();
 
  if(EName != '') {
    $.ajax({
      type : "get",
      dataType: "json",
      url: "phphandler.php?action=enamecheck&EName="+EName,
      success: function (data) {
        

          console.log(data);

           if(data=="duplicate"){

             $('#EName').addClass('is-invalid');
                $('#EName').removeClass('is-valid');
             $('#enameerror').show();
             $('#EName').val('');
          }  
          else if(data=="not duplicate")
          {

             $('#EName').removeClass('is-invalid');
             $('#EName').addClass('is-valid');
             $('#enameerror').hide();
          } 
      
        }
    });
  }
}
</script> 



<script type="text/javascript">
  
function showprompt(){

if($('input[name="copydata"]').is(':checked')){

$(".copyprompt").show();

} else {

  $(".copyprompt").hide();
}


}




</script>