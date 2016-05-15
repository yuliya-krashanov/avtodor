$(document).ready(function () {


    function hasParentClass( e, classname ) {
        if(e === document) return false;
        if( classie.has( e, classname ) ) {
            return true;
        }
        return e.parentNode && hasParentClass( e.parentNode, classname );
    }

    $('.selected-value').on('click', function(){
        $('.select-container').animate({'height': '200px'}, 300);
       $('.selected-value').addClass('active');
    });

    $('.points-list li').on('click', function(){
        var region = $(this).text();
        $('.selected-value').text(region);
        $('#user_selected_region').val(region);
        $('.select-container').animate({'height': '0'}, 300);
        $('.selected-value').removeClass('active');
    });

    var hideSelectArrows = function(e){
        if ( !hasParentClass( e.target, 'arrows' ) ){
            $('.manual-edit-tablo .arrows').animate({'height': '0'}, 300);
        }
        document.removeEventListener('click', hideSelectArrows);
    };

    // $('.manual-edit-tablo .arrows').each( function(){
    //     $(this).find('ul li').show();
    //     var direction = $(this).siblings('.current-arrow').find('img').attr('data-arrow');
    //     $(this).find('ul li.' + direction).hide();
    // });
    $('.current-arrow').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        var arrows = $(this).siblings('.arrows');
        var direction = $(this).find('img').attr('data-arrow');
        arrows.find('ul li').show();
        arrows.find('ul li.' + direction).hide();
        arrows.animate({'height': '80px'}, 300, 'linear', function(){
            document.addEventListener('click', hideSelectArrows);
        });
    });

    $('.manual-edit-tablo .signs .image-sign').on('click', function(){
        var side = $(this).parent().attr('class');
        var chooseSign =  $('.choose-sign');
        $(this).addClass('active');
        chooseSign.removeClass('left','right');
        chooseSign.addClass(side);
        chooseSign.animate({width: '450px', padding: '5px', border: '1px solid #dee4e8'}, 300 );
    });

    $('.manual-edit-tablo .arrows li').on('click', function(){
        var direction = $(this).attr('class');
        var arrows = $(this).parent().parent();
        var currentArrow = arrows.siblings('.current-arrow').find('img');
        currentArrow.attr('src','engine/templates/assets/img/arrows/tablo-arrow-'+ direction +'-selected.png');
        currentArrow.attr('data-arrow', direction);
        arrows.animate({'height': '0'}, 300 );
    });


    $('.pass-tabs-nav li').on('click', function() {
        $(this).addClass('active').siblings().removeClass('active');
        var tab = $(this).attr('data-tab');
        $('.pass-tabs-content #' + tab).addClass('active').siblings().removeClass('active');
    });


    $('.point-details').on('click', function(){

        var id = $(this).attr('data-id');

        $.ajax({
            url:'engine/lib/ajaxControl.php',
            type: 'POST',
            dataType: 'json',
            data:{
                cl: 'station',
                func: 'selectStationDevicesById',
                id: id
            },
            success: function(data){
                console.log(data);
                var data = jQuery.parseJSON(data);
                console.log(data);
                var indicator_class;
                var indicator_text;
                var fullPath = '?opt=passport&id=' + data.station[0].id;
                var tablo1='', tablo2='';
                var km = parseFloat(data.parse_address.km).toFixed(3).replace('.', '+').replace(',', '+');


                if (data.station[0].error == '1'){
                    indicator_class = 'service';
                    indicator_text = 'Сервис';
                }
                else if (data.station[0].meteo_error == '1'){
                    indicator_class = 'weather';
                    indicator_text = 'Погода';
                }
                else{
                    indicator_class = 'normal';
                    indicator_text = 'Работает';
                }

                $('.passport .point-title .road').text(data.parse_address.road);
                $('.passport .point-title .number').text(data.parse_address.km);
                $('.passport .status span.indicator').removeClass('weather normal service');
                $('.passport .status span.indicator').addClass(indicator_class);
                $('.passport .status span.text').text(indicator_text);


                $('.passport .status .full-pass a').attr('href', fullPath);

                if (data.tablo1){

                    tablo1 = '<div class="tablo"><div class="title-panel"><div class="point-title">';
                    tablo1 += '<span class="road">' + data.parse_address.road + '</span> <span class="number">' + km;
                    tablo1 += '</span> км</div><div class="buttons"><img src="engine/templates/assets/img/settings-tablo.png" alt="settings-tablo">';
                    tablo1 += '<img src="engine/templates/assets/img/settings.png" alt="settings">';

                    tablo1 += '<img src="engine/templates/assets/img/pan.png" alt="pan"></div></div> <div class="content-panel">';

                    tablo1 += '<div class="left-side"><div class="work"><img src="engine/templates/assets/img/tablo-img-work.png" alt="tablo-work-img"></div>';

                    tablo1 += '<div class="ar-work"><img src="engine/templates/assets/img/tablo-arrow.png" alt="tablo-arrow"></div></div>';

                    tablo1 += '<div class="message"><p>' + data.parse_tablo1.c1 + '</p><p>' + data.parse_tablo1.c2 + '</p><p>' + data.parse_tablo1.c3 + '</p> </div>';

                    tablo1 += '<div class="right-side"><div class="work"> <img src="engine/templates/assets/img/tablo-img-work.png" alt="tablo-work-img"></div>';

                    tablo1 += '<div class="ar-work"><img src="engine/templates/assets/img/tablo-arrow.png" alt="tablo-arrow"></div></div>';

                    tablo1 +=  '</div> <div class="road-panel">' +  data.parse_address.from  + '<span>></span>' + data.parse_address.to + '</div> </div>';
                }

                if (data.tablo2){



                    tablo2 = '<div class="tablo"><div class="title-panel"><div class="point-title">';
                    tablo2 += '<span class="road">' + data.parse_address.road + '</span> <span class="number">' + km;
                    tablo2 += '</span> км</div><div class="buttons"><img src="engine/templates/assets/img/settings-tablo.png" alt="settings-tablo">';
                    tablo2 += '<img src="engine/templates/assets/img/settings.png" alt="settings">';

                    tablo2 += '<img src="engine/templates/assets/img/pan.png" alt="pan"></div></div> <div class="content-panel">';

                    tablo2 += '<div class="left-side"><div class="work"><img src="engine/templates/assets/img/tablo-img-work.png" alt="tablo-work-img"></div>';

                    tablo2 += '<div class="ar-work"><img src="engine/templates/assets/img/tablo-arrow.png" alt="tablo-arrow"></div></div>';

                    tablo2 += '<div class="message"><p>' + data.parse_tablo2.c1 + '</p><p>' + data.parse_tablo2.c2 + '</p><p>' + data.parse_tablo2.c3 + '</p> </div>';

                    tablo2 += '<div class="right-side"><div class="work"> <img src="engine/templates/assets/img/tablo-img-work.png" alt="tablo-work-img"></div>';

                    tablo2 += '<div class="ar-work"><img src="engine/templates/assets/img/tablo-arrow.png" alt="tablo-arrow"></div></div>';

                    tablo2 +=  '</div> <div class="road-panel">' +  data.parse_address.to  + '<span>></span>' + data.parse_address.from + '</div> </div>';
                }

                $('.passport #pass-tablo').html(tablo1 + tablo2);


            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
            }
        });
    });

    $('#pass-stat-graphic').highcharts({


        xAxis: {
            tickInterval: 7 * 24 * 3600 * 1000, // one week
            tickWidth: 0,
            gridLineWidth: 1,
            labels: {
                align: 'left',
                x: 3,
                y: -3
            }
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C',
            shared: true,
            crosshairs: true
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        },  {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });


       // $('#pass-stat-graphic').highcharts({

       //      data: {
       //          csv: csv
       //      },

       //      title: {
       //          text: 'Температура августа'
       //      },

       //      xAxis: {
       //          tickInterval: 7 * 24 * 3600 * 1000, // one week
       //          tickWidth: 0,
       //          gridLineWidth: 1,
       //          labels: {
       //              align: 'left',
       //              x: 3,
       //              y: -3
       //          }
       //      },

       //      yAxis: [{ // left y axis
       //          title: {
       //              text: null
       //          },
       //          labels: {
       //              align: 'left',
       //              x: 3,
       //              y: 16,
       //              format: '{value:.,0f}'
       //          },
       //          showFirstLabel: false
       //      }],



       //      series: [{
       //          name: 'All visits',
       //          lineWidth: 4,
       //          marker: {
       //              radius: 4
       //          }
       //      }, {
       //          name: 'New visitors'
       //      }]
       //  });


    var app = {};

    app.tabs = (function() {
        var module = {};

        module.init = function() {

            var $tabs            = $('.tabs');
            var $tabList         = $('.tabs__list');
            var $tabItem         = $('.tabs__item');
            var $tabItemActive   = $('.tabs__item--active');
            var $tabLink         = $('.tabs__link');

            var width            = $(window).width();

            var tabSwitcher = function() {
                // On tab link click
                $tabLink.on('click', function(e) {
                    var currentAttrValue = jQuery(this).attr('data-tab');

                    // Show/Hide Tabs
                    $('.tabs__content').find('#' + currentAttrValue).addClass('active').siblings().removeClass('active')

                    // Change/remove current tab to active
                    $(this).parent('li').addClass('active').siblings().removeClass('active');

                    e.preventDefault();
                });
            }

            var tabToggle = function() {
                $tabItem.on('click', function(e) {
                    $(this).parent($tabList).toggleClass('tabs__list--open');
                });
            }

            var tabController = function() {
                tabToggle();
            }

            /* We cache window width size to prevent the resize event triggering on mobile scroll
             See: http://stackoverflow.com/questions/9361968/javascript-resize-event-on-scroll-mobile */
            $(window).resize(function() {
                var width = $(window).width();
                if ($(window).width() != width) {
                    width = $(window).width();
                    tabController();
                }
            });

            tabController();
            tabSwitcher();

        };
        return module;
    })();

    app.tabs.init();


});
