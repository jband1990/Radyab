<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'/>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no'/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet'/>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v2.0.0/mapbox-gl-directions.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet' />
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=Ur9d5vwfWAXrHbYEMfLN5LOD06o7OdHj"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=Ur9d5vwfWAXrHbYEMfLN5LOD06o7OdHj"></script>
    <link rel="stylesheet" href="css/persian-datepicker.min.css"/>
    <style>
        #controll{
            height 20%;
            border-bottom: 1px solid #ccc;
        }
        body {
            margin: 0;
            padding: 0;
           font: 12px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif;
            direction: rtl;
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
        .datePicker{
            width:100px !important;
        }
    </style>
    <?php
    require_once './BL/PositionManager.php';
    require_once 'persian_calendar.php';
    if(isset($_GET['submit'])){
        $persian_calendar=new persian_calendar();
        $startdate=$persian_calendar->convert($_GET['startdate']);
        $enddate=$persian_calendar->convert($_GET['enddate']);
        $startdate = explode('/', $startdate);
        $enddate = explode('/', $enddate);
        if((is_array ($startdate)) && (count($startdate)==3)) {
            $startdate = $persian_calendar->p2g(($startdate[0]), ($startdate[1]), ($startdate[2]));
            $startdate = $startdate[0] . '/' . $startdate[1] . '/' . $startdate[2];
        }else{
            $startdate='';
        }
        if((is_array ($enddate)) && (count($enddate)==3)) {
            $enddate = $persian_calendar->p2g(($enddate[0]), ($enddate[1]), ($enddate[2]));
            $enddate = $enddate[0] . '/' . $enddate[1] . '/' . $enddate[2];
        }else{
            $enddate='';
        }
        $query =getPositionByDate($startdate,$enddate);

    }else{
        $query =TodayTime(8);
    }
    $lastposition = lastrecord(8);
    $devicePositions=getPositionAsJson($query);
    $devicePositionsDet=getPositionDetailsAsJson($query);
    ?>
    <script type="text/javascript">
        var devicePositions =  <?=$devicePositions  ?>;
        var devicePositionsDet = <?=$devicePositionsDet  ?>;
//var devicePositions=[[51.66554,32.62231],[51.67116,32.62212]];
    </script>
</head>
<body>
<div id='map'></div>
<div class="controll">
    <form >
<!--        <label for="enddate">تاریخ پایان</label>-->
        <input type="text" class="datePicker" id="startdate" name="startdate" autocomplete="off" placeholder="تاریخ شروع" >
        <!--        <label for="startdate">تاریخ شروع</label>-->
        <input type="text" class="datePicker" id="enddate" name="enddate"  autocomplete="off" placeholder="تاریخ پایان" >
<!--        <input type="text" class="date-picker" />-->
        <input type="checkbox" name="speed" value="1"> سرعت غیر مجاز
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/persian-date.min.js"></script>
        <script src="scripts/persian-datepicker.min.js"></script>
        <input type="submit"  value="گزارش" name="submit">
    </form>
</div>
<script src="scripts/mapquest.js?<?= rand(1,5252525)?>" >
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".datePicker").pDatepicker({
            initialValue: false,
            "format":"l",'persianDigit':true,
            'position': [22,-95]
        });
    });
</script>
<script> // create a HTML element for each feature
//    var el = document.createElement('div');
//    el.className = 'marker';

//   mysqli_data_seek($query,0);
//   while ($row = mysqli_fetch_assoc($query)) {?>
//    var marker =  L.marker([<?//=$row['latitude'].','.$row['longitude']?>//], { title: "آخرین موقعیت" });
//    {
//    marker.bindPopup('This is Tutorialspoint').openPopup();
//    marker.addTo(map);

        CustomRouteLayer = MQ.Routing.RouteLayer.extend({
            createStopMarker: function(location, stopNumber) {
                var custom_icon,
                    marker;

                custom_icon = L.icon({
                    iconUrl: 'https://www.mapquestapi.com/staticmap/geticon?uri=poi-red_1.png',
                    iconSize: [20, 29],
                    iconAnchor: [10, 29],
                    popupAnchor: [0, -29],
                    size: 'md'
                });
                marker = L.marker(location.latLng, { icon: custom_icon })
                    .bindPopup('در تاریخ :'+devicePositionsDet[stopNumber-1].createDate+' '+'در زمان :'+devicePositionsDet[stopNumber-1].createTime + ' سرعت شما :' + devicePositionsDet[stopNumber-1].speed +' '+'کیلومتر بر ساعت')
                    .openPopup()
                    .addTo(map);
                return marker;
            }
        });

        map.addLayer(new CustomRouteLayer({
            directions: dir,
            fitBounds: true,
            draggable: false,
            ribbonOptions: {
                draggable: false,
                ribbonDisplay: { color: '#CC0000', opacity: 0.3 },
                widths: [ 15, 15, 15, 15, 14, 13, 12, 12, 12, 11, 11, 11, 11, 12, 13, 14, 15 ]
            }
        }));
</script>
</body>
</html>