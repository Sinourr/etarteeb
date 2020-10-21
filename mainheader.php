
<?php 
require("connection.php");

if(!isset($_SESSION)){    
session_start();    
} 


?>



 <!-- create Style To Change The Color Of DropDowns -->
  <style type="text/css"> 

    .navbar-expand-md .navbar-nav .dropdown-menu
    {
     background-color: black;
    } 

    .dropdown-item
    {
      color: white !important;
    }

    .highlightcolor
    {
      color: yellow !important;
    }

     .dropdown-item:hover
    {
      background-color: blue !important;
    }

   </style>




<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://kit.fontawesome.com/2e319dd642.js" crossorigin="anonymous"></script>

<?php 

$role = stripcslashes($_SESSION['Role']);

if($role == "Owner"){  ?> 



  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"> <img src="https://icons-for-free.com/iconfiles/png/512/business+company+estate+office+work+icon-1320086520504455343.png" width="30px"> Dashboard <span  class="sr-only">(current)</span></a>
      </li>

       


       <li class="nav-item">
            <a class="nav-link" href="companies.php"><i class="far fa-building"></i> Companies</a>
          </li>




          <li class="nav-item">
            <a class="nav-link" href="masterusers.php"><i class="far fa-user-circle"></i> Users</a>
          </li>

   
    </ul>





       <ul class="navbar-nav  ml-auto">
      

 <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="far fa-user"></i> <?php echo $_SESSION['MM_Username']; ?></a>

        <div class="dropdown-menu  " style="margin-left: -150px;" aria-labelledby="dropdown04"  >
            <a class="dropdown-item highlightcolor" href="#">  Change Password </a>
          <a class="dropdown-item highlightcolor" href="logout.php">  Logout </a>


           <a class="dropdown-item highlightcolor">  <?php if(!isset($_SESSION['MM_CompName'])){ echo "Logged In to: Maintenance"; }  ?>  </a>
        
     
        
     
        </div>

      </li>

   
    </ul>

  
  </div>
</nav>


 <?php } elseif($role == "user"){ ?>





  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"> <img src="https://icons-for-free.com/iconfiles/png/512/business+company+estate+office+work+icon-1320086520504455343.png" width="30px"> Dashboard <span  class="sr-only">(current)</span></a>
      </li>



 <li class="nav-item">
            <a class="nav-link" href="orders.php"><i class="far fa-user-circle"></i> Orders</a>
    </li>


   
    </ul>




       <ul class="navbar-nav  ml-auto">
      

 <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="far fa-user"></i> <?php echo $_SESSION['MM_Username']; ?></a>

        <div class="dropdown-menu  " style="margin-left: -150px;" aria-labelledby="dropdown04"  >
            <a class="dropdown-item highlightcolor" href="#">  Change Password </a>
          <a class="dropdown-item highlightcolor" href="logout.php">  Logout </a>


           <a class="dropdown-item highlightcolor">  <?php if(!isset($_SESSION['MM_CompName'])){ echo "Logged In to: Maintenance"; }  ?>  </a>
        
     
        
     
        </div>

      </li>

   
    </ul>

  
  </div>
</nav>



 <?php } elseif($role == "admin"){ ?> 


  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"> <img src="https://icons-for-free.com/iconfiles/png/512/business+company+estate+office+work+icon-1320086520504455343.png" width="30px"> Dashboard <span  class="sr-only">(current)</span></a>
      </li>

      





     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Support Files</a>

        <div class="dropdown-menu" aria-labelledby="dropdown04">

    
          <a class="dropdown-item" href="Branch.php?culture=en">Branches</a>

        </div>

      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Management Screen</a>

        <div class="dropdown-menu" aria-labelledby="dropdown04">
          <a class="dropdown-item" href="compusers.php">Users</a>
          <a class="dropdown-item" href="sysfixedparam.php">System Parameters</a>
          <a class="dropdown-item" href="feedbacksindex.php?culture=en">Feedbacks</a>
          <a class="dropdown-item" href="problems.php?culture=en">Problems</a>
       
        
        </div>

      </li>


 <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">System Reports</a>

        <div class="dropdown-menu" aria-labelledby="dropdown04">
         
          <a class="dropdown-item" href="orderreportindex.php?culture=en"> Order Report</a>
          <a class="dropdown-item" href="servicetimereport.php?culture=en"> Average service time report</a>
          
 
     
        </div>

      </li>

   
    </ul>




       <ul class="navbar-nav  ml-auto">

        

          <?php


$sql = "
SELECT *
FROM Orders WHERE isIssueResolved = 0";
$result1 = sqlsrv_query( $connSelComp, $sql, array(), array( "Scrollable" => 'static' ));
if( $result1 === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$totalRows_dataset = sqlsrv_num_rows($result1);

if($totalRows_dataset>0){
           ?> 

           <li class="nav-item active"> 
        <a class="nav-link" href="problems.php?culture=en"> <i class="fa fa-bell" aria-hidden="true"><sup style="font-size: 20px; background-color: red; border-radius: 50px; background-size: 200px;"><?php echo $totalRows_dataset; ?></sup></i>
</a>
      </li>

    <?php } ?>
      

 <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="far fa-user"></i> <?php echo $_SESSION['MM_Username']; ?></a>

        <div class="dropdown-menu" style="margin-left: -150px;" aria-labelledby="dropdown04" >
            <a class="dropdown-item highlightcolor" href="#">  Change Password </a>
          <a class="dropdown-item highlightcolor" href="logout.php">  Logout </a>


           <a class="dropdown-item highlightcolor"> Logged In to: <?php echo $_SESSION['MM_CompName']; ?>  </a>
        
     
        </div>

      </li>

   
    </ul>



  </div>
</nav>


<?php }


?>