<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset = "utf-8">
  <title>検索結果</title>
</head>
<body>


<?php

//sqlデータベースに接続
require("zenkou_account.php");
//require_once("zenkou_kensaku.php");

$kensaku = ($_POST["kensaku"]);

$connection=mysqli_connect ('localhost', $user, $password, $dbName);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

//入力されたデータをデータベースから検索して取得する
$query = "SELECT * FROM list WHERE summary LIKE '%{$kensaku}%'
OR detail LIKE '%{$kensaku}%' ";
$result = mysqli_query($connection, $query);
// セッションに値を代入する変数を定義しておく
function sousin($id){
$_SESSION["id"] = $id;
  }

while ($row = @mysqli_fetch_assoc($result)){



  ?>
<a href="kobetu_map.php?id=<?=$row['id']?>" onclick="sousin(<?=$row['id']?>)" >
  <?php echo ($row["summary"]);
  //  $_SESSION["id"] = $row['id']; ?>
</a>
<!-- <form method=POST action="kobetu_xml.php">
  <input type=hidden name="id" value="<?=$row['id']?>">
</form> -->

<!--
<form name = "myForm" method = "POST" action="test1.php">
  <input type="hidden" name="id" value="<?php // $row["id"] ?>">
  <a href="#" onclick="document.myForm.submit();"; return false;>
    <?php // echo ($row["summary"])?>
  </a>
</form>
-->

<?php

echo ($row["id"]),"\n";
echo ($row["detail"]),"\n";
echo ($row["date"]),"\n";

$reaction = ($row["reaction"]);

switch($reaction){
  case 1:
    echo "感謝", "<br>";
    break;
  case 2:
    echo "尊敬","<br>";
    break;
  case 3:
    echo "謝罪", "<br>";
    break;
}
}

?>
<!-- 登録画面へ -->
</form>
<form action="zenkou_touroku.html" method="post">
<input type="submit" value="登録画面へ"><br>
</form>

</body>
</html>
