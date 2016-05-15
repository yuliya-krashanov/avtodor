$( document ).ready(function() {
	meteoTime();
	setInterval(meteoTime, 600000);
	function search(){
		var search_query = $("#search_field").val()
		search_query = search_query.toLowerCase()
		if(search_query.length > 2){
			$(".active_now_table tr td:first-child").each(function(){
				var str = $(this).html();
				str = str.toLowerCase()
				if (!(str.indexOf(search_query) + 1)) {$(this).parent().hide()}
				else{$(this).parent().show()}
			})
		}		
		if(search_query.length == 0){
			$(".active_now_table tr td:first-child").each(function(){
				$(this).parent().show()
			})
		}	
	}
	$("input[name=search]").on("change", function(){
		search();
	})
	$(".glyphicon-search").on("click", function(){
		search();
	})
})