<?php

require_once ("zenkou_account.php");

//sqlコード
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['zid'];

$sql = "UPDATE list SET kyoukan=kyoukan+1 WHERE id='$id'";
$stm = $pdo->prepare($sql);
$stm->execute();

return "1up";

?>
