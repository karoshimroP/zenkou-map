<!DOCTYPE html>
<html lang="ja">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>善行確認ページ</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>

 <header><h1><a href="title_page.php">善行マップ</a></h1></header>
 <body>

   <!-- <script>
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
         center: new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $lng; ?>),
         zoom: 5
       });
       var infoWindow = new google.maps.InfoWindow;

         // Change this depending on the name of your PHP or XML file
         downloadUrl('zen_map_xml.php', function(data) {
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
     </script> -->
     <?php

       $lat = ($_POST["lat"]);
       $lng = ($_POST["lng"]);
       $reaction = ($_POST["reaction"]);
       ?>
     <?php require("re_geocording_test.php");?>
<dl>
    <dd><?php echo $date = ($_POST["date"]), "<br>";?></dd>
    <dd><?php echo $address, "<br><br>";?></dd>
     <dt><?php echo $summary = ($_POST["summary"]), "<br>";?></dt>
        <dd><?php echo $detail = ($_POST["detail"]), "<br><br>";?></dd>

  </dl>



  <form name="form" action="zenkou_touroku2.php" method="POST">
      <input type="hidden" name="summary" value="<?php echo $summary ?>">
      <input type="hidden" name="detail" value="<?php echo $detail ?>">
      <input type="hidden" name="date" value="<?php echo $date ?>">
      <input type="hidden" name="lat" value="<?php echo $lat ?>">
      <input type="hidden" name="lng" value="<?php echo $lng ?>">
      <input type="hidden" name="reaction" value="<?php echo $reaction ?>">
      <input type="hidden" name="address" value="<?php echo $address ?>">
      <input type="submit" value="念押し">
    </form>
  </body>
</html>
