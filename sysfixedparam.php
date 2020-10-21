<?php 
  require_once("connection.php"); 
  require_once('common.php');





  /*echo $_SESSION['MM_Username'];
  echo "<br>";
  echo $_SESSION['MM_UserId'];
  echo "<br>";
  echo $_SESSION['MM_CompName'];*/




$sql = "

SELECT * 
FROM SystemParameters ";
$stmt = sqlsrv_query( $connSelComp, $sql);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$row_data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);







if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {



$compNameAr = $_POST['compNameAr'];
$compNameEn = $_POST['compNameEn'];
$landline = $_POST['landline'];
$email = $_POST['email'];
$fax = $_POST['fax'];
$addrAr = $_POST['compAddrAr'];
$addrEn = $_POST['compAddrEn'];
$defaultCurrency = $_POST['dfltCurrency'];

$sql30 = "
SELECT TOP(1) Id 
FROM SystemParameters";
$stmt30 = sqlsrv_query( $connSelComp, $sql30);
if( $stmt30 === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$row_lastId = sqlsrv_fetch_array($stmt30, SQLSRV_FETCH_ASSOC);

$Id = $row_lastId['Id'];



$sql1 = "

SELECT COUNT(Id) as Countofsettings 
FROM SystemParameters ";
$stmt11 = sqlsrv_query( $connSelComp, $sql1);
if( $stmt11 === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$row_setting = sqlsrv_fetch_array($stmt11, SQLSRV_FETCH_ASSOC);

If($row_setting['Countofsettings'] == 1){

//update



 
/* Set up the parameterized query. */  
$tsql = "UPDATE SystemParameters  SET

compNameAr = (?),
compNameEn = (?),
landline = (?),
email = (?),
fax = (?),
addrAr = (?),
addrEn = (?),
defaultCurrency = (?)
      WHERE Id = (?)";  

        

/* Set parameter values. */  
$params = array($compNameAr, $compNameEn, $landline, $email,  $fax, $addrAr, $addrEn, $defaultCurrency, $Id);

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


  $updateGoTo = "sysfixedparam.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
   header(sprintf("Location: sysfixedparam.php", $insertGoTo));
} elseIf($row_setting['Countofsettings'] !== 1) {

//insert



 
 $tsql= "INSERT INTO dbo.SystemParameters (
            compNameAr,compNameEn,landline,email,fax,addrAr,addrEn,defaultCurrency) 
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)";
            
      $var = array($compNameAr, $compNameEn, $landline, $email, $fax, $addrAr, $addrEn, $defaultCurrency);
            if (!sqlsrv_query($connSelComp, $tsql, $var))
                 {
            print_r($var); 
            
            die('Error: ' . print_r(sqlsrv_errors()));
                 }
            echo "1 record added"; 
      
      
  
  $insertGoTo = "sysfixedparam.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: sysfixedparam.php", $insertGoTo));
}



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


   fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}


legend.scheduler-border {
    width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
}


</style>

  <title>
   Online Accounting System   
  </title>

 </head>
 <body>
 
<div id="headerr"></div>



<div class="container">



   <form method="post" name="form1" action="sysfixedparam.php">
<br>

<h2>System Fixed Parameters</h2>

<hr>

  <div class="col-md-12"><br></div>

<div class="col-md-12 row" >


<div class="col-md-3">Company Name Arabic</div>
<div class="col-md-3"><input class="form-control" type="text" name="compNameAr" required="required" value="<?php echo $row_data['compNameAr']; ?>"></div>


<div class="col-md-3">Company Name English</div>
<div class="col-md-3"><input class="form-control" type="text" name="compNameEn" required="required"  value="<?php echo$row_data['compNameEn']; ?>"></div>


<div class="col-md-12"><br></div>

<div class="col-md-3">Landline</div>
<div class="col-md-3"><input class="form-control" type="text" name="landline" required="required"  value="<?php echo $row_data['landline']; ?>"></div>



<div class="col-md-3">Email</div>
<div class="col-md-3"><input class="form-control" type="email" name="email" required="required"  value="<?php echo $row_data['email']; ?>"></div>

<div class="col-md-12"><br></div>

<div class="col-md-3">Fax</div>
<div class="col-md-3"><input class="form-control" type="text" name="fax"  value="<?php echo $row_data['fax']; ?>"></div>

<div class="col-md-12"><br></div>

<div class="col-md-3">Company Address Arabic</div>
<div class="col-md-9"><input class="form-control" type="text" name="compAddrAr" required="required"  value="<?php echo $row_data['addrAr']; ?>"></div>

<div class="col-md-12"><br></div>

<div class="col-md-3">Company Address English</div>
<div class="col-md-9"><input class="form-control" type="text" name="compAddrEn" required="required"  value="<?php echo $row_data['addrEn']; ?>"></div>

<div class="col-md-12"><br></div>

<div class="col-md-3">Default Currency</div> 
<div class="col-md-3"><input class="form-control" type="text" name="dfltCurrency" required="required"  value="<?php echo$row_data['defaultCurrency']; ?>"></div>


<div class="col-md-6"></div>
<div class="col-md-6"><input type="submit" value="Apply" class="btn btn-success" required="required"  value="<?php echo $row_data['compNameAr']; ?>"></div>
 



  <input type="hidden" name="MM_update" value="form1">



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
 

 $(document).ready(function(){
    $('tr.header').click(function(){
        $(this).find('span').text(function(_, value){return value=='-'?'+':'-'});
        $(this).nextUntil('tr.header').slideToggle(100, function(){

        
        });
    });
});


 $('tr.header2').click(function(){
        $(this).find('span').text(function(_, value){return value=='-'?'+':'-'});
        $(this).nextUntil('tr.header2').slideToggle(100, function(){

        
        });
    });



</script>

<script type="text/javascript">
 
 $("#tree").fancytree({


  extensions: ["childcounter", "persist", "filter"],
  checkbox: false,
  selectMode: 3,

  source: {
    url:
      "json_costcenter.php"


  },

 filter: {
       mode: "hide"
      },



persist: {
        expandLazy: true,
        // fireActivate: false,    // false: suppress `activate` event after active node was restored
        // overrideSource: false,  // true: cookie takes precedence over `source` data attributes.
        store: "local" // 'cookie', 'local': use localStore, 'session': sessionStore
        // Sample for a custom store:
        // store: {
        //   get: function(key){ this.info("get(" + key + ")"); return window.sessionStorage.getItem(key); },
        //   set: function(key, value){ this.info("set(" + key + ", " + value + ")"); window.sessionStorage.setItem(key, value); },
        //   remove: function(key){ this.info("remove(" + key + ")"); window.sessionStorage.removeItem(key); }
        // }


      },
   childcounter: {
        deep: false,
        hideZeros: true,
        hideExpanded: true
      },

      loadChildren: function(event, data) {
        // update node and parent counters after lazy loading
        data.node.updateCounters();


            

      },

  lazyLoad: function(event, data) {
    data.result = {url: "json_costcenter.php"};


  },
select: function(event, data) {
        



      },

  focus: function(event, data) {
  
      var node = data.node,
                orgEvent = data.originalEvent;

            if(node.data.href){
                //window.open(node.data.href, (orgEvent.ctrlKey || orgEvent.metaKey) ? "_blank" /*node.data.target*/ : node.data.target);
                window.location.href=node.data.href;    
            }



      },

  activate: function(event, data){




        },

});

 var tree = $("#tree").fancytree("getTree");

    /*
     * Event handlers for our little demo interface
     */
    $("input[name=search]").keyup(function(e){

      $.ui.fancytree.getTree("#tree").expandAll();
      var match = $(this).val();
      if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
        $("button#btnResetSearch").click();
        return;
      }
      // Pass text as filter string (will be matched as substring in the node title)
      var n = tree.applyFilter(match);
      $("button#btnResetSearch").attr("disabled", false);
      $("span#matches").text("(" + n + " matches)");
    }).focus();

    $("button#btnResetSearch").click(function(e){
      $("input[name=search]").val("");
      $("span#matches").text("");
      tree.clearFilter();
    }).attr("disabled", true);

    $("input#hideMode").change(function(e){
      tree.options.filter.mode = $(this).is(":checked") ? "hide" : "dimm";
      tree.clearFilter();
      $("input[name=search]").keyup();
//      tree.render();
    });
  



</script>


<script type="text/javascript">
  

function getData() {
  var GroupID = $('#GroupID').val();
 
  if(GroupID != '') {
    $.ajax({
      type : "get",
      dataType: "json",
      url: "getcode.php?GroupID="+GroupID,
      data: {GroupID : GroupID},
      success: function (data) {




          console.log(data['lastcodeindb'] + "New code: " + data['newcode']);

          $('#lastGroupCode').val(data['lastcodeindb']);
          $('#GroupCode').val(data['newcode']);
      
        }
    });
  }
}
</script> 

<script type="text/javascript">

  $( document ).ready(function() {
  $("#Code").focus();
});



</script>