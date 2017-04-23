/**
 * Created by Jubilus on 3/16/2017 AD.
 */

var source, destination;
//var directionsDisplay;
var directionsDisplay= new google.maps.DirectionsRenderer();
var directionsService = new google.maps.DirectionsService();
var lat_start=document.getElementById('txtLatStart');
var lng_start=document.getElementById('txtLngStart');
var result_weight=document.getElementById('result_weight');
var result_distance=document.getElementById('distance');
var result_current_distance=document.getElementById('current_distance');
var result_total_price=document.getElementById('total_price');
var driver_marker=new google.maps.Marker;
var sender_location_marker=new google.maps.Marker;
var bangkok = new google.maps.LatLng(13.7251097, 100.3529072);
var mapOptions = {
    zoom: 7,
    center: bangkok
};
var direction_markers=new google.maps.Marker;
var destination_marker= new google.maps.Marker();
var driver_marker= new google.maps.Marker();
var home_icon=null;
var driver_icon=null;
/*Location Search Auto Complete*/
google.maps.event.addDomListener(window, 'load', function () {
    new google.maps.places.SearchBox(document.getElementById('txtSource'));
    new google.maps.places.SearchBox(document.getElementById('txtDestination'));
    directionsDisplay = new google.maps.DirectionsRenderer({
        'draggable': true
    });
});

/****Create a map and center it on Bangkok*****/
var map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);

/*Show Route*/
function getRoute(){
    //directionsDisplay.setMap(map);
    //*********DIRECTIONS AND ROUTE**********************//
    source = document.getElementById("txtSource").value;
    destination = document.getElementById("txtDestination").value;

    var request = {
        origin: source,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING
    };//Route request
    /*Display Route*/
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setOptions({
                suppressMarkers:true
            })
            directionsDisplay.setDirections(response);//set directions on map
            directionsDisplay.setMap(map);
            var position=response.routes[0].legs[0];

            destination_marker.setMap(null);
            destination_marker.setMap(map);
            destination_marker.setPosition(position.end_location);
            destination_marker.setIcon(home_icon);
            destination_marker.setDraggable(true);

            driver_marker.setMap(null);
            driver_marker.setMap(map);
            driver_marker.setPosition(position.start_location);
            driver_marker.setIcon(driver_icon);
            driver_marker.setDraggable(true);

            destination_marker.addListener('dragend',function(){
                directionsDisplay.setMap(null);
                document.getElementById('txtSource').value=driver_marker.getPosition().lat()+','+driver_marker.getPosition().lng();
                document.getElementById('txtDestination').value=destination_marker.getPosition().lat()+','+destination_marker.getPosition().lng();
                getRoute()
            });
            driver_marker.addListener('dragend',function(){
                document.getElementById('txtSource').value=driver_marker.getPosition().lat()+','+driver_marker.getPosition().lng();
                document.getElementById('txtDestination').value=destination_marker.getPosition().lat()+','+destination_marker.getPosition().lng();
                getRoute()
            });
        }
        /*Get way point for driver position*/
        //getWayPoints(response);
    });
}

/*Route After Submit*/
function getCurrentlyRoute(){
    directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': false });
    //directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true });
    getRoute();
}

/*Way Points*/
function getWayPoints(direction_result){
    var waypoints=document.getElementById('driver_current_position');
    var my_route = direction_result.routes[0].legs[0];
    if(waypoints!=null){
        waypoints.options.lenght=0;
        for (var i = 0; i < my_route.steps.length; i++) {
            var waypoint=new Option(my_route.steps[i].start_location,my_route.steps[i].start_location);
            waypoints.options.add(waypoint);
        }
    }
}

/*Put Marker on the Map*/
function putMarker(){
    var waypoints=document.getElementById('driver_current_position');
    var driver_position=waypoints.options[waypoints.selectedIndex].text;
    driver_position = driver_position.slice(1,-1).split(',');
    driver_position=new google.maps.LatLng(driver_position[0],driver_position[1]);

    driver_marker.setMap(null); //remove all old marker if exists
    driver_marker.setMap(map); //set map for marker
    driver_marker.setPosition(driver_position); //set position of driver to map

}

function getCurrent(){

    map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);
    directionsDisplay.setMap(map);
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}

/*Driver Function*/
function showSenderLocationMap() {
    var sender_place = new google.maps.LatLng(lat_start.value, lng_start.value);
    var mapOptions = {
        zoom: 13,
        center: sender_place
    };
    var driver_marker = new google.maps.Marker();
    var test_marker = new google.maps.Marker;
    /****Create a map and center it on Sender Place*****/

    var sender_map = new google.maps.Map(document.getElementById('senderLocationMap'), mapOptions);
    test_marker.setMap(sender_map);
    test_marker.setPosition(sender_place);
    test_marker.setIcon(home_icon);

    google.maps.event.addListener(sender_map, 'click', function(event) {
        addDriverMarker(event.latLng);
    });

    /*Add Driver Position Marker*/
    function addDriverMarker(location){
        driver_marker.setMap(null);//remove old marker
        driver_marker.setMap(sender_map);
        driver_marker.setPosition(location);
        driver_marker.setIcon(driver_icon);

        console.log(driver_marker);
    }
}

