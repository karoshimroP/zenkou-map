<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>送信確認ページ</title>
<body>


<?php
require_once ("zenkou_account.php");
//各要素を変数に代入
$summary = ($_POST["summary"]);
$detail = ($_POST["detail"]);
$date = ($_POST["date"]);
$lat = ($_POST["lat"]);
$lng = ($_POST["lng"]);
$reaction = ($_POST["reaction"]);

//sqlコード
$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "INSERT list (summary, detail, date, lat, lng, reaction) VALUES
('$summary', '$detail', '$date', '$lat', '$lng', '$reaction')";
$stm = $pdo->prepare($sql);
$stm->execute();

echo "送信完了";


?>
<form action="zenkou_map_list.html" method="post">
<input type="submit" value="マップへ"><br>
</form>
<form action="zenkou_touroku.html" method="post">
<input type="submit" value="登録画面へ"><br>
</form>

</body>
</head>
</html>
