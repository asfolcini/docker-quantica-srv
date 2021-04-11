<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$VERSION            = 'v0.2';
$BUILD              = '20210408';
$THEME_DEFAULT      = 'darkly';

$HIGH_FREQUENCY     = 100;
$MID_FREQUENCY      = 500;
$LOW_FREQUENCY      = 1000;

$UPDATE_TIME        = $MID_FREQUENCY;
$SETTINGS_currency      = "€";
$SETTINGS_international = "it-IT";
$SETTINGS_locale        = "it-IT";
$SETTINGS_CSV_SEPARATOR = ";";
$SETTINGS_CSV_DECIMAL   = ",";
$SETTINGS_TIMEZONE      = "Europe/Rome";

$SETTINGS_NEWSFEED_1    = "";
$SETTINGS_NEWSFEED_2    = "";
$SETTINGS_NEWSPERPAGE   = 10;

$SETTINGS_ENDPOINT_START  = "http://127.0.0.1:8081/v1/quantica/start";
$SETTINGS_ENDPOINT_STOP   = "http://127.0.0.1:8081/v1/quantica/stop";
$SETTINGS_ENDPOINT_STATUS = "http://127.0.0.1:8081/v1/quantica/status";
$SETTINGS_API_KEY         = "secretAPIkey";

// set a cookie with a sessionID  
if (!isset($_COOKIE["theme"])){
    setcookie("theme", $THEME_DEFAULT, 0);
    $currentTheme = $THEME_DEFAULT;
}else{
    $currentTheme = $_COOKIE['theme'];
}

// UPDATETIME
if (!isset($_COOKIE["updatetime"])){
    setcookie("updatetime", $UPDATE_TIME, 0);
}else{
    $UPDATE_TIME = $_COOKIE['updatetime'];
}


// CURRENCY
if (!isset($_COOKIE["currency"])){
    setcookie("currency", $SETTINGS_currency, 0);
}else{
    $SETTINGS_currency = $_COOKIE['currency'];
}

// NUMERIC FORMAT
if (!isset($_COOKIE["numericFormat"])){
    setcookie("numericFormat", $SETTINGS_international, 0);
}else{
    $SETTINGS_international = $_COOKIE['numericFormat'];
}

// LOCALE
if (!isset($_COOKIE["locale"])){
    setcookie("locale", $SETTINGS_locale, 0);
}else{
    $SETTINGS_locale = $_COOKIE['locale'];
}

// CSV_SEPARATOR
if (!isset($_COOKIE["csv_separator"])){
    setcookie("csv_separator", $SETTINGS_CSV_SEPARATOR, 0);
}else{
    $SETTINGS_CSV_SEPARATOR = $_COOKIE['csv_separator'];
}

// CSV_DECIMAL
if (!isset($_COOKIE["csv_decimal"])){
    setcookie("csv_decimal", $SETTINGS_CSV_DECIMAL, 0);
}else{
    $SETTINGS_CSV_DECIMAL = $_COOKIE['csv_decimal'];
}

// TIMEZONE
if (!isset($_COOKIE["timezone"])){
    setcookie("timezone", $SETTINGS_TIMEZONE, 0);
}else{
    $SETTINGS_TIMEZONE = $_COOKIE['timezone'];
}
// SET TIME ZONE
date_default_timezone_set($SETTINGS_TIMEZONE);


// NEWSFEED_1
if (!isset($_COOKIE["newsFeed1"])){
    setcookie("newsFeed1", $SETTINGS_NEWSFEED_1, 0);
}else{
    $SETTINGS_NEWSFEED_1 = $_COOKIE['newsFeed1'];
}

// NEWSFEED_2
if (!isset($_COOKIE["newsFeed2"])){
    setcookie("newsFeed2", $SETTINGS_NEWSFEED_2, 0);
}else{
    $SETTINGS_NEWSFEED_2 = $_COOKIE['newsFeed2'];
}

// NEWSPERPAGE
if (!isset($_COOKIE["newsPerPage"])){
    setcookie("newsPerPage", $SETTINGS_NEWSPERPAGE, 0);
}else{
    $SETTINGS_NEWSPERPAGE = $_COOKIE['newsPerPage'];
}

/** ------------------------------------------------------------------------------------------
 * DATABASE CONNECTION SETTINGS AND INITS
 */
define('__DBCONNECTION__', serialize(array(
        'hostname'      => 'quantica-mariadb',
        'dbname'        => 'db-quantica-core',
        'username'      => 'quantica_usr',
        'password'      => 'quantica_psw',
        'persistent'    => true
        ))
);

include_once 'DB.class.php';
$dbh = DB::getInstance();
$dbConnection = 'KO';
try{
 $dbh->initDB(unserialize(__DBCONNECTION__));
 $dbConnection = 'OK';
}catch(Exception $e){
    header("Status: 301 Moved Permanently");
    header("Location: /error.php?e=".urlencode($e));
}

?>