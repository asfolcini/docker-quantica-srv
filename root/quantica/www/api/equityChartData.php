<?php

include '../classes/environment.inc.php';


$chart_type = '1Y';
if (isset($_POST['type'])){
    switch (strtoupper($_POST['type'])) {
        case 'ALL'  : $chart_type = 'ALL';break;
        case 'YTD'  : $chart_type = 'YTD';break;
        case '1Y'   : $chart_type = '1Y';break;
        case '6M'   : $chart_type = '6M';break;
        case '3M'   : $chart_type = '3M';break;
        case '1M'   : $chart_type = '1M';break;
        case '1W'   : $chart_type = '1W';break;
        case '1D'   : $chart_type = '1D';break;
        default: $chart_type = '1Y';
    }
}

$runID='';
if (isset($_POST['runID'])){
    $runID = $_POST['runID'];
}




$labels  = array();
$dataset = array();


 try{
    $query = "CALL get_equity('LIVE','".$runID."','".$chart_type."')";
    $rs = $dbh->doQuery($query);
    for($i=0;$i<count($rs);$i++){
        $labels[$i]   = $i;
        $dataset[$i] = $rs[$i]["cumEquity"];
    }
 }catch(Exception $e){}
  

 $json = array(
                "labels"   => $labels,
                "dataset"  => $dataset
         );

 echo json_encode($json);

?>