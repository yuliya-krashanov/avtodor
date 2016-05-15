$( document ).ready(function() {	

	$(".nav-pills li a").hover(function(){
		$(this).find("path").css("fill","white")	
	}, function(){
		if (($(this).parent("li").hasClass("active"))==false) {
			$(this).find("path").css("fill","#67809f")
		};
	})

	

	$(function() {$('input[name="daterange"]').daterangepicker();});
 	// прозрачность для всех полей-чекбоксов на странице
	$('input[type=checkbox]').css({'opacity': 0});
	// добавили обертку для элементов
	$('input[type=checkbox]').css({'opacity': 0}).wrap('<span class="wrap-checkbox"></span>');
	$('body').on('click', '.wrap-checkbox', function() {
	 	$(this).toggleClass('active'); /* переключатель класса .active */
	});


	var td_width = $(".page5_block1 .table-striped tr:not(:first-child) td:nth-child(2)").width();
	$(".page5_block1 .table-striped tr:not(:first-child) td:nth-child(2)").width(td_width+10);

	//$(".page5_block1 .table-striped tr:not(:first-child)").hover(function() {
	// 	$(this).find("div").addClass("triangle");
	// 	$(".page5_table2").css("display", "block");
	//}, function(){
	//	$(this).find("div").removeClass("triangle");
	//	$(".page5_table2").css("display", "none");
	//});

	//$(".page5_table3 table tr:not(:first-child)").hover(function() {
	//	$(this).find("td").css("border-top", "1px solid #595f65");
	//	$(this).find("td").css("border-bottom", "1px solid #595f65");
	//}, function(){
	//	$(this).find("td").css("border-top", '1px solid #222527');
	//	$(this).find("td").css("border-bottom", '1px solid #222527');
	//});

	$(".page5_table2").css("display", "block");
	// fix bottom
	var b = $('#equipment-table-left tbody').height();
	var fixBottom = b-24;
	$('.page5_table2 ').css('bottom', fixBottom+'px');

	$(".page5_table3 table tr:not(:first-child)").hover(function() {
		$(this).find("td").css("border-top", "1px solid #595f65");
		$(this).find("td").css("border-bottom", "1px solid #595f65");
	}, function(){
		$(this).find("td").css("border-top", '1px solid #222527');
		$(this).find("td").css("border-bottom", '1px solid #222527');
	});

	// default
	var default_id = $('#equipment-table-left tr:nth-child(2)').attr('id');
	$('#link1 a').attr('id', default_id);


	$('#equipment-table-left').on("click","tr",function(){
		// fix bottom
		var b = $('#equipment-table-left tbody').height();
		var fixBottom = b-24;
		$('.page5_table2 ').css('bottom', fixBottom+'px');
		// id
		var id = $(this).attr('rel');
		$.ajax({
			url:'engine/lib/ajaxControl.php',
			type:'POST',
			dataType:'json',
			data: {
				cl: 'passport',
				func: 'getDevices_by_id',
				id: id
			},
			success: function (data) {
				var parse = JSON.parse(data);
				var device = parse[0];
				$('#table2_ip').text(device.ip);
				$('#table2_sim').text(device.phone);
				$('#table2_id').text(device.id);
				$('#table2_period').text(device.period);
				$('#table2_last_connect').text(device.last_connect);
				$('#table2_sq').text(device.sq+'dbm');
				$('#table2_pv').text(device.pv+'V');
				$('#table2_ver').text(device.ver);
				$('#link1 a').attr('id', id);
			}
			,
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
			}
		});
	});

	// click delete from hub
	$('#link1').on("click","a",function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		var id_station = $('#equipment-table-left').attr('rel');

		$.ajax({
			url:'engine/lib/ajaxControl.php',
			type:'POST',
			dataType:'json',
			data: {
				cl: 'passport',
				func: 'delDeviceFromStation',
				id: id,
				id_station: id_station
			},
			success: function (data) {
				var parse = JSON.parse(data);
				$('#device'+id).remove();
				var gStyle = 'border-top: 1px solid rgb(34, 37, 39); border-bottom: 1px solid rgb(34, 37, 39);';
				$('#add_device_table tr:first').after('<tr id="add_device'+parse[0].id+'"><td style="'+gStyle+'">'+parse[0].id+'</td><td style="'+gStyle+'" id="imei'+parse[0].id+'">'+parse[0].imei+'</td><td style="'+gStyle+'">'+parse[0].phone+'</td><td style="'+gStyle+'">'+parse[0].id+'</td><td style="'+gStyle+'" id="checkfix"><span class="wrap-checkbox"><input style="opacity: 0;" rel="'+parse[0].id+'" name="itemSelect[]" type="checkbox"></span></td></tr>');


			}
			,
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
			}
		});
	});

	// checked = true
	$('input[type="checkbox"]').click(function(e){
		$(this).prop("checked", true);
	});

	// checked = false
	$('.active input[type="checkbox"]').click(function(e){
		$(this).prop("checked", false);
	});

	// save
	$('body').on("click","#save_link",function(e){
		//$('a#save_link').click(function(e){
		e.preventDefault();

		var id_station = $('#equipment-table-left').attr('rel');

		var selectedItems = new Array();
		$('.active*').find('input[type="checkbox"]:checked').each(function() {selectedItems.push($(this).attr('rel'));});

		$.ajax({
			url:'engine/lib/ajaxControl.php',
			type:'POST',
			dataType:'json',
			data: {
				cl: 'passport',
				func: 'addDeviceFromStation',
				id: selectedItems,
				id_station: id_station
			},
			success: function (data) {
				var parse = JSON.parse(data);

				for (var i = 0; i < parse.length; i++) {
					if(parse[i] != null){
						var imei = $('#imei'+parse[i]).text();
						$('#equipment-table-left tr:last-child ').after('<tr id="device'+parse[i]+'" rel="'+parse[i]+'"><td>'+parse[i]+'</td><td style="width: 675px;">'+imei+'<div></div></td></tr>');
						$('#add_device'+parse[i]).remove();
					}
					// fix bottom
					var b = $('#equipment-table-left tbody').height();
					var fixBottom = b-24;
					$('.page5_table2 ').css('bottom', fixBottom+'px');
				};
			}
			,
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
			}
		});

	});


});