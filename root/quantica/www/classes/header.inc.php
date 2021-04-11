<?php

    include_once 'environment.inc.php';

    // check if authenticated...    
    // AUTH can be "admin","user","demo"
    if (!isset($_SESSION['UID']) or !isset($_SESSION['AUTH'])){
        header("Location: login.php");  
    }

?>
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

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- CHARTJS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
    
    <!-- FONT AWESOME -->
    <script src="https://use.fontawesome.com/d315e79aa7.js"></script>
    
    <!-- Bootstrap -->
    <link href="assets/css/<?php echo $currentTheme?>.bootstrap.min.css" rel="stylesheet" id="bootstrapStyle">
    
    <!-- BootBox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" crossorigin="anonymous"></script>
    
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <?php
        if (isset($CSS)){
            foreach ($CSS as &$value) {
                echo $value;
            }
        };
    ?>
    
    <!-- CUSTOM JS -->
    <script src="assets/js/functions.min.js"></script>
    <?php
        if (isset($JSS)){
            foreach ($JSS as &$jsvalue) {
                echo $jsvalue;
            }
        };
    ?>
    
    
    <title>QUANTiCA - <?php echo $PAGE?></title>
</head>
<body>