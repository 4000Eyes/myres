<?php

include_once("CSiteGlobalConfig.class.php");
require_once 'log4php/Logger.php';

class CSiteLogger
{
	private $objSiteConfig;
	private $szLogPath;
	private $objLogger;
	
	private function Init()
	{
		try
		{
			$this->objSiteConfig = new CSiteGlobalConfig();
			$this->szLogPath = $this->objSiteConfig->getLogPath();
			echo "The log path is " . $this->szLogPath;
			Logger::configure($this->szLogPath);
			$this->objLogger = Logger::getLogger('myLogger');
		} catch (Exception $e)
		{
			error_log("Unable to open the site log with the given path" . $e->getMessage());
			exit;
		}
	}
	
	public function Log($szMessage)
	{
		if (! $this->objLogger)
			$this->Init();
		try
		{
			$this->objLogger->error($szMessage);
		} catch (Exception $e)
		{
			echo "error: " . $e->getMessage();
		}
	}
	
}

?>
