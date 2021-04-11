<?php

include '../classes/environment.inc.php';

$mode = 'LIVE';
$json = array();
if (isset($_POST['mode'])){
  $mode=$_POST['mode'];
}


  try{
      $query = "SELECT * FROM v_runids WHERE mode='".$mode."' ORDER BY status asc,realizedProfit desc";
      $rs = $dbh->doQuery($query);
      for($i=0;$i<count($rs);$i++){
         $obj = array(
                       "runID"              => $rs[$i]["RunID"],
                       "mode"               => $rs[$i]["mode"],
                       "brokerID"           => $rs[$i]["brokerID"],
                       "brokerDescription"  => $rs[$i]["brokerDescription"],
                       "status"             => $rs[$i]["status"],
                       "lastUpdate"         => $rs[$i]["lastupdateTS"],
                       "liveStrategies"     => $rs[$i]["liveStrategies"],
                       "accountBalance"     => $rs[$i]["accountBalance"],
                       "investedAmount"     => $rs[$i]["investedAmount"],
                       "realizedProfit"     => $rs[$i]["realizedProfit"],
                       "returnOnAccount"    => $rs[$i]["returnOnAccount"],
                       "sharpeRatio"        => $rs[$i]["sharpeRatio"],
                       "profitFactor"       => $rs[$i]["profitFactor"],
                       "unrealizedProfit"   => $rs[$i]["unrealizedProfit"],
                       "NrOpenPositions"    => $rs[$i]["NrOpenPositions"],
                       "winTrades"          => $rs[$i]["winTrades"],
                       "lossTrades"         => $rs[$i]["lossTrades"],
                       "oddTrades"          => $rs[$i]["oddTrades"],
                       "maxWin"             => $rs[$i]["maxWin"],
                       "maxLoss"            => $rs[$i]["maxLoss"],
                       "avgTrade"           => $rs[$i]["avgTrade"],
                       "avgWinTrade"        => $rs[$i]["avgWinTrade"],
                       "avgLossTrade"       => $rs[$i]["avgLossTrade"]
                       );
         
         array_push($json,$obj);
      }
  }catch(Exception $e){}


 echo json_encode($json);

?>