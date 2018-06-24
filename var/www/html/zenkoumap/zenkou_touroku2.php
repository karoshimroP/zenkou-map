<!DOCTYPE html>
<html lang="ja">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">

  <title>送信確認ページ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
 <header><h1><a href="title_page.php">善行マップ</a></h1></header>
<body>

<?php

ini_set( 'display_errors', 1 );

require_once ("zenkou_account.php");
//各要素を変数に代入

$summary = $_POST["summary"];
$detail = $_POST["detail"];
$date = $_POST["date"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$reaction = $_POST["reaction"];
$address = $_POST["address"];

//sqlコード
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "INSERT list (summary, detail, date, lat, lng, reaction, address) VALUES
('$summary', '$detail', '$date', '$lat', '$lng', '$reaction', '$address')";
$stm = $pdo->prepare($sql);
$stm->execute();

echo "送信完了";


?>
<!-- <form action="zenkou_map_list.php" method="post">
<input type="submit" value="マップへ"><br>
</form>
<form action="zenkou_touroku.php" method="post">
<input type="submit" value="登録画面へ"><br> -->
</form>
<?php require_once("footer.php") ?>
</body>
</head>
</html>
