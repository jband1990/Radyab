<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'/>
    <title></title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no'/>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet'/>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
    <?php
    require_once './BL/PositionManager.php';
    $positions = getAllPosition(8);
    $positionsStr = '';
    while ($row = mysqli_fetch_assoc($positions)) {

      $positionsStr .= '[' .$row["longitude"].','.$row["latitude"].'],';
    }
    $positionsStr ='['.rtrim($positionsStr,',').']';
    ?>
    <script type="text/javascript">
        var devicePositions =  <?=$positionsStr ?>
//var devicePositions=[[51.66554,32.62231],[51.67116,32.62212]];
    </script>
</head>
<body>
<div id='map'></div>
<script src="scripts/App.js?a=3" >
</script>
</body>
</html>