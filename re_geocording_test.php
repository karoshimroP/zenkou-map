<html>
<head>
</head>
<body>
<script>
function codeLatlng(){
        //現在地取得
        var mapcenter = map.getCenter();
        var latlng = new google.maps.LatLng(35.705145, 139.7172117);
        if (geocoder) {
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    document.getElementById("rv_adrname").value = results[0].formatted_address;
                }else{
                    alert("Geocoder failed due to: " + status);
                }
            });
        }
    }
    </script>
    <div>
        <input type="button" value="逆ジオコーディング→" onclick="codeLatlng()" onkeypress="codeLatlng()" />
        　住所：<input type="text" size="50" id="rv_adrname" value="" />
    </div>
  </body>
</html>
