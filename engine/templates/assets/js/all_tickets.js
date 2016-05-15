$(document).ready(function () {
	var myHeight = window.innerHeight - 80;
	$(".tickets_content").height(myHeight);
	var menu_btn_x_cord = $("#tickets_show_menu").offset().left;
	$(window).resize(function () {
		menu_btn_x_cord = $("#tickets_show_menu").offset().left;
		if ($(".tickets_menu").hasClass("tickets_active_menu")) {$(".tickets_menu").offset({left:menu_btn_x_cord-235})};
		myHeight = window.innerHeight - 80;
		$(".tickets_content").height(myHeight);
	});

	$("#tickets_show_menu").click(function () {
     	$(".tickets_menu").toggleClass("tickets_active_menu");
   		if ($(".tickets_menu").hasClass("tickets_active_menu")) {
   			$("#tickets_show_menu").attr("src", "/engine/templates/assets/img/close_menu.png");
			$(".tickets_menu").offset({left:menu_btn_x_cord-235});
   		}
		else{$("#tickets_show_menu").attr("src", "/engine/templates/assets/img/open_menu.png");}
    });

	$('.tickets_menu li').on('click', function () {
		$('.tickets_menu').removeClass('tickets_active_menu');
		$("#tickets_show_menu").attr("src", "/engine/templates/assets/img/open_menu.png");
	});
});