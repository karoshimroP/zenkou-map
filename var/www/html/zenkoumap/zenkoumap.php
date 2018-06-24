<style>
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    height: 50%;
  }
  /* Optional: Makes the sample page fill the window. */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }
</style>
</head>

<body>
<div id="map"></div>

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
      center: new google.maps.LatLng(38.705677, 139.717468),
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

    // var markerCluster = new MarkerClusterer(map, marker,
    //             {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});


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
