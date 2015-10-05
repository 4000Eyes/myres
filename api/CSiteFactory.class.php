<?php

include_once("CSiteFactoryDB.class.php");
include_once ("CSmartGoal.class.php");
include_once ("CUser.class.php");
class CSiteFactory
{
	private $objCacheFactoryDB;
	private $objMemCache;
	private $szMemCacheHost;
	private $szMemCachePort;
	
/*	
	function __construct()
	{
	
			$this->objCacheFactoryDB = new CSiteFactoryDB();
			$this->szMemCacheHost = host_memcache;
			$this->szMemCachePort = port_memcache;
	
	}
	
	public function InitCache()
	{
		$objMemCache = new Memcache;
		$objMemCache->connect($szMemCacheHost, $szMemCachePort);
		
	}
	
	private function loadCompanyCache()
	{
		my $arCompany = array();
		$this->objCache = objCacheFactoryDB->getCompany($arCompany);
		if ($arCompany)
		{
			foreach ( $arCompany as $arRow)
			{
				my $szKey = "4000Eyes-Company-" . $arRow[0];
				my $szValue = $arRow[1];
				$objMemCache->set($szKey, $szValue);
			}
		}
	}
	
	private function loadSmartGoals()
	{
		my $arCompany = array();
		$this->objCache = objCacheFactoryDB->getSmartGoals();
		if ($arCompany)
		{
			foreach ( $arCompany as $arRow)
			{
				my $szKey = "4000Eyes-Company-" . $arRow[0].$arRow[1];
				my $szValue = $arRow[1];
				$objMemCache->set($szKey, $szValue);
			}
		}	
	}
	public function getCompanyInfoByID($nCompanyId)
	{
		return ($objMemCache->get("4000Eyes-Company-".$szKey);
	}
	
	public function getCompanyInfoByName($szName)
	{
	}
	
	*/
	
	public function processRequest($objRequestArr)
	{
		// Process the user first
		
		// ProcessUser($objRequestArr)
		
		/*** structure of JSON for Request Type = PSG -- process (P) smart (S) Goals (G)
		 * 
		 * RequestType, LeadershipTraitType, UserID, SmartGoalDesc, CompanyID
		 */
		 
		if ($objRequestArr->RequestType == 'PSG') //Process Smart Goal
		{
			$objSmartGoal = new CSmartGoal();
			$objSmartGoal->processRequest($objRequestArr);
		}
		elseif ($objRequestArr->RequestType == 'GST') //Get Smart Goal Template
			{echo "GST";}
		elseif ($objRequestArr->RequestType == 'GT') //Get Title
			{echo "GT";}
			
		else
			{echo "AP";}	
		
	}
	
	private function ManagerUserSession($objRequestArr)
	{
		$objUser = new CUser();
		if ($objRequestArr->RequestType == 'NU') //New User
		{
			if ($objUser->InsertUser($objRequestArr) == false)
			{
				return false;
			}
		}
		elseif ($objRequestArr->RequestType == 'AU') // Activate User
		{
		}
		elseif ($objRequestArr->RequestType == 'LU') //Login User
		{
		}
		return true;
	}
}

?>
