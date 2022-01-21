<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>G2Cursos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
    <link href="{{ asset('css/index.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/leaflet-routing-machine.css') }}" rel="stylesheet" />
</head>

<body>
    <div id="map" class="map"></div>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
    <script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/Control.Geocoder.js') }}"></script>
    <script>
        window.onload = getLocation;
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                prompt("Geolokalizazioa ezin da kargatu zure nabigatzailean.");
            }
        }
        function showPosition(position) {
            var wayPoint1 = L.latLng(position.coords.latitude, position.coords.longitude);
            var map = L.map('map');

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var control = L.Routing.control(L.extend(window.lrmConfig, {
                waypoints: [
                    L.latLng(wayPoint1),
                    <?php 
                    $location = explode(";",$location);
                    ?>
                    L.latLng('<?php echo $location[0]?>', '<?php echo $location[1]?>')
                ],
                geocoder: L.Control.Geocoder.nominatim(),
                <?php
                    if($language == 'eu'){
                        // No hay traducción para el idioma euskera
                        $language = 'es';
                    } 
                ?>
                language: '<?php echo $language?>',
                routeWhileDragging: true,
                reverseWaypoints: true,
                showAlternatives: true,
                altLineOptions: {
                    styles: [
                        { color: 'black', opacity: 0.15, weight: 9 },
                        { color: 'white', opacity: 0.8, weight: 6 },
                        { color: 'blue', opacity: 0.5, weight: 2 }
                    ]
                }

            })).addTo(map);

            L.Routing.errorControl(control).addTo(map);
        }
    </script>
</body>

</html>