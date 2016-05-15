$( document ).ready(function() {	
	meteoTime();
	setInterval(meteoTime, 600000);
	meteoTimeDirection();
	setInterval(meteoTimeDirection, 600000);
	drawGraphFunc()//при загрузке страницы рисуем график
	function getDaysInMonth(month, year){//функция определения количества дней в месяце
		if ((month==9) || (month==11) || (month==4) || (month==6)) {//месяца, в которых 30 дней
			return 30
		}
		if(month==2){//если выбран февраль
			if (year/4 == parseInt(year/4)) {//если год кратен 4
				return 29//то в феврале 29 дней
			}
			else{
				return 28//иначе в феврале 28 дней
			}
		}
		else{
			return 31// иначе в месяце 31 день
		}

	}
	 $.ajax({
        url:'engine/lib/ajaxControl.php',
        type:'POST',
        dataType:'json',
        data: {
            cl: 'passport',
			func: 'getDate'
        },
        success: function (data) {//получаем сегодняшнюю дату
        	date_arr = data.split(',');//разбиваем дату на масив
        	month = parseInt(date_arr[0].substr(1));//месяц
        	day = parseInt(date_arr[1]);//день
        	year = parseInt(date_arr[2]);//год
        },
		error: function () {
			alert('System error!');
		}
    });
	$("#meteo_month").on('click', function(){//при выборе месяца
		$(this).parent().find(".butt").each(function(){//делаем все кнопки неактивными
			if ($(this).hasClass("butt_active")) {$(this).removeClass("butt_active")};
		})
		$(this).addClass("butt_active")//выбранную кнопку делаем активной
		last_month = month-1;//прошлый месяц
		last_year = year;//прошлый год
		if(month==1){//если январь
			last_year--
			last_month = 12;
		}
		day = parseInt(day);//"чистим" дату
		month = parseInt(month);
		last_month = parseInt(last_month);
		if (day<10) {day="0"+day};//если день меньше 10, то добавляем в начало 0
		if (month<10) {month="0"+month};;//если месяц меньше 10, то добавляем в начало 0
		if (last_month<10) {last_month="0"+last_month};;//если прошлый месяц меньше 10, то добавляем в начало 0
		$("#input_date").val(last_month+"-"+day+"-"+last_year+" - "+month+"-"+day+"-"+year)//перезаписываем значение у input_date
		drawGraphFunc()//рисуем график
	})
	$("#meteo_week").on('click', function(){//при выборе недели
		$(this).parent().find(".butt").each(function(){//делаем все кнопки неактивными
			if ($(this).hasClass("butt_active")) {$(this).removeClass("butt_active")};
		})
		$(this).addClass("butt_active")//выбранную кнопку делаем активной	
		last_month = month;//прошлый месяц
		last_year = year;//прошлый год
		if (day>7) {last_day = day -7};//если день позже 7-го числа, то прошлое число равно разнице 7 и текущего дня
		if (day<8) {//если день раньше 8-го числа, то
			last_month -- 
			last_day = getDaysInMonth(last_month, year)-(7-day)//получаем прошлое число
			if(month==1){//если январь
				last_year--
				last_month = 12;
			}
		};
		day = parseInt(day);//"чистим" дату
		last_day = parseInt(last_day);
		month = parseInt(month);
		last_month = parseInt(last_month);
		if (day<10) {day="0"+day};//если число меньше 10, то добавляем в начало 0
		if (last_day<10) {last_day="0"+last_day};
		if (month<10) {month="0"+month};
		if (last_month<10) {last_month="0"+last_month};
		$("#input_date").val(last_month+"-"+last_day+"-"+last_year+" - "+month+"-"+day+"-"+year)//перезаписываем значение у input_date
		drawGraphFunc()//рисуем график		
	})
	
	$("#meteo_day").on('click', function(){//при выборе дня
		$(this).parent().find(".butt").each(function(){//делаем все кнопки неактивными
			if ($(this).hasClass("butt_active")) {$(this).removeClass("butt_active")};
		})
		$(this).addClass("butt_active")//выбранную кнопку делаем активной	
		day = parseInt(day);//"чистим" дату
		month = parseInt(month);
		if (day<10) {day="0"+day};//если число меньше 10, то добавляем в начало 0
		if (month<10) {month="0"+month};
		$("#input_date").val(month+"-"+day+"-"+year+" - "+month+"-"+day+"-"+year)	//перезаписываем значение у input_date
		drawGraphFunc()//рисуем график		
	})
})