<?php
Class DB {

private static $instance;
private $dbh;

private function __construct() {}

public static function getInstance() {
        if( !self::$instance ) {
                self::$instance = new DB();
        }
        return self::$instance;
}

public function initDB($conn_info) {
        if( ! $this->checkArray($conn_info, 5, 6,true) ) {
                Throw new Exception("Incorrect number of arguments for MySQL connection.");
        } else if( ! (isset($conn_info['hostname']) && isset($conn_info['dbname']) && isset($conn_info['username']) && isset($conn_info['password'])) ) {
                Throw new Exception("MySQL connection info does not contain all necessary parts.");
        }

        $uri = sprintf("mysql:host=%s;dbname=%s", $conn_info['hostname'], $conn_info['dbname']);

        $limit = 10;
        $counter = 0;
        while (true){
                try{
                        set_error_handler(array($this, 'errHandler'));
                        $this->dbh = new PDO($uri, $conn_info['username'], $conn_info['password'], array(PDO::ATTR_PERSISTENT => $conn_info['persistent']));
                        break;
                }catch(Exception $e) {
                        $this->dbh = null;
                        $counter++;
                if ($counter == $limit)
                throw $e;
                }
        }
}

public function errHandler($errno, $errstr){
    //do stuff
}


public function doQuery($query, $params=NULL) {
        $this->requireInit();
        $dbh = $this->dbh;
        if(!$query) {
                return NULL;
        } else {
                $sth = $dbh->prepare($query);
                if($sth->execute($params)) {
                        return $sth->fetchAll(PDO::FETCH_ASSOC);
                } else {
                        $err_arr = $sth->errorInfo();
                        $err_msg = sprintf("SQLSTATE ERR: %s<br />\nmySQL ERR: %s<br />\nMessage: %s<br />\n", $err_arr[0], $err_arr[1], $err_arr[2]);
                        Throw new Exception($err_msg);
                }
        }
}

private function checkArray($arr, $min_ele, $max_ele, $allow_empty=FALSE) {
        $cnt = count($arr);
        if( ($cnt < $min_ele) || ($cnt > $max_ele) ) { return false; }
        else if( !$allow_empty ) {
                foreach( $arr as $element ) {
                        if( empty($element) ) { return false; }
                }
        }
        return true;
}

private function requireInit() {
        if( !isset($this->dbh) ) {
                throw new Exception('Database connection has not been initialized.');
        }
}

} //-- End of model class
?>