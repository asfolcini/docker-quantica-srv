<?php

    session_start();

    unset($_SESSION['UID']);
    unset($_SESSION['AUTH']);
    
    session_destroy();
    
    header("Location: login.php");     

?>