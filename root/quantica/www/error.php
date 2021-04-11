<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Favicon -->
    <link href="assets/images/favicon.png" rel="shortcut icon">
    
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="assets/css/darkly.bootstrap.min.css" rel="stylesheet" id="bootstrapStyle">
    
    <link rel="stylesheet" href="assets/css/main.css">
    
    <title>QUANTiCA - 404!</title>
</head>
<body>






  <!--  ---------------------------------------- PAGE CONTENT ------------------------------------------- -->
  <div class="error404">
      
      <div>
        <h1 class="text-center">Opssss...</h1>
        <p class="text-center"><img class="img-responsive" src="assets/images/swanlogo-big.png" width='200px'></p>
        <h2 class="text-center">...something went wrong!</h2>
        <p class="lead text-center">Check your configuration and quantica-db connection</p>
        <p class="small text-center text-muted">
          <?php 
              if (isset($_GET["e"]))
                echo $_GET["e"];
          ?>
        </p>
      </div>    
  <!--  ------------------------------------- END OF PAGE CONTENT ----------------------------------------- -->
  </div>




<!-- end of flex container-->


<?php

    include_once 'classes/footer.inc.php';

?>
