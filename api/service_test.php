
<html>
<head> Testing Web Services </head>
<body>
<?php
include_once ("CSiteGlobalConfig.class.php");
include_once ("CSiteLogger.class.php");

//require_once 'log4php/Logger.php';

echo "Inside PHP block";

$obj = new CSiteGlobalConfig();
$objLog = new CSiteLogger();

echo '<p> the name of the database is ' . $obj->getDBUserName() . '</p>';
echo 'After getting the user name';
$objLog->Log("I am testing");
?>
</body>
</html>
?>
