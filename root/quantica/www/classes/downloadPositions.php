<?php
    
    include '../classes/environment.inc.php';
    include '../classes/functions.inc.php';


    $runID='';
    if (isset($_POST['runID'])){
        $runID=$_POST['runID'];
    }
    
    $filename = trim($runID).'_Positions.csv';
    
    $positions = array();
    
    if ($runID=='')
        $query = "SELECT * FROM v_positions WHERE mode='LIVE'";
    else
        $query = "SELECT * FROM v_positions WHERE mode='LIVE' AND runID='".$runID."'";
    
    try{
        $rs = $dbh->doQuery($query);

        // HEADER
        $obj = array(
                           "runID"        => "SYSTEM ID",
                           "strategyID"   => "STRATEGY ID",
                           "strategy"     => "STRATEGY NAME",
                           "type"         => "SIDE",
                           "openDate"     => "OPEN DATE",
                           "closeDate"    => "CLOSE DATE",
                           "symbol"       => "SYMBOL",
                           "qty"          => "QTY",
                           "avgPrice"     => "AVG BUY PRICE",    
                           "mktPrice"     => "MARKET PRICE",
                           "PnL"          => "PROFIT AND LOSS"
            );
        array_push($positions,$obj);
        unset($obj);
        
        for($i=0;$i<count($rs);$i++){
                    $obj = array(
                               "runID"        => $rs[$i]["runID"],
                               "strategyID"   => $rs[$i]["strategyID"],
                               "strategy"     => $rs[$i]["strategy"],
                               "type"         => $rs[$i]["positionSide"],
                               "openDate"     => $rs[$i]["positionOpenTS"],
                               "closeDate"    => $rs[$i]["positionCloseTS"],
                               "symbol"       => $rs[$i]["symbol"],
                               "qty"          => $rs[$i]["quantity"],
                               "avgPrice"     => number_format($rs[$i]["averagePrice"],2,$SETTINGS_CSV_DECIMAL,""),    
                               "mktPrice"     => number_format($rs[$i]["marketPrice"],2,$SETTINGS_CSV_DECIMAL,""),
                               "PnL"          => number_format($rs[$i]["profitAndLoss"],2,$SETTINGS_CSV_DECIMAL,"")
                               );
                    array_push($positions,$obj);
                  }
    }catch(Exception $e){}
    

    array_to_csv_download($positions, $filename, $SETTINGS_CSV_SEPARATOR);
    
?>