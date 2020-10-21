<?php 
require_once('common.php');
require("connection.php");
require("mainheader.php");


//echo $_SESSION['MM_Username'];
//echo "<br>";
//echo $_SESSION['MM_UserId'];








$sql = "SELECT max(CAST(Id AS INT))+1 as countofid  FROM Orders";
$stmt1 = sqlsrv_query( $connSelComp, $sql);
if( $stmt1 === false ) {die( print_r( sqlsrv_errors(), true));}


$sql2 = "SELECT * FROM Orders WHERE ID = '".$_GET['id']."'";
$stmt2 = sqlsrv_query( $connSelComp, $sql2) or die ( print_r(sqlsrv_errors(), true));
$row_data = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC);





 ?>



 <!DOCTYPE html>
 <html>
 <head>

    <!-- To Add Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

 

 <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <!--suppress JSUnresolvedLibraryURL -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/star-rating.js" type="text/javascript"></script>
 	<title>
 		Tarteeb		
 	</title>

<meta name="viewport" content="width=device-width, initial-scale=1" />
 	<style type="text/css">
 		
.firma-ara{
    padding-bottom: 100px;
    padding-top: 100px;
}
.form-arka-plan{
   
}
.acik-renk-form{
    margin: 3%;
    background: rgba(255, 255, 255, 0.9);
}
.siyah-cerceve{
    -webkit-text-fill-color: blue;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: black;
}


body{

     
}


.glyphicon-minus-sign{

    display: none;
}
 	</style>

 </head>
 <body>



 


<div class="container acik-renk-form ">
    <div class="page-header">
        <h2>Feedback submitted by the user

            <a href="feedbacksindex.php?culture=en" class="btn btn-primary">Go Back</a>
            
        </h2>
    </div>


       


        
       <table>
           

           

           <tr>
    <td width="200px;"><h3>Please enter you Name: </h3> </td>
    <td><input id="issueCustName" name="issueCustName" class="form-control" required value="<?php echo $row_data['issueCustName']; ?>" readonly /></td>

</tr>



<tr>
    <td width="200px;"><h3>Please enter your Email Address: </h3> </td>
    <td><input id="issueCustEmail" name="issueCustEmail" class="form-control" required value="<?php echo $row_data['issueCustEmail']; ?>" readonly /></td>

</tr>




<tr>
    <td width="200px;"><h3>Service: </h3> </td>
    <td><input id="Feedback1" name="Feedback1" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title=""  value="<?php echo $row_data['Feedback1']; ?>" readonly /></td>

</tr>



<tr>
    <td width="200px;"><h3>Cleanliness: </h3> </td>
    <td><input id="Feedback2" name="Feedback2" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required value="<?php echo $row_data['Feedback2']; ?>" readonly /></td>

</tr>



<tr>
    <td width="200px;"><h3>Timeleness: </h3> </td>
    <td><input id="Feedback3" name="Feedback3" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required value="<?php echo $row_data['Feedback3']; ?>" readonly /></td>

</tr>




<tr>
    <td width="200px;"><h3>Customer Service: </h3> </td>
    <td><input id="Feedback4" name="Feedback4" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required value="<?php echo $row_data['Feedback4']; ?>" readonly /></td>

</tr>




<tr>
    <td width="200px;"><h3>Envirnoment: </h3> </td>
    <td><input id="Feedback5" name="Feedback5" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required value="<?php echo $row_data['Feedback5']; ?>" readonly /></td>

</tr>


<tr hidden="hidden">
    <td width="200px;"></td>
    <td>

        <input id="Feedbackdate" name="Feedbackdate" value="<?php echo date('Y-m-d'); ?>"/>
        <input id="Feedbacktime" name="Feedbacktime" value="<?php echo date('h:i:s A'); ?>"/>
         <input type="hidden" name="MM_insert" value="form1">
         <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
 


    </td>

</tr>





       </table>
        
        <div class="form-group" style="margin-top:10px">

            <hr>
          
            
        </div>



<script>
        jQuery(document).ready(function () {
            $("#input-21f").rating({
                starCaptions: function (val) {
                    if (val < 3) {
                        return val;
                    } else {
                        return 'high';
                    }
                },
                starCaptionClasses: function (val) {
                    if (val < 3) {
                        return 'label label-danger';
                    } else {
                        return 'label label-success';
                    }
                },
                hoverOnClear: false
            });
           
            $('#btn-rating-input').on('click', function () {
                $inp.rating('refresh', {
                    showClear: true,
                    disabled: !$inp.attr('disabled')
                });
            });


            $('.btn-danger').on('click', function () {
                $("#kartik").rating('destroy');
            });

            $('.btn-success').on('click', function () {
                $("#kartik").rating('create');
            });

            $inp.on('rating.change', function () {
                alert($('#rating-input').val());
            });


            $('.rb-rating').rating({
                'showCaption': true,
                'stars': '3',
                'min': '0',
                'max': '3',
                'step': '1',
                'size': 'xs',
                'starCaptions': {0: 'status:nix', 1: 'status:wackelt', 2: 'status:geht', 3: 'status:laeuft'}
            });
            $("#input-21c").rating({
                min: 0, max: 8, step: 0.5, size: "xl", stars: "8"
            });
        });
    </script>



 
 </body>
 </html>

 	





