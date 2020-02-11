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
                    center: new Microsoft.Maps.Location(40.76414,-74.07132 ),
                    zoom: 10
            });
               /* var center = map.getCenter();

                //Create array of locations
                var coords = [center, new Microsoft.Maps.Location(center.latitude + 1, center.longitude + 1)];

                //Create a polyline
                var line = new Microsoft.Maps.Polyline(coords, {
                    strokeColor: 'red',
                    strokeThickness: 3,
                    strokeDashArray: [4, 4]
                });

                //Add the polyline to map
                map.entities.push(line);
                */
                Microsoft.Maps.loadModule('Microsoft.Maps.Directions', function () {
                    var directionsManager = new Microsoft.Maps.Directions.DirectionsManager(map);
                    // Set Route Mode to driving
                    directionsManager.setRequestOptions({ routeMode: Microsoft.Maps.Directions.RouteMode.driving });
                    var waypoint1 = new Microsoft.Maps.Directions.Waypoint({ address: 'Company', location: new Microsoft.Maps.Location(40.77503,-74.05976) });
                    var waypoint2 = new Microsoft.Maps.Directions.Waypoint({ address: 'SaadatAbad', location: new Microsoft.Maps.Location(40.78815,-74.04997) });
                    directionsManager.addWaypoint(waypoint1);
                    directionsManager.addWaypoint(waypoint2);
                    // Set the element in which the itinerary will be rendered
                    directionsManager.setRenderOptions({ itineraryContainer: document.getElementById('printoutPanel') });
                    directionsManager.calculateDirections();
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
<div id="printoutPanel"></div>
</body>
</html>