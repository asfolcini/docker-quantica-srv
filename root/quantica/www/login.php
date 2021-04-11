<?php 
    
    include 'classes/environment.inc.php';
    
    session_start();

    $mex = '';
    if (isset($_POST['username'])&&isset($_POST['password'])){
         
         $uid = $_POST['username'];
         $psw = $_POST['password'];
         try{
            $query = "SELECT uid,psw,fullname,level FROM users WHERE uid='".$uid."' AND active=1";
            $rs = $dbh->doQuery($query);
            $hash = password_hash($psw,PASSWORD_DEFAULT); 
            if ($rs){
                 if (password_verify($psw,$rs[0]["psw"])){
                     $_SESSION['UID']       = $rs[0]["uid"];
                     $_SESSION['FULLNAME']  = $rs[0]["fullname"];
                     $_SESSION['AUTH']      = $rs[0]["level"];
                     header("Location: index.php");
                     die();
                 }else
                    $mex = 'Wrong password!';
            }else{
                if (isset($_SESSION['AUTH']))
                    unset($_SESSION['AUTH']);
                if (isset($_SESSION['UID']))
                    unset($_SESSION['UID']);
                if (isset($_SESSION['FULLNAME']))
                    unset($_SESSION['FULLNAME']);
                $mex = 'Wrong Username or Password! ';    
            }
        }catch(Exception $e){
            
        }

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
    
    <!-- FONT AWESOME -->
    <script src="https://use.fontawesome.com/d315e79aa7.js"></script>
    
    <!-- Bootstrap -->
    <link href="assets/css/darkly.bootstrap.min.css" rel="stylesheet" id="bootstrapStyle">
    
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/login.css">

    <title>QUANTiCA - Login</title>
</head>
<body>
    
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-1" style="background-image: url('assets/images/login-img<?php echo rand(1,9)?>.jpg'/*'http://placeimg.com/1024/768/nature/grayscale'*/);"></div>
            <div class="order-2 order-md-2">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-10">
                            <img class="img-fluid mt-4" src="assets/images/quanticalogo-big-gray.png">
                            <h3 class="margin-0 text-black-06">Algorithmic Trading Platform</span></h3>					
                            <br/>
                            <p class="mb-8">Login to QUANTiCA web console.</p>
                            <form action="login.php" method="post">
                                 <div class="mb-3"><input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required></div>
                                 <div class="mb-3"><input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required></div>
                                 <div class="mb-3"><input type="submit" value="Log In" class="btn btn-block btn-primary"></div>
                            </form>
                            <h4 class="text-danger"><?php echo $mex?></h4>
                        </div>
                    </div>
                </div>
        </div>
    </div>

<?php

    include_once 'classes/footer.inc.php';

?>