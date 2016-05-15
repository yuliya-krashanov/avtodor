// When the window has finished loading create our google map below
jQuery(document).ready(function(){
    // Login form dropdown
    var clicks_on_select = 0;
    $('.selected-value').on('click', function(){

        clicks_on_select++;
        if( clicks_on_select % 2 != 0 ) {
            $('.select-container').animate({'height': '144px'}, 300);
        }else{
            $('.select-container').animate({'height': '0'}, 300);
        }
    });

    $('#region-select li').on('click', function() {
        var region = $(this).text();
        var area = $(this).attr('data-reg');
        $('.selected-value').text(region);
        $('.selected-value').attr('data-region', area);
        $('#user_selected_region').val(region);
        $('.select-container').animate({'height': '0'}, 300);
    });

    $('#reg-form').on('submit', function(e) {
        e.preventDefault();
        var step = $('.active-step').attr('id');

//          Проверка 1 шага регистрации
        if (step == 'step1') {
            var checkName = $('#user_name_input').val();
            var checkLastName = $('#user_second_name_input').val();
            if (checkName == '' || checkLastName == '') {
                popUpMessage('Введите имя и фамилию');
            }
            else {
                $('.reg-step').removeClass('active-step');
                $('#step2').addClass('active-step');
            }
        }
//          Проверка 2 шага регистрации
        if (step == 'step2') {
            var checkLogin = $('#user_register_login').val();
            var checkPhone = $('#user_register_telephone').val();
            if (checkLogin == '' || checkPhone == '') {
                popUpMessage('Введите логин и телефон');
            }
            else {
                $('.reg-step').removeClass('active-step');
                $('#step3').addClass('active-step');
            }
        }
//          Проверка 3 шага регистрации
        if (step == 'step3') {
            var checkPassword = $('#user_register_password').val();
            var checkConfirmPassword = $('#user_register_password_confirm').val();
            if (checkPassword == '' || checkConfirmPassword == '') {
                popUpMessage('Введите пароль и подтверждение пароля');
            }
            else {
                if (checkPassword == checkConfirmPassword) {
                    var step2show = $(this).attr('rel');
                    $('.reg-step').removeClass('active-step');
                    $('#step4').addClass('active-step');
                }
                else {
                    popUpMessage('Пароли не совпадают');
                }
            }
        }
//          Переход на 4 шаг и регистрация
        if (step == 'step4') {
            ajaxRegister(e);
        }
    });

    $('.forgot-pass-wrap a').on('click', function(e){
        e.preventDefault();
        var step2show = $(this).attr('rel');
        $('.reg-step').removeClass('active-step');
        $(step2show).addClass('active-step');
    });
    // Login / Registration form tabs
    $('.tab-group a').on('click', function(e){
        e.preventDefault();
        var active_tab = $(this).attr('rel');
        $('.login-tabs').removeClass('active-tab');
        $('.tab-content').find(active_tab).addClass('active-tab');
        $('.tab-group li').removeClass('active');
        $(this).parent().addClass('active');

    })
    
    init();
        
    function init() {
        // Basic options for a simple Google Map
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 5,
            disableDefaultUI:true,
            panControl: false,
            zoomControl: false,
            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(51.822942, 24.657441), // New York

            // How you would like to style the map. 
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":1},{"color":"#000000"},{"lightness":25}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":10}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":11}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":20},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0f252e"},{"lightness":6}]}]
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map-canvas');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
    }
    
     // Animation on input filled
    (function() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
            (function() {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
            // in case the input is already filled..
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input--filled' );
            }

            // events:
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input--filled' );
            }
        }
    })();
});