<?php
include("Config.inc.php");
class CSiteDB{
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
     
    private function dbConnect()
    {
		$this->db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connect to the database" . $conf_hostname ;
    }
     
    public function getDBHandle()
    {
		$this->dbConnect() if (! $this->db);
		return $this-dbConnect()
	}
     
    public function close(){
        $this->db->close();
    }
     
}
?>
