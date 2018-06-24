<!DOCTYPE html>
<html lang="ja">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>善行入力フォーム</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>

 <header><h1><a href="title_page.php">善行マップ</a></h1></header>
<script>


// ユーザーの端末がGeoLocation APIに対応しているかの判定

// 対応している場合
if( navigator.geolocation )
{
	// 現在地を取得


	navigator.geolocation.getCurrentPosition(

		// [第1引数] 取得に成功した場合の関数
		function( position )
		{
			// 取得したデータの整理
			var data = position.coords ;
			// データの整理
			var lat = data.latitude ;
			var lng = data.longitude ;

			// HTMLへの書き出し
			// document.getElementById( 'result' ).innerHTML = '<dl><dt>緯度</dt><dd>' + lat + '</dd><dt>経度</dt><dd>' + lng + '</dd><dt>高度</dt><dd>' + alt + '</dd><dt>緯度、経度の精度</dt><dd>' + accLatlng + '</dd><dt>高度の精度</dt><dd>' + accAlt + '</dd><dt>方角</dt><dd>' + heading + '</dd><dt>速度</dt><dd>' + speed + '</dd></dl>' ;
      document.getElementById( 'lat' ).value = lat;
      document.getElementById( 'lng' ).value = lng;
		},

		// [第2引数] 取得に失敗した場合の関数
		function( error )
		{
			// エラーコード(error.code)の番号
			// 0:UNKNOWN_ERROR				原因不明のエラー
			// 1:PERMISSION_DENIED			利用者が位置情報の取得を許可しなかった
			// 2:POSITION_UNAVAILABLE		電波状況などで位置情報が取得できなかった
			// 3:TIMEOUT					位置情報の取得に時間がかかり過ぎた…
			// エラー番号に対応したメッセージ
			var errorInfo = [
				"原因不明のエラーが発生しました…。" ,
				"位置情報の取得が許可されませんでした…。" ,
				"電波状況などで位置情報が取得できませんでした…。" ,
				"位置情報の取得に時間がかかり過ぎてタイムアウトしました…。"
			] ;

			// エラー番号
			var errorNo = error.code ;
			// エラーメッセージ
			var errorMessage = "[エラー番号: " + errorNo + "]\n" + errorInfo[ errorNo ] ;

		} ,

		// [第3引数] オプション
		{
			"enableHighAccuracy": false,
			"timeout": 100000,
			"maximumAge": 0,
		}

	) ;
}

// 対応していない場合
else
{
	// エラーメッセージ
	var errorMessage = "お使いの端末は、GeoLocation APIに対応していません。" ;
	// アラート表示
	alert( errorMessage ) ;
}
//現在時刻を取得
function pTime()
{
	dt = new Date();
  mt  = dt.getMonth() + 1;
  d  = dt.getDate();
	h  = dt.getHours();
	m  = dt.getMinutes();
	// s  = dt.getSeconds();
	document.form.date.value = mt+"月"+d+"日　"+h+"時"+m+"分";

}

</script>

<body onLoad="pTime()">
  <form name="form" action="touroku_kakunin.php" method="POST">

    <input type="text" placeholder="どんな人？" name="summary"><br><br>

      <label class="control-label" for="InputText">概要</label><br>
        <textarea rows="5" placeholder="" class="form-control" name="detail"></textarea><br>

    <input type="hidden" name="date">

    <!-- リアクション<input type="text" name="reaction"><br> -->
    <select name="reaction" action="zenkou_touroku2.php" method="post">
      <option value="1" selected>感謝</option>
      <option value="2">尊敬</option>
      <option value="3">謝罪</option>
    </select>の念を込めて
    <input type="submit" value="記録する"><br><br>
    <p>座標を取得します。</p>

<div class="form-inline">
      <input type="text" class="form-control" name="lat" id="lat" readonly>


      <input type="text" class="form-control" name="lng" id="lng" readonly>

</div>
  </form>


</body>
<?php require_once("footer.php") ?>
</html>
