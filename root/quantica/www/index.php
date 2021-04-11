<?php 

    $PAGE = 'Dashboard';
    $CSS  = [''/*'<link rel="stylesheet" href="assets/css/dashboard.css">'*/];
    //$JSS  = ['<script src="assets/js/charts-resize.js"></script>'];

    include_once 'classes/header.inc.php';

    include_once 'classes/navbar.inc.php';

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
          <p class="text-muted small text-uppercase pb-0 mb-0"><a href="index.php">Dashboards</a>&nbsp;<span>/</span>&nbsp;Overall</p>  
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mx-0 px-0 text-right">
          <?php include_once 'components/connectionStatus.inc.php'; ?>
        </div>
    </div>


    <!-- --------------- ROW --------------- -->
     <div class="row align-items-left">

        <!-- LIVE STRATEGIES -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0 m-0">
          <?php include_once 'components/card.liveTradingSystems.table.inc.php';?>
        </div>

    </div>
    <!-- --------------- END OF  ROW --------------- -->

    <!-- --------------- ROW --------------- -->
     <div class="row align-items-left mt-1">

        <!-- NEWS -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-0 m-0">
          <?php 
                $newsPerPage = $SETTINGS_NEWSPERPAGE;
                $urlRss      = $SETTINGS_NEWSFEED_1;
                include 'components/card.rssnews.table.inc.php';
          ?>
        </div>
        
        <!-- NEWS -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-0 m-0">
          <?php 
                $newsPerPage = $SETTINGS_NEWSPERPAGE;
                $urlRss      = $SETTINGS_NEWSFEED_2;
                include 'components/card.rssnews.table.inc.php';
          ?>
        </div>
        

    </div>
    <!-- --------------- END OF  ROW --------------- -->



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