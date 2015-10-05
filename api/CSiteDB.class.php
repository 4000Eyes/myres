<?php
include_once("CSiteGlobalConfig.class.php");
class CSiteDB{
    private $db;
    private $hostname;
    private $username;
    private $password;
    private $schema;
    
     
    private function dbConnect()
    {
		$objSiteConfig = new CSiteGlobalConfig();
		$this->hostname = $objSiteConfig->getDBHost();
		$this->schema = $objSiteConfig->getDBSchema();
		$this->username = $objSiteConfig->getDBUserName();
		$this->password = $objSiteConfig->getDBPassword();
		echo "The db name is" .  $this->schema;
		$this->db = new PDO("mysql:host=$this->hostname;dbname=$this->schema", $this->username, $this->password);	
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connect to the database" . $objSiteConfig->getDBSchema() ;
    }
     
    public function getDBHandle()
    {
		if (! $this->db)
			if ( $this->dbConnect() == false)
				return false;
		return true;
	}
     
    public function close(){
        $this->db->close();
    }
     
}
?>
