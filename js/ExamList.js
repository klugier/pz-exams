jQuery(document).ready(function($) {
	bootbox.setDefaults({ locale: "pl" });
	
	$("a[id^=row-delete-id-]").click(function() {
		var id       = $(this).attr("id");
		var examID   = id.slice(id.lastIndexOf("-") + 1, id.length);
		var examName = $("#row-name-id-" + examID).html();
		var rowID    = "#row-id-" + examID;
		
		bootbox.confirm("Czy na pewno chcesz usunąć następujący egzamin <b>\"" + examName + "\"</b>?", function(result) {
			if (result) {
				$.ajax({
					type: "POST",
					url:  "lib/Ajax/AjaxExamDeleteRequest.php",
					data: {
						ID : examID
					},
					success: function(data, status) {
						status = data.status.trim();
						
						if (status === "success") {
							$(rowID).hide("slow");
							// $(rowID).remove();
						}
						else if (status === "failed") {
							msg = data.errorMsg.trim();
							
							if (msg != null) {
								alert(msg);
							}
						}
					},
					error: function(xhr, textStatus, errorThrown) {
						alert("Nie udało się uruchomić zapytania Ajax.");
					}
				});
			}
		});
	});
	
	$("button[id^=row-activate-button-id-]").click(function() {
		var id = $(this).attr("id");
		
		if (currentStatus == -1 || currentStatus == 0) {
			if (activate(id))
				currentStatus = 1;
		}
		else {
			if (deactivate(id))
				currentStatus = 0;
		}
	});
	
	$("button[id^=row-deactivate-button-id-]").click(function() {
		var id = $(this).attr("id");
		
		if (currentStatus == -1 || currentStatus == 1) {
			if (deactivate(id))
				currentStatus = 0;
		}
		else {
			if (activate(id))
				currentStatus = 1;
		}
	});
	
	function activate(id) {
		var examID = id.slice(id.lastIndexOf("-") + 1, id.length);
		var successful = sendActivationRequest(examID, "activate");
		
		if (successful) {
			$("#" + id).attr("class", "btn btn-danger dropdown-toggle btn-sm");
			$("#" + id).html("<b>Dezaktywuj</b>");
			$("#row-activated-id-" + examID).html("<b style=\"color: #156815;\">Tak</b>");
		}
		
		return successful;
	}
	
	function deactivate(id) {
		var examID = id.slice(id.lastIndexOf("-") + 1, id.length);
		var successful = sendActivationRequest(examID, "deactivate");
		
		if (successful) {
			$("#" + id).attr("class", "btn btn-success dropdown-toggle btn-sm");
			$("#" + id).html("<b>Aktywuj</b>");
			$("#row-activated-id-" + examID).html("<b style=\"color: #801313;\">Nie</b>");
		}
		
		return successful;
	}
	
	function sendActivationRequest(examID, mode) {
		setSendActivationSuccess(false);
		
		$.ajax({
			type:  "POST",
			url:   "lib/Ajax/AjaxExamActivationRequest.php",
			async: false,
			data: {
				id : examID,
				mode : mode,
			},
			success: function(data, status) {
				status = data.status.trim();
				
				if (status != null) {
					if (status === "success") {
						setSendActivationSuccess(true);
					}
					else if (status === "failed") {
						msg = data.errorMsg.trim();
						
						if (msg != null) {
							alert(msg);
						}
					}
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Nie udało się uruchomić zapytania Ajax.");
			}
		});
		
		return ajaxSendActivationSuccess;
	}
	
	function setSendActivationSuccess(success) {
		ajaxSendActivationSuccess = success;
	}
	
	var currentStatus = -1;
	var ajaxSendActivationSuccess = false;
});
