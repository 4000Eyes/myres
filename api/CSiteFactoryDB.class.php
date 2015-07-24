<? php

include_one("CSiteDB.class.php");

private $db;

function __construct()
{
	$this->db = new CSiteDB();
	
}

public function getCompany(&$arCompany)
{
	my $szSelectSQL = "SELECT * FROM res_company";
	try
	{
		my $dbObj = $this -> db -> getDBHandle()->prepare($query));
		$dbObj->execute();
		$arCompany = $dbObj->fetchall(PDO::FETCH_OBJ);
	} catch (PDOException &e)
	{
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

?>
