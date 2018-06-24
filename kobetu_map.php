<?php // session_start()?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
/*マップの高さを表示*/
      #map {
        height: 50%;
      }
/*bodyタグの適用範囲*/
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>



  <body>
    <header><h1><a href="title_page.php">善行マップ</a></h1></header>

    <!-- idにmapを指定 -->
      <div id="map"></div>
    <?php


// リンクから選んだidをGETで取得
     $id = $_GET["id"];
//  SESSIONでidを取得、ただ複数あると更新されてしまう
    // print_r ($_SESSION["id"]);
//アカウント取得
     require("zenkou_account.php");
// mysqlと接続
     $connection=mysqli_connect ('localhost', $user, $password, $dbName);
     if (!$connection) {
       die('Not connected : ' . mysql_error());
     }

// クエリ（命令）を設定のち、実行
     $query = "SELECT * FROM list WHERE id = " . $id;
     $result = mysqli_query($connection, $query);
// $rowに配列$resultを代入していく
     while ($row = @mysqli_fetch_assoc($result)){
       echo ($row["id"]),"\n";
       echo ($row["summary"]),"\n";
       echo ($row["lat"]),"\n";
       echo ($row["lng"]),"\n";
       echo ($row["detail"]),"\n";
       echo ($row["date"]),"\n";
       $lat = $row["lat"];
       $lng = $row["lng"];


    ?>

    <?php

    }

    ?>

    <script>
    //プルダウンメニューから送られてきた番号をアイコンに変換する
      var customLabel = {
        "1": {
          label: '感'
        },
        "2": {
          label: '尊'
        },
        "3": {
          label: '謝'
        },

      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
          zoom: 15
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('kobetu_xml.php?zid=' + <?=$id?>, function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('summary');
              var address = markerElem.getAttribute('detail');
              // var date = markerElem.getAttribute('date');
              var type = markerElem.getAttribute('reaction');
              //var type = "bar";
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              // var icon = customLabel[type] || {};
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }

        function downloadUrl(url, callback) {
          var request = window.ActiveXObject ?
              new ActiveXObject('Microsoft.XMLHTTP') :
              new XMLHttpRequest;

          request.onreadystatechange = function() {
            if (request.readyState == 4) {
              request.onreadystatechange = doNothing;
              callback(request, request.status);
            }
          };

          request.open('GET', url, true);
          request.send(null);
        }

        function doNothing() {}


</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7fD5SEmaSlPCLtmfoB0Es8sGtXOtcTZI&callback=initMap">
</script>
<?php echo $lat; ?>

</body>
</html>
