<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Polygon Arrays</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
// This example creates a simple polygon representing the Bermuda Triangle.
// When the user clicks on the polygon an info window opens, showing
// information about the polygon's coordinates.

var map;
var infoWindow;

function initialize() {
  var mapOptions = {
    zoom: 5,
    center: new google.maps.LatLng(24.886436490787712, -70.2685546875),
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };

  var bermudaTriangle;

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Define the LatLng coordinates for the polygon.
  var triangleCoords = [

      new google.maps.LatLng(106.6884,-6.37657),
      new google.maps.LatLng(106.6884,-6.08935),
      new google.maps.LatLng(106.980499,-6.08935),
      new google.maps.LatLng(106.980499,-6.37657)
      ];
  // Construct the polygon.
  bermudaTriangle = new google.maps.Polygon({
    paths: triangleCoords,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 3,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });

  bermudaTriangle.setMap(map);

  // Add a listener for the click event.
  google.maps.event.addListener(bermudaTriangle, 'click', showArrays);

  infoWindow = new google.maps.InfoWindow();
}

/** @this {google.maps.Polygon} */
function showArrays(event) {

  // Since this polygon has only one path, we can call getPath()
  // to return the MVCArray of LatLngs.
  var vertices = this.getPath();

  var contentString = '<b>Bermuda Triangle polygon</b><br>' +
      'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +
      '<br>';

  // Iterate over the vertices.
  for (var i =0; i < vertices.getLength(); i++) {
    var xy = vertices.getAt(i);
    contentString += '<br>' + 'Coordinate ' + i + ':<br>' + xy.lat() + ',' +
        xy.lng();
  }

  // Replace the info window's content and position.
  infoWindow.setContent(contentString);
  infoWindow.setPosition(event.latLng);

  infoWindow.open(map);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>