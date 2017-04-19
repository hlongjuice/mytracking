/**
 * Created by Jubilus on 3/16/2017 AD.
 */

var source, destination;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var lat_start=document.getElementById('txtLatStart');
var lng_start=document.getElementById('txtLngStart');
var result_weight=document.getElementById('result_weight');
var result_distance=document.getElementById('distance');
var result_current_distance=document.getElementById('current_distance');
var result_total_price=document.getElementById('total_price');
var driver_marker=new google.maps.Marker;
google.maps.event.addDomListener(window, 'load', function () {
    new google.maps.places.SearchBox(document.getElementById('txtSource'));
    new google.maps.places.SearchBox(document.getElementById('txtDestination'));
    directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true });
});
var bangkok = new google.maps.LatLng(13.7251097, 100.3529072);
var mapOptions = {
    zoom: 7,
    center: bangkok
};

/****Create a map and center it on Bangkok*****/
var map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);

function getRoute(){
    directionsDisplay.setMap(map);
    //*********DIRECTIONS AND ROUTE**********************//
    source = document.getElementById("txtSource").value;
    destination = document.getElementById("txtDestination").value;
    var waypts= {
        location: source,
        stopover:true
    };

    var request = {
        origin: source,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING,
        //travelMode:'WALKING'
        //waypoints:[waypts]

        //optimizeWaypoints: true
    };
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);//set directions on map
        }
        getWayPoints(response);
    });

    /*Get Lat/Lng and send to input form*/
    directionsDisplay.addListener('directions_changed', function() {
        var direction=directionsDisplay.getDirections();
        var destination=direction.routes[0].legs[0].end_address;
        var result_lat_start=document.getElementById("lat_start");
        var result_lng_start=document.getElementById('lng_start');
        var result_lat_end=document.getElementById('lat_end');
        var result_lng_end=document.getElementById('lng_end');


        console.log(direction);
        document.getElementById('txtSource').value=direction.routes[0].legs[0].start_address;
        document.getElementById('txtDestination').value=direction.routes[0].legs[0].end_address;

        /*Result of LatLng*/
        result_lat_start.value=direction.routes[0].legs[0].start_location.lat();
        result_lng_start.value=direction.routes[0].legs[0].start_location.lng();
        result_lat_end.value=direction.routes[0].legs[0].end_location.lat();
        result_lng_end.value=direction.routes[0].legs[0].end_location.lng();


        //*********DISTANCE AND DURATION**********************//
        var service = new google.maps.DistanceMatrixService();
        var current_position=direction.routes[0].legs[0].start_address;
        var start_position="";

        if(lat_start ==null && lng_start == null){
            start_position=current_position;
        }
        else{
            start_position=new google.maps.LatLng(lat_start.value,lng_start.value);
        }

        service.getDistanceMatrix({
            origins:[start_position,current_position],
            destinations:[destination],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
        }, function (response, status) {

            if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                var distance = response.rows[0].elements[0].distance.text;
                var curent_distance=response.rows[1].elements[0].distance.text;
                var duration = response.rows[0].elements[0].duration.text;
                var dvDistance = document.getElementById("dvDistance");
                var distance_price=distance_per_price*parseInt(distance);
                var weight_price=weight_per_price*document.getElementById("weight").value;
                var total_price=distance_price+weight_price;

                /*Calculate Result*/
                result_distance.value=distance;
                //result_distance_price.value=distance_price;
                result_weight.value=document.getElementById("weight").value;
                result_total_price.value=total_price;
                if(result_current_distance != null)
                {
                    result_current_distance.value=curent_distance;
                }
            } else {
                alert("Unable to find the distance via road.");
            }
        });

    });

}

/*Route After Submit*/
function getCurrentlyRoute(){
    directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': false });
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
function showSenderLocationMap(){
    var sender_place= new google.maps.LatLng(lat_start.value, lng_start.value);
    var mapOptions = {
        zoom: 7,
        center:sender_place
    };

    /****Create a map and center it on Bangkok*****/
    var map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);
}
