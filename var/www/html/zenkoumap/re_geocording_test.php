<?php

/*
** 緯度経度取得及び設定
*/
$latlngs = array();

$latlngs = [
 ["$lat", "$lng"]
];

/*
** jsonデータ取得
*/
$GMADs = array();

foreach ($latlngs as $latlng) {
 $GMADs[] = json_decode(@file_get_contents('http://maps.google.com/maps/api/geocode/json?latlng=' . $latlng[0] . ',' . $latlng[1] . '&sensor=false&language=ja'), true);
}

/*
** 住所取得
*/

foreach ($GMADs as $GMAD) {
 $address = $GMAD['results'][0]['address_components'][5]['long_name'].$GMAD['results'][0]['address_components'][4]['long_name'];
}
