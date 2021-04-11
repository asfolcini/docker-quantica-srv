<?php

include '../classes/environment.inc.php';

$type = "OPEN";
$runID = '';
$json = '';
$positions = array();
$rowPerPage = 10;
$page = 0;

if (isset($_POST['page'])){
  $page=$_POST['page'];
}
if (isset($_POST['rowPerPage'])){
  $rowPerPage=$_POST['rowPerPage'];
}
if (isset($_POST['runID'])){
  $runID=$_POST['runID'];
}
if (isset($_POST['type'])){
 if (strcmp($_POST['type'],"OPEN")==0)
  $type="OPEN";
 if (strcmp($_POST['type'],"CLOSED")==0)
  $type="CLOSED";
}


$total_PnL = 0;
$totalPositions = 0;


if ($runID==''){
         
           try{
              $query = "SELECT * FROM v_positions WHERE mode='LIVE' AND positionStatus='".$type."'";
              if ($type=='CLOSED'){ // paginate only for close positions
                  $query = $query . " LIMIT ".$rowPerPage." OFFSET ".($page*$rowPerPage);
              }
              $rs = $dbh->doQuery($query);
              for($i=0;$i<count($rs);$i++){
                $obj = array(
                           "runID"        => $rs[$i]["runID"],
                           "positionID"   => $rs[$i]["positionID"],
                           "strategyID"   => $rs[$i]["strategyID"],
                           "strategy"     => $rs[$i]["strategy"],
                           "type"         => $rs[$i]["positionSide"],
                           "openDate"     => $rs[$i]["positionOpenTS"],
                           "closeDate"    => $rs[$i]["positionCloseTS"],
                           "symbol"       => $rs[$i]["symbol"],
                           "qty"          => $rs[$i]["quantity"],
                           "avgPrice"     => $rs[$i]["averagePrice"],    
                           "mktPrice"     => $rs[$i]["marketPrice"],
                           "PnL"          => $rs[$i]["profitAndLoss"]
                           );
                array_push($positions,$obj);
              }
            }catch(Exception $e){}

           try{
              $query = "SELECT COUNT(positionID) as totalPositions ,SUM(profitAndLoss) as total_PnL FROM v_positions WHERE mode='LIVE' AND positionStatus='".$type."'";
              $rs = $dbh->doQuery($query);
              $total_PnL = $rs[0]["total_PnL"];
              $total_Positions = $rs[0]["totalPositions"];
           }catch(Exception $e){}

}
else {
    // runID is there!!
           try{
              $query = "SELECT * FROM v_positions WHERE mode='LIVE' AND positionStatus='".$type."' AND runID='".$runID."'";
              if ($type=='CLOSED'){ // paginate only for close positions
                  $query = $query . " LIMIT ".$rowPerPage." OFFSET ".($page*$rowPerPage);
              }
              $rs = $dbh->doQuery($query);
              for($i=0;$i<count($rs);$i++){
                $obj = array(
                           "runID"        => $rs[$i]["runID"],
                           "positionID"   => $rs[$i]["positionID"],
                           "strategyID"   => $rs[$i]["strategyID"],
                           "strategy"     => $rs[$i]["strategy"],
                           "type"         => $rs[$i]["positionSide"],
                           "openDate"     => $rs[$i]["positionOpenTS"],
                           "closeDate"    => $rs[$i]["positionCloseTS"],
                           "symbol"       => $rs[$i]["symbol"],
                           "qty"          => $rs[$i]["quantity"],
                           "avgPrice"     => $rs[$i]["averagePrice"],    
                           "mktPrice"     => $rs[$i]["marketPrice"],
                           "PnL"          => $rs[$i]["profitAndLoss"]
                           );
                array_push($positions,$obj);
              }
           }catch(Exception $e){}

           try{
              $query = "SELECT COUNT(positionID) as totalPositions ,SUM(profitAndLoss) as total_PnL FROM v_positions WHERE mode='LIVE' AND positionStatus='".$type."' AND runID='".$runID."'";
              $rs = $dbh->doQuery($query);
              $total_PnL = $rs[0]["total_PnL"];
              $total_Positions = $rs[0]["totalPositions"];
           }catch(Exception $e){}
  
}


  $json = array(
              "totalPositions"    => $total_Positions,
              "positions"         => $positions,
              "totalPnL"          => $total_PnL
      );

 echo json_encode($json);

?>