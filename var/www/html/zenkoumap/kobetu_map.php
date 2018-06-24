<!DOCTYPE html >
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <link href="css/bootstrap.min.css" rel="stylesheet">
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <title>Using MySQL and PHP with Google Maps</title>

    <style>
/*マップの高さを表示*/
      #map {
        height: 25%;
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

    ini_set( 'display_errors', 1 );

// リンクから選んだidをGETで取得
     $id = $_GET["id"];
//  SESSIONでidを取得、ただ複数あると更新されてしまう
    // print_r ($_SESSION["id"]);
//アカウント取得
     require("zenkou_account.php");
// mysqlと接続
     $connection=mysqli_connect ($host, $user, $password, $dbName);
     if (!$connection) {
       die('Not connected : ' . mysql_error());
     }
mysqli_query($connection, 'SET NAMES utf8');

if (isset($_GET['oneUp'])) {
  $sql = "UPDATE list SET kyoukan=kyoukan+1 WHERE id='$id'";
  $connection->query($sql);
}


// クエリ（命令）を設定のち、実行
     $query = "SELECT * FROM list WHERE id = " . $id;
     $result = mysqli_query($connection, $query);
// $rowに配列$resultを代入していく
     while ($row = @mysqli_fetch_assoc($result)){?>
       <div class="alt-table-responsive">
         <table class="table table-bordered">
           <h2 class="text-center"><?php echo ($row["summary"]);?>への<?php
                $reaction = ($row["reaction"]);

                switch($reaction){
                  case 1:
                    echo "\"感謝\"";
                    break;
                  case 2:
                    echo "尊敬";
                    break;
                  case 3:
                    echo "謝罪";
                    break;
                }
                ?></h2>


              </tr>
            </thead>
          </table>
        </div>
 <h4><?php echo ($row["detail"]), "<br><br>"; ?></h4>
 <p class="text-right"><?php echo ($row["address"]),"<br>";?>
 <?php echo ($row["date"]),"<br>";?></p>
       <?php
       $lat = $row["lat"];
       $lng = $row["lng"];
       $kyoukan = $row["kyoukan"];

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
          downloadUrl('kobetu_xml.php?zid=' + <?php echo $id; ?>, function(data) {
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

        function kyoukan(id) {
            downloadUrl('kyoukan_up.php?zid=' + id, function(data) {
              // console.log();
            });
        }
</script>

  <a href="kobetu_map.php?id=<?php echo $id; ?>&oneUp=1" type="button" class="btn btn-danger btn-lg btn-block">共感 <?php echo $kyoukan;?></a>
  <br>
  <a href="zenkou_itiran.php" type="button" class="btn btn-success"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> 戻る</a>

<?php require_once("footer.php") ?>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7fD5SEmaSlPCLtmfoB0Es8sGtXOtcTZI&callback=initMap">
</script>


</body>
</html>
