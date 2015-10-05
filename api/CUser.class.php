<?php
include_once ("CSiteFactoryDB.class.php");
include_once ("CSiteLogger.class.php");
class CUser
{
	public function InsertNewUser()
	{
	}
	public function ActivateUser()
	{
	}
	public function LoginUser($objUser)
	{
		$username=mysql_real_escape_string($objUser->UserName);
		$password=mysql_real_escape_string($objUser->password);
	}
	
}
?>
