<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>善行マップ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <?php require("header.php");?>
</head>
<body>


  <?php require("zenkoumap.php") ?>

    <?php require("button.php") ?>

<!-- クラスター表示のscript -->
<!-- <script src="cluster.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

</body>
<?php require_once("footer.php") ?>
</html>
