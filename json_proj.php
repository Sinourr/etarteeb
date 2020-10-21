<?php 
  require_once("connection.php"); 
 
require_once('common.php');
 
$sqlcompname = "

SELECT * 
FROM SystemParameters ";
$stmtcompname = sqlsrv_query( $connSelComp, $sqlcompname);
if( $stmtcompname === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$row_compname = sqlsrv_fetch_array($stmtcompname, SQLSRV_FETCH_ASSOC);

$title = $row_compname['compNameEn'];

$sql = "SELECT 1 AS ID, NullIf('null', 'null') AS GroupID, '".$title."'  AS title,'Project.php?id=1' AS href, 
1 AS folder, 'mainhead' AS extraClasses, 
'mainicon' AS icon
UNION
SELECT ID, GroupID, EName AS title, CONCAT('Project.php?id=', ID) AS href, 
IsGroup AS folder, IIF(GroupID IS NULL, 'mainhead', '') AS extraClasses, 
IIF(GroupID IS NULL, 'mainicon', 'fancytree-icon') AS icon
FROM Projects
";
$res = sqlsrv_query($connSelComp, $sql) or die ( print_r(sqlsrv_errors(), true));
    //iterate on results row and create new index array of data
    while( $row = sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC ) ) { 
        $data[] = $row;
    }
    $itemsByReference = array();

// Build array of item references:
foreach($data as $key => &$item) {
   $itemsByReference[$item['ID']] = &$item;
   // Children array:
   $itemsByReference[$item['ID']]['children'] = array();
   // Empty data class (so that json_encode adds "data: {}" ) 
   $itemsByReference[$item['ID']]['data'] = new StdClass();
}

// Set items as children of the relevant parent item.
foreach($data as $key => &$item)
   if($item['GroupID'] && isset($itemsByReference[$item['GroupID']]))
      $itemsByReference [$item['GroupID']]['children'][] = &$item;

// Remove items that were added to parents elsewhere:
foreach($data as $key => &$item) {
   if($item['GroupID'] && isset($itemsByReference[$item['GroupID']]))
      unset($data[$key]);
}
// Encode:
echo json_encode($data);



 ?>

