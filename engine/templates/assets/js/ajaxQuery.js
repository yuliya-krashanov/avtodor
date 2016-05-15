$(document).ready(function () {

	
//---------------------------------------//
//		Ajax ticket sistem				 //
//---------------------------------------//
	function stratShowTickets () {
		$.ajax({
			url:'engine/lib/ajaxControl.php',
			type:'POST',
			dataType:'json',
			data: {
				cl: 'tickets',
				func: 'getTickets',
			},
			success: function (data) {
				var prs = JSON.parse('[' + data + ']');
					$('.allTickets').append(prs[0].length);
				for (var i = 0; i < prs[0].length; i++) {
					$('.tickets').append('<tr><td rowspan="2"> img </td><td> ' + prs[0][i].title + ' </td><td> ' + prs[0][i].id_region + ' </td><td rowspan="2">Button</td></tr><tr><td>' + prs[0][i].date + '</td><td>' + prs[0][i].name + '</td></tr>');
				}
			},
			error: function () {
				alert('Ошибка вывода тикета');
			}
		});
	}
	//stratShowTickets();
});

//---------------------------------------//
//			Autorization				 //
//---------------------------------------//
$('#auth-form').on('submit', function (e) {
	e.preventDefault();
	var login = $('#input-4').val();
	var password = $('#input-5').val();
	if (login != '' && password != '') {
		$.ajax({
			url: 'engine/lib/ajaxControl.php',
			type: 'POST',
			dataType: 'json',
			data: {
				cl: 'auth',
				func: 'checkAuth',
				login: login,
				password: password
			},
			success: function (data) {
				var data = JSON.parse(data);
				if (data == true) {
					document.location.href = 'http://avtodor.loc/?opt=index';
				}
				else if (data == false) {
					popUpMessage('Учетная запись не подтверждена');
				}
				else {
					popUpMessage('Неправильный логин или пароль');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown);
			}
		});
	}
	else {
		popUpMessage('Введите логин и пароль');
	}
});

//---------------------------------------//
//		Registration Query				 //
//---------------------------------------//

function ajaxRegister (e) {
	e.preventDefault();
	var name = $('#user_name_input').val();
	var lastname = $('#user_second_name_input').val();
	var login = $('#user_register_login').val();
	var phone = $('#user_register_telephone').val();
	var password = $('#user_register_password_confirm').val();
	var region = $('.selected-value').attr('data-region');

	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data: {
			cl: 'reg',
			func: 'checkReg',
			name: name,
			lastname: lastname,
			login: login,
			phone: phone,
			password: password,
			region: region
		},
		success: function (data) {
			var data = JSON.parse(data);
			if (data == 'check') {
				popUpMessage('Такой логин существует');
			}
			else if (data == true) {
				$('.reg-step').removeClass('active-step');
				$('#step5').addClass('active-step');
			}
			else {
				popUpMessage('Ошибка регистрации');
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
		}
	});
}

//---------------------------------------//
//	      Show pop up new user           //
//---------------------------------------//

$('.custom-button-right').on('click', function () {
	var id = $(this).attr('data-id');
	$('#popup-name').text('xxx');
	$('#popup-tel').text('xxx');
	$('#popup-login').text('xxx');
	$('#popup-pass').text('xxx');
	$('#popup-area').text('xxx');

    $.ajax({
        url:'engine/lib/ajaxControl.php',
        type:'POST',
        dataType:'json',
        data: {
            cl: 'admin',
			func: 'showUsersId',
			id: id
        },
        success: function (data) {
			var prs = JSON.parse('[' + data + ']');
			var user = prs[0];
			$('#popup-name').text(user.name + ' ' + user.lastname);
			$('#popup-tel').text(user.phone);
			$('#popup-login').text(user.login);
			$('#popup-pass').text(/*user.pass*/'937999293q');
			$('#popup-area').text(user.area);
			$('.pop-up-button').attr('data-user-id', id);
        },
		error: function () {
			alert('Error show new users');
		}
    });
});

//---------------------------------------//
//	      		Confirm user             //
//---------------------------------------//

$('.pop-up-button').on('click', function () {
	var id = $('.pop-up-button').attr('data-user-id');
	var permissions = $('#popup-access').val();
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data: {
			cl: 'admin',
			func: 'confirm_user',
			id: id,
			permissions: permissions
		},
		success: function (data) {
			$('.close').trigger('click');
			$('#nu' + id).css('display', 'none');
		},
		error: function () {
			alert('error confirm user');
		}
	});
});
//---------------------------------------//
//	      		Users info               //
//---------------------------------------//

$('.tbl-all-users td').on('click', function () {
	var id = $(this).attr('data-us-id');
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data: {
			cl: 'admin',
			func: 'showUsersId',
			id: id
		},
		success: function (data) {
			var prs = JSON.parse('[' + data + ']');
			var users = prs[0];
			var type;

			if (users.type == 'superadmin') { type = 'Администратор'; }
			if (users.type == 'base') { type = 'Базовый'; }
			if (users.type == 'tech') { type = 'Специалист'; }

			$('#us-name').text(users.name);
			$('#us-tel').text(users.phone);
			$('#us-login').text(users.login);
			$('#us-pass').text('*********');
			$('#us-area').text(users.area);
			$('#us-access').text(type);
			$('.select-access').attr('data-update-user', id);
			$('#delete-user').attr('data-delete-id', id);
		},
		error: function () {
			alert('error confirm user');
		}
	});
});

//---------------------------------------//
//	  Update password area and status    //
//---------------------------------------//

$('#confirm-update-user').on('click', function (e) {
	e.preventDefault();
	var id = $('.select-access').attr('data-update-user');
	var getPass = $('#new-pass').val();
	var getCheckPass = $('#check-new-pass').val();
	var access = $('.act-access').attr('data-value-assets');
	var area = $('.act-area').attr('data-value-region');
	if (getPass == getCheckPass) {
		$.ajax({
			url: 'engine/lib/ajaxControl.php',
			type: 'POST',
			dataType: 'json',
			data: {
				cl: 'admin',
				func: 'resultUpdateUser',
				id: id,
				password: getPass,
				area: area,
				access: access
			},
			success: function (data) {
				alert(data);
			},
			error: function () {
				alert('error confirm user');
			}
		});
	}
	else {
		alert('Повторите правильность ввода пароля');
	}
});

//---------------------------------------//
//	  			Close ticket    		 //
//---------------------------------------//
$('.button-right-fixed-block').on('click', function () {
	var arr = [];
	$('.tbl tr').each(function(){
		var id = $(this).find('input').attr('data-check');
		console.log(id);
		if ($(this).find('.wrap-checkbox').hasClass('active')) { arr.push(id); }
	});
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data:{
			cl: 'admin',
			func: 'getUpdateTicketStatus',
			arr: arr
		},
		success: function (data) {
			$('.tbl tr').each(function(){
				if ($(this).find('.wrap-checkbox').hasClass('active')) {
					$(this).css('display', 'none');
					console.log(data);
				}
			});
		},
		error: function () {
			alert('Error');
		}
	});
});

//---------------------------------------//
//	  		history delay ticket		 //
//---------------------------------------//
$('#history_del_ticket').on('click', function () {
	var arr = [];
	$('#tickets-table tbody tr').each(function(){
		var id = $(this).find('input').attr('data-check');
		if ($(this).find('.wrap-checkbox').hasClass('active')) {
			arr.push(id);
		}
	});
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data:{
			cl: 'passport',
			func: 'getUpdateTicketStatus',
			arr: arr
		},
		success: function (data) {
			$('#tickets-table tbody tr').each(function(){
				var id = $(this).find('input').attr('data-check');
				if ($(this).find('.wrap-checkbox').hasClass('active')) {
					$(this).find('.history_ticket_status').html('Закрыт');
					if ($(this).find('.history_ticket_status').hasClass('check-text')) {
						$(this).find('.history_ticket_status').removeClass('check-text');
						$(this).find('.history_ticket_status').addClass('open-text');
					}
				}
			});
		},
		error: function () {
			alert('Error');
		}
	});
});

//---------------------------------------//
//	  	history procces ticket	 		 //
//---------------------------------------//
$('#history_process_ticket').on('click', function () {
	var arr = [];
	$('#tickets-table tbody tr').each(function(){
		var id = $(this).find('input').attr('data-check');
		if ($(this).find('.wrap-checkbox').hasClass('active')) {
			arr.push(id);
		}
	});
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data:{
			cl: 'passport',
			func: 'getUpdateTicketStatus',
			arr: arr,
			val: 1
		},
		success: function (data) {
			$('#tickets-table tbody tr').each(function(){
				var id = $(this).find('input').attr('data-check');
				if ($(this).find('.wrap-checkbox').hasClass('active')) {
					$(this).find('.history_ticket_status').html('На проверке');
					if ($(this).find('.history_ticket_status').hasClass('open-text')) {
						$(this).find('.history_ticket_status').removeClass('open-text');
						$(this).find('.history_ticket_status').addClass('check-text');
					}
				}
			});
		},
		error: function () {
			alert('Error');
		}
	});
});

//---------------------------------------//
//	  		  meteo info update	  		 //
//---------------------------------------//

function meteoTime () {
	var id_val = $(".hide_for_meteoTime").html();
	var lang;
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data: {
			cl: 'passport',
			func: 'return_lang'
		},
		success: function (data) {
			data = JSON.parse(data);
			lang = JSON.parse(data);
		}
	});
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data: {
			cl: 'passport',
			func: 'get_meteo_indicators',
			st_id: id_val
		},
		success: function (data) {
			var prs = JSON.parse('[' + data + ']');
			var values = prs[0];
			var html_array = [".first_pos",".second_pos",".third_pos",".fourth_pos",".fifth_pos",".six_pos"];
			for (var i = 0; i < html_array.length; i++) {
				$(html_array[i]).html(" ")
			};

			function addParam(array, lang, param, param_pos, value, flag, prefix){
				jq_class = "."+param
				if ((param_pos)>0) {
					$(jq_class).parents("tr").find("td:last-child a").each(function(){
						if ($(this).html()==param_pos) {
							$(this).addClass("active_link")
						}
					})
					$(jq_class).parents("tr").find("td:last-child span").addClass('active')
					if (flag == 1) {
						$(array[param_pos-1]).html(
							lang+"<br><span>"+value+prefix+"</span"
						);
					};
					if (flag == 2) {
						var str =lang;
						str=str.replace(" ", "<br>");
						$(array[param_pos-1]).html(
							"<span>"+value+prefix+"</span><br>"+str
						);
					};
				};
			}

			addParam(html_array, lang.coating_condition, "coating_condition", values.coating_condition_pos, values.coating_condition, 1, "");
			addParam(html_array, lang.visibility, "visibility", values.visibility_pos, values.visibility, 1, " м");
			addParam(html_array, lang.air_temp, "air_temp", values.air_temp_pos, values.air_temp, 2, " С");
			addParam(html_array, lang.road_temp, "road_temp", values.road_temp_pos, values.road_temp, 2, " С");
			addParam(html_array, lang.coeff_slipperiness, "coeff_slipperiness", values.coeff_slipperiness_pos, values.coeff_slipperiness, 2, "");
			addParam(html_array, lang.dot_dew, "dot_dew", values.dot_dew_pos, values.dot_dew, 2, " С");

			$(".visibility").text(values.visibility+" м");
			$(".coating_condition").text(values.coating_condition);
			$(".air_temp").text(values.air_temp+" С");
			$(".road_temp").text(values.road_temp+" С");
			$(".dot_dew").text(values.dot_dew+" С");
			$(".coeff_slipperiness").text(values.coeff_slipperiness);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
		}
	});
}

//---------------------------------------//
//	  	 Checkbox active show 			 //
//---------------------------------------//
$("body").on('click', '.wrap-checkbox', function() {
	var elem = $(this).parents("tr").find("td:nth-child(2) span").attr("class")+"_pos"
	$(this).parents("tr").find("td:last-child a").removeClass("active_link")
	if (($(this).hasClass("active"))) {
		$.ajax({
			url:'engine/lib/ajaxControl.php',
			type:'POST',
			dataType:'json',
			data: {
				cl: 'passport',
				func: 'set_position',
				elem: elem,
				to_pos: " ",
				prev_elem: " "
			},
			success: function (data) {
				meteoTime();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
			}
		});
	};
});

//---------------------------------------//
//	  		Change value in tablo		 //
//---------------------------------------//

$(".to_first_tab a").on('click', function(){
	$(this).parent(".to_first_tab").find("a").each(function(){
		$(this).removeClass("active_link")
	})
	if ($(this).parents("tr").find("td:last-child span").hasClass('active')) {
		var to_pos = $(this).html();
		var elem = $(this).parents("tr").find("td:nth-child(2) span").attr("class")+"_pos"
		var prev_elem = " ";
		$(this).parents("table").find("a.active_link").each(function(){
			if ($(this).html()==to_pos) {
				prev_elem = $(this).parents("tr").find("td:nth-child(2) span").attr("class")+"_pos"
				$(this).parents("td").find(".wrap-checkbox").removeClass("active")
				$(this).removeClass("active_link")
			};
		})
		$.ajax({
			url:'engine/lib/ajaxControl.php',
			type:'POST',
			dataType:'json',
			data: {
				cl: 'passport',
				func: 'set_position',
				elem: elem,
				to_pos: to_pos,
				prev_elem: prev_elem
			},
			success: function (data) {
				meteoTime()
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
			}
		});
	}
	else{popUpMessage('Сперва поставьте галочку!');}
});

//---------------------------------------//
//	  		  Delete user		  		 //
//---------------------------------------//
$('#delete-user').on('click', function () {
	var id = $(this).attr('data-delete-id');
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data:{
			cl: 'admin',
			func: 'user_delete',
			id: id
		},
		success: function (data) {
			$('.tbl-all-users tr').each(function () {
				var elem = $(this).children('td').attr('data-us-id');
				if (elem == id) {
					$(this).css('display','none');
				}
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
		}
	});
});

//---------------------------------------//
//	  		  Translate			  		 //
//---------------------------------------//

$('#lang_en').on('click', function () {
	setLanguage("en");
	$('.localization-list li').each(function (){
		if($(this).hasClass("active")){$(this).removeClass("active")};
	});
	$(this).addClass("active");
});
$('#lang_ru').on('click', function () {
	setLanguage("ru");
	$('.localization-list li').each(function (){
		if($(this).hasClass("active")){$(this).removeClass("active")};
	});
	$(this).addClass("active");
});
$('#lang_ukr').on('click', function () {
	setLanguage("ukr");
	$('.localization-list li').each(function (){
		if($(this).hasClass("active")){$(this).removeClass("active")};
	});
	$(this).addClass("active");
});

function setLanguage(lang) {
	url = 'engine/lang/'+lang+'.json'
	$.ajax({
		url : url, //тянем файл с языком
		dataType : 'json',
		success : function (response) {
			$('body').find("[lng]").each(function (){ //ищем все элементы с атрибутом
				var lng = response[ $(this).attr('lng') ]; //берем нужное значение по атрибуту lng
				var tag = $(this)[0].tagName.toLowerCase();
				switch (tag) {//узнаем название тега
					case "input":
						$(this).val(lng);
						break;
					default:
						$(this).html(lng);
						break;
				}
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
		}
	});
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data: {
			cl: 'auth',
			func: 'setLanguage',
			lang: lang
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
		}
	});
}

//---------------------------------------//
//	  		  Отрисовка графика	  		 //
//---------------------------------------//
function drawGraphFunc() {//функция обработки графика
	station_id = $(".hide_for_meteoTime").html();//получаем id станции
	date = $("#input_date").val();//получаем дату
	date_arr = date.split('-');//разбиваем дату на массив

	begin_day = parseInt(date_arr[1]);//день даты начала
	begin_month = parseInt(date_arr[0]);//месяц даты начала
	begin_year = parseInt(date_arr[2]);//год даты начала

	end_day = parseInt(date_arr[4]);//день даты окончания
	end_month = parseInt(date_arr[3]);//месяц даты окончания
	end_year = parseInt(date_arr[5]);//год даты окончания

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
	if (begin_month==end_month) {//если период дат в одном месяце
		count_days = end_day-begin_day+1//от дня окончания отнимаем день начала
	};
	if (begin_month != end_month) {//если период дат в разных месяцах
		count_days = (getDaysInMonth(begin_month, begin_year)-begin_day) + end_day+1//узнаем количество дней в периоде
	}
	days_coeff = 1;//коефициент дней, если в периоде больше 12 дней
	if (count_days>12) {//если в периоде больше 12 дней
		days_coeff = Math.floor(count_days/12);//коефициент равен количеству дней деленному на 12 и округленному в меньшую сторону
	};


	if (begin_month < 10) {begin_month = "0"+begin_month};//если месяц меньше 10, то добавляем 0 к числу
	if (begin_day < 10) {begin_day = "0"+begin_day};//если день меньше 10, то добавляем 0 к числу
	begin_date =begin_year+"-"+begin_month+"-"+begin_day;//получаем строку начальной даты
	if (end_month < 10) {end_month = "0"+end_month};//если месяц меньше 10, то добавляем 0 к числу
	if (end_day < 10) {end_day = "0"+end_day};//если день меньше 10, то добавляем 0 к числу
	end_date =end_year+"-"+end_month+"-"+end_day;//получаем строку конечной даты

	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data: {
			cl: 'passport',
			func: 'drawGraph',
			station_id: station_id, //отправляем на сервер id станции,
			begin_date: begin_date, //начальную дату,
			end_date: end_date,// конечную дату,
			count_days: count_days//количество дней
		},
		success: function (data) {
			var param_arr = JSON.parse(data)//парсим ответ сервера
			air_temp_arr = new Array();//масив параметров температуры воздуха
			road_temp_arr = new Array();// масив параметров температуры дороги

			for (i = 0; i < param_arr.length; i+=days_coeff) {//перебераем масив ответа от сервера, с шагом в коефициент дней(на случай, если выбрано больше 12 дней)
				air_temp_arr.push(parseInt(param_arr[i].air_temp));//добавляем значение в масив параметров температуры воздуха
				road_temp_arr.push(parseInt(param_arr[i].road_temp));//добавляем значение в масив параметров температуры дороги
			}

			if (count_days == 1) {//если выбран 1 день
				today_day = $(".hide_date").html();//получаем сегодняшнюю дату
				if (param_arr.length == 24) {//если пользователь выбрал 1 день
					drawGraphForDay(date_arr[1], date_arr[0], date_arr[2], road_temp_arr, air_temp_arr);//строим график
					$(".highcharts-xaxis-labels text tspan").html("00:00")//фиксим баг
				}
				if (parseInt(begin_day) == today_day){//если пользователь выбрал сегодняшнюю дату
					drawGraphForDay(date_arr[1], date_arr[0], date_arr[2], road_temp_arr, air_temp_arr);//строим график
					$(".highcharts-xaxis-labels text tspan").html("00:00")//фиксим баг
				}
				if ((param_arr.length != 24)&&(parseInt(begin_day) != today_day)) {popUpMessage('Ошибка системы!');}//если дата не сегодняшняя и сервера нехватка данных(меньше 24), то вызываем ошибку
			}
			else{
				if (param_arr.length==count_days) {//если пользователь выбрал более 1 дня
					drawGraph(date_arr[1], date_arr[0], date_arr[2], road_temp_arr, air_temp_arr, days_coeff);//строим график
				}
				else{popUpMessage('Ошибка системы!');}//если с сервера пришли не все данные, вызываем ошибку
			}

		},
		error: function () {
			alert('Ошибка!');
		}
	});
}

//---------------------------------------//
//	  		  Стоим график		  		 //
//---------------------------------------//
$("body").on("click", '.applyBtn', function(){//при клике по "Применить" вызываем функцию постройки графика, и делаем кнопки справа неактивными
	drawGraphFunc()
	$(this).parents().find(".butt").each(function(){
		if ($(this).hasClass("butt_active")) {$(this).removeClass("butt_active")};
	})
});

//---------------------------------------//
//	  	Стрелка направления ветра		 //
//---------------------------------------//
function meteoTimeDirection() {
	var id_val = $(".hide_for_meteoTime").html();
	$.ajax({
		url:'engine/lib/ajaxControl.php',
		type:'POST',
		dataType:'json',
		data: {
			cl: 'passport',
			func: 'get_meteo_direction_indicators',
			st_id: id_val
		},
		success: function (data) {
			var prs = JSON.parse('[' + data + ']');
			var indicators = prs[0];
			$('.values div:first-child span').html(indicators.angle_arrow);
			$('.values #second span').html(indicators.wind_speed);
			$('.direction .arrow img').css({
				"transform": "rotate("+indicators.angle_arrow+"deg)",
				"-web-kit-transform": "rotate("+indicators.angle_arrow+"deg)",
				"-moz-transform": "rotate("+indicators.angle_arrow+"deg)"
			});
			$('.direction .road img').css({
				"transform": "rotate("+indicators.angle_road+"deg)",
				"-web-kit-transform": "rotate("+indicators.angle_road+"deg)",
				"-moz-transform": "rotate("+indicators.angle_road+"deg)"
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
		}
	});
}