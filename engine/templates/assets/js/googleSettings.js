var map;
var markers = [];
var listenerHandle;


function initialize() {
    //           Установка карты и координаты центра
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 11,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(50.1539966666667, 25.2402416666667),
        disableDefaultUI: true,

        // How you would like to style the map.
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0f252e"},{"lightness":17}]}],
    };
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    //            Вызов функции установки маркеров

    $.ajax({
        url:'engine/lib/ajaxControl.php',
        type: 'POST',
        dataType: 'json',
        data:{
            cl: 'station',
            func: 'selectAllPointsForMap'
        },
        success: function(data){
            var jsonObj = $.parseJSON('[' + data + ']');
            var arrStat = jsonObj[0];
            var stations = [];
            for (var i = 0; i < arrStat.length; i++){
                var gps = arrStat[i]['gps'].split(',');
                if ( arrStat[i]['meteo_error'] == 1 ){
                    var image = 'engine/templates/assets/img/weather-marker.png';
                }else if( arrStat[i]['error'] == 1 ){
                    var image = 'engine/templates/assets/img/service-marker.png';
                }else{
                    var image = 'engine/templates/assets/img/normal-marker.png';
                }
                var station  = [ arrStat[i]['id'], gps[0].substr(1), gps[1], image ];

                stations.push(station);
            }
            setMarkers(map, stations);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
        }
    });
}

//            Массив с маркерами

function setMarkers(map, locations) {

    var shape = {
        coords: [1, 1, 1, 20, 18, 20, 18 , 1],
        type: 'poly'
    };
    for ( var i = 0; i < locations.length; i++ ) {
        var beach = locations[i];

        var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
        //console.log(myLatLng);
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            shape: shape,
            title: beach[0],
            icon: beach[3]
        });
    }
}

//        Вызов функции установки карты
google.maps.event.addDomListener(window, 'load', initialize);


function addMarker(location) {
    var marker = new google.maps.Marker({
        //draggable:true, - позволяет перетаскивать маркеры
        position: location,
        map: map
    });
    markers.push(marker);
}

// Sets the map on all markers in the array.
function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}



$(document).ready(function () {
    /*$('.new-point-on-map').click(function(){
     listenerHandle =google.maps.event.addListener(map, 'click', function(event) {
     addMarker(event.latLng);
     google.maps.event.removeListener(listenerHandle);
     console.log(event.latLng);
     });

     map.setOptions({draggableCursor:'crosshair'});
     });

     /*google.maps.event.addListener(map, 'mouseup', function(event) {
     alert('up');
     });*/
    /*$('#map-canvas').mouseup(function() {
     map.setOptions({draggableCursor:''});
     });*/
});