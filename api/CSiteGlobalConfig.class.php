<?php

class CSiteGlobalConfig
{
	private static $__arGlobalConfigArray;
	private function Init()
	{
		error_reporting(E_ALL);
		
		self::$__arGlobalConfigArray = [];
		
		if (self::$__arGlobalConfigArray)
			return true;
		try
		{
			self::$__arGlobalConfigArray = parse_ini_file("site.ini",1);
		} catch (Exception $e)
		{
			print "error in parsing the file $e->getMessage();";
			return false;
		}
		
		//print_r($this->__arGlobalConfigArray);
		return true;
	}
	
	public function getDBUserName()
	{
			if ( $this->Init())
				return self::$__arGlobalConfigArray['database']['db_username'];
			return '';
	}
	
/*
	public function getDBPassword()
	{
		if ( $this::Init())
			return $__arGlobalConfigArray["db_password"];
		return '';
	}
	
	public function getDBHost()
	{
		if ($this->Init())
			return $__arGlobalConfigArray["db_host"];
		return '';
	}
	
	public function getDBSchema()
	{
		if ( $this->Init() )
			return $__arGlobalConfigArray["db_schema"] ;
		return '';
	}
	
	public function getMemCacheHost()
	{
		if ( $this->Init() ) 
			return $__arGlobalConfigArray["memcache_host"] ;
		return '';
	}
	
	public function getMemCachePort()
	{
		if ( $this->Init() ) 
			return $__arGlobalConfigArray["memcache_port"] ;
		return '';
	}
	
	*/
	
	public function getLogPath()
	{
			if ( $this->Init())
				return self::$__arGlobalConfigArray['logs']['site_log'];
			return '';
	}
}

?>
