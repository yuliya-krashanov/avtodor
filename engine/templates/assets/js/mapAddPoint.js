var map;
var markers = [];
var listenerHandle;
var selectedCoordinates;


function initialize() {
    //           Установка карты и координаты центра
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 8,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(50.1539966666667, 25.2402416666667),
        disableDefaultUI: true,

        // How you would like to style the map.
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0f252e"},{"lightness":17}]}],
    };
    //var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var map = new google.maps.Map(document.getElementById('add-point-map'), mapOptions);
    //            Вызов функции установки маркеров
    window.map = map;
   
}

//            Массив с маркерами

function setMarkers(map, locations) {

    var shape = {
        coords: [1, 1, 1, 20, 18, 20, 18 , 1],
        type: 'poly'
    };
    for ( var i = 0; i < locations.length; i++ ) {
        var point = locations[i];        
        var myLatLng = new google.maps.LatLng(point[1], point[2]);
        //console.log(myLatLng);
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            shape: shape,
            title: point[0],
            icon: point[3]
        });
    }
}

//        Вызов функции установки карты
google.maps.event.addDomListener(window, 'load', initialize);


function addMarker(location) {
    var image = {
       url: 'engine/templates/assets/img/marker-new-point.png',
       anchor: new google.maps.Point(54, 54)
    };
    var marker = new google.maps.Marker({
        draggable: true, //позволяет перетаскивать маркеры
        position: location,
        map: map,
        icon: image
    });
    markers.push(marker);

    google.maps.event.addListener(marker, 'dragend', function(e) {
        selectedCoordinates = e.latLng;
    });
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
function clearMarkers() {
    setMapOnAll(null);
}
function deleteMarkers() {
    clearMarkers();
    markers = [];
}

$(document).ready(function () {


    $('#step2 .add-point-next').on('click', function(){
        //setAllMap(map);
        deleteMarkers();
        $('#step2').removeClass('active');
        $('#step3').addClass('active');
        $('#step3').find('#coordinates').val(selectedCoordinates);
    });

	$('#step1 .district-list li').on('click', function(){
		
		var regionId = $(this).attr('data-id');
        $('#step3').find('#region').val(regionId);
    	$('#step1').removeClass('active');
    	$('#step2').addClass('active');

	    $.ajax({
	        url:'engine/lib/ajaxControl.php',
	        type: 'POST',
	        dataType: 'json',
	        data:{
	            cl: 'station',
	            func: 'selectStationsByRegion',
	            region_id: regionId
	        },
	        success: function(data){
	            var jsonObj = $.parseJSON('[' + data + ']');
	            var arrStat = jsonObj[0];
	            var stations = [];	            
	            var image = 'engine/templates/assets/img/marker-exist.png';
	            for (var i = 0; i < arrStat.length; i++){
	                var gps = arrStat[i]['gps'].split(',');                
	                var station  = [ arrStat[i]['id'], gps[0].substr(1), gps[1], image ];

	                stations.push(station);
	            }
	            //console.log(stations);
	            
	            setMarkers(map, stations);
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	            console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
	        }
	    });

		listenerHandle = google.maps.event.addListener(map, 'click', function(event) {
		    addMarker(event.latLng);
            selectedCoordinates = event.latLng;
		    map.setOptions({draggableCursor:''});
		    google.maps.event.removeListener(listenerHandle);
	    });

	    map.setOptions({draggableCursor:'crosshair'});	    
	});
});
