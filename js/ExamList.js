jQuery(document).ready(function($) {
    $("a[id^=row-delete-id-]").click(function() {
		var id    = $(this).attr("id");
		var examID = id.slice(id.lastIndexOf("-") + 1, id.length);
		var rowID  = "#row-id-" + examID;
		
		// TODO: Powinno być zapytanie ajax.
		
		$(rowID).hide("slow");
		// $(rowID).remove();
	});
	
	$("button[id^=row-activate-button-id-]").click(function() {
		var id = $(this).attr("id");
		
		if (currentStatus == -1 || currentStatus == 0) {
			activate(id);
			currentStatus = 1;
		}
		else {
			deactivate(id);
			currentStatus = 0;
		}
	});
	
	$("button[id^=row-deactivate-button-id-]").click(function() {
		var id = $(this).attr("id");
		
		if (currentStatus == -1 || currentStatus == 1) {
			deactivate(id);
			currentStatus = 0;
		}
		else {
			activate(id);
			currentStatus = 1;
		}
	});
	
	function activate(id) {
		var examID = id.slice(id.lastIndexOf("-") + 1, id.length);
		
		$("#" + id).attr("class", "btn btn-danger dropdown-toggle btn-sm");
		$("#" + id).html("<b>Dezaktywuj</b>");
		$("#row-activated-id-" + examID).html("<b style=\"color: #801313;\">Nie</b>");
	}
	
	function deactivate(id) {
		var examID = id.slice(id.lastIndexOf("-") + 1, id.length);
		
		$("#" + id).attr("class", "btn btn-success dropdown-toggle btn-sm");
		$("#" + id).html("<b>Aktywuj</b>");
		$("#row-activated-id-" + examID).html("<b style=\"color: #156815;\">Tak</b>");
	}
	
	var currentStatus = -1;
});
