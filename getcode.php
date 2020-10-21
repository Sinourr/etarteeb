<?php 
  require_once("connection.php"); 
  require_once('common.php');


$action = 0;

if($_GET['GroupID'] == '1'){
   $action = "maingrp";
} elseif($_GET['GroupID'] !== '1') {
   $action = 'sec_grp';
};

if ($action == "maingrp"){

//checking if there is any groups under selected group or not?
  $StrSql = "SELECT TOP(1) * FROM LASCostCentersgrp WHERE GroupID = '1' ORDER BY id DESC";
$Result = sqlsrv_query( $connSelComp, $StrSql) or die ( print_r(sqlsrv_errors(), true));

$code = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);

$row_count = sqlsrv_num_rows( $Result );

//if there is no cost center in same level then do this

$n= $code['GroupCode'] + 100000;
$outp = array(

"lastcodeindb" => $code['GroupCode'],
"newcode" => str_pad($n, 3, '0', STR_PAD_LEFT),
   );
print json_encode($outp);

    

} elseif ($action == "sec_grp"){



//if the grp is secondary then we jump to this section

$StrSql = "SELECT TOP(1) * FROM LASCostCentersgrp WHERE ID = '".$_GET['GroupID']."' ORDER BY id DESC";
$Result = sqlsrv_query( $connSelComp, $StrSql) or die ( print_r(sqlsrv_errors(), true));
$code = sqlsrv_fetch_array( $Result, SQLSRV_FETCH_ASSOC);
$row_count_sec = sqlsrv_num_rows($Result);


//Check if there is some record under selected group.
$Sql1 = "SELECT TOP(1) * FROM LASCostCentersgrp WHERE GroupID = '".$_GET['GroupID']."' ORDER BY id DESC";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$Result1 = sqlsrv_query( $connSelComp, $Sql1, $params, $options) or die ( print_r(sqlsrv_errors(), true));
$checkexistingrows = sqlsrv_fetch_array( $Result1, SQLSRV_FETCH_ASSOC);
$row_checkexistingrows = sqlsrv_num_rows( $Result1 );




$levelSql = "
WITH cte AS (
    SELECT ID, EName, GroupCode, GroupID, 0 AS level
    FROM LASCostCentersgrp
    WHERE GroupID = 1
    UNION ALL 
    SELECT t1.ID, t1.EName, t1.GroupCode, t1.GroupID, t2.level + 1
    FROM LASCostCentersgrp t1
    INNER JOIN cte t2
        ON t1.GroupID = t2.ID
)

SELECT ID, EName, GroupCode, GroupID, Level
FROM cte
WHERE ID = '" . $_GET['GroupID'] . "'
ORDER BY ID";
$levelResult = sqlsrv_query( $connSelComp, $levelSql) or die ( print_r(sqlsrv_errors(), true));
$levelcode = sqlsrv_fetch_array( $levelResult, SQLSRV_FETCH_ASSOC);
$row_count_level = sqlsrv_num_rows( $levelResult );

if($row_checkexistingrows !== 0){




$n =  intval($checkexistingrows['GroupCode'])+substr(10000,0);




$outp = array(

"lastcodeindb" => 'Last code =  '.$checkexistingrows['GroupCode'].' & lvl ='.$levelcode['Level'],
"newcode" => $n,
   );
print json_encode($outp);




}

else if($row_checkexistingrows == 0){


            if($levelcode['Level'] == 0){



                    $n0= $code['GroupCode'] + intval(substr(10000, 0 ));

                    $outp = array(

                    "lastcodeindb" => '___No existing rows under: - '.$checkexistingrows['EName'].'& lvl ='.$levelcode['Level'],
                    "newcode" => str_pad($n0, 2, '0', STR_PAD_LEFT),
                       );
                    print json_encode($outp);




            } elseif($levelcode['Level'] !== 0){

                    $n0= $code['GroupCode'] + intval(substr(10000, 0 , -$levelcode['Level']));

                    $outp = array(

                    "lastcodeindb" => '___No existing rows under: - '.$checkexistingrows['EName'].'& lvl ='.$levelcode['Level'],
                    "newcode" => str_pad($n0, 2, '0', STR_PAD_LEFT),
                       );
                    print json_encode($outp);
          }


}



} 

?>
