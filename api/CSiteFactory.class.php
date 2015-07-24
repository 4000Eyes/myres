<? php
include_once ("Config.inc.php");
include_once("CSiteFactoryDB.class.php");


class CSiteFactory
{
	private $objCacheFactoryDB;
	private $objMemCache;
	private $szMemCacheHost;
	private $szMemCachePort;
	
	
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
		$this->objCache = getCompany($arCompany);
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
	
	public function getCompanyInfoByID($nCompanyId)
	{
		return ($objMemCache->get("4000Eyes-Company-".$szKey);
	}
	
	public function getCompanyInfoByName($szName)
	{
	}
}

?>
