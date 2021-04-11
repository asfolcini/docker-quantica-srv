<?php

include '../classes/environment.inc.php';

$chart_type = 'MONTH';
if (isset($_POST['type'])){
    switch (strtoupper($_POST['type'])) {
        case 'DAY'  : $chart_type = 'DAY';break;
        case 'WEEK' : $chart_type = 'WEEK';break;
        case 'MONTH': $chart_type = 'MONTH';break;
        case 'YEAR' : $chart_type = 'YEAR';break;
        default: $chart_type = 'MONTH';
    }
}

$runID='';
if (isset($_POST['runID'])){
    $runID = $_POST['runID'];
}


 $labels  = array();
 $dataset = array();


 try{
    $query = "CALL get_profits('LIVE','".$runID."','".$chart_type."')";
    $rs = $dbh->doQuery($query);
    for($i=0;$i<count($rs);$i++){
        $labels[$i]   = $rs[$i]["period"];
        $dataset[$i] = $rs[$i]["profitAndLoss"];
    }
 }catch(Exception $e){}
  

 $json = array(
                "labels"   => $labels,
                "dataset"  => $dataset
         );




/*if ($chart_type=='YEAR'){
  $json = array(
                 "labels"   => array('2019','2020','2021'),
                 "dataset"  => array(
                                      1360,
                                      7600,
                                      200 + rand(-1000,1000)
                                      )
          );
}




if ($chart_type=='MONTH'){
  $json = array(
                 "labels"   => array('Jen','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep'),
                 "dataset"  => array(
                                      1200,
                                      320,
                                      -720.3,
                                      -120,
                                      450,
                                      640,
                                      130,
                                      -20,
                                      200 + rand(-1000,1000)
                                      )
          );
}


if ($chart_type=='WEEK'){
  
  $json = array(
                 "labels"   => array('w1','w2','w3','w4','w5','w6','w7','w8','w9','w10','w11','w12','w13','w14','w15','w16','w17','w18','w19','w20','w21','w22','w23','w24','w25','w26','w27','w28'),
                 "dataset"  => array(200,1200,-400,250,120,-802,-120,20,600,-280 ,-100 ,340 ,-400 ,450 ,-740 ,380 ,680 ,700 ,-460 ,300 ,1500 ,-600 ,800 ,-1200 ,-240 ,920 ,-320 ,1000+rand(-500,500))
          );
}



if ($chart_type=='DAY'){
  
  $json = array(
                 "labels"   => array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60'),
                 "dataset"  => array(200,1200,-400,250,120,-802,-120,20,600,-280 ,-100 ,340 ,-400 ,450 ,-740 ,380 ,680 ,700 ,-460 ,300 ,1500 ,-600 ,800 ,-1200 ,-240 ,920 ,-320 ,200,1200,-400,250,120,-802,-120,20,600,-280 ,-100 ,340 ,-400 ,450 ,-740 ,380 ,680 ,700 ,-460 ,300 ,1500 ,-600 ,800 ,-1200 ,-240 ,920 ,-320 , 0, -400,-90,10,rand(-500,500))
          );
}

*/


 echo json_encode($json);

?>