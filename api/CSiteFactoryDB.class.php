<?php

include_once("CSiteDB.class.php");
include_once("CSiteLogger.class.php");
class CSiteFactoryDB
{
	private $db;
	private $objLogger;
	private function __construct()
	{
		$this->db = new CSiteDB();
		$this->objLogger = new CSiteLogger;
	}

	public function getCompany(&$arCompany)
	{
		$szSelectSQL = "SELECT * FROM res_company";
		try
		{
			$dbObj = $this -> db -> getDBHandle()->prepare($query);
			$dbObj->execute();
			$arCompany = $dbObj->fetchall(PDO::FETCH_OBJ);
		} catch (PDOException $e)
		{
			$objLogger->Log($e->getMessage());
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}
	}

	public function getCompanyByNameDB(&$arName)
	{
		$Szsql = "SELECT * FROM res_company WHERE UPPER(name) LIKE :query ORDER BY name";
		try {
			$szStmt = $this->db->getDBHandle()->prepare($szsql);
			$szQuery = "%".$arName."%";  
			$szStmt->bindParam("query", $szQuery);
			$szStmt->execute();
			$szCompanyNames = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo '{"wine": ' . json_encode($szCompanyNames) . '}';
		} catch(PDOException $e) {
			return json_encode("Issue with dbconnect");
			$objLogger->Log($e->getMessage()); 
		}
	}

	public function InsertNewCompanyDB($objCompany)
	{
		
		$sql = "INSERT INTO res_company 	
			(  company_name, company_address, company_type) 
			VALUES ( :company_name, :company_address, :company_type)";
			
		try {
			$szStmt = $db->prepare($sql);  
			$szStmt->bindParam("company_name", $objAccomplishment->company_name);
			$szStmt->bindParam("company_address", $objAccomplishment->company_address);
			$szStmt->bindParam("company_type", $objAccomplishment->country_type);
			$szStmt->execute();
		} catch(PDOException $e) {
			return false;
			$objLogger->Log($e->getMessage()); 
		}
		return true;
	}
	
	public function getTitle(&$arCompany)
	{
		$szSelectSQL = "SELECT * FROM res_title";
		try
		{
			$dbObj = $this -> db -> getDBHandle()->prepare($query);
			$dbObj->execute();
			$arCompany = $dbObj->fetchall(PDO::FETCH_OBJ);
		} catch (PDOException $e)
		{
			$objLogger->Log($e->getMessage());
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}
	}

	public function getTitleByNameDB(&$arName)
	{
		$Szsql = "SELECT * FROM res_title WHERE UPPER(title_name) LIKE :query ORDER BY title_name";
		try {
			$szStmt = $this->db->getDBHandle()->prepare($szsql);
			$szQuery = "%".$arName."%";  
			$szStmt->bindParam("query", $szQuery);
			$szStmt->execute();
			$szTitleNames = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo '{"title": ' . json_encode($szTitleNames) . '}';
		} catch(PDOException $e) {
			return json_encode("Issue with dbconnect");
			$objLogger->Log($e->getMessage()); 
		}
	}

	public function InsertNewTitleDB($objTitle)
	{
		
		$sql = "INSERT INTO res_title 	
			(  title_name, alternate_titles, title_level) 
			VALUES ( :title_name, :alternate_titles, :title_level)";
			
		try {
			$szStmt = $db->prepare($sql);  
			$szStmt->bindParam("title_name", $objTitle->title_name);
			$szStmt->bindParam("alternate_titles", $objTitle->alternate_titles);
			$szStmt->bindParam("title_level", $objTitle->title_level);
			$szStmt->execute();
		} catch(PDOException $e) {
			return false;
			$objLogger->Log($e->getMessage()); 
		}
		return true;
	}
	
	public function InsertSmartGoal($objSmartGoal)
	{
		$szStmt = "Insert into res_user_smart_goal 
						(user_id, leadership_trait_id,smart_goal_tmpl_id, title_id, company_id, smart_goal_desc)
						values
						(:user_id, :leadership_trait_id,:smart_goal_tmpl_id, :title_id, :company_id, :smart_goal_desc)
						";
		try {
			$szStmt = $db->prepare($sql);  
			$szStmt->bindParam("user_id", $objTitle->user_id);
			$szStmt->bindParam("leadership_trait_id", $objTitle->leadership_trait_id);
			$szStmt->bindParam("smart_goal_tmpl_id", $objTitle->smart_goal_tmpl_id);
			$szStmt->bindParam("title_id", $objTitle->title_id);
			$szStmt->bindParam("company_id", $objTitle->company_id);
			$szStmt->bindParam("smart_goal_desc", $objTitle->smart_goal_desc);
			$szStmt->execute();
		} catch(PDOException $e) {
			return false;
			$objLogger->Log($e->getMessage()); 
		}
		return true;
	}
	
	public function UpdateSmartGoal($objSmartGoal)
	{
		$szStmt = "update res_user_smart_goal 
					set
					company_id = :company_id, 
					smart_goal_desc = :smart_goal_desc, 
					sequence_id = :sequence_id
					where
					user_id = :user_id and
					leadership_trait_id = :leadership_trait_id and
					smart_goal_tmpl_id = :smart_goal_tmpl_id and
					title_id = :title_id
					";
		try {
			$szStmt = $db->prepare($sql);  
			$szStmt->bindParam("user_id", $objTitle->user_name);
			$szStmt->bindParam("leadership_trait_id", $objTitle->leadership_trait_id);
			$szStmt->bindParam("smart_goal_tmpl_id", $objTitle->smart_goal_tmpl_id);
			$szStmt->bindParam("title_id", $objTitle->title_id);
			$szStmt->bindParam("company_id", $objTitle->company_id);
			$szStmt->bindParam("smart_goal_desc", $objTitle->smart_goal_desc);
			$szStmt->bindParam("sequence_id", $objTitle->sequence_id);
	
			$szStmt->execute();
		} catch(PDOException $e) {
			return false;
			$objLogger->Log($e->getMessage()); 
		}
		return true;
	}
	
	public function getAllSmartGoals()
	{
		$Szsql = "SELECT * FROM res_smart_goal_matrix";
		try {
			$szStmt = $this->db->getDBHandle()->prepare($szsql);
			$szStmt->execute();
			$szTitleNames = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo '{"title": ' . json_encode($szTitleNames) . '}';
		} catch(PDOException $e) {
			json_encode("Issue with dbconnect");
			$objLogger->Log($e->getMessage()); 
		}
	}
	
	public function getSmartGoalByTitleAndTraitDB($nTitleID, $nLeadershipTraitID, &$arSmartGoal)
	{
		$szSelectSQL = "SELECT * FROM res_smart_goal_matrix 
							where title_id = :title_id_val and
								leadership_trait_id = :trait_id_val";
		try
		{
			$szStmtSQL = $db->prepare($szSelectSQL);
			$szStmtSQL->bindParam("title_id", $nTitleID);
			$szStmtSQL->bindParam("leadership_trait_id", $nLeadershipTraitID);
			$dbObj = $this -> db -> getDBHandle()->prepare($query);
			$dbObj->execute();
			$arSmartGoal = $dbObj->fetchall(PDO::FETCH_OBJ);
		} catch (PDOException $e)
		{
			$objLogger->Log($e->getMessage());
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}
	}
	
	
	public function InsertSmartGoalRecommendation($objSmartGoalReco)
	{
		$szSQL = "Insert into res_user_relation 
						(smart_goal_id, email_address, relation_type, send_dt, send_status)
						values
						(:smart_goal_id, :email_address, :relation_type, :send_dt, :send_status)
						";
		try {
			$szStmt = $db->prepare($szSQL);  
			$szStmt->bindParam("smart_goal_id", $objTitle->smart_goal_id);
			$szStmt->bindParam("email_address", $objTitle->email_address);
			$szStmt->bindParam("relation_type", $objTitle->relation_type);
			$szStmt->bindParam("send_dt", $objTitle->send_dt);
			$szStmt->bindParam("send_status", $objTitle->send_status);
			$szStmt->execute();
		} catch(PDOException $e) {
			return false;
			$objLogger->Log($e->getMessage()); 
		}
		return true;
	}
	
	public function getUser($szUserName,&$arUserRecord)
	{
		$szSelectSQL = "SELECT * FROM res_user 
							where username = :user_name ";
		try
		{
			$szStmtSQL = $db->prepare($szSelectSQL);
			$szStmtSQL->bindParam("username", $szUserName);
			$dbObj = $this -> db -> getDBHandle()->prepare($query);
			$dbObj->execute();
			$arUserRecord = $dbObj->fetchall(PDO::FETCH_OBJ);
		} catch (PDOException $e)
		{
			$objLogger->Log($e->getMessage());
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}

	}
	public function InsertUser($objSmartGoalReco)
	{
		$szSQL = "Insert into res_user 
						(username, password,email,activ_status,activ_key)
						values
						(:user_name, :password, :email_address, :activ_status, :activ_key)
						";
		try {
			$szStmt = $db->prepare($szSQL);  
			$szStmt->bindParam("username", $objTitle->user_name);
			$szStmt->bindParam("password", $objTitle->password);
			$szStmt->bindParam("email", $objTitle->email_address);
			$szStmt->bindParam("activ_status", $objTitle->activ_status);
			$szStmt->bindParam("activ_key", $objTitle->activ_key);
			$szStmt->execute();
		} catch(PDOException $e) {
			return false;
			$objLogger->Log($e->getMessage()); 
		}
		return true;
	}
	
	public function UpdateUser($objSmartGoalReco)
	{
		$szSQL = "update res_user set
						username = :user_name,
						password = :password,
						email = :email_address,
						activ_status = :activ_status,
						activ_key = :activ_key
					where id = :user_id
						";
		try {
			$szStmt = $db->prepare($szSQL);  
			$szStmt->bindParam("username", $objTitle->user_name);
			$szStmt->bindParam("password", $objTitle->password);
			$szStmt->bindParam("email", $objTitle->email_address);
			$szStmt->bindParam("activ_status", $objTitle->activ_status);
			$szStmt->bindParam("activ_key", $objTitle->activ_key);
			$szStmt->execute();
		} catch(PDOException $e) {
			return false;
			$objLogger->Log($e->getMessage()); 
		}
		return true;
	}	
	
}
?>
