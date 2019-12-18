/**
 * Created by msi on 12/9/2019.
 */
var map,
    dir;

map = L.map('map', {
    layers: MQ.mapLayer(),
    center: [ 32.62432, 51.68115 ],
    zoom: 12,
});

dir = MQ.routing.directions();

dir.route({
    locations: devicePositions
    //     [
    //
    //     { latLng: { lat: 32.62217, lng: 51.66471 }},
    //     { latLng: { lat: 32.62383, lng: 51.69914 }},
    // ]
});

map.addLayer(MQ.routing.routeLayer({
    directions: dir,
    //fitBounds: true
}));