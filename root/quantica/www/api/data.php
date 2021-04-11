<?php

include '../classes/environment.inc.php';

$runID='XXX-NOT-EXISTANT-XXX';
if (isset($_POST["runID"])){
    $runID=$_POST["runID"];
}


$accountBalance   = 0;
$investedAmount   = 0;
$realizedProfit   = 0;
$returnOnAccount  = 0;
$sharpeRatio      = 0;
$profitFactor     = 0;
$unrealizedProfit = 0;
$liveStrategies   = 0;
$winTrades        = 0;
$lossTrades       = 0;
$oddTrades        = 0;
$maxWin           = 0;
$maxLoss          = 0;
$avgTrade         = 0;
$avgWinTrade      = 0; 
$avgLossTrade     = 0;


try{
    $query = "SELECT * FROM v_runids WHERE RunID='".$runID."'";
    $rs = $dbh->doQuery($query);
    $accountBalance   = $rs[0]["accountBalance"];
    $investedAmount   = $rs[0]["investedAmount"];
    $realizedProfit   = $rs[0]["realizedProfit"];
    $returnOnAccount  = $rs[0]["returnOnAccount"];
    $sharpeRatio      = $rs[0]["sharpeRatio"];
    $profitFactor     = $rs[0]["profitFactor"];
    $unrealizedProfit = $rs[0]["unrealizedProfit"];
    $liveStrategies   = $rs[0]["liveStrategies"];
    $winTrades        = $rs[0]["winTrades"];
    $lossTrades       = $rs[0]["lossTrades"];
    $oddTrades        = $rs[0]["oddTrades"];
    $maxWin           = $rs[0]["maxWin"];
    $maxLoss          = $rs[0]["maxLoss"];
    $avgTrade         = $rs[0]["avgTrade"];
    $avgWinTrade      = $rs[0]["avgWinTrade"];
    $avgLossTrade     = $rs[0]["avgLossTrade"];
}catch(Exception $e){
    
}


 $json = array(
                "connectionStatus"  => $dbConnection,
                "accountBalance"    => $accountBalance,
                "investedAmount"    => $investedAmount,
                "realizedProfit"    => $realizedProfit,
                "returnOnAccount"   => $returnOnAccount,
                "sharpeRatio"       => $sharpeRatio,
                "profitFactor"      => $profitFactor,
                "unrealizedProfit"  => $unrealizedProfit,
                "liveStrategies"    => $liveStrategies,
                "winTrades"         => $winTrades,
                "lossTrades"        => $lossTrades,
                "oddTrades"         => $oddTrades,
                "maxWin"            => $maxWin,
                "maxLoss"           => $maxLoss,
                "avgTrade"          => $avgTrade,
                "avgWinTrade"       => $avgWinTrade,
                "avgLossTrade"      => $avgLossTrade
        );

 echo json_encode($json);

?>