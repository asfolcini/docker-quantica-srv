<?php 

    $PAGE = 'Dashboard';
    $CSS  = [''/*'<link rel="stylesheet" href="assets/css/dashboard.css">'*/];
    //$JSS  = ['<script src="assets/js/charts-resize.js"></script>'];

    include_once 'classes/header.inc.php';

    include_once 'classes/navbar.inc.php';

$mode='';
$runID='';
if ((!isset($_POST['runID']))&&(!isset($_POST['mode']))){
  header("Location: index.php");
  die();
}else{
  if (isset($_POST['runID'])){
    $runID=$_POST['runID'];
  }
  if (isset($_POST['mode'])){
    $mode=$_POST['mode'];
  }
}
?>


<div class="d-flex flex-row">

    <!--  ---------------------------------------- SIDE BAR ------------------------------------------- -->
    <nav id="sidebar" class="bg-secondary">
      <?php 
        include_once 'components/sidebar.user.inc.php';
      ?>
      <ul class="list-unstyled components pl-3">
        <p class="m-0 text-uppercase">Dashboards</p>
        <li class="pl-2">
          <a href="index.php"><i class="fa fa-caret-right"></i>&nbsp;Overall</a>
        </li>
        <li class="pl-2">
          <a href="#">Backtests</a>
        </li>
    
        <!-- external quantica links -->     
        <?php
          include_once 'components/sidebar.dashboard.quantica.inc.php';
        ?>
        <!-- ----------------------- -->
      </ul>      
    </nav>
    <!-- ------------------------------------- END OF SIDEBAR ----------------------------------------- -->



  <!--  ---------------------------------------- PAGE CONTENT ------------------------------------------- -->
  <div class="container-fluid ml-1 mt-0 mb-2 mr-0">

    <!-- BREADCRUMBS -->
    <div class="row align-items-center pl-2 pr-2 mt-1">
        <div class="col-xs-6 col-sm-6 col-md-6 mx-0 px-0">
          <p class="text-muted small text-uppercase pb-0 mb-0"><a href="index.php">Dashboards</a>&nbsp;<span>/</span><a href="index.php">&nbsp;Overall</a>&nbsp;<span>/</span>&nbsp;SYSTEM <?php echo $runID?></p>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mx-0 px-0 text-right">
          <?php include_once 'components/connectionStatus.inc.php'; ?>
        </div>
    </div>

    <!-- --------------- FIRST ROW --------------- -->
     <div class="row align-items-center mt-0">

        <!-- ACCOUNT BALANCE -->
        <div class="col-6  col-sm-4 col-md-4 col-lg-4 col-xl-2 p-0 m-0">
          <?php include_once 'components/card.accountBalance.inc.php'; ?>
        </div>        

        <!-- INVESTED AMOUNT -->
        <div class="col-6  col-sm-4 col-md-4 col-lg-4 col-xl-2 p-0 m-0">
          <?php include_once 'components/card.investedAmount.inc.php'; ?>
        </div>        

        <!-- RETURN ON ACCOUNT % -->
        <div class="col-6  col-sm-4 col-md-4 col-lg-4 col-xl-2 p-0 m-0">
          <?php include_once 'components/card.returnOnAccount.inc.php'; ?>
        </div>        

        <!-- REALIZED PROFIT -->
        <div class="col-6  col-sm-4 col-md-4 col-lg-4 col-xl-2 p-0 m-0">
          <?php include_once 'components/card.realizedProfit.inc.php'; ?>
        </div>        

        <!-- UNREALIZED PROFIT -->
        <div class="col-6  col-sm-4 col-md-4 col-lg-4 col-xl-2 p-0 m-0">
          <?php include_once 'components/card.unrealizedProfit.inc.php'; ?>
        </div>        

        <!-- SHARPE RATIO -->
        <div class="col-6  col-sm-4 col-md-4 col-lg-4 col-xl-2 p-0 m-0">
          <?php include_once 'components/card.sharpeRatio.inc.php'; ?>
        </div>        

    </div>
    <!-- --------------- END OF FIRST ROW --------------- -->

    <!-- --------------- SECOND ROW --------------- -->
     <div class="row align-items-left">

        <!-- BAR CHART -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 p-0 m-0">
          <?php include_once 'components/card.returnsBarChart.inc.php';?>
        </div>

        <!-- EQUITY CHART -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 p-0 m-0">
          <?php include_once 'components/card.equityChart.inc.php';?>
        </div>


        <!-- STRATEGIES RUNNING -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 p-0 m-0">
          <?php include_once 'components/card.strategiesRunning.table.inc.php';?>
        </div>
          

    </div>
    <!-- --------------- END OF SECOND ROW --------------- -->


    <!-- --------------- SECOND ROW --------------- -->
     <div class="row align-items-left mt-1">

        <!-- OPEN POSITIONS -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 p-0 m-0">
          <?php include_once 'components/card.openPositions.table.inc.php';?>
        </div>

        <!-- WINRATE -->
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2 col-xl-2 p-0 m-0" style="height: auto">
           <?php include_once 'components/card.winrate.inc.php';?>
        </div>
        
        <!-- AVERAGE TRADE -->
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2 col-xl-2 p-0 m-0" style="height: auto">
           <?php include_once 'components/card.averageTrades.inc.php';?>
        </div>


    </div>
    <!-- --------------- END OF SECOND ROW --------------- -->

   <!-- --------------- LAST ROW --------------- -->
     <div class="row align-items-left mt-1">

        <!-- CLOSED POSITIONS -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 p-0 m-0">
          <?php include_once 'components/card.closedPositions.table.inc.php';?>
        </div>


    </div>
    <!-- --------------- END OF LAST ROW --------------- -->




  <!--  ------------------------------------- END OF PAGE CONTENT ----------------------------------------- -->
  </div>




<!-- end of flex container-->
</div>


<?php

    include_once 'classes/footer.inc.php';

?>


<script>
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});
</script>