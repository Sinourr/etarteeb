<?php 
  require_once("connection.php"); 



require_once('common.php');



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

 
 $Code = $_POST['Code'];
 $AName = $_POST['AName'];
 $EName = $_POST['EName'];

  if($_POST['GroupID'] == '0' ){ 
    $GroupID = "1";
  }else{
    $GroupID = $_POST['GroupID'];
}

 $GroupCode = $_POST['GroupCode'];
 if ($_POST['IsGroup'] == '1'){ $IsGroup = "1";}else{$IsGroup = "0";}
 if ($_POST['IsActive'] == '1'){ $IsActive = "1";}else{$IsActive = "0";}
 $Id = $_POST['id'];


/* Set up the parameterized query. */  
$tsql = "UPDATE Projects  SET 
          Code = (?),
          AName = (?),
          EName= (?),
          GroupID= (?),
          GroupCode= (?),
          IsGroup= (?),
          IsActive= (?)
          WHERE ID = (?)";  

/* Set parameter values. */  
$params = array($Code, $AName, $EName, $GroupID,  $GroupCode, $IsGroup, $IsActive, $Id);

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


 
  $updateGoTo = "editproject.php?id=".$Id;
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
   header(sprintf("Location: editproject.php?id=".$Id, $insertGoTo));
}




  /*echo $_SESSION['MM_Username'];
  echo "<br>";
  echo $_SESSION['MM_UserId'];
  echo "<br>";
  echo $_SESSION['MM_CompName'];*/



$StrSql = "Select * from Projects WHERE ID = '".$_GET['id']."'";
$Result = sqlsrv_query( $connSelComp, $StrSql) or die ( print_r(sqlsrv_errors(), true));

$row_costcenter = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);




 ?>


 <!DOCTYPE html>
 <html>
 <head>
  <!-- To Add Jquery -->



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>


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


</style>

  <title>
   Online Accounting System   
  </title>

 </head>
 <body>
 
<div id="headerr"></div>



<div class="col-md-3"><br></div>

<div class="col-md-3 float-left">

<p>
    <label  class="col-md-3">Search: </label>
    <input name="search" placeholder="Search..." autocomplete="off" class="col-md-5">
    <button id="btnResetSearch" class="col-md-1">&times;</button>
    <span class="col-md-2" id="matches"></span>
  </p>



<div id="tree" class=""></div>

<div class="actionbuttons">
  <br>

<?php

$newgroupid = $row_costcenter['ID'];

if($row_costcenter['IsGroup'] == 1){
 echo "<a href='createproject.php?id=".$row_costcenter['ID']."&GroupID=".$newgroupid."' class='btn btn-primary col-md-4 float-left' >Add New</a>"; }
 elseif($row_costcenter['IsGroup'] == 0) {echo "<a class='btn btn-primary col-md-4 float-left'  disabled >Add New</a>"; }

 ?>

 

<div class="col-md-6"></div>

<a href="editproject.php?id=<?php echo $row_costcenter['ID']; ?>" class="btn btn-success col-md-4 float-right" >Edit</a>



</div>
</div>


<div class="col-md-8 float-right">
 
 <div class="heading">

  <h3 class="col-md-10"> <span class="glyphicon glyphicon-pencil"></span> Edit Project Information  </h3> 
  

</div>

  <hr/>


<div class="">
  
    <form method="post" name="form1" action="editproject.php">

<div class="col-md-2">Code</div>
<div class="col-md-10"><input type="text" name="Code" class="form-control" value="<?php echo trim($row_costcenter['Code']); ?>" /></div>

<div class="col-md-12"><br></div>

<div class="col-md-2">Name (Arabic)</div>
<div class="col-md-10"><input type="text" name="AName" class="form-control" value="<?php echo trim($row_costcenter['AName']); ?>" /></div>

<div class="col-md-12"><br></div>

<div class="col-md-2">Name (English)</div>
<div class="col-md-10"><input type="text" name="EName" class="form-control"  value="<?php echo trim($row_costcenter['EName']); ?>" /></div>

<div class="col-md-12"><br></div>





<div class="col-md-2">Parent</div>
<div class="col-md-10">
<select name="GroupID" id="GroupID" class="form-control"  value="<?php echo $row_costcenter['GroupID']; ?>" onchange="getData();"   >
  
  <option value="">Select</option>
  
   <?php

$sqlCOMPNAME = "

SELECT *
FROM SystemParameters
where ID = '1'";
$stmtcompname = sqlsrv_query( $connSelComp, $sqlCOMPNAME);
if( $stmtcompname === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$row_compname = sqlsrv_fetch_array( $stmtcompname, SQLSRV_FETCH_ASSOC);


$sql1 = "

SELECT 1 AS ID, 'COMP' AS Code, '".$row_compname['compNameEn']."' AS EName, '1' AS IsGroup, '1' AS IsActive
UNION
SELECT  ID, Code, EName, IsGroup, IsActive
FROM Projects
WHERE  IsGroup = '1' AND IsActive = '1'";
$stmt110 = sqlsrv_query( $connSelComp, $sql1);
if( $stmt110 === false ) {
     die( print_r( sqlsrv_errors(), true));
}


 while ($row_groupid = sqlsrv_fetch_array( $stmt110, SQLSRV_FETCH_ASSOC)){ 





?>
          

          <option value="<?php echo $row_groupid['ID']?>" <?php if (!(strcmp($row_groupid['ID'], htmlentities($row_costcenter['GroupID'], ENT_COMPAT, '')))) {echo "SELECTED";} ?>><?php
      
         echo $row_groupid['Code']." | ".$row_groupid['EName']; ?></option>
          <?php }; ?>



</select>

</div>

<div class="col-md-12"><br></div>



<div class="col-md-2">GroupCode</div>

<div class="col-md-10"><input type="text" name="GroupCode" id="GroupCode" class="form-control"  value="<?php echo $row_costcenter['GroupCode']; ?>" /></div>

<div class="col-md-12"><br></div>



<div class="row">
<div class="col-md-1">IsGroup</div>
<div class="col-md-1">

  <input type="checkbox" name="IsGroup" value="1" <?php  if($row_costcenter['IsGroup'] == '1'){echo "Checked";} ?> > 

</div>




<div class="col-md-1">IsActive</div>
<div class="col-md-1">
<input type="checkbox" name="IsActive" value="1" <?php  if($row_costcenter['IsActive'] == '1'){echo "Checked";} ?> > 
</div>

<div class="col-md-4"><br></div>

 <input type="submit" id="addbtn" value="Edit Project" class="col-md-2 btn btn-primary col-xs-offset-1">

</div>




 <input type="hidden" name="id" value="<?php echo $row_costcenter['ID']; ?>">
  <input type="hidden" name="MM_update" value="form1">
 


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
      "json_proj.php"

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
    data.result = {url: "json_proj.php"};


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
      url: "getpcode.php?GroupID="+GroupID,
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