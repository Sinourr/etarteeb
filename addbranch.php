<?php 


  require_once("connection.php");
  require_once("common.php");
  require_once("mainheader.php"); 
  require("lang.php");

  /*echo $_SESSION['MM_Username'];
  echo "<br>";
  echo $_SESSION['MM_UserId'];
  echo "<br>";
  echo $_SESSION['MM_CompName'];*/



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {



/*

 $user_Id_selected=''; 
    // Check if form is submitted successfully 
    if(isset($_POST["MM_insert"]))  
    { 
       
        // Check if any option is selected 
        if(isset($_POST["user_Id"]))  
        { 
            // Retrieving each selected option 
            foreach ($_POST['user_Id'] as $user_Id)  
              

                 $user_Id_selected.=$user_Id.", "; 

        } 
    
    else
        echo "Select an option first !!"; 
    
    } 

echo $user_Id_selected;


*/

 $nameEnglish = $_POST['nameEnglish'];
 $nameArabic = $_POST['nameArabic'];
 $compid = $_POST['compid'];

 if (isset($_POST['isActive']) == '1'){ $isActive = "1";}else{$isActive = "0";}


 
 
 $tsql= "INSERT INTO dbo.Branches (
            AName,EName,CompanyId,IsActive) 
            VALUES
            (?, ?, ?, ?); SELECT MAX(Id) AS Id FROM Branches;";
            
      $var = array($nameEnglish, $nameArabic, $compid, $isActive);
           
          
      $stmt500 = sqlsrv_query($conn, $tsql, $var);


        // Consume the first result (rows affected by INSERT) without calling sqlsrv_next_result.
        echo "Rows affected: ".sqlsrv_rows_affected($stmt500)."<br />";

    // Move to the next result and display results.
        $next_result = sqlsrv_next_result($stmt500);
        if( $next_result ) {
            $row = sqlsrv_fetch_array( $stmt500, SQLSRV_FETCH_ASSOC);

         

        } elseif( is_null($next_result)) {
            echo "No more results.<br />";
        } else {
            die(print_r(sqlsrv_errors(), true));
        }


          $insertGoTo = "editbranch.php";
        if (isset($_SERVER['QUERY_STRING'])) {
            $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
            $insertGoTo .= $_SERVER['QUERY_STRING'];
        }
        header(sprintf("Location: editbranch.php?culture=".$_GET['culture']."&id=".$row['Id'], $insertGoTo));
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
 <body>
 
<div id="headerr"></div>

<div>


<br>


</div>





<div class="container">
 
 <div class="heading">


<div class="col-md-12"><br></div>
<div class="col-md-12"><br></div>

<h2 class="<?php echo $float; ?>"><?php echo $Add." ".$Branches; ?> <a href="branches.php?culture=<?php echo $culture; ?>" class="btn btn-outline-primary" style=""><?php echo $Goback; ?></a>
 </h2>

<br>
<br>


</div>

 
  <hr/>


<div class="">
  
    <form method="post" name="form1" action="addbranch.php?culture=<?php echo $culture; ?>">

<div class="row">
<div class="col-md-2"><?php echo $Code; ?></div>
<div class="col-md-3">
  <input type="text" name="code" id="code" class="form-control" tabindex="1"  maxlength="12" autofocus autocomplete="off" required value="<?php echo $_SESSION['compid']; ?>" />
</div>
</div>

<div class="col-md-12"><br></div>

<div class="row">
<div class="col-md-2"><?php echo $NameA; ?></div>
<div class="col-md-4"><input type="text" name="nameArabic" class="form-control" tabindex="2" autocomplete="off" required /></div>

<div class="col-md-2"><?php echo $NameE; ?></div>
<div class="col-md-4"><input type="text" name="nameEnglish" class="form-control" tabindex="3" autocomplete="off" required /></div>

</div>



<div class="col-md-12"><br></div>

<div class="row">
<div class="col-md-2"><?php echo $IsActive; ?></div>
<div class="col-md-1"><input type="checkbox" name="isActive" value="1" size="32" id="isActive" autocomplete="off"  checked="checked" ></div>

<div class="col-md-4"></div>

 <input type="submit" id="addbtn" value="<?php echo $Add; ?>" class="col-md-2 btn btn-primary offset-md-3" tabindex="5" >


</div>



  <input type="hidden" name="MM_insert" value="form1">
 

    
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

  <script>

$(document).ready(function() {
    $('.dropdownn').select2();
});

</script>

<?php ob_end_flush(); ?>