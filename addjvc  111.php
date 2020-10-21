<?php 
  require_once("connection.php"); 

  session_start();
  /*echo $_SESSION['MM_Username'];
  echo "<br>";
  echo $_SESSION['MM_UserId'];
  echo "<br>";
  echo $_SESSION['MM_CompName'];*/





if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


 $VoucherCode = $_POST['VoucherCode'];
 $DescriptionAr = $_POST['DescriptionAr'];
 $DescriptionEn = $_POST['DescriptionEn'];
 $SerializationType = $_POST['SerializationType'];
 $SerializationMethod = $_POST['SerializationMethod'];
 if ($_POST['IsActive'] == '1'){ $IsActive = "1";}else{$IsActive = "0";}


 
 
 $tsql= "INSERT INTO dbo.JournalVC (
            VoucherCode,DescriptionAr,DescriptionEn,SerializationType,SerializationMethod,IsActive) 
            VALUES
            (?, ?, ?, ?, ?, ?) SELECT MAX(Id) AS Id FROM JournalVC;";
            
      $var = array($VoucherCode, $DescriptionAr, $DescriptionEn, $SerializationType,  $SerializationMethod, $IsActive);
           
          
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

        $insertGoTo = "editjvc.php";
        if (isset($_SERVER['QUERY_STRING'])) {
            $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
            $insertGoTo .= $_SERVER['QUERY_STRING'];
        }
        header(sprintf("Location: editjvc.php?id=".$row['Id'], $insertGoTo));
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

		<h3 class="col-md-8"><i class="far fa-file-alt"></i> Add Journal Voucher Code <a href='Journalvc.php' class='btn btn-outline-primary' >Go Back</a>
  </h3> 
		

</div>

	
		<hr/>


<div class="">
  
    <form method="post" name="form1" action="addjvc.php">

<div class="row">
<div class="col-md-2">Voucher Code</div>
<div class="col-md-3">
  <input type="text" name="VoucherCode" id="VoucherCode" class="form-control" tabindex="1"  maxlength="4" autofocus />
</div>
</div>

<div class="col-md-12"><br></div>

<div class="row">
<div class="col-md-2">Description (Arabic)</div>
<div class="col-md-4"><input type="text" name="DescriptionAr" class="form-control" tabindex="2"  /></div>

<div class="col-md-2">Description (English)</div>
<div class="col-md-4"><input type="text" name="DescriptionEn" class="form-control" tabindex="3"  /></div>

</div>
<div class="col-md-12"><br></div>








<div class="row">
  <div class="card-body bg-light col-md-5 text-center">
<div class="col-md-12">Type of Serialization</div>

<div class="row">
<div class="col-md-12 text-left">

<select type="checkbox" name="SerializationType" id="SerializationType"  onclick="unhideSerializationMethodcard();" class="SerializationType form-control" size="3"> 



<option value="manual">Manual</option>
<option value="autooncreate">Auto on Creation</option>
<option value="autoonsave">Automatic on Save</option>

</select>

</div>
</div>
</div>

<div class="col-md-2"><br></div>

  <div class="card-body bg-light col-md-5 text-center SerializationMethodcard" style="display: none ;">
<div class="col-md-12">Serialization Method</div>

<div class="row">
<div class="col-md-12 text-left">


  <select type="checkbox" name="SerializationMethod" id="SerializationMethod" class="SerializationMethod form-control" size="4"> 

<option value="continous">Continous</option>
<option value="yearly">Yearly</option>
<option value="monthly">Monthly</option>

</select>

</div>


</div>
</div>
</div>

<div class="col-md-12"><br></div>


<div class="row">



<div class="col-md-1">IsActive</div>
<div class="col-md-1"><input type="checkbox" name="IsActive" value="1" class="" tabindex="7"   /></div>

<div class="col-md-4"></div>

 <input type="submit" id="addbtn" value="Add Voucher Code" class="col-md-2 btn btn-primary offset-md-3" tabindex="9" >


</div>



  <input type="hidden" name="MM_insert" value="form1">
 

    
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
      "json_branch.php"


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
    data.result = {url: "json_branch.php"};


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
      url: "getbranchcode.php?GroupID="+GroupID,
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




<script type="text/javascript">

              
function unhideSerializationMethodcard(){


  
   if($( "#SerializationType" ).val() == 'manual'){ 

              $(".SerializationMethodcard").show();
              $("#SerializationMethod").prop("required", true);

} else if($( "#SerializationType" ).val() !== 'manual'){ 

              $(".SerializationMethodcard").hide();
              $('#SerializationMethod').val(0);
               $("#SerializationMethod").prop("required", false);



}

}



</script>