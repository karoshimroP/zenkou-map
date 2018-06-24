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
$connection=mysqli_connect ('localhost', $user, $password, $dbName);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

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

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'summary="' . parseToXML($row['summary']) . '" ';
  echo 'detail="' . parseToXML($row['detail']) . '" ';
  echo 'date="' . parseToXML($row['date']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'reaction="' . $row['reaction'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
