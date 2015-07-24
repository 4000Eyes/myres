<?php
   
$dbhandle = new SQLite3('data/effres.db'); 

if (!$dbhandle) die ($error);
    
$query = "SELECT title_name FROM eff_title";
$result = $dbhandle->query($query);
if (!$result) die("Cannot execute query.");
while ($row = $result->fetchArray()) {
	//echo $row[title_name];
	echo json_encode($row['title_name']);
	echo '<br>';
}
?>
