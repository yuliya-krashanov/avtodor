jQuery(document).ready(function(){

    $('.selected-value').on('click', function(){
        $('.select-container').animate({'height': '200px'}, 300);
    });

    $('.points-list li').on('click', function(){
        $('#choose-point-step1').hide();
        $('#choose-point-step2').show();
    });

    $('#choose-point-step2-btn').on('click', function(){
        $('#choose-point-step2').hide();
        $('#choose-point-step3').show();
    })

    $('.points-list li').on('click', function(){
        var region = $(this).text();
        $('.selected-value').text(region);
        $('#user_selected_region').val(region);
        $('.select-container').animate({'height': '0'}, 300);
    });
    
    init();
        
    function init() {

         var locations = [
            ['loc1',41.23, -71.34],
            ['loc2',41.24, -71.35],
            ['loc3',41.25, -71.36],
            ['loc4',41.26, -71.37],
            ['loc5',41.27, -71.34],
            ['loc6',41.28, -71.34],
            ['loc6',41.29, -71.34]
        ];
        // Basic options for a simple Google Map
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 11,

            panControl: false,
            
            zoomControl: false,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(41.27, -71.3400), // New York

            // How you would like to style the map. 
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0f252e"},{"lightness":17}]}]
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map-canvas');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
       /* var marker = new google.maps.Marker({
            position: new google.maps.LatLng(40.6700, -73.9400),
            map: map,
            draggable:true,
            title: 'Snazzy!'
        });*/

        // This event listener calls addMarker() when the map is clicked.
        google.maps.event.addListener(map, 'click', function(e) {
            placeMarker(e.latLng, map);
        });

        function placeMarker(position, map) {
            var mapMarker = 'img/step2-point-location.png';
            var marker = new google.maps.Marker({
              position: position,
              icon: mapMarker,
              draggable:true,
              map: map
            });  
            map.panTo(position);
        }

        var i;

        for (i = 0; i < locations.length; i++) {

            var toolTip = '<div class="choose-point-tooltip">' +
                        '<span class="icon-holder"><i class="fa fa-check"></i><br/>Спасибо!</span>' +
                        '<p class="point-status">Ваша точка успешно добавлена в систему.</p>' + 
                        '<div class="tooltip-arrow"></div>' + 
                    '</div>';

            var infoWindow = new google.maps.InfoWindow({
                content: toolTip,
                disableAutoPan: false,
                infoBoxClearance: new google.maps.Size(1, 1)
            });

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                draggable: true
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });
        }
    }
});
//    script
        (function($){
            $(window).load(function(){
                
                var content=$(".points-list"),autoScrollTimer=8000,autoScrollTimerAdjust,autoScroll;
                
                content.mCustomScrollbar({
                    scrollButtons:{enable:true},
                    callbacks:{
                        whileScrolling:function(){
                            autoScrollTimerAdjust=autoScrollTimer*this.mcs.topPct/100;
                        },
                        onScroll:function(){ 
                            if($(this).data("mCS").trigger==="internal"){AutoScrollOff();}
                        }
                    }
                });
                
                content.addClass("auto-scrolling-on auto-scrolling-to-bottom");
                AutoScrollOn("bottom");
                
                function AutoScrollOn(to,timer){
                    if(!timer){timer=autoScrollTimer;}
                    content.addClass("auto-scrolling-on").mCustomScrollbar("scrollTo",to,{scrollInertia:timer,scrollEasing:"easeInOutSmooth"});
                    autoScroll=setTimeout(function(){
                        if(content.hasClass("auto-scrolling-to-top")){
                            AutoScrollOn("bottom",autoScrollTimer-autoScrollTimerAdjust);
                            content.removeClass("auto-scrolling-to-top").addClass("auto-scrolling-to-bottom");
                        }else{
                            AutoScrollOn("top",autoScrollTimerAdjust);
                            content.removeClass("auto-scrolling-to-bottom").addClass("auto-scrolling-to-top");
                        }
                    },timer);
                }
                
                function AutoScrollOff(){
                    clearTimeout(autoScroll);
                    content.removeClass("auto-scrolling-on").mCustomScrollbar("stop");
                }
                
            });
        })(jQuery);

        (function($){
            $(window).load(function(){
                
                var content=$(".sensors"),autoScrollTimer=8000,autoScrollTimerAdjust,autoScroll;
                
                content.mCustomScrollbar({
                    scrollButtons:{enable:true},
                    callbacks:{
                        whileScrolling:function(){
                            autoScrollTimerAdjust=autoScrollTimer*this.mcs.topPct/100;
                        },
                        onScroll:function(){ 
                            if($(this).data("mCS").trigger==="internal"){AutoScrollOff();}
                        }
                    }
                });
                
                content.addClass("auto-scrolling-on auto-scrolling-to-bottom");
                AutoScrollOn("bottom");
                
                function AutoScrollOn(to,timer){
                    if(!timer){timer=autoScrollTimer;}
                    content.addClass("auto-scrolling-on").mCustomScrollbar("scrollTo",to,{scrollInertia:timer,scrollEasing:"easeInOutSmooth"});
                    autoScroll=setTimeout(function(){
                        if(content.hasClass("auto-scrolling-to-top")){
                            AutoScrollOn("bottom",autoScrollTimer-autoScrollTimerAdjust);
                            content.removeClass("auto-scrolling-to-top").addClass("auto-scrolling-to-bottom");
                        }else{
                            AutoScrollOn("top",autoScrollTimerAdjust);
                            content.removeClass("auto-scrolling-to-bottom").addClass("auto-scrolling-to-top");
                        }
                    },timer);
                }
                
                function AutoScrollOff(){
                    clearTimeout(autoScroll);
                    content.removeClass("auto-scrolling-on").mCustomScrollbar("stop");
                }
                
            });
        })(jQuery);