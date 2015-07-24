<?php
include("Config.inc.php");
class MySQLDatabase{
    private $db;
    private $hostname;
    private $username;
    private $password;
    private $schema;
     
    function __construct() {
        if(func_num_args() == 0){
            $this->hostname = conf_hostname;
            $this->username = conf_username;
            $this->password = conf_password;
            $this->schema = conf_schema;
        }
        else{
            $params = func_get_args();
            $this->hostname = $params[0];
            $this->username = $params[1];
            $this->password = $params[2];
            $this->schema = $params[3];
        }
    }
     
    private function open(){
        $this->db = mysql_connect($this->hostname, $this->username, $this->password) or die ('Error connecting to mysql');
        mysql_select_db($this->schema, $this->db);
    }
     
    public function executeQuery($query){
        $this->open();
        $results = mysql_query($query, $this->db) or die ("Error in query: $query. ".mysql_error());
        return $results;
    }
     
    public function close(){
        mysql_close($this->db);
    }
     
}
?>
