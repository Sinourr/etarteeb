<?php 
  require_once("connection.php");
  require_once("common.php");
  require_once("mainheader.php"); 
  require_once("lang.php"); 




$sql = "
SELECT IsAdmin
FROM AspNetUsers 
WHERE UserName = '".$_SESSION['MM_Username']."'";
$resultadmin = sqlsrv_query( $conn, $sql, array(), array( "Scrollable" => 'static' ));
if( $resultadmin === false ) {
    die( print_r( sqlsrv_errors(), true));
}
$row_isadmin = sqlsrv_fetch_array( $resultadmin, SQLSRV_FETCH_ASSOC);



$sql = "
SELECT *
FROM Orders WHERE Feedbacktime IS NOT NULL";
$result1 = sqlsrv_query( $connSelComp, $sql, array(), array( "Scrollable" => 'static' ));
if( $result1 === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$totalRows_dataset = sqlsrv_num_rows($result1);

  /*

$sql = "
SELECT *
FROM Permissions WHERE user_id = '".$_SESSION['MM_UserId']."'";
$result = sqlsrv_query( $conn, $sql, array(), array( "Scrollable" => 'static' ));
if( $result === false ) {
    die( print_r( sqlsrv_errors(), true));
}
$row_permission = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);

*/


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.6.0/src/jquery.fancytree.filter.js" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
<script src="js/sweetalert.min.js"></script>


<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="css/sweetalert.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.34.0/skin-win7/ui.fancytree.min.css" crossorigin="anonymous" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />  
<link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.6/css/dataTables.checkboxes.css" media="all" type="text/css"/>
<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



<style type="text/css">
 



</style>

  <title>
   <?php echo $sysheadertitle; ?>  
  </title>

 </head>
 <body dir="<?php echo $dir; ?>">

 
<div id="headerr"></div>

<br>
<div class="container">



<div dir="<?php echo $dir; ?>"><h2> <span class="<?php echo $float; ?>"><i class="far fa-file-alt"></i><?php echo "Feedbacks"; ?></span>
<?php //if( substr($row_permission['SupportFiles_access_level'],1,-3)  == '1' || $row_isadmin['IsAdmin'] == '1'){  ?>
 <!--<a href='addbranch.php?culture=<?php echo $culture; ?>' class='btn btn-outline-primary <?php echo $Ifloat; ?> ' ><?php echo $Add." ".$Branches; ?></a> -->

<?php //} ?>
</h2>


<br>
<br>

<hr>
</div>


<?php if($totalRows_dataset > 0){ ?>



<table class="example" id="example">
  <thead>
  <tr>
  <th><?php echo $SNo; ?></th>
  <th><?php echo "Order No."; ?></th>
  <th><?php echo $Name; ?></th>
  <th><?php echo "Average Rating"; ?></th>
 <th><?php echo "Date & time of feedback"; ?></th>
  
  <th></th> 
  </tr>
  </thead>

  <tbody>
<?php
  $sn=0;
   while( $row_dataset = sqlsrv_fetch_array( $result1, SQLSRV_FETCH_ASSOC) ) {

    $sn++; 

     ?>
<tr>
    <td><?php echo $sn; ?></td>
    <td><?php echo $row_dataset['OrderNo']; ?></td>
    <td><?php  echo $row_dataset['issueCustName'];  ?></td>
    <td><?php

    

//Our array, which contains a set of numbers.
$array = array($row_dataset['Feedback1'], $row_dataset['Feedback2'], $row_dataset['Feedback3'], $row_dataset['Feedback4'], $row_dataset['Feedback5']);
 
//Calculate the average and round it up.
$average =  array_sum($array) / count($array) ;
 
//Print out the average.
echo $average." <i class='fa fa-star'></i>";


     ?></td>

      <td><?php  echo $row_dataset['Feedbackdate']." ".$row_dataset['Feedbacktime'];  ?></td>
    <td>



   

<?php // if(substr($row_permission['SupportFiles_access_level'],2,-2)  == '1' || $row_isadmin['IsAdmin'] == '1'){  ?>
    <a href="feedbackview.php?culture=<?php echo $culture; ?>&id=<?php echo $row_dataset['ID']; ?>" class="btn btn-outline-success"><i class="fa fa-eye"></i></a>



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



<?php //if((substr($row_permission['SupportFiles_access_level'],4,1)) == '1' || $row_isadmin['IsAdmin'] == '1')

//{echo "  ?>

<script>
    
   
$(document).ready(function() {
   var table = $('#example').DataTable({
      

   
   
     
      'columnDefs': [
         {
            'targets': 0,
           
         }
      ],
     
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
      

";


<?php /*} else {
  
  echo "
  
  
  <script>
  
  
  
   $('#example').DataTable( {
    responsive: true
} );

</script>";} */?>






<script type="text/javascript">
$(".deleteSweetAlert").on('click', function () {
                var recordId = $(this).attr("data-id");
                // Calling Function of Sweet Alert Library
                swal({
                    title: 'Are You Sure?',
                    text: 'All related information will be deleted as well',
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                   function (isConfirm) {
                       if (isConfirm) {
                           // Changing the URL and calling delete action if user confirms the delete. Alternative is Ajax Call
                           window.location.href = 'deletebranch.php?id=' + recordId;

                       }
                   });


            });
   
   
</script>