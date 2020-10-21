<?php 
  require_once("connection.php"); 

  require_once('common.php');
  /*echo $_SESSION['MM_Username'];
  echo "<br>";
  echo $_SESSION['MM_UserId'];
  echo "<br>";
  echo $_SESSION['MM_CompName'];*/



$StrSql = "Select * from Departments WHERE ID = '".$_GET['id']."'";
$Result = sqlsrv_query( $connSelComp, $StrSql) or die ( print_r(sqlsrv_errors(), true));

$row_costcenter = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);


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

 echo "<a href='createdepartment.php?id=".$row_costcenter['ID']."&GroupID=".$newgroupid."' class='btn btn-primary col-md-4 float-left' >Add New</a>"; 
}
 elseif($_GET['id'] == 1) {

  
 echo "<a href='createdepartment.php?id=".$row_costcenter['ID']."&GroupID=1' class='btn btn-primary col-md-4 float-left' >Add New</a>";
}
 
 elseif($row_costcenter['IsGroup'] == 0) {

  echo "<a class='btn btn-primary col-md-4 float-left'  disabled >Add New</a>"; 
}


 ?>

 

<div class="col-md-6"></div>

<a href="editdepartment.php?id=<?php echo $row_costcenter['ID']; ?>" class="btn btn-success col-md-4 float-right <?php if($_GET['id'] == 1){echo "disabled";} ?>"  >Edit</a>



</div>
</div>


<div class="col-md-8 float-right">
 
 <div class="heading">

  <h3 class="col-md-10"> Department Information  </h3> 
  

</div>

  <hr/>


<div class="">
  

<div class="col-md-2">Code</div>
<div class="col-md-10"><input type="text" name="Code" class="form-control-plaintext" value="<?php echo $row_costcenter['Code']; ?>" /></div>

<div class="col-md-12"><br></div>

<div class="col-md-2">Name (Arabic)</div>
<div class="col-md-10"><input type="text" name="AName" class="form-control-plaintext" value="<?php echo $row_costcenter['AName']; ?>" /></div>

<div class="col-md-12"><br></div>

<div class="col-md-2">Name (English)</div>
<div class="col-md-10"><input type="text" name="EName" class="form-control-plaintext"  value="<?php echo $row_costcenter['EName']; ?>" /></div>

<div class="col-md-12"><br></div>



<div class="col-md-2">Parent</div>
<div class="col-md-10">
<input type="text" name="GroupID" class="form-control-plaintext"  value="<?php




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
SELECT  *
FROM Departments
WHERE  ID = '".$row_costcenter['GroupID']."' ";
$stmt11 = sqlsrv_query( $connSelComp, $sql1);
if( $stmt11 === false ) {
     die( print_r( sqlsrv_errors(), true));
}

 $row_groupid = sqlsrv_fetch_array( $stmt11, SQLSRV_FETCH_ASSOC);


if($row_costcenter['GroupID'] == 1 ){


echo "COMP | ".$row_compname['compNameEn']."";

  }else if($row_costcenter['GroupID'] !== 1){

echo trim($row_groupid['Code'])." | ".trim($row_groupid['EName']);

}
  ?>" />
  

  



</select>

</div>

<div class="col-md-12"><br></div>



<div class="col-md-2">GroupCode</div>

<div class="col-md-10"><input type="text" name="GroupCode" class="form-control-plaintext"  value="<?php echo $row_costcenter['GroupCode']; ?>" /></div>

<div class="col-md-12"><br></div>



<div class="row">
<div class="col-md-1">IsGroup</div>
<div class="col-md-1"><input type="checkbox" name="IsGroup" class="" <?php  
if($row_costcenter['IsActive'] == 1){ echo 'checked';}else{} ?>  /></div>




<div class="col-md-1">IsActive</div>
<div class="col-md-1"><input type="checkbox" name="IsActive" class=""  <?php  
if($row_costcenter['IsActive'] == 1){ echo 'checked';}else{} ?>   /></div>


</div>

<div class="col-md-12"><br></div>

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
      "json_department.php"

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
               window.location.replace(node.data.href, (orgEvent.ctrlKey || orgEvent.metaKey) ? "_self" /*node.data.target*/ : node.data.target);
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



