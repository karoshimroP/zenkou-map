<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>善行マップ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <title>善行検索ページ</title>
</head>

<header><h1><a href="title_page.php">善行マップ</a></h1></header>

<!-- 検索フォーム -->
<body>
  <p>タイトル検索</p>
  <form action="zenkou_kensaku_kekka.php" method="post">
    <input type="text" name="title">
    <input type="submit" value="検索">
  </form>
  <p>フリーワード検索</p>
  <form action="zenkou_kensaku_kekka.php" method="post">
    <input type="text" name="free">
    <input type="submit" value="検索">
  </form>
  <br>

<?php require_once("footer.php") ?>
</body>
</html>
