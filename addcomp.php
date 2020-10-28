<?php 


require_once("connection.php"); 
require_once('common.php');

  /*echo $_SESSION['MM_Username'];
  echo "<br>";
  echo $_SESSION['MM_UserId'];
  echo "<br>";
  echo $_SESSION['MM_CompName'];*/





if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


 $Code = $_POST['Code'];
 $AName = $_POST['AName'];
 $EName = $_POST['EName'];
 $AAddress = $_POST['AAddress'];
 $EAddress = $_POST['EAddress'];
 $POBox = $_POST['POBox'];
 $Zip = $_POST['Zip'];
 $TelNo1 = $_POST['TelNo1'];
 $FaxNo1 = $_POST['FaxNo1'];
 $WebPage = $_POST['WebPage'];
 $OpeningEDate = $_POST['OpeningEDate'];
 $AccountNo = $_POST['AccountNo'];
 $CrNo = $_POST['CrNo'];
 if ($_POST['IsActive'] == '1'){ $IsActive = "1";}else{$IsActive = "0";};

 



 $tsql= "INSERT INTO dbo.LASCompanies (Code, AName, EName, AAddress, EAddress, POBox, Zip, TelNo1, FaxNo1, WebPage, OpeningEDate, AccountNo, CrNo,  IsActive) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) 
            
            SELECT TOP(1) MAX(Id) AS Id, Code FROM LASCompanies
            GROUP BY Code
            ORDER  BY Id DESC;
            ";
            
            $var = array($Code, $AName, $EName, $AAddress, $EAddress, $POBox, $Zip, $TelNo1, $FaxNo1, $WebPage, $OpeningEDate, 
              $AccountNo, $CrNo, $IsActive);
          
            $stmt500 = sqlsrv_query($conn, $tsql, $var);

            // Consume the first result (rows affected by INSERT) without calling sqlsrv_next_result.
            echo "Rows affected: ".sqlsrv_rows_affected($stmt500)."<br />";
          
    // Move to the next result and display results.
        $next_result = sqlsrv_next_result($stmt500);
        if( $next_result ) {

          $row = sqlsrv_fetch_array( $stmt500, SQLSRV_FETCH_ASSOC);
  


 $tsql1= "INSERT INTO dbo.AspNetUsers (CompanyId, companyCode, nameEnglish, nameArabic, branchId, isAdmin, isActive, Role, EmployeeId, UserName, Password2, AddedBy, AddedDate) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";
            
            $var1 = array($row['Id'], $row['Code'], "admin", "admin", "1", "1", "1", "admin", "0", "admin", "4868aff1a9bbba84138137c1527b7f63", "Owner", date('yyyy-mm-dd'));
          
            $stmt501 = sqlsrv_query($conn, $tsql1, $var1);
            if($stmt501 === false) {
                  die(print_r(sqlsrv_errors(), true));
              }
              sqlsrv_free_stmt($stmt501);




 $tsql2= "INSERT INTO Branches (Code, AName, EName, CompanyId, IsActive) 
            VALUES
            (?, ?, ?, ?, ?) ";
            
            $var2 = array($row['Code']."-1", "Main Branch", "Main Branch", $row['Id'], "1");
          
            $stmt502 = sqlsrv_query($conn, $tsql2, $var2);
            if($stmt502 === false) {
                  die(print_r(sqlsrv_errors(), true));
              }
              sqlsrv_free_stmt($stmt502);






        } elseif( is_null($next_result)) {
            echo "No more results.<br />";
        } else {
          echo "<span style='color:red;'>error has occured: </span>";
            die(print_r(sqlsrv_errors(), true));
        }

        $insertGoTo = "companies.php";
        if (isset($_SERVER['QUERY_STRING'])) {
            $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
            $insertGoTo .= $_SERVER['QUERY_STRING'];
        }
        header(sprintf("Location: companies.php", $insertGoTo));
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
   Tarteeb   
  </title>

 </head>
 <body>
 
<div id="headerr"></div>

<div>


<br>


</div>





<div class="container">
  
  <div class="heading">

    <h3 class="col-md-8"><i class="far fa-building" aria-hidden="true"></i> Add Company Information <a href='companies.php' class='btn btn-outline-primary' >Go Back</a>
  </h3> 
    

</div>

  
    <hr/>


<div class="">
  
 

<form action="addcomp.php" enctype="multipart/form-data" method="post" name="form1"> <div class="col-md-12">

   


        


        <div class="form-group row">

            <label class="control-label col-md-2" for="Code">Short Code<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2 ">
                <input readonly class="form-control text-box single-line" data-val="true" name="Code" id="Code" type="text" value="<?php 


$Sql = 'SELECT TOP(1) Code as CODE from LASCompanies ORDER BY Code DESC';
$Result = sqlsrv_query( $conn, $Sql) or die ( print_r(sqlsrv_errors(), true));

$row_code = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);


echo $row_code['CODE']+1;

 ?>"

  required="required" onblur="checkcode();" autocomplete="off"  >
                <span class="text-danger" id="codeerror" style="display: none;">Code already exists in database</span>


                            </div>
            <label class="control-label col-md-2" for="OpeningEDate">Contract Date</label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" id="OpeningEDate" name="OpeningEDate" type="date" value="">
                <span class="field-validation-valid text-danger" data-valmsg-for="OpeningEDate" data-valmsg-replace="true"></span>
            </div>
           
        </div>

        <div class="form-group row">
            

            <label class="control-label col-md-2" for="AName">Name (Arabic)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" id="AName" name="AName" type="text" value="" required="required" autocomplete="off" onblur="checkaname();">
                 <span class="text-danger" id="anameerror" style="display: none;">Code already exists in database</span>
            </div>
            <label class="control-label col-md-2" for="EName">Name (English)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" id="EName" name="EName" type="text" value="" required="required" autocomplete="off" onblur="checkename();">
                 <span class="text-danger" id="enameerror" style="display: none;">Code already exists in database</span>
            </div>
           
            <div class="col-md-4"></div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-2" for="Email">Email<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" id="Email" name="Email" type="email" value="">
            </div>

            <label class="control-label col-md-2" for="TelNo1">Telephone<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" id="TelNo1" name="TelNo1" type="tel" required>
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-2" for="FaxNo1">Fax</label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" id="FaxNo1" name="FaxNo1" type="text" value="" autocomplete="off">
            </div>
            <label class="control-label col-md-2" for="WebPage">Website</label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" id="WebPage" name="WebPage" type="url" value="" autocomplete="off">
            </div>
            <div class="col-md-4"></div>
        </div>

        <div class="form-group row">
             <label class="control-label col-md-2" for="AAddress">Address (Arabic)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" id="AAddress" name="AAddress" type="text" value="">
            </div>

            <label class="control-label col-md-2" for="EAddress">Address (English)<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" id="EAddress" name="EAddress" type="text" value="">
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
            <div class="col-md-2">
                <input class="form-control text-box single-line"  id="AccountNo" name="AccountNo" type="text" value="">
            </div>

            <label class="control-label col-md-2" for="CrNo">CR #<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" id="CrNo" name="CrNo" type="text" value="">
            </div>
            <div class="col-md-4"></div>
        </div>


           <div class="form-group row">
            <label class="control-label col-md-2" for="POBox">POBox #<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line"  id="POBox" name="POBox" type="text" value="">
            </div>

            <label class="control-label col-md-2" for="Zip">Zip #<span style="color:red; font-size:15px;"> *</span></label>
            <div class="col-md-2">
                <input class="form-control text-box single-line" data-val="true" id="Zip" name="Zip" type="text" value="">
            </div>
            <div class="col-md-4"></div>
        </div>




        <div class="form-group row">
            <label class="control-label col-md-2" for="IsActive">Is Active?</label>
            <div class="checkbox col-md-2">
                <input type="checkbox" name="IsActive" id="IsActive" value="1" class="" />
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


            <div class="col-md-3"></div>

         
  <input type="hidden" name="MM_insert" value="form1">
 


                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save </button>
                <br>

                
               
        
            <div class="col-md-4">

            </div>
        </div>

    </div>


</form>
</div>
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



