
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>検索結果</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>

<header><h1><a href="title_page.php">善行マップ</a></h1></header>

<body>


<?php

//sqlデータベースに接続
require("zenkou_account.php");
//require_once("zenkou_kensaku.php");
if(isset($_POST["title"])){
        $kensaku = ($_POST["title"]);

      $connection=mysqli_connect ('ttjs.ctimigi6vjbg.ap-northeast-1.rds.amazonaws.com', 'root', 'medialive2008', 'zenkoumap');
      if (!$connection) {
        die('Not connected : ' . mysql_error());
      }

      mysqli_query($connection, 'SET NAMES utf8');

      //入力されたデータをデータベースから検索して取得する
      $query = "SELECT * FROM list WHERE summary LIKE '%{$kensaku}%'
      OR detail LIKE '%{$kensaku}%' ";
      $result = mysqli_query($connection, $query);

} else if (isset($_POST["free"])){

      $kensaku = ($_POST["free"]);

      $connection=mysqli_connect ('ttjs.ctimigi6vjbg.ap-northeast-1.rds.amazonaws.com', 'root', 'medialive2008', 'zenkoumap');
      if (!$connection) {
        die('Not connected : ' . mysql_error());
      }

      mysqli_query($connection, 'SET NAMES utf8');

      //入力されたデータをデータベースから検索して取得する
      $query = "SELECT * FROM list WHERE summary LIKE '%{$kensaku}%'
      OR detail LIKE '%{$kensaku}%' ";
      $result = mysqli_query($connection, $query);
}else{
  echo "入力してください。";
}
  ?>
<div class="alt-table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th class0="col-xs-">タイトル</th>
        <th>詳細</th>
        <th>日時</th>
        <th>反応</th>
        <th>共感</th>
      </tr>
    </thead>
    <tbody>
<?php while ($row = @mysqli_fetch_assoc($result)){



  ?>
<tr>
  <th>
<a href="kobetu_map.php?id=<?php echo $row['id']; ?>" onclick="sousin(<?php echo $row['id']; ?>)" >
  <?php echo ($row["summary"]); ?>
</a></th>





<!-- <td><?php echo ($row["id"]),"\n";?></td> -->
<td><?php echo substr(($row["detail"]), 0,10),"\n";?></td>
<td><?php echo ($row["date"]),"\n";?></td>
<td><?php
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
?>
</td>
<td><?php echo ($row["kyoukan"]),"\n";?>
</tr>
<?php
}

?>
</tbody>
</table>
</div>
<!-- 登録画面へ -->
</form>
<form action="zenkou_touroku.php" method="post">
<input type="submit" value="登録画面へ"><br>
</form>
<?php require_once("footer.php") ?>
</body>
</html>
