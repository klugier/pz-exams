$(document).ready(function() {
	$(".panel-heading").click(function(){
		var elementID = $(this).attr("id");
		//var doc = document.getElementById("#b"+elementID);
		$("#b"+elementID).slideToggle();
	});
});