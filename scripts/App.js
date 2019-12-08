mapboxgl.accessToken = 'pk.eyJ1IjoiamJhbmQxOTkwIiwiYSI6ImNrM2VzMWtmaTAxZHUzcG9ieTV6aG9pd3QifQ.y_jB0jQxq0aLkI-X9cSFaA';
mapboxgl.setRTLTextPlugin('https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-rtl-text/v0.2.3/mapbox-gl-rtl-text.js');
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v10',
    center: [51.66554, 32.62231], // starting position
    zoom: 12
});
map.on('load', function (m) {

    m.directions.setOrigin([51.66554, 32.62231]);
    directions.addWaypoint(0, [51.68629,32.62466 ]);
    directions.addWaypoint(1, [51.70432, 32.63224]);
    directions.setDestination([51.66554, 32.62231]);
    // map.addLayer({
    //     "id": "route",
    //     "type": "line",
    //     "source": {
    //         "type": "geojson",
    //         "data": {
    //             "type": "Feature",
    //             "properties": {},
    //             "geometry": {
    //                 "type": "LineString",
    //                 "coordinates": devicePositions /*[
    //                     [51.67116,32.62212],
    //                     [51.67496, 32.62204],
    //                 ]*/
    //             }
    //         }
    //     },
    //     "layout": {
    //         "line-join": "round",
    //         "line-cap": "round"
    //     },
    //     "paint": {
    //         "line-color": "#888",
    //         "line-width": 8
    //     }
    // });
});
// set the bounds of the map
//var bounds = [[-123.069003, 45.395273], [-122.303707, 45.612333]];
//map.setMaxBounds(bounds);

// initialize the map canvas to interact with later
var canvas = map.getCanvasContainer();

// an arbitrary start will always be the same
// only the end or destination will change
//var start = [51.67116,32.62212];

// this is w1here the code for the next step will go
// adds the route as a layer on the map
function addRoute (coords) {
    // check if the route is already loaded
    if (map.getSource('route')) {
        map.removeLayer('route')
        map.removeSource('route')
    } else{
        map.addLayer({
            "id": "route",
            "type": "line",
            "source": {
                "type": "geojson",
                "data": {
                    "type": "Feature",
                    "properties": {},
                    "geometry": coords
                }
            },
            "layout": {
                "line-join": "round",
                "line-cap": "round"
            },
            "paint": {
                "line-color": "#3b9ddd",
                "line-width": 8,
                "line-opacity": 0.8
            }
        });
    };
}