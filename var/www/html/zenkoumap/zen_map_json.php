
<html>
	<head>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</head>

<?php
require("zenkou_account.php");

function parseToXML($htmlStr)
{
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

// Opens a connection to a MySQL server
$connection=mysqli_connect ($host, $user, $password, $dbName);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

mysqli_query($connection, 'SET NAMES utf8');

// Set the active MySQL database
//$db_selected = mysqli_select_db($database, $connection);
//if (!$db_selected) {
//  die ('Can\'t use db : ' . mysqli_error());
//}

// Select all the rows in the markers table
$query = "SELECT * FROM list WHERE 1";
$result = mysqli_query($connection, $query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

echo var_export($result,true);

echo "<hr>";

// header("Content-type: text/json");

$data = [];

while ($row = @mysqli_fetch_assoc($result)){
	$data[]= $row;
}

$data = json_encode($data,true);

echo $data;

echo "<hr>";

$data_array = json_decode($data, true);

echo "<code>".var_dump($data_array,true)."</code>";

?>

</html>