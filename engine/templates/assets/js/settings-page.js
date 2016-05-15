jQuery(document).ready(function($) {

	var min_temperature = $('#min_temperature').val();
	var max_temperature = $('#max_temperature').val();

	var min_visibility = $('#min_visibility').val();
	var max_visibility = $('#max_visibility').val();

	var min_coef_slipperiness = $('#min_coef_slipperiness').val();
	var max_coef_slipperiness = $('#max_coef_slipperiness').val();

	var min_temperature_coating = $('#min_temperature_coating').val();
	var max_temperature_coating = $('#max_temperature_coating').val();

	var min_wind_speed = $('#min_wind_speed').val();
	var max_wind_speed = $('#max_wind_speed').val();

	if(min_temperature == ""){ $('#min_temperature').val('0'); }
	if(max_temperature == ""){ $('#max_temperature').val('0'); }

	if(min_visibility == ""){ $('#min_visibility').val('0'); }
	if(max_visibility == ""){ $('#max_visibility').val('0'); }

	if(min_coef_slipperiness == ""){ $('#min_coef_slipperiness').val('0'); }
	if(max_coef_slipperiness == ""){ $('#max_coef_slipperiness').val('0'); }

	if(min_temperature_coating == ""){ $('#min_temperature_coating').val('0'); }
	if(max_temperature_coating == ""){ $('#max_temperature_coating').val('0'); }

	if(min_wind_speed == ""){ $('#min_wind_speed').val('0'); }
	if(max_wind_speed == ""){ $('#max_wind_speed').val('0'); }

	// get value
	$('area').click(function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		$('#save').attr('rel', id);
		$('#radio-setting-page*').parent("div").find('input[type="radio"]').prop("checked", false).removeClass('radio-setting-active');

		$.ajax({
	        url:'engine/lib/ajaxControl.php',
	        type:'POST',
	        dataType:'json',
	        data: {
	            cl: 'admin',
				func: 'showRegion',
				id: id
	        },
	        success: function (data) {
	        	// alert($('.radio-setting-active').val());

				var parse = JSON.parse('[' + data + ']');
				var region = parse[0];
				if(region.brightness == 0){
					$('#radio-setting-page').parent("div").find('input[type="radio"]').css('top', '216px').prop("checked", true).addClass('radio-setting-active');
				}else{
					$('.bright-bottom').find('input[value="'+region.brightness+'"]').css('top', '216px').prop("checked", true).addClass('radio-setting-active');
				}
				// block top
	        	$('#show_min_temperature').text(region.min_temperature);
	        	$('#show_max_temperature').text(region.max_temperature);
	        	$('#show_min_visibility').text(region.min_visibility+'m');
	        	$('#show_max_visibility').text(region.max_visibility+'m');
	        	$('#show_min_coef_slipperiness').text(region.min_coef_slipperiness);
	        	$('#show_max_coef_slipperiness').text(region.max_coef_slipperiness);
	        	$('#show_min_temperature_coating').text(region.min_temperature_coating);
	        	$('#show_max_temperature_coating').text(region.max_temperature_coating);
	        	$('#show_min_wind_speed').text(region.min_wind_speed);
	        	$('#show_max_wind_speed').text(region.max_wind_speed);
	        	// block bottom
	        	$('#min_temperature').val(region.min_temperature);
	        	$('#max_temperature').val(region.max_temperature);
	        	$('#min_visibility').val(region.min_visibility);
	        	$('#max_visibility').val(region.max_visibility);
	        	$('#min_coef_slipperiness').val(region.min_coef_slipperiness);
	        	$('#max_coef_slipperiness').val(region.max_coef_slipperiness);
	        	$('#min_temperature_coating').val(region.min_temperature_coating);
	        	$('#max_temperature_coating').val(region.max_temperature_coating);
	        	$('#min_wind_speed').val(region.min_wind_speed);
	        	$('#max_wind_speed').val(region.max_wind_speed);
	        },
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
			}
	    });

	});


	// save value
	$('#save').click(function(e){	
		e.preventDefault();
		var id = $(this).attr('rel');

		var min_temperature = $('#min_temperature').val();
		var max_temperature = $('#max_temperature').val();

		var min_visibility = $('#min_visibility').val();
		var max_visibility = $('#max_visibility').val();

		var min_coef_slipperiness = $('#min_coef_slipperiness').val();
		var max_coef_slipperiness = $('#max_coef_slipperiness').val();

		var min_temperature_coating = $('#min_temperature_coating').val();
		var max_temperature_coating = $('#max_temperature_coating').val();

		var min_wind_speed = $('#min_wind_speed').val();
		var max_wind_speed = $('#max_wind_speed').val();

		var brightness = $('.radio-setting-active').val();

		$.ajax({
	        url:'engine/lib/ajaxControl.php',
	        type:'POST',
	        dataType:'json',
	        data: {
	            cl: 'admin',
				func: 'updateRegions',
				id: id, 
				min_temperature: min_temperature, 
				max_temperature: max_temperature, 
				min_visibility: min_visibility, 
				max_visibility: max_visibility, 
				min_coef_slipperiness: min_coef_slipperiness, 
				max_coef_slipperiness: max_coef_slipperiness, 
				min_temperature_coating: min_temperature_coating, 
				max_temperature_coating: max_temperature_coating, 
				min_wind_speed: min_wind_speed, 
				max_wind_speed: max_wind_speed,
				brightness: brightness
	        },
	        success: function (data) {
	        	$('#show_min_temperature').text(min_temperature);
	        	$('#show_max_temperature').text(max_temperature);
	        	$('#show_min_visibility').text(min_visibility+'m');
	        	$('#show_max_visibility').text(max_visibility+'m');
	        	$('#show_min_coef_slipperiness').text(min_coef_slipperiness);
	        	$('#show_max_coef_slipperiness').text(max_coef_slipperiness);
	        	$('#show_min_temperature_coating').text(min_temperature_coating);
	        	$('#show_max_temperature_coating').text(max_temperature_coating);
	        	$('#show_min_wind_speed').text(min_wind_speed);
	        	$('#show_max_wind_speed').text(max_wind_speed);
	        },
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.responseText + '. ERRORS: ' + errorThrown );
			}
	    });
	});

	// radio value
	$('#radio-setting-page*').click(function(e){	
		e.preventDefault();
		$('#radio-setting-page*').parent("div").find('input[type="radio"]').prop("checked", false).removeClass('radio-setting-active');
		$(this).parent("div").find('input[type="radio"]').css('top', '216px').prop("checked", true).addClass('radio-setting-active');
	});
});