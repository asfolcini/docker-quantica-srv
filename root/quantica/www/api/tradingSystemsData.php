<?php

include '../classes/environment.inc.php';

$runID = '';
$json = array();
if (isset($_POST['runID'])){
  $runID=$_POST['runID'];
}


if ($runID==''){
  try{
      $query = "SELECT * FROM v_liveTradingSystems";
      $rs = $dbh->doQuery($query);
      for($i=0;$i<count($rs);$i++){
         $obj = array(
                       "runID"        => $rs[$i]["runID"],
                       "strategyID"   => $rs[$i]["strategyID"],
                       "strategy"     => $rs[$i]["strategyName"],
                       "strategyDesc" => $rs[$i]["strategyDescription"],
                       "date"         => $rs[$i]["lastupdateTS"],
                       "activeTrades" => $rs[$i]["NrActiveTrades"],
                       "trades"       => $rs[$i]["totalTrades"],
                       "PnL"          => $rs[$i]["PnL"],
                       "status"       => $rs[$i]["status"]
                       );
         
         array_push($json,$obj);
      }
  }catch(Exception $e){}
}else{
 try{
      $query = "SELECT * FROM v_liveTradingSystems WHERE runID='".$runID."'";
      $rs = $dbh->doQuery($query,$param);
      for($i=0;$i<count($rs);$i++){
         $obj = array(
                       "runID"        => $rs[$i]["runID"],
                       "strategyID"   => $rs[$i]["strategyID"],
                       "strategy"     => $rs[$i]["strategyName"],
                       "strategyDesc" => $rs[$i]["strategyDescription"],
                       "date"         => $rs[$i]["lastupdateTS"],
                       "activeTrades" => $rs[$i]["NrActiveTrades"],
                       "trades"       => $rs[$i]["totalTrades"],
                       "PnL"          => $rs[$i]["PnL"],
                       "status"       => $rs[$i]["status"]
                       );
         array_push($json,$obj);
      }
  }catch(Exception $e){}
}

/*
$json = array(  
                        array (
                          "strategyID"   => "ID-1-".rand(100000,1000000),
                          "strategy"     => 'HF Maia v1.2',
                          "date"         => '2021-03-05 15:33:01',
                          "activeTrades" => rand(0,4),
                          "trades"       => rand(0,300),
                          "PnL"          => 960 + rand(-5000,7000)/100
                        ),
                        array (
                          "strategyID"   => "ID-2-".rand(100000,1000000),
                          "strategy"     => 'Vectorial DAX v2.2',
                          "date"         => '2020-03-05 10:13:45',
                          "activeTrades" => rand(0,2),
                          "trades"       => rand(0,1300),
                          "PnL"          => 9960 + rand(-50000,70000)/100
                        ),
                        array (
                          "strategyID"   => "ID-3-".rand(100000,1000000),
                          "strategy"     => 'Neural Scalper ',
                          "date"         => '2020-03-05 10:13:45',
                          "activeTrades" => rand(0,2),
                          "trades"       => rand(0,1300),
                          "PnL"          => 100 + rand(-50000,70000)/100
                        )
                     );
   
*/



 echo json_encode($json);

?>