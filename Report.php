<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report</title>
    <script type='text/javascript'
            src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ArEIhVba9nPri81YH_rHpDnvhCUtUn7WdKUte8NR5paEfk_iH9sfrF796EtOAO_L' async defer></script>

        <script type='text/javascript'>
            function GetMap()
            {
                var map = new Microsoft.Maps.Map('#map',{
                credentials: 'ArEIhVba9nPri81YH_rHpDnvhCUtUn7WdKUte8NR5paEfk_iH9sfrF796EtOAO_L',
                    center: new Microsoft.Maps.Location(32.622315,51.671060 ),
                    mapTypeId: Microsoft.Maps.MapTypeId.road,
                    zoom: 5
            });
            }
    </script>
    <style>
        .controll{
            height:100px;
            border-bottom:1px solid #ccc;
        }
        .map{
            position: absolute;
            top:100px;
            left:0px;
            right:0px;
            bottom:0px;
        }
    </style>


</head>
<body>
<div class="controll"></div>
<div class="map" id="map"></div>
</body>
</html>