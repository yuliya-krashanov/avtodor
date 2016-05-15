jQuery(document).ready(function($) {
	var interval; // Интервал обновления сообщений
	var idn; // id тикета по клику
	var firstTicket = $('.checkbox-text:first').text(); // Первый тикет
	var mainUserId = $('#main-user-id').val();
	var mainUserName = $('#main-user-name').val();
	var mainUserLastName = $('#main-user-lastname').val();
	var filename = new Array(); // Список добавляемых картинок
	controlUpdate (firstTicket); // Вывод первого тикета

//		Вывод сообщений по id
	function showMessage (id) {
			$.ajax({
				url:'engine/lib/ajaxControl.php',
				type:'POST',
				dataType:'json',
				data: {
					cl: 'passport',
					func: 'getAlarmMessage_by_id',
					id: id
				},
				success: function (data) {
					var data = JSON.parse(data);
					var firstData = data[0];
					var firsteNote = (!jQuery.isEmptyObject(data)) ? firstData.note : '';
					var firstDate = (!jQuery.isEmptyObject(data)) ? firstData.date : '';

//						Замена шапки
					$('#tickets_id').text(id);
					$('#tickets_note').text(firsteNote);
					$('#tickets_date').text(firstDate);
					$('.left-side').html('');
//						Выывод сообщения
					for (var i = 0; i < data.length; i++) {
						var img = '';
						var sortImg = data[i].images.split(',');
						var ticketPosition = (data[i].id_user != mainUserId) ? 'right' : 'left';

						for (var t = 0; t < sortImg.length; t++) {
							if (sortImg[t] == '') {
								var sortImg = [];
							}
						}

						for (var j = 0; j < sortImg.length; j++) {
							img += '<div class="attachment">' +
								'<span class="attached-file"><p class="file-name">' + sortImg[j] + '<i></i></p></span>' +
								'<a href="#" class="#">Загрузить</a>' +
								'<a href="#" class="#">Смотреть</a>' +
								'</div>';
						}

						$('.left-side').append('<div class="ticket" style="float: ' + ticketPosition + ' ;">' +
							'<div class="top-panel">' +
							'<p class="author" id="first-author">' + data[i].name + '</p>' +
							'<p class="date-time" id="first-date">' + data[i].messdate + '</p>' +
							'</div>' +
							'<div class="ticket-message" id="first-message">' +
							'<p>' + data[i].message + '</p>' +
							'</div>' +
							'<div class="ticket-bottom-panel" id="first-ticket">' + img + '</div>' +
							'</div>');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
				}
			});
	}
//		Control update
	function controlUpdate (idTick) {
		clearInterval(interval);
		showMessage(idTick);
		interval = setInterval(function () { showMessage(idTick) }, 5000);
	}

//		Start update function
	$('.click p').click(function (e) {
		e.preventDefault();
		idn = $(this).attr('id');
		controlUpdate (idn);
	});

//		Ззагрузвка картинки с progress bar
	$('#loadImage').on('change', function(e) {
		var progressBar = $('#progressbar');
		e.preventDefault();
		var $that = $(this);
		var formData = new FormData($that.get(0));
		var checkUpload = $(this).children('.upload');
		formData.append( 'cl', 'passport');
		formData.append( 'func', 'loadImage');

		if (checkUpload.length > 0) {
			$.ajax({
				url: 'engine/lib/ajaxControl.php',
				type: 'POST',
				contentType: false,
				processData: false,
				data: formData,
				dataType: 'json',
				xhr: function () {
					var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
					xhr.upload.addEventListener('progress', function (evt) { // добавляем обработчик события progress (onprogress)
						if (evt.lengthComputable) { // если известно количество байт
							// высчитываем процент загруженного
							var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
							// устанавливаем значение в атрибут value тега progress
							// и это же значение альтернативным текстом для браузеров, не поддерживающих &lt;progress&gt;
							progressBar.val(percentComplete);
						}
					}, false);
					return xhr;
				},
				success: function (data) {
					var data = JSON.parse(data);
					var data = JSON.parse(data);
					filename.push(data.path);
					console.log(filename);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown);
				}
			});
		}
	});

//		Добавить сообщение
	$('#loadImage').on('submit', function (e) {
		e.preventDefault();
		var message = $('#message_sender').val();
		var name = mainUserName + '  ' + mainUserLastName;
		var img = filename;
		var ticketsId = $('#tickets_id').text();

		$.ajax({
			url: 'engine/lib/ajaxControl.php',
			type: 'POST',
			dataType: 'json',
			data: {
				cl: 'passport',
				func: 'add_message',
				message: message,
				name: name,
				imgName: img,
				userId: mainUserId,
				id: ticketsId
			},
			success: function (data) {
				console.log(data);
				controlUpdate (ticketsId);
				$('#message_sender').val('');
				$('div.upload').remove();
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
			}
		});
	});

//		Добавить полосу загрузки при выборе картинки
	$('.input-file-history input[type="file"]').change(function(e){
		var file = $('.input-file-history').find('input[type=file]')[0].files[0];
		$('.upload-indicators-panel').after('<div class="upload"><progress id="progressbar" class="progress-bar" value="0" max="100"></progress><div class="attachment"><span class="attached-file"><p class="file-name">'+file.name+'<i></i></p></span></div></div>');
	});
});