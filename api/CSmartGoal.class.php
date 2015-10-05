<?php

include_once ("CSiteFactoryDB.class.php");
include_once ("CSiteLogger.class.php");

class CSmartGoal
{
	private $szSmartGoalTemplates;
	private $objDB;
	private $objLogger;
	public function Init()
	{
		$this->objDB = new CSiteFactoryDB();
		$this->objLogger = new CSiteLogger();
		
	}
	private function getSmartGoalTemplate($nTitleId, $nLeadershipTrait)
	{
		return false;
	}
	
	public function processSmartGoal($objGoalArr)
	{
		$szStr = preg_replace('/[^a-z\d ]/i', '', $objGoalArr->SmartGoalDesc); // clean the string
		
		switch ($objGoalArr->LeadershipTraitID)
		{
			case 0: //hiring
				break;
			case 1: //execution or delivery
				break;
			case 2:// cost savings
				break;
			case 3: // Team building
				break;
			case 4: //promotions
				break;
			case 5: //software skills
				break;
			case 6: //education, diplomas
				break;
			case 7: //
				break;
		}
		
		$objContent = array();
		$objContent->user_id = $objGoalArr->UserID;
		$objContent->leadership_trait_id = $objGoalArr->LeadershipTraitID;
		$objContent->smart_goal_desc = $objGoalArr->SmartGoalDesc;
		$objContent->title_id = $objGoalArr->TitleID;
		$objContent->company_id = $objGoalArr->CompanyID;
		 
		if ( $objDB->InsertSmartGoal($objContent) == FALSE)
			return FALSE;
		return TRUE;
	}
	
	public function getSmartGoalTemplateByTitleAndTrait($nTitleID, $nLeadershipTrait, $arSmartGoal)
	{
		if ( $objDB->getSmartGoalByTitleAndTraitDB($nTitleID, $nLeadershipTrait) == FALSE)
			return FALSE;
		return TRUE;
	}
	
	public function getSmartGoalFeedback($objSmartGoalFeedback)
	{
	
		for ($row = 0; $row < count($objSmartGoalFeedback); $row++)
		{
			if ( $objDB->InsertSmartGoalRecommendation($objSmartGoalFeedback[$row]) == false)
			{
				$objLogger->Log("Smart Goal recommendation was not inserted into the DB for smart goal id" . $objSmartGoalFeedack[$row][0]);
				return false;
			}
		}
		return true;
	}	
}

?>
