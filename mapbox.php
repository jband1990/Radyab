<?php


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'/>
    <title></title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet'/>
<!--    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v2.0.0/mapbox-gl-directions.js'></script>-->
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet' />
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=Ur9d5vwfWAXrHbYEMfLN5LOD06o7OdHj"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=Ur9d5vwfWAXrHbYEMfLN5LOD06o7OdHj"></script>

    <style>
        #controll{
            height 20%;
            border-bottom: 1px solid #ccc;
        }
        body {
            margin: 0;
            padding: 0;
           font: 12px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif;
        }


        #map {
            position: absolute;
            top: 20%;
            bottom: 0;
            width: 100%;
        }
        .marker {
            background-image: url('mapbox-icon.png');
            background-color: red;
            background-size: cover;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
    <?php
    require_once './BL/PositionManager.php';
    $positions = getAllPosition(8);
    $positionsStr = '';
    while ($row = mysqli_fetch_assoc($positions)) {
//        { latLng: { lat: 32.62217, lng: 51.66471 }}
      $positionsStr .= '{ latLng: { lat: ' .$row["latitude"].', lng:'.$row["longitude"].'}},';
    }
    $positionsStr ='['.rtrim($positionsStr,',').']';
    $lastposition=lastrecord(8);
    ?>
    <script type="text/javascript">
        var devicePositions =  <?=$positionsStr ?>
//var devicePositions=[[51.66554,32.62231],[51.67116,32.62212]];
    </script>
</head>
<body>
<div id='map'></div>
<div class="controll"></div>
<script src="scripts/mapquest.js?<?= rand(1,5252525)?>" >

</script>    <script> // create a HTML element for each feature
    var el = document.createElement('div');
    el.className = 'marker';
    L.marker([<?= $lastposition['latitude'].','.$lastposition['longitude']?>]).addTo(map);

    // make a marker for each feature and add to the map
//    new mapboxgl.Marker(el)
//        .setLngLat([-77.032, 38.913])
//        .addTo(map);

</script>
</body>
</html>