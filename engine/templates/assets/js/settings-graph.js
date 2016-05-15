function drawGraph(day, month, year, t_road, t_air, coeff) {
    $('#container').highcharts({
        chart: {
            color:'#f1f1f2',
            backgroundColor: '#2d3337',
            type: 'spline',
            style: {
                fontFamily: "Exo2-Medium",
                color:'#fff'
            }
        },
        // title: {
        //     text: 'Monthly Average Temperature',
        //         style: {
        //         fontFamily: 'exo 2 medium',
        //         color:'#fff'
        //     }
        // },
        // subtitle: {
        //     text: 'Source: WorldClimate.com',
        //     style: {
        //         fontFamily: 'exo 2 medium',
        //         color:'#fff'
        //     }
        // },
        xAxis: {
                minorTickLength:5,
                minorTickColor: "#444a4f",
                lineColor:'#444a4f',
            strokeColor:"#444a4f",
                 type: 'datetime',
                 dateTimeLabelFormats: {
                day: '%e/%m'
            },

                // categories: ['01/11', '02/11', '03/11', '04/11', '05/11', '06/11',
                // '07/11'],

            labels:{
                style: {
                fontFamily: "Exo2-Medium",
                color:'#fff'
                }
            }
        },
        yAxis: {
             gridLineColor: "#3b4145",
            title: {
               text:null
            },
            labels: {
                formatter: function () {
                    return this.value + '°';
                },
                style: {
                fontFamily: "Exo2-Medium",
                color:'#fff'
                }
            }
            
        },
        legend:{
            enabled: false
        },
        tooltip: {
            valueSuffix:' c',
            // followPointer:true,
            // followTouchMove:true,
            dateTimeLabelFormats: {
            day: "%Y/%m/%e %H:%M"

                    },
            backgroundColor:"#363c40",
            borderColor:"#595f65",
            borderRadius:"5",
            borderWidth: '1',
            opacity:"0.5",
            style: {
                padding: 20,
                fontFamily: '"Exo2-Regular"',
                color:'#fff',
                fontSize: '8pt'
                },
            crosshairs: [{

                width: 1,
                color: '#3f4448'
            }],
             shared:true,

        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 0
                }
            }
        },
        series: [{
            name: 't-Воздуха  ',
            marker: {
                symbol: 'circle',
                radius: 6,
                    lineColor: '#666666',
                    lineWidth: 0
            },
            data: t_road,
            pointStart: Date.UTC(year,month-1, day),
            pointInterval: 24*3600*1000*coeff


        }, {   
            width:2,
            color:"#d1eafb",
            name: 't-Дороги  ',
            marker: {
                symbol: 'circle',
                radius: 6,
                    lineColor: '#666666',
                    lineWidth: 0
            },
            data: t_air,
            pointStart: Date.UTC(year,month-1, day),
            pointInterval: 24*3600*1000*coeff
        }]
    });
};

function drawGraphForDay(day, month, year, t_road, t_air) {
    $('#container').highcharts({
        chart: {
            color:'#f1f1f2',
            backgroundColor: '#2d3337',
            type: 'spline',
            style: {
                fontFamily: "Exo2-Medium",
                color:'#fff'
            }
        },
        xAxis: {
                minorTickLength:5,
                minorTickColor: "#444a4f",
                lineColor:'#444a4f',
            strokeColor:"#444a4f",
                 type: 'datetime',

            labels:{
                style: {
                fontFamily: "Exo2-Medium",
                color:'#fff'
                }
            }
        },
        yAxis: {
             gridLineColor: "#3b4145",
            title: {
               text:null
            },
            labels: {
                formatter: function () {
                    return this.value + '°';
                },
                style: {
                fontFamily: "Exo2-Medium",
                color:'#fff'
                }
            }
            
        },
        legend:{
            enabled: false
        },
        tooltip: {
            valueSuffix:' c',
            backgroundColor:"#363c40",
            borderColor:"#595f65",
            borderRadius:"5",
            borderWidth: '1',
            opacity:"0.5",
            style: {
                padding: 20,
                fontFamily: '"Exo2-Regular"',
                color:'#fff',
                fontSize: '8pt'
                },
            crosshairs: [{

                width: 1,
                color: '#3f4448'
            }],
             shared:true,

        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 0
                }
            }
        },
        series: [{
            name: 't-Воздуха  ',
            marker: {
                symbol: 'circle',
                radius: 6,
                    lineColor: '#666666',
                    lineWidth: 0
            },
            data: t_air,
            pointStart: Date.UTC(year,month-1, day, 0),
            pointInterval: 3600*1000
        }, {   
            width:2,
            color:"#d1eafb",
            name: 't-Дороги  ',
            marker: {
                symbol: 'circle',
                radius: 6,
                    lineColor: '#666666',
                    lineWidth: 0
            },
            data: t_road,
            pointStart: Date.UTC(year,month-1, day, 0),
            pointInterval: 3600*1000
        }]
    });
}