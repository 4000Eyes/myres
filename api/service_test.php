<html>
<head> Testing Web Services </head>
<body>
<?php
require ("CSession.class.php");
$session = new CSession();
$session->start_session('_s', false);
$_SESSION['Name'] = 'Narayana';

echo "The session id is " . $_SESSION['Name'];
/*
 * include_once ("CSiteLogger.class.php");
include_once ("CSiteFactory.class.php");

//require_once 'log4php/Logger.php';

echo "Inside PHP block";

$arFeedback = array( array(test=>"krishnan", tt=>0), array(test=>"kris", tt=>1));

$je = json_encode($arFeedback);

echo $je . "<br/>";

$obj = array();

$obj = json_decode($je, true);

echo "Number of rows" . count($obj) . "<br/>";
	
for ($row = 0; $row < count($obj); $row++)
{
	echo "The name is " . $obj[$row]["test"] . "<br/>";
}


$objLog = new CSiteLogger();
$objSiteFactory = new CSiteFactory();

echo 'After getting the user name';
$objLog->Log("I am testing");
echo "After instantiating Site DB";
*/



?>
</body>
</html>
