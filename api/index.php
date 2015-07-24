<?php

require 'Slim/Slim.php';
require '../site/functions.php';

$app = new Slim();

$app->post('/accomplishment', 'InsertAccomplishment');
$app->get('/accomplishment/search/:query', 'getTitlesFromCache');

$app->run();

// Generate Guid
function NewGuid() {
    $s = strtoupper(md5(uniqid(rand(),true)));
    $guidText =
        substr($s,0,8) .
        substr($s,8,4) .
        substr($s,12,4).
        substr($s,16,4).
        substr($s,20);
    return $guidText;
}
// End Generate Guid


function getTitlesFromCache($keyword)
{
	$sql = "SELECT title_name FROM eff_title where lower(title_name) like :query order by title_name";
	error_log("I am inside the function");
try
{
	$dbhandle = new SQLite3('../data/effres.db'); 
	if (!$dbhandle) die ($error);
	$stmt = $dbhandle->prepare($sql);
	$keyword = "%" . $keyword . "%";
	$stmt->bindValue("query", $keyword);
	$result = $stmt->execute();
	$rows = count($result);
	error_log("After execution" . $rows);
	while ($row = $result->fetchArray()) {
		error_log("The values are ". $row['title_name']);
		json_encode($row['title_name']) ; 
	}
}
catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function InsertAccomplishment() {
	$request = Slim::getInstance()->request();
	$objAccomplishment = json_decode($request->getBody());
	$sql = "INSERT INTO user_accomplishment 	
		(user_id, company_id, accomplishment_id, accomplishment_desc) 
		VALUES (:user_id, :company_id , :accomplishment_id, :accomplishment_desc)";
	$objAccomplishment->accomplishment_desc = _cleanup_text($objAccomplishment->accomplishment_desc);
	error_log("The sql is ". $sql) ;
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("user_id", $objAccomplishment->user_id);
		$stmt->bindParam("company_id", $objAccomplishment->company_id);
		$szGuid = NewGuid();
		$stmt->bindParam("accomplishment_id", $szGuid);
		$stmt->bindParam("accomplishment_desc", $objAccomplishment->accomplishment_desc);
		$stmt->execute();
		$db = null;
		echo json_encode($objAccomplishment); 
	} catch(PDOException $e) {
		error_log($e->getMessage());
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


function updateAccomplishment() {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$wine = json_decode($body);
	$sql = "UPDATE user_accomplishment SET accomplishment_desc=:accomplishment_desc WHERE user_id=:user_id and company_id=:company_id and accomplishment_id=:accomplishment_id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("accomplishment_desc", $wine->accomplishment_desc);
		$stmt->bindParam("user_id", $user_id);
		$stmt->bindParam("company_id", $company_id);
		$stmt->bindParam("accomplishment_id", $accomplishment_id);
		$stmt->execute();
		$db = null;
		echo json_encode($wine); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteAccomplishment() {
	$request = Slim::getInstance()->request();
	$objAccomplishment = json_decode($request->getBody());
	$szObj = json_decode($objAccomplishment);
	$sql = "DELETE FROM user_accomplishment WHERE user_id=:user_id and company_id=:company_id and accomplishment_id=:accomplishment_id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("user_id", $user_id);
		$stmt->bindParam("project_id", $project_id);
		$stmt->bindParam("accomplishment_id", $accomplishment_id);
		$stmt->execute();
		$db = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


function InsertCompany() {
	$request = Slim::getInstance()->request();
	$objAccomplishment = json_decode($request->getBody());
	$sql = "INSERT INTO eff_company 	
		( company_id, company_name, company_country) 
		VALUES (:company_id , :company_name, :company_country)";
	$objAccomplishment->company_name = _cleanup_text($objAccomplishment->company_name);
	error_log("The sql is ". $sql) ;
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("company_id", $objAccomplishment->company_id);
		$stmt->bindParam("company_name", $objAccomplishment->company_name);
		$stmt->bindParam("company_country", $objAccomplishment->country);
		$stmt->execute();
		$db = null;
		echo json_encode($objAccomplishment); 
	} catch(PDOException $e) {
		error_log($e->getMessage());
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


function updateCompany() {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$wine = json_decode($body);
	$sql = "UPDATE eff_company SET company_name=:company_name, company_country=:company_country WHERE company_id=:company_id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("company_name", $wine->company_name);
		$stmt->bindParam("company_country", $wine->company_country);
		$stmt->bindParam("company_id", $company_id);
		$stmt->bindParam("accomplishment_id", $accomplishment_id);
		$stmt->execute();
		$db = null;
		echo json_encode($wine); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteCompany() {
	$request = Slim::getInstance()->request();
	$objAccomplishment = json_decode($request->getBody());
	$szObj = json_decode($objAccomplishment);
	$sql = "DELETE FROM eff_company WHERE company_id=:company_id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("company_id", $company_id);
		$stmt->execute();
		$db = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function findByName($query) {
	$sql = "SELECT * FROM wine WHERE UPPER(name) LIKE :query ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$query = "%".$query."%";  
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"wine": ' . json_encode($wines) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}



function getConnection() {
	$dbhost="127.0.0.1";
	$dbuser="root";
	$dbpass="krishna123";
	$dbname="effres";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>
