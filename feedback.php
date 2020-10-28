<?php 
require_once('common.php');
require("connection.php");


//echo $_SESSION['MM_Username'];
//echo "<br>";
//echo $_SESSION['MM_UserId'];






if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

 
 $Id = $_POST['id'];
 $Feedback1 = $_POST['Feedback1'];
 $Feedback2 = $_POST['Feedback2'];
 $Feedback3 = $_POST['Feedback3'];
 $Feedback4 = $_POST['Feedback4'];
 $Feedback5 = $_POST['Feedback5'];
 $Feedbackdate = $_POST['Feedbackdate'];
 $Feedbacktime = $_POST['Feedbacktime'];


 
 
 $tsql= "UPDATE dbo.Orders SET 
 Feedback1 = (?),
 Feedback2 = (?), 
 Feedback3 = (?), 
 Feedback4 = (?), 
 Feedback5 = (?),
 Feedbackdate = (?),
 Feedbacktime = (?)
 WHERE Id = (?)";
            
   

/* Set parameter values. */  
$params = array($Feedback1, $Feedback2, $Feedback3, $Feedback4, $Feedback5, $Feedbackdate, $Feedbacktime, $Id);

/* Prepare and execute the query. */  
$stmt20 = sqlsrv_query($conn, $tsql, $params);  
if ($stmt20) {  
    echo "Row successfully updates.\n";  
} else {  
    echo "Row update failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  


/* exit(); */

  $updateGoTo = "thanks.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}




$sql = "SELECT max(CAST(Id AS INT))+1 as countofid  FROM Orders";
$stmt1 = sqlsrv_query( $conn, $sql);
if( $stmt1 === false ) {die( print_r( sqlsrv_errors(), true));}


$sql2 = "SELECT * FROM Orders";
$stmt2 = sqlsrv_query( $conn, $sql2) or die ( print_r(sqlsrv_errors(), true));
$row_data = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC);





 ?>



 <!DOCTYPE html>
 <html>
 <head>
 < <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
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

     

 background-image: url("https://www.updatetvandstereo.com/wp-content/uploads/2017/03/feedback-background.jpg");

        background-repeat: no-repeat;
        background-size: cover;
          /* Full height */
  height: 100%;

}


.glyphicon-minus-sign{

    display: none;
}
 	</style>

 </head>
 <body>



 




<div class="container acik-renk-form ">
    <div class="page-header">
        <h2>Welcome. We are Glad to serve you.  Please fill the feedback form below to help us server you better
            
        </h2>
    </div>

   
<form id="form1" name="form1" method="post" action="feedback.php">
       


        
       <table>
           

           

           <tr>
    <td width="200px;"><h3>Please enter you Name: </h3> </td>
    <td><input id="issueCustName" name="issueCustName" class="form-control" required /></td>

</tr>



<tr>
    <td width="200px;"><h3>Please enter your Email Address: </h3> </td>
    <td><input id="issueCustEmail" name="issueCustEmail" class="form-control" required /></td>

</tr>




<tr>
    <td width="200px;"><h3>Service: </h3> </td>
    <td><input id="Feedback1" name="Feedback1" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required /></td>

</tr>



<tr>
    <td width="200px;"><h3>Cleanliness: </h3> </td>
    <td><input id="Feedback2" name="Feedback2" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required/></td>

</tr>



<tr>
    <td width="200px;"><h3>Timeleness: </h3> </td>
    <td><input id="Feedback3" name="Feedback3" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required/></td>

</tr>




<tr>
    <td width="200px;"><h3>Customer Service: </h3> </td>
    <td><input id="Feedback4" name="Feedback4" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required/></td>

</tr>




<tr>
    <td width="200px;"><h3>Envirnoment: </h3> </td>
    <td><input id="Feedback5" name="Feedback5" class="rating" data-glyphicon=0 data-stars="5" data-step="0.5" title="" required/></td>

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
            <button type="submit" class="btn btn-primary ">Submit</button>
            
        </div>
    </form>



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

 	





