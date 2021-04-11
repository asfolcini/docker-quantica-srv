<?php
    
    include '../classes/environment.inc.php';
    include '../classes/functions.inc.php';


    $mode='';
    if (isset($_POST['mode'])){
        $mode=$_POST['mode'];
    }
    
    $filename = 'QUANTiCA_'.trim($mode).'_Systems.csv';
    
    $positions = array();
    
    $query = "SELECT * FROM v_runids WHERE mode='".$mode."' ORDER BY status asc,realizedProfit desc";
    
    try{
        $rs = $dbh->doQuery($query);

        // HEADER
        $obj = array(
                            "runID"              => "SYSTEM ID",
                            "mode"               => "MODE",
                            "brokerID"           => "BROKER ID",
                            "brokerDescription"  => "BROKER DESC",
                            "status"             => "SYSTEM STATUS",
                            "lastUpdate"         => "LAST UPDATE",
                            "liveStrategies"     => "#ALGOS",
                            "accountBalance"     => "BALANCE",    
                            "investedAmount"     => "INVESTED",
                            "realizedProfit"     => "REALIZED PNL",    
                            "returnOnAccount"    => "RETURN ON ACCOUNT",    
                            "sharpeRatio"        => "SHARPE RATIO",    
                            "profitFactor"       => "PROFIT FACTOR",    
                            "unrealizedProfit"   => "UNREALIZED PNL",    
                            "NrOpenPositions"    => "OPEN TRADES",
                            "winTrades"          => "WIN TRADES",
                            "lossTrades"         => "LOSS TRADES",
                            "oddTrades"          => "ODD TARDES",
                            "maxWin"             => "MAX WIN",    
                            "maxLoss"            => "MAX LOSS",    
                            "avgTrade"           => "AVG TRADE",    
                            "avgWinTrade"        => "AVG WIN TRADE",    
                            "avgLossTrade"       => "AVG LOSS TRADE"
            );
        array_push($positions,$obj);
        unset($obj);
        
        for($i=0;$i<count($rs);$i++){
                    $obj = array(
                               "runID"              => $rs[$i]["RunID"],
                               "mode"               => $rs[$i]["mode"],
                               "brokerID"           => $rs[$i]["brokerID"],
                               "brokerDescription"  => $rs[$i]["brokerDescription"],
                               "status"             => $rs[$i]["status"],
                               "lastUpdate"         => $rs[$i]["lastupdateTS"],
                               "liveStrategies"     => $rs[$i]["liveStrategies"],
                               "accountBalance"     => number_format($rs[$i]["accountBalance"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "investedAmount"     => number_format($rs[$i]["investedAmount"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "realizedProfit"     => number_format($rs[$i]["realizedProfit"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "returnOnAccount"    => number_format($rs[$i]["returnOnAccount"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "sharpeRatio"        => number_format($rs[$i]["sharpeRatio"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "profitFactor"       => number_format($rs[$i]["profitFactor"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "unrealizedProfit"   => number_format($rs[$i]["unrealizedProfit"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "NrOpenPositions"    => $rs[$i]["NrOpenPositions"],
                               "winTrades"          => $rs[$i]["winTrades"],
                               "lossTrades"         => $rs[$i]["lossTrades"],
                               "oddTrades"          => $rs[$i]["oddTrades"],
                               "maxWin"             => number_format($rs[$i]["maxWin"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "maxLoss"            => number_format($rs[$i]["maxLoss"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "avgTrade"           => number_format($rs[$i]["avgTrade"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "avgWinTrade"        => number_format($rs[$i]["avgWinTrade"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "avgLossTrade"       => number_format($rs[$i]["avgLossTrade"],2,$SETTINGS_CSV_DECIMAL,"")
                               );
                    array_push($positions,$obj);
                  }
    }catch(Exception $e){}
    

    array_to_csv_download($positions, $filename, $SETTINGS_CSV_SEPARATOR);
    
?>