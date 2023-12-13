<!DOCTYPE html>
<html>
<head>
  <title>Google Maps API Example</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiu3WdmZl0Afe2EoY4drAfzZ3FhLZaskM"></script>
  <script>
    function initMap() {
      // Initialize the map
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 37.7749, lng: -122.4194},
        zoom: 12
      });
      
      // Define the directions service
      var directionsService = new google.maps.DirectionsService();
      
      // Define the directions renderer
      var directionsRenderer = new google.maps.DirectionsRenderer({
        map: map
      });
      
      // Define the start and end points for the route
      var start = new google.maps.LatLng(37.7749, -122.4194);
      var end = new google.maps.LatLng(37.7857, -122.4061);
      
      // Define the route request
      var request = {
        origin: start,
        destination: end,
        travelMode: 'DRIVING'
      };
      
      // Get the route directions
      directionsService.route(request, function(result, status) {
        if (status == 'OK') {
          directionsRenderer.setDirections(result);
        }
      });
    }
  </script>
</head>
<body onload="initMap()">
  <div id="map" style="height: 500px;"></div>
</body>
</html>
