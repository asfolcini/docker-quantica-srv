<?php

include '../classes/environment.inc.php';

// check AUTH 
if (strtoupper($_SESSION['AUTH'])=='VIEW'){
    // no auth level for this user
    echo -1;
    die();
}


$action = '';
if (isset($_POST['action'])){
    $action = $_POST['action'];
}



// ---------------------------------------------------------------------------------------------------------
// REMOVE SYSTEM 
// ---------------------------------------------------------------------------------------------------------
if ($action=="REMOVE_SYSTEM"){
    $runID = '';
    if (isset($_POST['runID'])){
        $runID = $_POST['runID'];
    }
    
    try{
        $query = "CALL REMOVE_runID('".$runID."')";
        $rs = $dbh->doQuery($query);
        echo 0;
    }catch(Exception $e){
        echo -1;
    }
}
else
    echo -1;

?>