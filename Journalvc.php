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
FROM JournalVC";
$result = sqlsrv_query( $connSelComp, $sql, array(), array( "Scrollable" => 'static' ));
if( $result === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$totalRows_dataset = sqlsrv_num_rows($result);

  

 ?>


 <!DOCTYPE html>
 <html>
 <head>
  <!-- To Add Jquery -->


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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/skin-win7/ui.fancytree.min.css" crossorigin="anonymous" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />  
<link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/css/dataTables.checkboxes.css" media="all" type="text/css"/>
<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />
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

<br>
<div class="container">

<div><h2><i class="far fa-file-alt"></i> Journal Voucher Code

 <a href='addjvc.php' class='btn btn-outline-primary float-right' >Add Journal Voucher Code</a>
</h2>




<hr>
</div>


<?php if($totalRows_dataset > 0){ ?>



<table class="example">
  <thead>
  <tr>
  <th>S.No</th>
  <th>VoucherCode</th>
  <th>Description</th>
  <th></th> 
  </tr>
  </thead>

  <tbody>
<?php
  $sn=0;
   while( $row_dataset= sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {

    $sn++; 

     ?>
<tr>
    <td><?php echo $sn; ?></td>
    <td><?php echo $row_dataset['VoucherCode']; ?></td>
    <td><?php echo $row_dataset['DescriptionEn']; ?></td>
    <td><a href="editjvc.php?id=<?php echo $row_dataset['Id']; ?>" class="btn btn-outline-primary">Edit</a>
        <a href="deletejvc.php?id=<?php echo $row_dataset['Id']; ?>" class="btn btn-outline-danger">Delete</a>


    </td>  
</tr>
<?php } ?>

  </tbody>
</table>




<?php } else {?>

  <div>No Records</div>

<?php } ?>


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


<script type="text/javascript">

   
$(document).ready(function() { 
   var table = $('.example').DataTable({
      
   
     
      'columnDefs': [
         {
            'targets': 0,
           
         }
      ],
      'select': {
        
      },
      'order': [[0, 'asc']],
           'dom': 'Blfrtip',
           'buttons': [
            {
                'extend': 'print', 
                'text': 'Print All',   
            },
      
         {
            'extend': 'excel', 
                'text': 'excel',
            },
            
            {
            
            'extend': 'pdf', 
                'text': 'pdf',
              'orientation': 'landscape',
                'pageSize': 'LEGAL'
            }
        ],  
   
   
           
         
           });
  
   
 
   
} );
  

</script>
