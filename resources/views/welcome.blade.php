<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1gMHv7ezcGWoJ6y0mDFuYSAzHDLm49hE"></script>
    <style>
        #map {
            height: 100%;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 2,
                center: { lat: 0, lng: 0 }
            });

            var earthquakeData = @json($earthquakeData);

            earthquakeData.features.forEach(function(feature) {
                var coords = feature.geometry.coordinates;
                var latLng = new google.maps.LatLng(coords[1], coords[0]);
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: feature.properties.place
                });

                marker.addListener('click', function() {
                    var date = new Date(feature.properties.time);
                    var formattedDate = date.toLocaleDateString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric'
                    });

                    var infoWindow = new google.maps.InfoWindow({
                        content: '<div><strong>' + feature.properties.place + '</strong><br>' + formattedDate + '</div>'
                    });

                    infoWindow.open(map, marker);
                });
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1gMHv7ezcGWoJ6y0mDFuYSAzHDLm49hE&callback=initMap"></script>
</body>
</html>
